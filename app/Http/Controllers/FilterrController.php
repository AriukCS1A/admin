<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;

class FilterrController extends Controller
{
    public function uploadFilterInfo(Request $request)
    {
        $request->validate([
            'filter' => 'required|string|max:255', 
        ]);

        $filter = new Filter(); 
        $filter->filter = $request->filter;
        $filter->save(); 
    }
}
