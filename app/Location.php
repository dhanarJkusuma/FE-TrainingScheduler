<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'lokasi_latihan';

    protected $fillable = [
        'nama', 'alamat', 'kecamatan_id', 'penanggung_jawab', 'latitude', 'longitude'
    ];

    public function User(){
    	return $this->belongsTo('App\User', 'penanggung_jawab');
    }

    public function Kecamatan(){
    	return $this->belongsTo('App\Kecamatan','kecamatan_id');
    }

    public function Group(){
    	return $this->hasMany('App\Location', 'lokasi_latihan_id');
    }
}
