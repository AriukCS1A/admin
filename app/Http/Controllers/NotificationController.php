<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function create()
    {
        return view('notifications.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'notifId' => 'required|exists:notifications,notifId',
            'message' => 'required|string|max:255',
            'is_read' => 'required|boolean'
        ]);

        Notifications::create($validatedData);

        return redirect()->route('notifications.index')->with('success', 'Brand амжилттай');
    }

    public function edit($id)
    {
        $notifications = Notifications::findOrFail($id);
        return view('notifications.edit', compact('notifications'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'message' => 'required|string|max:255',
            'is_read' => 'required|boolean'
        ]);

        $notifications = Notifications::findOrFail($id);
        $notifications->update($validatedData);

        return redirect()->route('notifications.index')->with('success', 'Оноо амжилттай шинэчлэгдэв.');
    }

    public function destroy($id)
    {
        $notifications = Notifications::findOrFail($id);
        $notifications->delete();

        return redirect()->route('notifications.index')->with('success', 'Данс устгагдлаа.');
    }
}
