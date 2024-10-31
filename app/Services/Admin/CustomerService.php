<?php

namespace App\Services\Admin;

use App\Models\CategoryTour;
use App\Models\CategoryTuor;
use App\Models\Customer;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CustomerService
{
    use ImageTrait;
    public function getList()
    {
        return Customer::select(Customer::getSelectAttribute())->get();
    }
    public function store($request)
    {
        Customer::create([
            'name' => $request->name,
            'short_description' => $request->short_description
        ]);

        return true;
    }

    public function update($request)
    {
        $location = Customer::find($request->id);
        $location->name = $request->name;
        $location->short_description = $request->short_description;

        return $location->save();
    }

    public function delete($request)
    {
        $location = Customer::find($request->id);
        $location->delete();

        return true;
    }
}
