<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|max:100',
            'address' => 'required|max:255',
            'role' => 'in:0,1,2',
        ];
        switch ($this->method()) {
            case 'POST':
                $rules['email'] = 'required|email:dns,max:100|unique:users,email';
                $rules['password'] = 'required|min:8|max:255';
                break;
            case 'PATCH':
                $rules['email'] = ['required', 'email:dns,max:100', Rule::unique('users', 'email')->ignore($this->user->username, 'username')];
                $rules['password'] = 'nullable|min:8|max:255';
                break;
            default:
                break;
        }

        return $rules;
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi dan tidak boleh kosong.',
            'name.max' => 'Nama tidak boleh lebih dari 100 karakter.',
            'address.required' => 'Alamat harus diisi dan tidak boleh kosong.',
            'address.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi dan tidak boleh kosong.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'email.max' => 'Email tidak boleh lebih dari 100 karakter.',
            'email.unique' => 'Email ini sudah digunakan. Silakan gunakan email yang lain.',
            'role.in' => 'Peran yang dipilih tidak valid.',
            'password.required' => 'Kata sandi harus diisi dan tidak boleh kosong.',
            'password.min' => 'Kata sandi harus memiliki minimal 8 karakter.',
            'password.max' => 'Kata sandi tidak boleh lebih dari 255 karakter.',
            'password.nullable' => 'Kata sandi boleh tidak diisi.',
        ];
    }
}
