<?php

namespace App\Admin\Cats\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BreedRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'is_active' => 'required',
        ];
    }
}
