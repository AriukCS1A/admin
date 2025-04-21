<?php

namespace App\Observers;

use App\Models\Advice;
use App\Services\FirebaseService;

class AdviceObserver
{
    public function created(Advice $advice)
    {
        (new FirebaseService())->sendToTopic(
            '🆕 Шинэ зөвлөгөө нэмэгдлээ!',
            $advice->name,
            'all_users',
            [
                'type' => 'advice',
                'advice_id' => (string) $advice->id, // ✅ string болгоно
            ]
        );
    }
}

