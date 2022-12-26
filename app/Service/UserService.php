<?php

namespace App\Service;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function tasks(): object
    {
        return Task::get();
    }

    public function update($input, $task): object
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
