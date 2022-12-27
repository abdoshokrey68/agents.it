<?php

namespace App\Service;

use App\Models\Project;

class ProjectsService
{
    /**
     * @return object
     */
    public function index(): object
    {
        return Project::get();
    }

    /**
     * @param mixed $project_id
     *
     * @return object or null
     */
    public function show ($project_id)
    {
        $project = Project::find($project_id);
        return $project;
    }

    /**
     * @param mixed $request
     *
     * @return object
     */
    public function store($request): object
    {
        $project =  Project::create($request);
        return $project;
    }

    /**
     * @param mixed $request
     * @param mixed $project
     *
     * @return object
     */
    public function update($request, $project): object
    {
        $project->update($request);
        return $project;
    }

    /**
     * @param mixed $project
     *
     * @return object
     */
    public function delete($project): object
    {
        $project->delete();
        return $project;
    }
}
