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
    ];

    public $timestamps = false;

    public function momchange()
    {
        return $this->belongsTo(\App\Models\Momchange::class);
    }

    public function babydev()
    {
        return $this->belongsTo(\App\Models\Babydev::class);
    }

}
