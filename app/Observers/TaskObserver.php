<?php

namespace App\Observers;

use App\Models\Task;
use App\Services\FirebaseService;

class TaskObserver
{
    public function created(Task $task)
    {
        (new FirebaseService())->sendToTopic(
            '🆕 Шинэ үүрэг нэмэгдлээ!',
            $task->name,
            'all_users',
            [
                'type' => 'task',
                'task_id' => (string) $task->id,
            ]
        );
    }
}
