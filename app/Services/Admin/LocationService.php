<?php 

namespace App\Services\Admin;
use App\Models\TouristAttraction;

class LocationService
{
    public function getList(){
        return TouristAttraction::select(TouristAttraction::getSelectAttribute())->get();
    }
    public function store($request)
    {
        return TouristAttraction::create([
            'longtitude' => $request->longtitude,
            'latitude' => $request->latitude,
            'address' => $request->address,
        ]);
    }

    public function delete($request)
    {
        $location = TouristAttraction::find($request->id);
        $location->delete();

        return true;
    }
}