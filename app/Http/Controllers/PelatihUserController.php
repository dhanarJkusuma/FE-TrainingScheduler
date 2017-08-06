<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Group;
use App\Location;
use Auth;
class PelatihUserController extends Controller
{
	public function __construct(){
        $this->middleware(['auth','pelatih']);
    }

    public function index(){
        $day = date('N');
        $id = Auth::user()->id;
        $hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        $sesi = array(
            "Sesi I (06:00 - 11:00)",
            "Sesi II (13:00 - 17:00)",
            "Sesi III (20:00 - 00:00)"
        );
        $jadwal = Jadwal::where('hari','=', $day)
                        ->where(function ($query) use ($id) {
                           $query->where('pelatih_i','=', $id)
                            ->orWhere('pelatih_ii','=',$id)
                            ->orWhere('pelatih_iii','=',$id);
                        })           
                        ->orderBy('hari','asc')
                        ->get();

    	return view('pelatih.home')->with(compact( 'hari', 'sesi','jadwal'));
    }

    public function showJadwal(){
    	$id = Auth::user()->id;
    	$hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        $sesi = array(
            "Sesi I (06:00 - 11:00)",
            "Sesi II (13:00 - 17:00)",
            "Sesi III (20:00 - 00:00)"
        );
    	$jadwal = Jadwal::where('pelatih_i','=', $id)
    					->orWhere('pelatih_ii','=',$id)
    					->orWhere('pelatih_iii','=',$id)
    					->orderBy('hari','asc')
    					->get();
        $user = Auth::user();
    	return view('pelatih.jadwal')->with(compact('jadwal', 'hari', 'sesi','user'));
    }

    public function showDetail($id){
        $jadwal = Jadwal::find($id);
        $sesi = array(
            "Sesi I (06:00 - 11:00)",
            "Sesi II (13:00 - 17:00)",
            "Sesi III (20:00 - 00:00)"
        );
        $hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        $anggota = Group::find($jadwal->grup_id);
        $location = Location::find($anggota->lokasi_latihan_id);
        return view('pelatih.detail_jadwal')->with(compact('jadwal','hari','sesi','anggota','location'));
    }
}
