<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Service\ProjectsService;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectApiController extends Controller
{
    use ResponseStatus;
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
     * @return array
     */
    public function index(): array
    {
        $projects = $this->service->index();
        return $this->successResponse($projects);
    }


    /**
     * @param Project $project
     *
     * @return array
     */
    public function show($project_id): array
    {
        // return Project::get();
        $result = $this->service->show($project_id);
        return $this->successResponse($result);
    }

    /**
     * @param ProjectRequest $request
     *
     * @return array
     */
    public function store(ProjectRequest $request): array
    {
        $input = $request->all();
        $input['created_by'] = auth()->id();
        $result = $this->service->store($input);
        return $this->successResponse($result, 'The project has been created successfully');
    }

    /**
     * @param ProjectRequest $request
     * @param Project $project
     *
     * @return array
     */
    public function update(ProjectRequest $request, Project $project): array
    {
        $input = $request->all();
        $result = $this->service->update($input, $project);
        return $this->successResponse($result, 'The project has been updated successfully');
    }

    /**
     * @param Project $project
     *
     * @return array
     */
    public function delete(Project $project): array
    {
        $result = $this->service->delete($project);
        return $this->successResponse($result, 'The project has been successfully deleted');
    }
}
