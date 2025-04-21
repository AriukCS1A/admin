<?php

namespace App\Observers;

use App\Models\Banner;
use App\Services\FirebaseService;

class BannerObserver
{
    public function created(Banner $banner)
    {
        (new FirebaseService())->sendToTopic(
            'Шинэ хямдрал, урамшуулал нэмэгдлээ!',
            $banner->description,
            'all_users',
            [
                'type' => 'banner',
                'banner_id' => (string) $banner->id, // ✅ string болгоно
            ]
        );
    }
}

