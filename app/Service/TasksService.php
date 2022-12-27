<?php

namespace App\Service;

use App\Models\Task;

class TasksService
{
    /**
     * @return object|null
     */
    public function index(): ?object
    {
        return Task::get();
    }


    /**
     * @param mixed $task_id
     *
     * @return object|null
     */
    public function show($task_id): ?object
    {
        $task = Task::find($task_id);
        return $task;
    }


    /**
     * @param mixed $request
     *
     * @return object|null
     */
    public function store($request): ?object
    {
        $task =  Task::create($request);
        return $task;
    }

    /**
     * @param mixed $input
     * @param mixed $task
     *
     * @return object|null
     */
    public function update($input, $task): ?object
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

    /**
     * @param mixed $task
     *
     * @return object|null
     */
    public function delete($task): ?object
    {
        $task->delete();
        return $task;
    }
}
