<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function create()
    {
        return view('level.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'minPoint' => 'required|integer',
            'maxPoint' => 'required|integer',
            'levelReward' => 'required|string'
        ]);

        Level::create($validatedData);

        return redirect()->route('level.index')->with('success', 'Brand амжилттай');
    }

    public function edit($id)
    {
        $level = Level::findOrFail($id);
        return view('level.edit', compact('level'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'minPoint' => 'required|integer',
            'maxPoint' => 'required|integer',
            'levelReward' => 'required|string'
        ]);

        $level = Level::findOrFail($id);
        $level->update($validatedData);

        return redirect()->route('level.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();

        return redirect()->route('level.index')->with('success', 'Данс устгагдлаа.');
    }
}
