<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Label;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        return [
            new Middleware('can:viewAny,App\Models\Task', only: ['index']),
            new Middleware('can:view,task', only: ['show']),
            new Middleware('can:create,App\Models\Task', only: ['create', 'store']),
            new Middleware('can:update,task', only: ['edit', 'update']),
            new Middleware('can:delete,task', only: ['destroy']),
        ];
    }

    public function index(Request $request)
    {
        /** @var \Spatie\QueryBuilder\QueryBuilder $query */
        $query = QueryBuilder::for(Task::class);

        $tasks = $query
            ->with(['status', 'author', 'assignedTo'])
            ->allowedFilters(
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            )
            ->orderBy('id')
            ->paginate(15);

        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('tasks.index', compact('tasks', 'statuses', 'users'));
    }

    public function create()
    {
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('tasks.create', compact('statuses', 'users', 'labels'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tasks'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
        ], [
            'name.unique' => __('validation.task.unique_error'),
        ]);

        $task = $request->user()->createdTasks()->create($validated);

        $task->labels()->sync($request->input('labels', []));

        flash(__('validation.task.created'))->success();

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task->load(['status', 'author', 'assignedTo', 'labels'])
        ]);
    }

    public function edit(Task $task)
    {
        $statuses = TaskStatus::pluck('name', 'id');
        $users = User::pluck('name', 'id');
        $labels = Label::pluck('name', 'id');

        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tasks,name,' . $task->id],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
        ], [
            'name.unique' => __('validation.task.unique_error'),
        ]);

        $task->update($validated);
        $task->labels()->sync($request->input('labels', []));

        flash(__('validation.task.updated'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();

        flash(__('validation.task.deleted'))->success();

        return redirect()->route('tasks.index');
    }
}
