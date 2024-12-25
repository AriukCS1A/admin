<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advice extends Model
{
    use HasFactory;

    protected $table = 'advice';

    protected $fillable = [
        'name',
        'pic',
        'description'
    ];

    public $timestamps = false;
}
