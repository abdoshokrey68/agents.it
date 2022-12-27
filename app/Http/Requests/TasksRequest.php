<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|min:2|max:100',
            'user_id'   => 'required|exists:users,id',
            'project_id'=> 'required|exists:projects,id'
        ];
    }
}
