<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Baby;


class Reward extends Model
{
    use HasFactory;

    protected $table = 'reward';
    protected $primaryKey = 'rewardId';
    public $incrementing = true; 
    protected $keyType = 'int';

    protected $fillable = [
        'productPhoto',
        'name',
        'info',
        'requiredAge',
        'requiredMonth',
        'validFrom',
        'validTo'
    ];

    public $timestamps = false;

}
