<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Reward;
class Baby extends Model
{
    use HasFactory;

    protected $table = 'baby';
    protected $primaryKey = 'babyId';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'babyName',
        'gender',
        'register',
        'bDay',
        'user_id'
    ];

    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

     public function rewards()
    {
        return $this->belongsToMany(\App\Models\Reward::class, 'gift', 'baby_id', 'reward_id')
        ->withPivot('grantedAt')
        ->withTimestamps();
    }

}
