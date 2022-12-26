<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Service\ProjectsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    protected $service;

    public function __construct(ProjectsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $projects = $this->service->index();
        return view('project.index', compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function store (ProjectRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::id();
        // return $input;
        $result = $this->service->store($input);
        return redirect()->route('project')->with('status', 'The project has been created successfully');
    }

    public function edit (Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        $input = $request->all();
        $result = $this->service->update($input, $project);
        return redirect()->route('project')->with('status', 'The project has been updated successfully');
    }

    public function delete (Project $project)
    {
        $result = $this->service->delete($project);
        return redirect()->route('project')->with('status', 'The project has been successfully deleted');
    }
}
