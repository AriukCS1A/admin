<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupon = Coupon::with('user')->get(); // Холбогдсон хэрэглэгчийн мэдээлэлтэй цуг авах
        return view('coupon.index', compact('coupon'));
    }

    public function create()
    {
        return view('coupon.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'discount_percent' => 'required|double',
            'is_used' => 'required|boolean'
        ]);

        coupon::create($validatedData);

        return redirect()->route('coupon.index')->with('success', 'Данс амжилттай үүсэв.');
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'discount_percent' => 'required|double',
            'is_used' => 'required|boolean'
        ]);

        $coupon = Coupon::findOrFail($id);
        $coupon->update($validatedData);

        return redirect()->route('coupon.index')->with('success', 'Данс амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupon.index')->with('success', 'Данс устгагдлаа.');
    }
}
