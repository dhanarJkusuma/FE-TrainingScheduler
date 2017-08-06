<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';

    public function User(){
    	return $this->hasMany('App\Users', 'kecamatan_id');
    }

    public function Location(){
    	return $this->hasMany('App\Location', 'kecamatan_id');
    }
}
