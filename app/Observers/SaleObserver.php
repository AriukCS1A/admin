<?php

namespace App\Observers;

use App\Models\Sale;
use App\Services\FirebaseService;

class SaleObserver
{
    public function created(Sale $sale)
    {
        $productName = $sale->product?->name ?? 'Бүтээгдэхүүн'; // fallback name
        $percent = $sale->percent;

        $message = "{$productName} {$percent}% хямдарлаа! 🎉";

        (new FirebaseService())->sendToTopic(
            '🛍️ Хямдрал эхэллээ!',
            $message,
            'all_users',
            [
                'type' => 'sale',
                'sale_id' => (string) $sale->id,
            ]
        );
    }
}
