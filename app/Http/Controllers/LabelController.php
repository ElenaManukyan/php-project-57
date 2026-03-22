<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LabelController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Label::class, 'label');
    }

    public function index()
    {
        return view('labels.index', [
            'labels' => Label::orderBy('id')->get()
        ]);
    }

    public function create()
    {
        return view('labels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:labels',
            'description' => 'nullable|string',
        ]);

        Label::create($validated);
        flash(__('validation.label.created'))->success();

        return redirect()->route('labels.index');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', compact('label'));
    }

    public function update(Request $request, Label $label)
    {
        $validated = $request->validate([
            'name' => "required|string|max:255|unique:labels,name,{$label->id}",
            'description' => 'nullable|string',
        ]);

        $label->update($validated);
        flash(__('validation.label.updated'))->success();

        return redirect()->route('labels.index');
    }

    public function destroy(Label $label)
    {
        if ($label->tasks()->exists()) {
            flash(__('validation.label.error'))->error();
            return redirect()->route('labels.index');
        }

        $label->delete();
        flash(__('validation.label.deleted'))->success();

        return redirect()->route('labels.index');
    }
}
