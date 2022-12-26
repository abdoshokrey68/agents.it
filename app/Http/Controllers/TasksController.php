<?php

namespace App\Http\Controllers;

use App\Http\Requests\TasksRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Service\TasksService;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    protected $service;

    public function __construct(TasksService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $tasks = $this->service->index();
        return view('task.index', compact('tasks'));
    }

    public function create()
    {
        $projects = Project::get();
        $users = User::whereIsAdmin(false)->get();
        return view('task.create', compact('projects', 'users'));
    }

    public function store(TasksRequest $request)
    {
        $input = $request->all();
        $input['created_by'] = Auth::id();
        $result = $this->service->store($input);
        return redirect()->route('task')->with('status', 'The task has been created successfully');
    }

    public function edit(Task $task)
    {
        $projects = Project::get();
        $users  = User::get();
        return view('task.edit', compact('task', 'projects', 'users'));
    }

    public function update(TasksRequest $request, Task $task)
    {
        $input = $request->all();
        $result = $this->service->update($input, $task);
        return redirect()->route('task')->with('status', 'The task has been updated successfully');
    }

    public function delete(Task $task)
    {
        $result = $this->service->delete($task);
        return redirect()->route('task')->with('status', 'The task has been successfully deleted');
    }
}
