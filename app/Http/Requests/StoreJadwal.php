<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJadwal extends FormRequest
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
            'grup_id' => 'required',
            'hari' => 'required',
            'sesi' => 'required',
            'pelatih_i' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'grup_id.required' => 'Grup tidak boleh kosong.',
            'hari.required' => 'Hari tidak boleh kosong.',
            'sesi.required' => 'Sesi tidak boleh kosong.',
            'pelatih_i.required' => 'Pelatih I tidak boleh kosong'
        ];
    }
}
