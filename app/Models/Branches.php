<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Banner;

class Branches extends Model
{
    use HasFactory;

    protected $table = 'branches';
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'address'
    ];
    public $timestamps = false;

    public function banners()
    {
        return $this->hasMany(\App\Models\Banner::class);
    }
}
