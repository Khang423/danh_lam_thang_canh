<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Services\Admin\BookingService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BookingController extends Controller
{
    use ResponseTrait;
    public BookingService $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    public function index()
    {
        return view('admin.booking');
    }

    public function getList()
    {
        $book = $this->bookingService->getList();

        return DataTables::of($book)
        ->editColumn('user_id', function ($item) {
            return $item->user->full_name;
        })
        ->editColumn('tuors_id', function ($item) {
            return $item->tour->name;
        })
        ->editColumn('location_id', function ($item) {
            return $item->location->name;
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
            ->rawColumns(['action', 'image'])
            ->make();
    }

    public function store(Request $request)
    {
        $result = $this->bookingService->store($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function update(Request $request)
    {
        $result = $this->bookingService->update($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function delete(Request $request)
    {
        $result = $this->bookingService->delete($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

}
