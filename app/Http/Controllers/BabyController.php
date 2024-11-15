<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baby;
use App\Models\User;


class BabyController extends Controller
{
    public function uploadBabyInfo(Request $request)
    {
        $request->validate([
            'babyName' => 'required|string|max:255',
            'register' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'bDay' => 'required|date',
            'user_id' => 'required|exists:users,id' 
        ]);

        $baby = new Baby(); 
        $baby->babyName = $request->babyName;
        $baby->register = $request->register;
        $baby->gender = $request->gender;
        $baby->bDay = $request->bDay;
        $task->user_id = $request->user_id;
        $baby->save(); 
    }

    public function getBabies()
{
    // `user` харилцааг `with` функцээр ачаална
    $babies = Baby::with('users')->get();

    return response()->json($babies);
}
}
