<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationImage extends Model
{
    use HasFactory;

    protected $table = 'location_images';
    protected $fillable = [
        'id ',
        'url',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id ',
            'url',
            'created_at'
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

}
