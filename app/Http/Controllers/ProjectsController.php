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
    /**
     * @var object
     */
    protected object $service;

    /**
     * @param ProjectsService $service
     */
    public function __construct(ProjectsService $service)
    {
        $this->service = $service;
    }

    /**
     * @return object
     */
    public function index(): object
    {
        $projects = $this->service->index();
        return view('project.index', compact('projects'));
    }

    /**
     * @return object
     */
    public function create(): object
    {
        return view('project.create');
    }

    /**
     * @param ProjectRequest $request
     *
     * @return object
     */
    public function store (ProjectRequest $request) : object
    {
        $input = $request->all();
        $input['created_by'] = Auth::id();
        $this->service->store($input);
        return redirect()->route('project')->with('status', 'The project has been created successfully');
    }

    /**
     * @param Project $project
     *
     * @return object
     */
    public function edit (Project $project) : object
    {
        return view('project.edit', compact('project'));
    }

    /**
     * @param ProjectRequest $request
     * @param Project $project
     *
     * @return object
     */
    public function update(ProjectRequest $request, Project $project) : object
    {
        $input = $request->all();
        $this->service->update($input, $project);
        return redirect()->route('project')->with('status', 'The project has been updated successfully');
    }

    /**
     * @param Project $project
     *
     * @return object
     */
    public function delete (Project $project): object
    {
        $this->service->delete($project);
        return redirect()->route('project')->with('status', 'The project has been successfully deleted');
    }
}
