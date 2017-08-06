<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSantri extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'no_hp' => 'required|min:5|max:16',
            'kecamatan_id' => 'required',
            'alamat' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong.',
            'email.unique' => 'Email sudak dipakai.',
            'email.required' => 'Email tidak boleh kosong.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.confirmed' => 'Password konfirmasi harus sesuai.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'no_hp'  => 'No Hp tidak boleh kosong.',
            'no_hp.min' => 'No Hp minimal 5 karakter'
        ];
    }
}
