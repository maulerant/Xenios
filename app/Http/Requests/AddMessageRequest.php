<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddMessageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user' => [
                'required',
                'string'
            ],
            'text' => [
                'string'
            ],
            'group_id' => [
                'required',
                'integer',
                'exists:group_of_messages,id'
            ]
        ];
    }
}
