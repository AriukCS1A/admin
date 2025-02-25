<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Babydev extends Model
{
    use HasFactory;

    protected $table = 'babydev';

    protected $fillable = [
        'name',
        'pic',
        'month'
    ];

    public $timestamps = false;
}
