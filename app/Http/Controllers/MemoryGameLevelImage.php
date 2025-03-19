<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemoryGameLevelImage;
use App\Models\Level;
use App\Models\MemoryGameImage;

class MemoryGameLevelImageController extends Controller
{
    // Pivot хүснэгтийн мэдээллийг авах
    public function getMemoryGameLevelImageData()
    {
        $memorygamelevelimage = MemoryGameLevelImageData::with(['level', 'memory_game_images'])->get(); // Baby болон Reward загваруудыг холбож авна
        return response()->json($gifts);
    }

    // Pivot хүснэгтийн мэдээллийг засах
    public function updateMemoryGameLevelImageData(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:memory_game_level_images,id',
        ]);

        $memorygamelevelimage = MemoryGameLevelImage::findOrFail($request->id);
        $memorygamelevelimage->save();

        return response()->json(['message' => 'data updated successfully']);
    }


}
