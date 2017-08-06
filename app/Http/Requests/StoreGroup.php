<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroup extends FormRequest
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
            'ketua_grup_id' => 'required',
            'nama_grup' => 'required|string|max:25',
            'lokasi_latihan_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'ketua_grup_id.required' => 'Ketua Grup tidak boleh kosong.',
            'nama_grup.required' => 'Nama Grup tidak boleh kosong.',
            'lokasi_latihan_id.required' => 'Lokasi Latihan tidak boleh kosong.'
        ];
    }
}
