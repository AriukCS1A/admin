<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create()
    {
        return view('review.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'star' => 'required|integer',
            'message' => 'required|string'
        ]);

        review::create($validatedData);

        return redirect()->route('review.index')->with('success', 'Brand амжилттай');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('review.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'star' => 'required|integer',
            'message' => 'required|string'
        ]);

        $review = Review::findOrFail($id);
        $review->update($validatedData);

        return redirect()->route('review.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('review.index')->with('success', 'Данс устгагдлаа.');
    }
}
