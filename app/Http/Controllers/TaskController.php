<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Task; // don't forget this import next time
use Illuminate\Support\Facades\Auth;
//Apparently, do this: # php artisan make:controller TaskController --resource
class TaskController extends Controller
{


    /**
     * Apply auth middleware to protect routes
     */


    /**
     * Display a listing of the resource. In this case, show all tasks.
     */
 public function index()
    {
        // Get tasks with their associated user
        $tasks = Auth::user()->tasks()->latest()->paginate(10); //BENIGN ERROR. This isn't actually an error.

        return view('tasks.index', compact('tasks'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{

        // Use the Auth facade to get the authenticated user
        $validated['user_id'] = Auth::user()->id;

        $task = Task::create($validated);

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Task created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
            'completed' => 'boolean'
        ]);

        $task->update($validated);

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Task deleted successfully!');
    }
}
