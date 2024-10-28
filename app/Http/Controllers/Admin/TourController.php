<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Services\Admin\TourService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TourController extends Controller
{
    use ResponseTrait;
    public TourService $tourService;

    public function __construct(TourService $tourService)
    {
        $this->tourService = $tourService;
    }

    public function index()
    {
        return view('admin.tour');
    }

    public function getList()
    {
        $categoryTuor = $this->tourService->getList();

        return DataTables::of($categoryTuor)->with('category-tour')
            ->editColumn('image', function ($item) {
                $image = asset($item->image);
                return "<div>
                <img src='{$image}' style='width:200px;height:150px;border-radius:5px'  loading='lazy'/>
            </div>";
            })
            ->editColumn('price', function ($item) {
                return number_format($item->price, 0, '', ',') . ' VND';
            })
            ->editColumn('category_id', function ($item) {
                return $item->category_tour->name;
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
            ->rawColumns(['action', 'image', 'category_id'])
            ->make();
    }

    public function store(Request $request)
    {
        $result = $this->tourService->store($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function update(Request $request)
    {
        $result = $this->tourService->update($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function delete(Request $request)
    {
        $result = $this->tourService->delete($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function getDataForUpdate(Request $request) 
    {
        $id = $request->id;
        $data = Tour::select(Tour::getSelectAttribute())->where('id',$id)->get();

        return response()->json(['data' => $data]);
    }

    public function getAlldata()
    {
        $result = Tour::select(Tour::getSelectAttribute())->get();

        return response()->json($result);
    }
}
