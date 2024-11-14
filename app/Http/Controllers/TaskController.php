<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function uploadTaskImage(Request $request)
    {
        $request->validate([
            'pic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'info' => 'required|string|max:255',
            'taskStart' => 'required|date',
            'taskEnd' => 'required|date|after_or_equal:taskStart',
            'progress' => 'required|integer|max:255',
            'filter_id' => 'required|exists:task_filter,id', 
        ]);

        $fileName = time() . '_' . $request->file('pic')->getClientOriginalName();
        
        $filePath = $request->file('pic')->storeAs('public/task', $fileName);

        $task = new Task();
        $task->pic = url('storage/task/' . $fileName); 
        $task->name = $request->name;
        $task->info = $request->info;
        $task->taskStart = $request->taskStart;
        $task->taskEnd = $request->taskEnd;
        $task->progress = $request->progress;
        $task->filter_id = $request->filter_id; 
        $task->save(); 

        return redirect()->back()->with('success', 'Зургийг амжилттай орууллаа');
    }
}
