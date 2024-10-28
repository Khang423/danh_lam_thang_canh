<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';
    protected $fillable = [
        'id',
        'booking_id',
        'invoice_date',
        'tatol_amount',
        'status',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id',
            'booking_id',
            'invoice_date',
            'tatol_amount',
            'status',
            'created_at'
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
