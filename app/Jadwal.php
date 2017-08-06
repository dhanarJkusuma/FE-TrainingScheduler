<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'grup_id', 'hari', 'sesi', 'pelatih_i', 'pelatih_ii', 'pelatih_iii'
    ];
    
    public function Group(){
    	return $this->belongsTo('App\Group','grup_id');
    }

    public function Pelatih1(){
    	return $this->belongsTo('App\User', 'pelatih_i');
    }

    public function Pelatih2(){
    	return $this->belongsTo('App\User', 'pelatih_ii');
    }

    public function Pelatih3(){
    	return $this->belongsTo('App\User', 'pelatih_iii');
    }
}
