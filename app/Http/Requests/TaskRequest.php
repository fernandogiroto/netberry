<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    public function rules()
    {
        return [
            'task_name' => 'required',
            'task_category' => 'required',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
