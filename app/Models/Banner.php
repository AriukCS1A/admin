<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner'; // Хүснэгтийн нэрийг зөв эсэхийг шалгаарай

    // Бөглөх боломжтой баганууд
    protected $fillable = [
        'photo',
        'public_id',
        'startDate',
        'endDate',
    ];

    public $timestamps = false; // created_at, updated_at баганыг ашиглахгүй бол false
}
