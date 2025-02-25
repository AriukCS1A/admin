<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;

class AdviceController extends Controller
{
    public function uploadDetailImage(Request $request)
    {
        $request->validate([
            'full' => 'required|string',
            'head' => 'required|string',
            'pic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time() . '_' . $request->file('pic')->getClientOriginalName();
        
        $filePath = $request->file('pic')->storeAs('public/detail', $fileName);

        $detail = new Detail();
        $detail->pic = url('storage/detail/' . $fileName);
        $detail->full = $request->full;
        $detail->head = $request->head;
        $detail->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
