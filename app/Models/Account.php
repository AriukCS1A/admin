<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'account'; // Хүснэгтийн нэр
    protected $primaryKey = 'accId';
    protected $fillable = [
        'user_id',
        'level_id',
        'accountNum',
        'totalAdd',
        'totalSub',
        'balance',
        'createTime',
        'updateTime',
    ];
    public $timestamps = false;

    // `users` хүснэгттэй холбох гадаад түлхүүрийн харьцаа
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function level()
    {
        return $this->belongsTo(\App\Models\Level::class);
    }
}
