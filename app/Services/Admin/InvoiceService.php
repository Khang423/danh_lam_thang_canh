<?php

namespace App\Services\Admin;

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
        return Invoice::select(Invoice::getSelectAttribute())->get();
    }
    
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $create_img = $this->storeImage($request->file('Invoice_image'), 'Invoice');
            Invoice::create([
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
        $Invoice = Invoice::find($request->id);
        $Invoice->name = $request->name;
        $Invoice->description = $request->description;
        $Invoice->latitude = $request->latitude;
        $Invoice->longtitude = $request->longtitude;
        $Invoice->address = $request->address;

        if($request->file('Invoice_image'))
        {
            if($Invoice->image)
            {
                $this->deleteImage($request->Invoice_image);
            }
            $upLoadFile = $this->storeImage($request->file('Invoice_image'), 'Invoice');
            $Invoice->image = $upLoadFile['url'];
        }
        
        return $Invoice->save();
    }

    public function delete($request)
    {
        $Invoice = Invoice::find($request->id);
        $Invoice->delete();

        return true;
    }
}
