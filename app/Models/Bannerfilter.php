<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bannerfilter extends Model
{
    use HasFactory;

    protected $table = 'bannerfilter'; 
   

    protected $fillable = [
        'banner_id',       
        'storyfilter_id',     
            
    ];

    public $timestamps = false; 

    public function banner()
    {
        return $this->belongsTo(\App\Models\Banner::class);
    }

    // Reward загварын харилцаа
    public function storyfilter()
    {
        return $this->belongsTo(\App\Models\Storyfilter::class);
    }
}
