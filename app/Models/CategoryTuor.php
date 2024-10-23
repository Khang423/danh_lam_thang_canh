<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTuor extends Model
{
    use HasFactory;

    protected $table = 'category_tuor';
    protected $fillable = [
        'id ',
        'name',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id',
            'name',
            'created_at',
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function tour()
    {
        return $this->hasMany(Tour::class, 'tour_id', 'id');
    }
}
