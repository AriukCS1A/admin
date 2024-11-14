<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;


class Filter extends Model
{
    use HasFactory;

    protected $table = 'filter';

    protected $fillable = [
        'filter'
    ];

    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(\App\Models\Task::class);
    }
}
