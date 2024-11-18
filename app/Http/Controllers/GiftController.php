<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gift;
use App\Models\Baby;
use App\Models\Reward;

class GiftController extends Controller
{
    // Pivot хүснэгтийн мэдээллийг авах
    public function getGiftData()
    {
        $gifts = Gift::with(['baby', 'reward'])->get(); // Baby болон Reward загваруудыг холбож авна
        return response()->json($gifts);
    }

    // Pivot хүснэгтийн мэдээллийг засах
    public function updateGiftData(Request $request)
    {
        $request->validate([
            'gift_id' => 'required|exists:gift,giftId',
            'grantedAt' => 'required|date',
        ]);

        $gift = Gift::findOrFail($request->gift_id);
        $gift->grantedAt = $request->grantedAt;
        $gift->save();

        return response()->json(['message' => 'Gift data updated successfully']);
    }


}
