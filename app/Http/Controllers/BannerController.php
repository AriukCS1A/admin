<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class BannerController extends Controller
{
    public function uploadBannerImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
        
        
        $filePath = $request->file('image')->storeAs('public/banner', $fileName);

        $banner = new Banner();
        $banner->photo = url('storage/banner/' . $fileName); 
        $banner->startDate = $request->startDate;
        $banner->endDate = $request->endDate;
        $banner->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
