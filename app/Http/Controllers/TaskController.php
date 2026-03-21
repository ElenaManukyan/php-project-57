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

class TaskController extends Controller implements HasMiddleware
{
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

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $tasks = QueryBuilder::for(Task::class)
            ->with(['status', 'author', 'assignedTo']) 
            ->allowedFilters(
                AllowedFilter::exact('status_id'),
                AllowedFilter::exact('created_by_id'),
                AllowedFilter::exact('assigned_to_id')
            )
            ->orderBy('id', 'asc')
            ->paginate(15);

        $statuses = TaskStatus::all();
        $users = User::all();

        return view('tasks.index', compact('tasks', 'statuses', 'users'));
    }

    public function create()
    {
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('tasks.create', compact('statuses', 'users', 'labels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tasks'],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
        ], [
            'name.unique' => __('Задача с таким именем уже существует.'),
        ]);

        $data['created_by_id'] = auth()->id();
        $task = Task::create($data);
        $task->labels()->sync($request->input('labels', []));

        flash(__('Задача успешно создана'))->success();

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
        $statuses = TaskStatus::all();
        $users = User::all();
        $labels = Label::all();

        return view('tasks.edit', compact('task', 'statuses', 'users', 'labels'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tasks,name,' . $task->id],
            'description' => ['nullable', 'string'],
            'status_id' => ['required', 'exists:task_statuses,id'],
            'assigned_to_id' => ['nullable', 'exists:users,id'],
            'labels' => ['nullable', 'array'],
            'labels.*' => ['exists:labels,id'],
        ], [
            'name.unique' => __('Задача с таким именем уже существует.'),
        ]);

        $task->update($data);
        $task->labels()->sync($request->input('labels', []));

        flash(__('Задача успешно изменена'))->success();

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->labels()->detach();
        $task->delete();

        flash(__('Задача успешно удалена'))->success();

        return redirect()->route('tasks.index');
    }
}
