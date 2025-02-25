<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons'; // Хүснэгтийн нэр
    protected $primaryKey = 'couponId';
    protected $fillable = [
        'user_id',
        'discount_percent',
        'is_used',
        'created_at'
    ];
    public $timestamps = false;

    // `users` хүснэгттэй холбох гадаад түлхүүрийн харьцаа
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
