<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $table = 'detail';

    protected $fillable = [
        'pic',
        'head',
        'full'
    ];

    public $timestamps = false;

    public function advice()
    {
        return $this->belongsTo(\App\Models\Advice::class);
    }
}
