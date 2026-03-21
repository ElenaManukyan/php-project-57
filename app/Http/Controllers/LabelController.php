<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class LabelController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index']),

            new Middleware('can:viewAny,App\Models\Label', only: ['index']),
            new Middleware('can:create,App\Models\Label', only: ['create', 'store']),
            new Middleware('can:update,label', only: ['edit', 'update']),
            new Middleware('can:delete,label', only: ['destroy']),
        ];
    }

    public function __construct()
    {
    }

    public function index()
    {
        return view('labels.index', ['labels' => Label::all()]);
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:labels',
            'description' => 'nullable|string',
        ], [
            'name.unique' => __('Метка с таким именем уже существует.'),
        ]);

        Label::create($data);

        flash(__('Метка успешно создана'))->success();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:labels,name,' . $label->id,
            'description' => 'nullable|string',
        ], [
            'name.unique' => __('Метка с таким именем уже существует.'),
        ]);

        $label->update($data);

        flash(__('Метка успешно изменена'))->success();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('Не удалось удалить метку'))->error();
            return redirect()->route('labels.index');
        }

        $label->delete();

        flash(__('Метка успешно удалена'))->success();

        return redirect()->route('labels.index');
    }
}
