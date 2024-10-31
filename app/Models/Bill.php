<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';
    protected $fillable = ['id', 'location_id', 'user_id', 'customer_id', 'total', 'status', 'comment', 'created_at'];

    public static function getSelectAttribute()
    {
        return ['id', 'location_id', 'user_id', 'customer_id', 'total', 'status', 'comment', 'created_at'];
    }
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    public function detail_bill()
    {
        return $this->hasMany(DetailBill::class, 'detail_bill_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
