<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sale';

    protected $fillable = [
        'product_id',
        'percent',
        'startDate',
        'endDate'
    ];

    public $timestamps = false;

    public function product()
{
    return $this->belongsTo(\App\Models\Products::class);
}
}
