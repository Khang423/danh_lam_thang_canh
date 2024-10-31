<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'id',
        'name',
        'tel',
        'gmail',
        'address',
        'created_at'
    ];

    public static function getSelectAttribute()
    {
        return [
            'id',
            'name',
            'tel',
            'gmail',
            'address',
            'created_at'
        ];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function bill()
    {
        return $this->hasMany(Bill::class, 'bill_id', 'id');
    }
}
