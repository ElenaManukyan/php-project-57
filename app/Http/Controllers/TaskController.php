<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
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
        $labels = Label::all();

        return view('tasks.create', compact('statuses', 'users', 'labels'));
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
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
        ]);

        $data['created_by_id'] = auth()->id();

        $task = Task::create($data);

        $task->labels()->sync($data['labels']);

        flash('Задача успешно создана')->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task->load(['status', 'author', 'assignee', 'labels'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all(); // <- добавляем

        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

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
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
        ]);

        $task->update($data);

        $labels = $request->input('labels', []);
        $task->labels()->sync($labels);

        flash('Задача успешно обновлена')->success();

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (auth()->id() !== $task->created_by_id) {
            abort(403);
        }

        $task->labels()->detach();

        $task->delete();

        flash('Задача успешно удалена')->success();

        return redirect()->route('tasks.index');
    }
}
