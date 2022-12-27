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
    /**
     * @var object
     */
    protected $service;

    /**
     * @param TasksService $service
     */
    public function __construct(TasksService $service)
    {
        $this->service = $service;
    }

    /**
     * @return object
     */
    public function index() : object
    {
        $tasks = $this->service->index();
        return view('task.index', compact('tasks'));
    }

    /**
     * @return object
     */
    public function create() : object
    {
        $projects = Project::get();
        $users = User::whereIsAdmin(false)->get();
        return view('task.create', compact('projects', 'users'));
    }

    /**
     * @param TasksRequest $request
     *
     * @return object
     */
    public function store(TasksRequest $request): object
    {
        $input = $request->all();
        $input['created_by'] = Auth::id();
        $result = $this->service->store($input);
        return redirect()->route('task')->with('status', 'The task has been created successfully');
    }

    /**
     * @param Task $task
     *
     * @return object
     */
    public function edit(Task $task): object
    {
        $projects = Project::get();
        $users  = User::get();
        return view('task.edit', compact('task', 'projects', 'users'));
    }

    /**
     * @param TasksRequest $request
     * @param Task $task
     *
     * @return object
     */
    public function update(TasksRequest $request, Task $task): object
    {
        $input = $request->all();
        $result = $this->service->update($input, $task);
        return redirect()->route('task')->with('status', 'The task has been updated successfully');
    }

    /**
     * @param Task $task
     *
     * @return object
     */
    public function delete(Task $task): object
    {
        $result = $this->service->delete($task);
        return redirect()->route('task')->with('status', 'The task has been successfully deleted');
    }
}
