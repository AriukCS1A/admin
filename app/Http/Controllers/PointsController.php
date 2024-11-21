<?php

namespace App\Http\Controllers;

use App\Models\Points;
use Illuminate\Http\Request;

class PointsController extends Controller
{
    public function index()
    {
        $points = Points::with('user', 'account')->get(); // Холбогдсон хэрэглэгчийн мэдээлэлтэй цуг авах
        return view('points.index', compact('points'));
    }

    public function create()
    {
        return view('points.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'added' => 'required|integer',
            'substracted' => 'required|integer',
            'transDate' => 'required|date',
        ]);

        Account::create($validatedData);

        return redirect()->route('points.index')->with('success', 'Оноо амжилттай');
    }

    public function edit($id)
    {
        $points = Points::findOrFail($id);
        return view('points.edit', compact('points'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'added' => 'required|integer',
            'substracted' => 'required|integer',
            'transDate' => 'required|date',
        ]);

        $points = Points::findOrFail($id);
        $points->update($validatedData);

        return redirect()->route('points.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $points = Points::findOrFail($id);
        $points->delete();

        return redirect()->route('points.index')->with('success', 'Данс устгагдлаа.');
    }
}
