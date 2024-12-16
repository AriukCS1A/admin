<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products'; // Хүснэгтийн нэрийг зөв эсэхийг шалгаарай
    protected $fillable = [
    'brand_id',
    'name', 
    'barCode',
    'pic',
    'description',
    'price'
    ];

    public $timestamps = false;

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class);
    }
}
