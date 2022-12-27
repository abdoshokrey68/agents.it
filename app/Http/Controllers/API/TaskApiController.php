<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TasksRequest;
use App\Models\Task;
use App\Service\TasksService;
use App\Traits\ResponseStatus;

class TaskApiController extends Controller
{
    use ResponseStatus;
    /**
     * @var object
     */
    protected object $service;

    /**
     * @param TasksService $service
     */
    public function __construct(TasksService $service)
    {
        $this->service = $service;
    }


    /**
     * @return array
     */
    public function index(): array
    {
        $tasks = $this->service->index();
        return $this->successResponse($tasks);
    }


    /**
     * @param Task $task
     *
     * @return array
     */
    public function show($task_id): array
    {
        $result = $this->service->show($task_id);
        return $this->successResponse($result);
    }

    /**
     * @param TasksRequest $request
     *
     * @return array
     */
    public function store(TasksRequest $request): array
    {
        $input = $request->all();
        $input['created_by'] = auth()->id();
        $result = $this->service->store($input);
        return $this->successResponse($result, 'The task has been created successfully');
    }

    /**
     * @param TasksRequest $request
     * @param Task $task
     *
     * @return array
     */
    public function update(TasksRequest $request, $task_id)
    {
        $task = Task::findOrFail($task_id);
        $input = $request->all();
        $result = $this->service->update($input, $task);
        return $this->successResponse($result, 'The task has been updated successfully');
    }

    /**
     * @param Task $task
     *
     * @return array
     */
    public function delete($task_id): array
    {
        $task = Task::findOrFail($task_id);
        $result = $this->service->delete($task);
        return $this->successResponse($result, 'The task has been successfully deleted');
    }
}
