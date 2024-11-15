<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\User;

class PointsController extends VoyagerBaseController
{
    // Онооны жагсаалт харуулах
    public function index(Request $request)
    {
        // Бүх онооны мэдээллийг хэрэглэгчийн нэртэй хамт авах
        $points = Points::with('user')->paginate(10); // 10 мөр хуудаслах
        return view('vendor.voyager.points.browse', compact('points'));
    }

    // Тухайн онооны дэлгэрэнгүйг харуулах
    public function show(Request $request, $id)
    {
        $point = Points::with('user')->findOrFail($id);
        return view('vendor.voyager.points.read', compact('point'));
    }
}
