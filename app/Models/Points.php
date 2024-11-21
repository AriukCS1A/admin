<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    use HasFactory;

    protected $table = 'points';
    protected $primaryKey = 'pointId';

    protected $fillable = [
        'user_id',
        'added',
        'substracted',
        'transDate',
        'createdTime',
        'updatedTime',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
