<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advice;

class AdviceController extends Controller
{
    public function uploadAdviceImage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time() . '_' . $request->file('pic')->getClientOriginalName();
        
        $filePath = $request->file('pic')->storeAs('public/advice', $fileName);

        $advice = new Advice();
        $advice->pic = url('storage/advice/' . $fileName);
        $advice->name = $request->name;
        $advice->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
