<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserTasksRequest;
use App\Models\Task;
use App\Service\UserService;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    use ResponseStatus;
    /**
     * @var object
     */
    protected object $service;

    /**
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * @return array
     */
    public function tasks(): array
    {
        $result = $this->service->tasks(auth()->id());
        return $this->successResponse($result);
    }

    public function show ($task_id):array
    {
        $result = $this->service->show($task_id);
        return $this->successResponse($result);
    }

    /**
     * @param UserTasksRequest $request
     * @param mixed $task_id
     *
     * @return array
     */
    public function update(UserTasksRequest $request, $task_id):array
    {
        $input = $request->all();
        $task = Task::where('user_id', auth()->id())->find($task_id);
        $result = $this->service->update($input, $task);
        return $this->successResponse($result, 'The task has been completed successfully');
    }
}
