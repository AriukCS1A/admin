<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\FirebaseService;

class TaskController extends Controller
{
    public function uploadTaskImage(Request $request)
{
    $request->validate([
        'pic' => 'required|string', // Cloudinary URL л учраас image биш string байна
        'name' => 'required|string|max:255',
        'info' => 'required|string|max:255',
        'taskStart' => 'required|date',
        'taskEnd' => 'required|date|after_or_equal:taskStart',
        'progress' => 'required|integer|max:255',
        'filter_id' => 'required|exists:filter,id',
        'product_id' => 'required|exists:products,id',
        'barCode' => 'nullable|string|max:255',
    ]);

    $task = new Task();
    $task->pic = $request->input('pic'); // Cloudinary URL-г шууд хадгална
    $task->name = $request->name;
    $task->info = $request->info;
    $task->taskStart = $request->taskStart;
    $task->taskEnd = $request->taskEnd;
    $task->progress = $request->progress;
    $task->filter_id = $request->filter_id;
    $task->product_id = $request->product_id;
    $task->barCode = $request->barCode;
    $task->save();

    return redirect()->route('voyager.task.index')->with('success', '✅ Task амжилттай нэмэгдлээ!');
}
}
