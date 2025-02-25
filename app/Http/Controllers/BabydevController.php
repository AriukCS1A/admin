<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Babydev;

class BabydevController extends Controller
{
    public function uploadBabydevImage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'month' => 'required|string|max:255',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time() . '_' . $request->file('pic')->getClientOriginalName();
        
        $filePath = $request->file('pic')->storeAs('public/babydev', $fileName);

        $babydev = new Babydev();
        $babydev->pic = url('storage/babydev/' . $fileName);
        $babydev->name = $request->name;
        $babydev->month = $request->cycle;
        $babydev->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
