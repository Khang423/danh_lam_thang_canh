<?php

namespace App\Services\Admin;

use App\Models\Booking;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class BookingService
{
    use ImageTrait;
    public function getList()
    {
        return Booking::select(Booking::getSelectAttribute())->get();
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $create_img = $this->storeImage($request->file('Booking_image'), 'Booking');
            Booking::create([
                'longtitude' => $request->longtitude,
                'latitude' => $request->latitude,
                'address' => $request->address,
                'image' => $create_img['url'],
                'description' => $request->description,
                'name' => $request->name,
            ]);
            DB::commit();
            return true;
        }catch (Throwable $th)
        {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function update($request)
    {  
        $Booking = Booking::find($request->id);
        $Booking->name = $request->name;
        $Booking->description = $request->description;
        $Booking->latitude = $request->latitude;
        $Booking->longtitude = $request->longtitude;
        $Booking->address = $request->address;

        if($request->file('Booking_image'))
        {
            if($Booking->image)
            {
                $this->deleteImage($request->Booking_image);
            }
            $upLoadFile = $this->storeImage($request->file('Booking_image'), 'Booking');
            $Booking->image = $upLoadFile['url'];
        }
        
        return $Booking->save();
    }

    public function delete($request)
    {
        $Booking = Booking::find($request->id);
        $Booking->delete();

        return true;
    }
}
