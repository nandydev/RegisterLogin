<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user')->paginate(10); // Paginate with 10 tasks per page
        return view('tasks.index', compact('tasks'))
               ->with('i', (request()->input('page', 1) - 1) * 10);
    }
    public function showTask()
    {
        $user = Auth::user();
        $tasks = $user->tasks()->paginate(10); 
        
        return view('dashboard', compact('tasks'));
    }
    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'status' => 'required',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')
                         ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        $users = User::all();
        return view('tasks.edit', compact('task', 'users'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'user_id' => 'required|exists:users,id',
            'status' => 'required',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')
                         ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully.');
    }
}
