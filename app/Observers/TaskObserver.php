<?php

namespace App\Observers;

use App\Models\Task;
use App\Services\FirebaseService;

class TaskObserver
{
    public function created(Task $task)
    {
        $taskName = $task->name;
        $message = "{$taskName} худалдан авч даалгавраа биелүүлээрэй";
        (new FirebaseService())->sendToTopic(
            '🆕 Шинэ үүрэг нэмэгдлээ!',
            $message,
            'all_users',
            [
                'type' => 'task',
                'task_id' => (string) $task->id,
            ]
        );
    }
}
