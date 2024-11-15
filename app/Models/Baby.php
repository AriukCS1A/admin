<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Baby extends Model
{
    use HasFactory;

    protected $table = 'baby';

    protected $fillable = [
        'babyName',
        'gender',
        'register',
        'bDay',
        'user_id', // user_id талбарыг энд оруулж байгаа эсэхээ шалгана уу.
    ];

    public $timestamps = false;

    // User загвартай харилцаа (relationship) тодорхойлох
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
