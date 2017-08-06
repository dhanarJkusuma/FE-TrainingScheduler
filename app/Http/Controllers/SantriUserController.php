<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use Auth;
use App\Group;
use App\Message;
class SantriUserController extends Controller
{
	public function __construct(){
        $this->middleware(['auth','santri']);
    }

    public function index(){

        $group_id = Auth::user()->grup_id;
        if($group_id!=null){
            $day = date('N');
            $messages = Message::join('jadwal', function($join) use ($group_id){
                $join->on('pesan.jadwal_id','=','jadwal.id')
                    ->where('jadwal.grup_id','=', $group_id)
                    ->where('pesan.created_at','>', date('Y-m-d'));
            })->get();

            
            $hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
            $sesi = array(
                "Sesi I (06:00 - 11:00)",
                "Sesi II (13:00 - 17:00)",
                "Sesi III (20:00 - 00:00)"
            );
            $group = Group::find($group_id);    
            return view('santri.jadwal')->with(compact('group','hari','sesi','day','messages'));
        }
        
        return view('santri.no_group');
        
    }
}
