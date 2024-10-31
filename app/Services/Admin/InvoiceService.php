<?php

namespace App\Services\Admin;

use App\Models\DetailBill;
use App\Models\Invoice;
use App\Models\TouristAttraction;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class InvoiceService
{
    use ImageTrait;
    public function getList()
    {
        return DetailBill::select(DetailBill::getSelectAttribute())->get();
    }
    
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $create_img = $this->storeImage($request->file('Invoice_image'), 'Invoice');
            DetailBill::create([
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
        $detail_bill = DetailBill::find($request->id);
        $detail_bill->name = $request->name;
        $detail_bill->description = $request->description;
        $detail_bill->latitude = $request->latitude;
        $detail_bill->longtitude = $request->longtitude;
        $detail_bill->address = $request->address;

        if($request->file('Invoice_image'))
        {
            if($detail_bill->image)
            {
                $this->deleteImage($request->Invoice_image);
            }
            $upLoadFile = $this->storeImage($request->file('Invoice_image'), 'Invoice');
            $detail_bill->image = $upLoadFile['url'];
        }
        
        return $detail_bill->save();
    }

    public function delete($request)
    {
        $detail_bill = DetailBill::find($request->id);
        $detail_bill->delete();

        return true;
    }
}
