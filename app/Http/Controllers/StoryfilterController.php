<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storystoryfilter;

class StoryfilterController extends Controller
{
    public function uploadstoryfilterInfo(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
        ]);

        $storyfilter = new Storyfilter(); 
        $storyfilter->storyfilter = $request->storyfilter;
        $storyfilter->save(); 
    }
}
