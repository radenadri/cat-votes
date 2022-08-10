<?php

namespace App\Admin\Cats\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'is_active' => 'required',
            'breed_id' => 'required|exists:breeds,id',
            'avatar' => 'nullable|image|mimes:png,jpg',
        ];
    }
}
