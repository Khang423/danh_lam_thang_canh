<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\TouristAttraction;
use App\Services\Admin\MapService;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public MapService $mapService;

    public function __construct(MapService $mapService)
    {
        $this->mapService = $mapService;
    }
    public function index()
    {
        return view('admin.map');
    }

    public function getAllLocation()
    {
        $location = Location::all()->toArray();
        return response()->json($location);
    }

    public function store(Request $request)
    {
        $this->mapService->store($request);

        return true;
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $result = Location::select(Location::getSelectAttribute())
            ->where('name', 'like', '%' . $q . '%')
            ->get();

        return response()->json($result);
    }
}
