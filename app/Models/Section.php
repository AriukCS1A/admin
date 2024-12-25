<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $table = 'section';

    protected $fillable = [
        'brand_id',
        'answer',
        'question',
    ];

    public $timestamps = false;

    public function brand()
{
    return $this->belongsTo(\App\Models\Brand::class);
}
}
