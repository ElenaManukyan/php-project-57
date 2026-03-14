<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    { 
        return view('tasks.index', ['tasks' => Task::with(['status', 'author', 'assignee'])->get()]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = TaskStatus::all();
        $users = User::all();

        return view('tasks.create', compact('statuses', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
        ]);

        $data['created_by_id'] = auth()->id();

        Task::create($data);

        flash('Задача успешно создана')->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task) 
    { 
        return view('tasks.show', ['task' => $task->load(['status', 'author', 'assignee'])]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();

        return view('tasks.edit', compact('task', 'statuses', 'users'));
    }
    // public function edit(Task $task) 
    // {
    //     $this->authorize('update', $task);

    //     return view('tasks.edit', [
    //         'task'     => $task,
    //         'statuses' => TaskStatus::all(),
    //         'users'    => User::all()
    //     ]); 
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
        ]);

        $task->update($data);

        flash('Задача успешно обновлена')->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
