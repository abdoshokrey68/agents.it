<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTasksRequest;
use App\Models\Task;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
     * @return object
     */
    public function tasks(): object
    {
        $tasks = $this->service->tasks(Auth::id());
        return view('member.tasks', compact('tasks'));
    }

    /**
     * @param Task $task
     *
     * @return object
     */
    public function edit(Task $task): object
    {
        return view('member.edit', compact('task'));
    }

    /**
     * @param UserTasksRequest $request
     * @param Task $task
     *
     * @return object
     */
    public function update(UserTasksRequest $request, Task $task): object
    {
        $input = $request->all();
        $this->service->update($input, $task);
        return redirect()->route('member.tasks')->with('status', "The task has been completed successfully");
    }
}
