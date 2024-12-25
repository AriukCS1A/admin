<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function create()
    {
        return view('progress.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'userId' => 'required|exists:users,id',
            'taskId' => 'required|exists:task,id',
            'currentProgress' => 'required|integer',
            'reward_available' => 'required|boolean',
            'reward_claimed' => 'required|boolean'
        ]);

        Progress::create($validatedData);

        return redirect()->route('progress.index')->with('success', 'Brand амжилттай');
    }

    public function edit($id)
    {
        $progress = Progress::findOrFail($id);
        return view('progress.edit', compact('progress'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'userId' => 'required|exists:users,id',
            'taskId' => 'required|exists:task,Id',
            'currentProgress' => 'required|integer',
            'reward_available' => 'required|boolean',
            'reward_claimed' => 'required|boolean'
        ]);

        $progress = Progress::findOrFail($id);
        $progress->update($validatedData);

        return redirect()->route('progress.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $progress = Progress::findOrFail($id);
        $progress->delete();

        return redirect()->route('progress.index')->with('success', 'Данс устгагдлаа.');
    }
}
