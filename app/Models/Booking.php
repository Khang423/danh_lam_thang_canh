<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    protected $fillable = [
        'id',
        'tuors_id',
        'location_id',
        'user_id',
        'booking_date',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id',
            'tuors_id',
            'location_id',
            'user_id',
            'booking_date',
            'created_at'
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tuors_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
