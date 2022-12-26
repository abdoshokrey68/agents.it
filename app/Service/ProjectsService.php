<?php

namespace App\Service;

use App\Models\Project;

class ProjectsService
{
    public function index(): object
    {
        return Project::get();
    }

    public function store($request): object
    {
        $project =  Project::create($request);
        return $project;
    }

    public function update($request, $project): object
    {
        $project->update($request);
        return $project;
    }

    public function delete($project): object
    {
        // $project = Project::find($id);

        $project->delete();

        return $project;
    }
}
