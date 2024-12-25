<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function create()
    {
        return view('section.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_id' => 'required|exists:brand,id',
            'answer' => 'required|string',
            'question' => 'required|string'
        ]);

        Section::create($validatedData);

        return redirect()->route('section.index')->with('success', 'Brand амжилттай');
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('section.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_id' => 'required|exists:brand,id',
            'answer' => 'required|string',
            'question' => 'required|string'
        ]);

        $section = Section::findOrFail($id);
        $section->update($validatedData);

        return redirect()->route('section.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return redirect()->route('section.index')->with('success', 'Данс устгагдлаа.');
    }
}
