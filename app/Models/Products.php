<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products'; // Хүснэгтийн нэрийг зөв эсэхийг шалгаарай
    protected $fillable = [
    'name', 
    'barCode',
    'pic'
    ];

    public $timestamps = false;
}
