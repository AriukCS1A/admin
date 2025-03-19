<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemoryGameImages extends Model
{
    use HasFactory;

    protected $table = 'memory_game_images'; // Хүснэгтийн нэрийг зөв эсэхийг шалгаарай

    // Бөглөх боломжтой баганууд
    protected $fillable = [
        'image_url',
        'product_name',
        'created_at'
    ];

    public $timestamps = false; // created_at, updated_at баганыг ашиглахгүй бол false
}
