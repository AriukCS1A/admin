<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    public function create()
    {
        return view('invite.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recNumber' => 'required|string',
            'accepted' => 'required|boolean'
        ]);

        Invite::create($validatedData);

        return redirect()->route('invite.index')->with('success', 'Brand амжилттай');
    }

    public function edit($id)
    {
        $invite = Invite::findOrFail($id);
        return view('invite.edit', compact('invite'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'recNumber' => 'required|string',
            'accepted' => 'required|boolean'
        ]);

        $invite = Invite::findOrFail($id);
        $invite->update($validatedData);

        return redirect()->route('invite.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $invite = Invite::findOrFail($id);
        $invite->delete();

        return redirect()->route('invite.index')->with('success', 'Данс устгагдлаа.');
    }
}
