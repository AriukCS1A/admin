<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advice;
use App\Services\FirebaseService;

class AdviceController extends Controller
{

    protected FirebaseService $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function uploadAdviceImage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pic' => 'required|string'
        ]);

        $advice = new Advice();
        $advice->pic = $request->input('pic');
        $advice->name = $request->name;
        $advice->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
