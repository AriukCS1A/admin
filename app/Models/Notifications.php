<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Notifications extends Model
{
    use HasFactory;

    protected $table = 'notifications';
    protected $primaryKey = 'notifId';
    protected $fillable = [
        'user_id',
        'message',
        'is_read'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
