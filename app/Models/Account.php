<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Points;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account';

    protected $fillable = [
        'accountNum',
        'totalAdd',
        'totalSub',
        'balance',
        'user_id', // user_id талбарыг энд оруулж байгаа эсэхээ шалгана уу.
    ];

    const CREATED_AT = 'createTime';
    const UPDATED_AT = 'updateTime';

    // User загвартай харилцаа (relationship) тодорхойлох
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function points()
    {
        return $this->hasMany(\App\Models\Points::class, 'user_id', 'user_id');
    }
}
