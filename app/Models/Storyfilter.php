<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storyfilter extends Model
{
    use HasFactory;

    protected $table = 'storyfilter';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;
}
