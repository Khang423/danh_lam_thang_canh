<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $table = 'tours';
    protected $fillable = [
        'id',
        'name',
        'short_description',
        'image',
        'price',
        'location_id',
        'category_id',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id',
            'name',
            'short_description',
            'image',
            'price',
            'location_id',
            'category_id',
            'created_at'
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function category_tour()
    {
        return $this->belongsTo(CategoryTour::class, 'category_id');
    }
    
    public function detail_bill()
    {
        return $this->hasMany(DetailBill::class, 'detail_bill_id', 'id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
