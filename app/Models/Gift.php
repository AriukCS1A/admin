<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $table = 'gift'; 
    protected $primaryKey = 'giftId'; 
    public $incrementing = true; 
    protected $keyType = 'int'; 

    protected $fillable = [
        'baby_id',       
        'reward_id',     
        'grantedAt',    
    ];

    public $timestamps = false; 

    public function baby()
    {
        return $this->belongsTo(\App\Models\Baby::class, 'baby_id');
    }

    // Reward загварын харилцаа
    public function reward()
    {
        return $this->belongsTo(\App\Models\Reward::class, 'reward_id');
    }
}
