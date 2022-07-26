<?php

namespace App\Http\Requests;

class CategoryRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                    'email' => 'required',
                    'password' => 'required|min:8',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            // Validation messages
        ];
    }
}
