<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Session::get('user_id'))->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high'
        ]);

        Task::create([
            'title' => $request->title,
            'priority' => $request->priority,
            'user_id' => Session::get('user_id'),
            'completed' => false
        ]);

        return redirect('/tasks')->with('success', 'Task added successfully!');
    }

    public function update(Request $request, $id)
    {
        $task = Task::where('user_id', Session::get('user_id'))->findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high'
        ]);

        $task->update([
            'title' => $request->title,
            'priority' => $request->priority
        ]);

        return redirect('/tasks')->with('success', 'Task updated successfully!');
    }

    public function toggle($id)
    {
        $task = Task::where('user_id', Session::get('user_id'))->findOrFail($id);
        $task->completed = !$task->completed;
        $task->save();

        return redirect('/tasks')->with('success', 'Task status updated!');
    }

    public function destroy($id)
    {
        $task = Task::where('user_id', Session::get('user_id'))->findOrFail($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted successfully!');
    }
}
