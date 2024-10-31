<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Booking;
use App\Models\DetailBill;
use App\Models\Invoice;
use App\Models\Location;
use App\Models\Tour;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $sumTour = Tour::get()->count(); 
        $sumLocation = Location::get()->count();
        $sumBooking = Bill::get()->count();
        $totalAmount = number_format(DetailBill::sum('price'), 0, ',', '.') . ' VNĐ';   
        return view('admin.dashboard' ,[
            'sumTour' => $sumTour,
            'sumLocation' => $sumLocation,
            'sumBooking' => $sumBooking,
            'totalAmount' => $totalAmount
        ]);
    }
}
