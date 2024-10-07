<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TouristAttraction;
use App\Services\Admin\MapService;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public MapService $mapService;
    
    public function __construct(MapService $mapService){
        $this->mapService = $mapService;
    }
    public function index() 
    {
        return view('admin.map');
    }

    public function getData()
    {
        $location = TouristAttraction::all()->toArray();
        return response()->json($location);
    }

    public function store(Request $request)
    {
        $this->mapService->store($request);
    }
}
