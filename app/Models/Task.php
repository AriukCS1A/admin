<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Filter;

class Task extends Model
{
    use HasFactory;

    protected $table = 'task';

    protected $fillable = [
        'name',
        'info',
        'taskStart',
        'taskEnd',
        'pic',
        'progress',
        'filter_id', // Энэ баганаар `task_filter` хүснэгттэй холбогдоно
        'Barcode'    // Шинээр нэмсэн багана
    ];

    public $timestamps = false;

    /**
     * Task нь нэг TaskFilter-т хамаарна.
     */
    public function filter()
    {
        return $this->belongsTo(\App\Models\Filter::class);
    }
}
