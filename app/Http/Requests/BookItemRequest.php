<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookItemRequest extends FormRequest
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
        return [
            'book_id' => 'numeric|required',
            'total_books' => 'numeric|required',
            'date' => 'date|required',
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.required' => 'Buku harus di pilih dan tidak boleh kosong.',
            'book_id.numeric' => 'Buku harus berupa angka.',
            'total_books.required' => 'Jumlah buku harus di isi dan tidak boleh kosong.',
            'total_books.numeric' => 'Jumlah buku harus berupa angka.',
            'date.required' => 'Tanggal harus di isi dan tidak boleh kosong.',
            'date.date' => 'Tanggal harus berupa tanggal yang valid.',
        ];
    }
}
