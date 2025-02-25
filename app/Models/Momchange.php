<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Momchange extends Model
{
    use HasFactory;

    protected $table = 'momchange';

    protected $fillable = [
        'name',
        'pic',
        'cycle'
    ];

    public $timestamps = false;
}
