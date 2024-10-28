<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Services\Admin\LocationService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LocationController extends Controller
{
    use ResponseTrait;
    public LocationService $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }
    public function index()
    {
        return view('admin.list-location');
    }

    public function getList()
    {
        $location = $this->locationService->getList();

        return DataTables::of($location)
            ->editColumn('image', function ($item) {
                $image = asset($item->image);
                return "<div>
                    <img src='{$image}' style='width:200px;height:150px;border-radius:5px;'  loading='lazy'/>
                </div>";
                })
            ->editColumn('action', function ($item) {
                return "
                <a
                    data-id='{$item->id}'
                    href='javascript:void(0);'
                    class='action-icon btn-update'
                    id='btn-update'
                    data-bs-toggle='modal'
                    data-bs-target='#modal-update'
                >
                    <i class='mdi mdi-square-edit-outline'></i>
                </a>
                <a
                    data-id='{$item->id}'
                    href='javascript:void(0);'
                    class='action-icon btn-delete'
                    data-bs-toggle='modal'
                    data-bs-target='#modal-delete'
                >
                    <i class='mdi mdi-delete'></i>
                </a>
            ";
            })
            ->rawColumns(['action','image'])
            ->make();
    }

    public function store(Request $request)
    {
        $result = $this->locationService->store($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function update(Request $request)
    {

        $result = $this->locationService->update($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function delete(Request $request)
    {
        $result = $this->locationService->delete($request);
        
        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function getDataForUpdate(Request $request) 
    {
        $id = $request->id;
        $data = Location::select(Location::getSelectAttribute())->where('id',$id)->get();

        return response()->json(['data' => $data]);
    }

    public function getAlldata()
    {
        $result = Location::select(Location::getSelectAttribute())->get();
        
        return response()->json($result);
    }
}
