<?php

namespace App\Http\Controllers;

use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskStatusController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class, 'task_status');
    }

    public function index()
    {
        $taskStatuses = TaskStatus::orderBy('id')->get();
        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create()
    {
        return view('task_statuses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:task_statuses|max:255',
        ], [
            'name.unique' => __('validation.status.unique'),
        ]);

        TaskStatus::create($validated);

        flash(__('validation.status.created'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus)
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(Request $request, TaskStatus $taskStatus)
    {
        $validated = $request->validate([
            'name' => "required|max:255|unique:task_statuses,name, {$taskStatus->id}",
        ], [
            'name.unique' => __('validation.status.unique'),
        ]);

        $taskStatus->update($validated);

        flash(__('validation.status.updated'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus)
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('validation.status.error'))->error();
            return redirect()->route('task_statuses.index');
        }

        $taskStatus->delete();

        flash(__('validation.status.deleted'))->success();

        return redirect()->route('task_statuses.index');
    }
}
