<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\Baby;

class RewardController extends Controller
{
    public function uploadRewardImage(Request $request)
    {
        $request->validate([
            'productPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => required|string|max:255',
            'info' => required|string|max:255',
            'requiredAge' => required|integer|max:255,
            'requiredMonth' => required|integer|max:255,
            'validFrom' => required|date,
            'validTo' => required|date

        ]);

        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        
        
        $filePath = $request->file('image')->storeAs('public/reward', $fileName);

        $reward = new Reward();
        $reward->productPhoto = url('storage/reward/' . $fileName); 
        $reward->name = $request->name;
        $reward->info = $request->info;
        $reward->requiredAge = $request->requiredAge;
        $reward->requiredMonth = $request->requiredMonth;
        $reward->validFrom = $request->validFrom;
        $reward->validTo = $request->validTo;
        $reward->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }

public function getRewardBabies($rewardId)
{
    $reward = Reward::with('babies')->findOrFail($rewardId);
    return response()->json($reward->babies);
}


public function attachBabyToReward($rewardId, $babyId)
{
    $reward = Reward::findOrFail($rewardId);
    $baby = Baby::findOrFail($babyId);

    // Reward-ийг Baby-д холбоно
    $reward->babies()->attach($baby->babyId, ['grantedAt' => now()]); // babyId-г зөв ашиглана
    return response()->json(['message' => 'Baby attached to reward successfully']);
}


public function updateGiftPivot($babyId, $rewardId, Request $request)
{
    $request->validate([
        'grantedAt' => 'required|date',
    ]);

    $baby = Baby::findOrFail($babyId);
    $baby->rewards()->updateExistingPivot($rewardId, ['grantedAt' => $request->grantedAt]);

    return response()->json(['message' => 'Pivot data updated successfully']);
}


}
