<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // Note: "Models" not "models" (case-sensitive!)
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{


public function index()
{
    // Debug authentication state
    \Log::info('TaskController@index accessed', [
        'auth_check' => Auth::check(),
        'auth_user' => Auth::user() ? Auth::user()->email : 'null',
        'auth_id' => Auth::id(),
        'session_id' => session()->getId(),
        'session_data' => session()->all(),
        'cookies' => request()->cookie(),
        'url' => request()->url()
    ]);

    if (!Auth::check()) {
        // Log why we're redirecting
        \Log::warning('User not authenticated, redirecting to login');
        return redirect()->route('login');
    }

    $tasks = Auth::user()->tasks()->latest()->paginate(10);
    return view('tasks.index', compact('tasks'));
}

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // 1. VALIDATE the input first
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date|after:today',
        ]);

        // 2. Add the user_id to validated data
        $validated['user_id'] = Auth::id();

        // 3. Create the task
        $task = Task::create($validated);

        return redirect()->route('tasks.index', $task)
                         ->with('success', 'Task created successfully!');
    }

    public function show(Task $task) // Use Route Model Binding
    {
        // Authorization check - user can only view their own tasks
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.index', compact('task'));
    }

    public function edit(Task $task) // Use Route Model Binding
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
            'completed' => 'boolean'
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index', $task)
                         ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        // Authorization check
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully!');
    }
}
