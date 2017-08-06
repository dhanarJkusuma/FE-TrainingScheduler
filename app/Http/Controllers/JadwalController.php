<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use App\Jadwal;
use App\User;
use App\Http\Requests\StoreJadwal;

class JadwalController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    
    public function insertJadwal(array $data)
    {
        return Jadwal::create([
            'grup_id' => $data['grup_id'],
            'hari' => $data['hari'],
            'sesi' => $data['sesi'],
            'pelatih_i' => ($data['pelatih_i']!=0) ? $data['pelatih_i'] : null,
            'pelatih_ii' => ($data['pelatih_ii']!=0) ? $data['pelatih_ii'] : null,
            'pelatih_iii' => ($data['pelatih_iii']!=0) ? $data['pelatih_iii'] : null
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $group = Group::find($id);
        $hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        $sesi = array(
            "Sesi I (06:00 - 11:00)",
            "Sesi II (13:00 - 17:00)",
            "Sesi III (20:00 - 12:00)"
        );
        $jadwal = Jadwal::where('grup_id','=',$id)->paginate(10);
        $pelatih = User::where('is_approved','=',1)->where('status','=','pelatih')->get(['id','name']);
        return view('jadwal')->with(compact('group','jadwal','pelatih', 'hari', 'sesi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJadwal $request)
    {
        $found = Jadwal::where('hari','=', $request->input('hari'))->where('sesi','=', $request->input('sesi'))->where('grup_id','=',$request->input('grup_id'))->count();
        if($found > 0){
            $request->session()->flash('error', "Gagal menambahkan jadwal. Hari, dan sesi sudah digunakan.");
        }else if($request->input('pelatih_i')==0){
            $request->session()->flash('error', "Gagal menambahkan jadwal. Pelatih I wajib untuk diisi.");
        }else{
            $this->insertJadwal($request->all());
            $request->session()->flash('status', 'Berhasil menambahkan jadwal.');
        }
        
        return redirect()->route('group-jadwal',['id' => $request->input('grup_id')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $group = Group::find($id);
        $hari = array("Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu");
        $sesi = array(
            "Sesi I (06:00 - 11:00)",
            "Sesi II (13:00 - 17:00)",
            "Sesi III (20:00 - 12:00)"
        );
        $jadwal = Jadwal::find($id);
        $pelatih = User::where('is_approved','=',1)->where('status','=','pelatih')->get(['id','name']);
        
        return view('jadwal-update')->with(compact('group','jadwal','pelatih', 'hari', 'sesi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreJadwal $request, $id)
    {
        $found = Jadwal::where('hari','=', $request->input('hari'))
                ->where('sesi','=', $request->input('sesi'))
                ->where('grup_id','=',$request->input('grup_id'))
                ->where('id', '<>', $id)
                ->count();
        if($found > 0){
            $request->session()->flash('error', "Gagal menambahkan jadwal. Hari, dan sesi sudah digunakan.");
        }else if($request->input('pelatih_i')==0){
            $request->session()->flash('error', "Gagal menambahkan jadwal. Pelatih I wajib untuk diisi.");
        }else{
            $data = $request->except(['_token', '_method']);
            $data['pelatih_ii'] = ($data['pelatih_ii']!=0) ? $data['pelatih_ii'] : null;
            $data['pelatih_iii'] = ($data['pelatih_iii']!=0) ? $data['pelatih_ii'] : null;
            
            Jadwal::find($id)->update($data);
            $request->session()->flash('status','Berhasil mengubah jadwal');
        }

        return redirect()->route('group-jadwal',['id' => $request->input('grup_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $jadwal = Jadwal::find($id);
        $grup_id = $jadwal->grup_id;
        $jadwal->delete();
        $request->session()->flash('status', 'Berhasil menghapus jadwal');
        return redirect()->route('group-jadwal',['id' => $grup_id]);
    }
}
