<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTasksRequest;
use App\Models\Task;
use App\Service\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected object $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function tasks()
    {
        $tasks = $this->service->tasks();
        return view('member.tasks', compact('tasks'));
    }

    public function edit(Task $task)
    {
        return view('member.edit', compact('task'));
    }

    public function update(UserTasksRequest $request, Task $task)
    {
        $input = $request->all();
        $this->service->update($input, $task);
        return redirect()->route('member.tasks')->with('status', "The task has been completed successfully");
    }
}
