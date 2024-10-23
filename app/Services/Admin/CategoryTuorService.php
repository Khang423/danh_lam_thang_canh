<?php

namespace App\Services\Admin;

use App\Models\CategoryTuor;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class CategoryTuorService
{
    use ImageTrait;
    public function getList()
    {
        return CategoryTuor::select(CategoryTuor::getSelectAttribute())->get();
    }
    public function store($request)
    {
        CategoryTuor::create([
            'name' => $request->name,
        ]);

        return true;
    }

    public function update($request)
    {
        $location = CategoryTuor::find($request->id);
        $location->name = $request->name;

        return $location->save();
    }

    public function delete($request)
    {
        $location = CategoryTuor::find($request->id);
        $location->delete();

        return true;
    }
}
