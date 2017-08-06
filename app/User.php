<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'no_hp', 'kecamatan_id', 'alamat', 'password', 'status', 'is_approved', 'grup_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Kecamatan(){
        return $this->belongsTo('App\Kecamatan','kecamatan_id');
    }

    public function Penanggung(){
        return $this->hasMany('App\Location', 'penanggung_jawab');
    }

    public function Ketua(){
        return $this->hasMany('App\Group', 'ketua_group_id');
    }

    public function Group(){
        return $this->belongsTo('App\Group', 'grup_id');
    }
}
