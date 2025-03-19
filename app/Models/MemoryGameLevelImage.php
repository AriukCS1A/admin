<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoryGameLevelImage extends Model
{
    use HasFactory;

    protected $table = 'memory_game_level_images';  

    protected $fillable = [
        'level_id',       
        'image_id',         
    ];

    public $timestamps = false; 

    public function level()
    {
        return $this->belongsTo(\App\Models\Level::class, 'level_id');
    }

    // Reward загварын харилцаа
    public function memorygameimage()
    {
        return $this->belongsTo(\App\Models\MemoryGameImages::class, 'level_id');
    }
}
