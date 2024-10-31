<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\Admin\BillService;
use App\Services\Admin\BookingService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BillController extends Controller
{
    use ResponseTrait;
    public BillService $billService;

    public function __construct(BillService $billService)
    {
        $this->billService = $billService;
    }
    public function index()
    {
        return view('admin.bill');
    }

    public function getList()
    {
        $book = $this->billService->getList();

        return DataTables::of($book)
        ->editColumn('user_id', function ($item) {
            return $item->customer->name;
        })
        ->editColumn('status', function ($item) {
            return $item->status === 1 ? 'Chưa duyệt' : 'Đã duyệt ';
        })
        ->editColumn('location_id', function ($item) {
            return $item->location->name;
        })
            ->editColumn('action', function ($item) {
                return "
                <a
                    data-id='{$item->id}'
                    href='javascript:void(0);'
                    class='action-icon btn-detail'
                    id='btn-detail'
                    data-bs-toggle='modal'
                    data-bs-target='#modal-detail'
                >
                    <i class='uil-eye'></i>
                </a>
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
        $result = $this->billService->store($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function update(Request $request)
    {
        $result = $this->billService->update($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function delete(Request $request)
    {
        $result = $this->billService->delete($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

}
