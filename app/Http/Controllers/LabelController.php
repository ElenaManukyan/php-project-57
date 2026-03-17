<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
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
        ]);

        $label->update($data);
        flash(__('Метка успешно обновлена'))->success();
        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        // Если метка связана с задачей, удалить её нельзя
        if ($label->tasks()->exists()) {
            flash('Не удалось удалить метку')->error();
            return redirect()->route('labels.index');
        }

        $label->delete();
        flash('Метка успешно удалена')->success();
        return redirect()->route('labels.index');
    }
}
