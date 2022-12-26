<?php

namespace App\Service;

use App\Models\Task;

class TasksService
{
    public function index(): object
    {
        return Task::get();
    }

    public function store($request)
    {
        $task =  Task::create($request);
        return $task;
    }

    public function update($input, $task)
    {
        if (isset($input['status'])) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }
        // return $input;
        $task->update($input);
        return $task;
    }

    public function delete($task): object
    {
        // $task = Task::find($id);

        $task->delete();

        return $task;
    }
}
