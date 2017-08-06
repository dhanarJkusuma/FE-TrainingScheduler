<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'grup_latihan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'ketua_grup_id', 'nama_grup', 'lokasi_latihan_id'
    ];

    public function User(){
    	return $this->belongsTo('App\User', 'ketua_grup_id');
    }

    public function Anggota(){
        return $this->hasMany('App\User', 'grup_id');
    }

    public function Location(){
    	return $this->belongsTo('App\Location','lokasi_latihan_id');
    }

    public function Jadwal(){
        return $this->hasMany('App\Jadwal', 'grup_id');
    }
}
