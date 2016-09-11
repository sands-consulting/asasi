<?php

namespace App\Http\Controller\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

class CommRequirementsController extends Controller
{
    public function index()
    {
        
    }

    public function show(CommRequirement $commRequirement)
    {
        return view()->make('admin.comm-requirements.show', compact('commRequirement'))
    }

    public function create()
    {
        return view()->make('admin.comm-requirements.index');
    }

    public function store(CommRequirementRequest $request)
    {
        $inputs = $request->only('title', 'mandatory', 'require_file');
        $commRequirement = CommRequirementsRepositories::create(new CommRequirement, $inputs);

        return redirect()
            ->route()
            ->with('with', trans('admin.comm-requirements.create', $commRequirement->name));
    }

    public function edit(CommRequirement $commRequirement)
    {
        return view()->make('admin.comm-requirement.edit', compact('commRequirement'));
    }
}
