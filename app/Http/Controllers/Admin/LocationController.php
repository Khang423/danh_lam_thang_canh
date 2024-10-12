<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
            ->editColumn('action', function ($item) {
                return ("
                <a  
                    data-id='{$item->id}'
                    href='javascript:void(0);'
                    class='action-icon btn-update' 
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
            ");
            })
            ->rawColumns(['action'])
            ->make();
    }

    public function delete(Request $request) 
    {
        $result = $this->locationService->delete($request);
        if($result == true)
        {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();

    }
}
