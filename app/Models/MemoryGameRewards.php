<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class MemoryGameRewards extends Model
{
    use HasFactory;

    protected $table = 'memory_game_rewards';
    protected $fillable = [
        'level_id',
        'reward_type',
        'reward_product_id',
        'reward_points',
        'max_winners_per_month',
        'created_at'
    ];
    public $timestamps = false;

    public function level()
    {
        return $this->belongsTo(\App\Models\Level::class);
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Products::class);
    }
}
