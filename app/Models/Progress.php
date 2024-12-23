<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'user_task_progress';
    protected $fillable = [
        'userId',
        'taskId',
        'currentProgress',
        'reward_available',
        'reward_claimed'
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function task()
    {
        return $this->belongsTo(\App\Models\Task::class, 'task');
    }
}
