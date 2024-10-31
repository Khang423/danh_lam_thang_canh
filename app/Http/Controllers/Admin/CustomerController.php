<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Services\Admin\CustomerService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    use ResponseTrait;
    public CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function getAllData()
    {
        $result = Customer::select(Customer::getSelectAttribute())->get();

        return response()->json($result);
    }

    public function index()
    {
        return view('admin.customer');
    }

    public function getList()
    {
        $customer = $this->customerService->getList();

        return DataTables::of($customer)
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
        $result = $this->customerService->store($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function update(Request $request)
    {
        $result = $this->customerService->update($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function delete(Request $request)
    {
        $result = $this->customerService->delete($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }
}
