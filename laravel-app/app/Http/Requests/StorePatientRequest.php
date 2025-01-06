<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
            'document_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
