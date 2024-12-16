<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brand';
    protected $fillable = [
        'name'
    ];
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(\App\Models\Products::class);
    }
}
