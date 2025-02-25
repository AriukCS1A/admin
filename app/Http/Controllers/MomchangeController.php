<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Momchange;

class MomchangeController extends Controller
{
    public function uploadMomchangeImage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cycle' => 'required|string|max:255',
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $fileName = time() . '_' . $request->file('pic')->getClientOriginalName();
        
        $filePath = $request->file('pic')->storeAs('public/momchange', $fileName);

        $momchange = new Momchange();
        $momchange->pic = url('storage/momchange/' . $fileName);
        $momchange->name = $request->name;
        $momchange->cycle = $request->cycle;
        $momchange->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
