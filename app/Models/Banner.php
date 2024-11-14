<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner'; // Хүснэгтийн нэрийг зөв эсэхийг шалгаарай
    protected $fillable = [
    'photo', 
    'startDate',
    'endDate'
    ];

    public $timestamps = false;
}
