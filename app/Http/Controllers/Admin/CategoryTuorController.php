<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryTuor;
use App\Services\Admin\CategoryTuorService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryTuorController extends Controller
{
    use ResponseTrait;
    public CategoryTuorService $categoryService;

    public function __construct(CategoryTuorService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('admin.category');
    }

    public function getList()
    {
        $categoryTuor = $this->categoryService->getList();

        return DataTables::of($categoryTuor)
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
            ->rawColumns(['action', 'image'])
            ->make();
    }

    public function store(Request $request)
    {
        $result = $this->categoryService->store($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function update(Request $request)
    {
        $result = $this->categoryService->update($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function delete(Request $request)
    {
        $result = $this->categoryService->delete($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function getAlldata()
    {
        $result = CategoryTuor::select(CategoryTuor::getSelectAttribute())->get();

        return response()->json($result);
    }
}
