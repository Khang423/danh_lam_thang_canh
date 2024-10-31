<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\DetailBill;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use App\Services\Admin\InvoiceService;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DetailBillController extends Controller
{
    use ResponseTrait;
    public InvoiceService $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }
    public function index()
    {
        return view('admin.detail-bill');
    }

    public function getList()
    {
        $Invoice = $this->invoiceService->getList();

        return DataTables::of($Invoice)
            ->editColumn('booking_id', function ($item) {
                return $item->booking->user->full_name;
            })
            ->editColumn('tour_id', function ($item) {
                return $item->booking->tour->name;
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
        $result = $this->invoiceService->store($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function update(Request $request)
    {
        $result = $this->invoiceService->update($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function delete(Request $request)
    {
        $result = $this->invoiceService->delete($request);

        if ($result == true) {
            return $this->responseDataSuccess($result);
        }

        return $this->responseMessageBadrequest();
    }

    public function getDataForUpdate(Request $request)
    {
        $id = $request->id;
        $data = DetailBill::select('tours.name','tours.price')
        ->join('tours','bill_details.tour_id','=','tours.id')
        ->where('bill_details.bill_id', $id)
        ->get();

        return response()->json(['data' => $data]);
    }

    public function getDataForChart()
    {
        $result = Bill::select(Bill::raw('DATE(created_at) as date'), Bill::raw('SUM(total) as total'))
        ->groupBy(Bill::raw('DATE(created_at)'))->get();

        return response()->json($result);
    }

    public function searchChart(Request $request)
    {
        $startDateString = $request->fromday;
        $endDateString = $request->today;

        $startDate = Carbon::createFromFormat('d/m/Y', $startDateString)->format('Y-m-d');
        $endDate = Carbon::createFromFormat('d/m/Y', $endDateString)->format('Y-m-d');
        
        $result2 = Bill::select('tours.name', Bill::raw('SUM(bills.total) as total'))
            ->join('locations', 'locations.id', '=', 'bills.location_id')
            ->join('bill_details', 'bill_details.bill_id', '=', 'bills.id')
            ->join('tours', 'bill_details.tour_id', '=', 'tours.id')
            ->where('bills.status', '1')
            ->whereBetween('bills.created_at', [$startDate, $endDate])
            ->groupBy('tours.name')
            ->havingRaw('total > 0')
            ->get();    
        
        return response()->json($result2);
    }
}
