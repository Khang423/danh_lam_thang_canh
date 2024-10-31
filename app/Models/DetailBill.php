<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBill extends Model
{
    use HasFactory;

    protected $table = 'bill_details';
    protected $fillable = [
        'id',
        'bill_id',
        'tour_id',
        'price',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id',
            'bill_id',
            'tour_id',
            'price',
            'created_at'
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }
}
