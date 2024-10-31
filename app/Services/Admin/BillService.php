<?php

namespace App\Services\Admin;

use App\Models\Bill;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\DetailBill;
use App\Models\Tour;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BillService
{
    use ImageTrait;
    public function getList()
    {
        return Bill::select(Bill::getSelectAttribute())->get();
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $tour_id = $request->tours_id;
            $total = Tour::where('id', $tour_id)->value('price');
            $fomatTotal = str_replace('.', '', $total);

            Customer::create([
                'name' => $request->name,
                'tel' => $request->tel,
                'gmail' => $request->gmail,
                'address' => $request->address,
            ]);

            $customer_id = Customer::max('id');
            Bill::create([
                'user_id' => Auth::user()->id,
                'customer_id' => $customer_id,
                'location_id' => $request->location_id,
                'total' => $fomatTotal,
                'status' => 1,
                'comment' => $request->comment,
            ]);

            $bill_id = Bill::max('id');
            DetailBill::create([
                'bill_id' => $bill_id,
                'tour_id' => $tour_id,
                'price' => $fomatTotal,
            ]);
            DB::commit();
            return true;
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function update($request)
    {
        return true;
    }

    public function delete($request)
    {
        $bill = Bill::find($request->id);
        $bill->delete();

        return true;
    }
}
