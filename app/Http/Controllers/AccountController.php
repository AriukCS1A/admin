<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::with('user')->get(); // Холбогдсон хэрэглэгчийн мэдээлэлтэй цуг авах
        return view('account.index', compact('accounts'));
    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'level_id' => 'required|exists:level,id',
            'totalAdd' => 'required|integer',
            'totalSub' => 'required|integer',
            'balance' => 'required|integer',
        ]);

        Account::create($validatedData);

        return redirect()->route('account.index')->with('success', 'Данс амжилттай үүсэв.');
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        return view('account.edit', compact('account'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'totalAdd' => 'required|integer',
            'totalSub' => 'required|integer',
            'balance' => 'required|integer',
        ]);

        $account = Account::findOrFail($id);
        $account->update($validatedData);

        return redirect()->route('account.index')->with('success', 'Данс амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();

        return redirect()->route('account.index')->with('success', 'Данс устгагдлаа.');
    }
}
