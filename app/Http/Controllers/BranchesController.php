<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|double',
            'longitude' => 'required|double',
            'address' => 'required|string'
        ]);

        Branches::create($validatedData);

        return redirect()->route('branches.index')->with('success', 'Brand амжилттай');
    }

    public function edit($id)
    {
        $brand = Branches::findOrFail($id);
        return view('branches.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'latitude' => 'required|double',
            'longitude' => 'required|double',
            'address' => 'required|string'
        ]);

        $branches = Branches::findOrFail($id);
        $branches->update($validatedData);

        return redirect()->route('branches.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $branches = Branches::findOrFail($id);
        $branches->delete();

        return redirect()->route('branches.index')->with('success', 'Данс устгагдлаа.');
    }
}
