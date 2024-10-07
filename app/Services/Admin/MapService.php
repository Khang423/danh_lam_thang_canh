<?php 

namespace App\Services\Admin;
use App\Models\TouristAttraction;

class MapService
{
    public function store($request)
    {
        return TouristAttraction::create([
            'longtitude' => $request->longtitude,
            'latitude' => $request->latitude,
            'address' => $request->address,
        ]);
    }
}