<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Baby;

class BabyController extends Controller
{
    // Pivot хүснэгтийн мэдээллийг авах
    public function getBabyData()
    {
        $babies = Baby::with(['user', 'baby'])->get(); // Baby болон Reward загваруудыг холбож авна
        return response()->json($babies);
    }

    // Pivot хүснэгтийн мэдээллийг засах
    public function updateGiftData(Request $request)
    {
        $request->validate([
            'baby_id' => 'required|exists:baby,babyId',
            'babyName' => 'required|exists:baby, babyName',
            'gender' => 'required|exists:baby, gender',
            'register' => 'required|exists:baby, register',
            'bDay' => 'required|date',
        ]);

        $baby = Baby::findOrFail($request->baby_id);
        $baby->babyName = $request->babyName;
        $baby->gender = $request->gender;
        $baby->register = $request->register;
        $baby->bDay = $request->bDay;
        $baby->save();

        return response()->json(['message' => 'Baby data updated successfully']);
    }


}
