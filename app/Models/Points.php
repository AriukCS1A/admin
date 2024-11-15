<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Points extends Model
{
    use HasFactory;

    protected $table = 'points';

    protected $fillable = [
        'added',
        'substracted',
        'transDate',
        'user_id', // user_id талбарыг энд оруулж байгаа эсэхээ шалгана уу.
    ];

    
    const CREATED_AT = 'createdTime';
    const UPDATED_AT = 'updatedTime';

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class, 'user_id', 'user_id');
    }


}
