<?php

namespace App\Services\Admin;

use App\Models\Tour;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class TourService
{
    use ImageTrait;
    public function getList()
    {
        return Tour::select(Tour::getSelectAttribute())->get();
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $create_img = $this->storeImage($request->file('tour_image'), 'tour');
            Tour::create([
                'image' => $create_img['url'],
                'short_description' => $request->short_description,
                'name' => $request->name,
                'category_id' => $request->category_id,
                'price' => $request->price,
            ]);
            DB::commit();
            return true;
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
            return false;
        }
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $tour = Tour::find($request->id);
            $tour->name = $request->name;
            $tour->short_description = $request->short_description;
            $tour->price = $request->price;
            $tour->category_id = $request->category_id;

            if ($request->file('tour_image')) {
                if ($tour->image) {
                    $this->deleteImage($request->tour_image);
                }
                $upLoadFile = $this->storeImage($request->file('tour_image'), 'tour');
                $tour->image = $upLoadFile['url'];
            }

            DB::commit();

            return $tour->save();
        } catch (Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return false;
        }
    }

    public function delete($request)
    {
        $location = Tour::find($request->id);
        $location->delete();

        return true;
    }
}
