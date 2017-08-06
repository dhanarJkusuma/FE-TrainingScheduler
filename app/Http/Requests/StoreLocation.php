<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocation extends FormRequest
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
            'nama' => 'required',
            'alamat' => 'required|string|max:255',
            'kecamatan_id' => 'required',
            'penanggung_jawab' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama tidak boleh kosong.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'kecamatan_id.required' => 'Kecamatan tidak boleh kosong.',
            'penanggung_jawab.required' => 'Penanggung Jawab tidak boleh kosong.',
            'latitude.required'  => 'Lokasi kosong, mohon untuk menentukan lokasi pada google map.',
            'longitude.required' => 'Lokasi kosong, mohon untuk menentukan lokasi pada google map.'
        ];
    }
}
