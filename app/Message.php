<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'pesan';

    protected $fillable = [
        'jadwal_id', 'status', 'pelatih', 'pesan'
    ];

    public function Pelatih(){
    	return $this->belongsTo('App\User','pelatih');
    }

    public function Jadwal(){
    	return $this->belongsTo('App\Jadwal','jadwal_id');
    }
}
