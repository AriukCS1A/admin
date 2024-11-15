<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Points;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    // Хэрэглэгчийн дансны мэдээллийг харуулах функц
    public function show($userId)
    {
        // Дансны мэдээлэл авах
        $account = Account::where('user_id', $userId)->first();

        // Онооны түүхийг авах
        $points = Points::where('user_id', $userId)->get();

        return view('admin.account_details', compact('account', 'points'));
    }

    // Бүх дансны мэдээллийг харуулах функц
    public function index()
    {
        // Бүх дансны жагсаалт
        $accounts = Account::with('user')->paginate(10);

        return view('admin.accounts', compact('accounts'));
    }
}
