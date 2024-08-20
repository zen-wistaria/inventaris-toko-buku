<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
            'author' => 'required|max:100',
            'publisher' => 'required|max:100',
            'price' => 'required|numeric',
            'year' => 'required|numeric|digits:4',
        ];
        switch ($this->method()) {
            case 'POST':
                $rules['title'] = ['required', 'max:100', Rule::unique('books', 'title')];
                break;
            case 'PATCH':
                $rules['title'] = ['required', 'max:100', Rule::unique('books', 'title')->ignore($this->book->slug, 'slug')];
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
            'title.required' => 'Judul harus diisi dan tidak boleh kosong.',
            'title.max' => 'Judul tidak boleh lebih dari 100 karakter.',
            'title.unique' => 'Judul harus unik. Judul ini sudah digunakan.',
            'author.required' => 'Nama penulis harus diisi dan tidak boleh kosong.',
            'author.max' => 'Nama penulis tidak boleh lebih dari 100 karakter.',
            'publisher.required' => 'Nama penerbit harus diisi dan tidak boleh kosong.',
            'publisher.max' => 'Nama penerbit tidak boleh lebih dari 100 karakter.',
            'price.required' => 'Harga harus diisi dan tidak boleh kosong.',
            'price.numeric' => 'Harga harus berupa Angka.',
            'year.required' => 'Tahun terbit harus diisi dan tidak boleh kosong.',
            'year.numeric' => 'Tahun terbit harus berupa Angka.',
            'year.digits' => 'Tahun terbit harus berupa angka 4 digit.',
        ];
    }
}
