<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Level extends Model
{
    use HasFactory;

    protected $table = 'level';
    protected $fillable = [
        'name',
        'minPoint',
        'maxPoint',
        'levelReward',
    ];
    public $timestamps = false;

    public function accounts()
    {
        return $this->hasMany(\App\Models\Account::class);
    }
}
