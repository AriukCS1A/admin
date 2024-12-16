<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    public function uploadProductImage(Request $request)
    {
        $request->validate([
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'barCode' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brand,id',
            'description' => 'required|string',
            'price' => 'required|integer|max:255',
        ]);

        $fileName = time() . '_' . $request->file('pic')->getClientOriginalName();
        
        $filePath = $request->file('pic')->storeAs('public/products', $fileName);

        $product = new Products();
        $product->pic = url('storage/products/' . $fileName);
        $product->brand_id = $request->brand_id;
        $product->barCode = $request->barCode;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
