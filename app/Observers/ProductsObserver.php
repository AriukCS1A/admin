<?php

namespace App\Observers;

use App\Models\Products;
use App\Services\FirebaseService;

class ProductsObserver
{
    public function created(Products $products)
    {
        (new FirebaseService())->sendToTopic(
            'Манайд шинэ бүтээгдэхүүн нэмэгдлээ!',
            $products->name,
            'all_users',
            [
                'type' => 'products',
                'products_id' => (string) $products->id, // ✅ string болгоно
            ]
        );
    }
}

