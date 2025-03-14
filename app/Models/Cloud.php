<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Cloud extends Model
{
    protected $table = 'cloud';

    protected $fillable = [
        'pic',
    ];

    public $timestamps = false;
}
