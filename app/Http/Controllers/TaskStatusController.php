<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TaskStatusController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index']),

            new Middleware('can:viewAny,App\Models\TaskStatus', only: ['index']),
            new Middleware('can:create,App\Models\TaskStatus', only: ['create', 'store']),
            new Middleware('can:update,task_status', only: ['edit', 'update']),
            new Middleware('can:delete,task_status', only: ['destroy']),
        ];
    }

    public function __construct()
    {
    }

    public function index()
    {
        $taskStatuses = TaskStatus::all();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        return view('task_statuses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:task_statuses',
        ], [
            'name.unique' => __('Статус с таким именем уже существует.'),
        ]);

        TaskStatus::create($data);

        flash(__('Статус успешно создан'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $data = $request->validate([
            'name' => 'required|unique:task_statuses,name,' . $taskStatus->id,
        ], [
            'name.unique' => __('Статус с таким именем уже существует.'),
        ]);

        $taskStatus->update($data);

        flash(__('Статус успешно изменён'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('Не удалось удалить статус'))->error();
            return redirect()->route('task_statuses.index');
        }

        $taskStatus->delete();

        flash(__('Статус успешно удалён'))->success();

        return redirect()->route('task_statuses.index');
    }
}
