<?php

namespace App\Services\Admin;

use App\Models\Location;
use App\Models\TouristAttraction;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class LocationService
{
    use ImageTrait;
    public function getList()
    {
        return Location::select(Location::getSelectAttribute())->get();
    }
    public function store($request)
    {   
        DB::beginTransaction();
        try {
            $create_img = $this->storeImage($request->file('location_image'), 'location');
            Location::create([
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
        $location = Location::find($request->id);
        $location->name = $request->name;
        $location->description = $request->description;
        $location->latitude = $request->latitude;
        $location->longtitude = $request->longtitude;
        $location->address = $request->address;

        if($request->file('location_image'))
        {
            if($location->image)
            {
                $this->deleteImage($request->location_image);
            }
            $upLoadFile = $this->storeImage($request->file('location_image'), 'location');
            $location->image = $upLoadFile['url'];
        }
        
        return $location->save();
    }

    public function delete($request)
    {
        $location = Location::find($request->id);
        $location->delete();

        return true;
    }
}
