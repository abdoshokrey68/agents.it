<?php

namespace App\Service;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * @param mixed $user_id
     *
     * @return object|null
     */
    public function tasks($user_id): ?object
    {
        return Task::where('user_id', $user_id)->get();
    }

    /**
     * @param mixed $task
     *
     * @return object|null
     */
    public function show($task_id): ?object
    {
        return Task::where('user_id', auth()->id())->find($task_id);
    }

    /**
     * @param mixed $input
     * @param mixed $task
     *
     * @return object|null
     */
    public function update($input, $task): ?object
    {
        if (Auth::id() === $task->user_id) {
            $task->details = $input['details'];
            $task->status = 1;
            $task->save();
            return $task;
        } else {
            abort(405);
        }
    }
}
