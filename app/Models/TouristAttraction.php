<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristAttraction extends Model
{
    use HasFactory;

    protected $table = 'tourist_attractions';
    protected $fillable = [
        'id ',
        'name',
        'description',
        'address',
        'image_id',
        'review_id',
        'latitude',
        'longtitude',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id',
            'name',
            'description',
            'address',
            'image_id',
            'review_id',
            'latitude',
            'longtitude',
            'created_at',
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
