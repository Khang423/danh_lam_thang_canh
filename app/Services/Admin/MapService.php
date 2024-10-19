<?php 

namespace App\Services\Admin;

use App\Models\Location;
use App\Models\TouristAttraction;

class MapService
{
    public function store($request)
    {
        return Location::create([
            'longtitude' => $request->longtitude,
            'latitude' => $request->latitude,
            'address' => $request->address,
        ]);
    }
}