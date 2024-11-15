<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Baby;
use App\Models\Points;
use App\Models\Account;

class User extends \TCG\Voyager\Models\User
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationship with Baby model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    //baby

    public function babies()
    {
        return $this->hasMany(\App\Models\Baby::class, 'user_id');
    }
    
    //points

    public function points()
    {
        return $this->hasMany(\App\Models\Points::class);
    }

    public function account()
    {
        return $this->hasOne(\App\Models\Account::class);
    }
   

}
