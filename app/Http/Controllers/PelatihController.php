<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kecamatan;
use App\Location;
use Illuminate\Pagination\Paginator;
use App\Http\Requests\StorePelatih;
use App\Http\Controllers\GlobalController;
class PelatihController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function insertUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'kecamatan_id' => $data['kecamatan_id'],
            'password' => bcrypt($data['password']),
            'status' => 'pelatih',
            'is_approved' => 1,
            'alamat' => $data['alamat']
        ]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        GlobalController::calculateSession();
        $users = User::where('is_approved', '=', 1)->where('status', '=', 'pelatih')->paginate(10);
        $kecamatan = Kecamatan::all();
        return view('pelatih')->with(compact('users', 'kecamatan'));
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
    public function store(StorePelatih $request)
    {
        $this->insertUser($request->all());
        $request->session()->flash('status','Berhasil menambahkan pelatih.');
        return redirect('pelatih');
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
        $user = User::where('status','=','pelatih')->where('is_approved','=',1)->where('id','=',$id)->first();
        $kecamatan = Kecamatan::all();
        return view('pelatih-update')->with(compact('user', 'kecamatan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('status','=','pelatih')->where('is_approved','=',1)->where('id','=',$id)->update($request->except(['_token', '_method']));
        $request->session()->flash('status','Berhasil mengubah pelatih.');
        return redirect('pelatih');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $found = Location::where('penanggung_jawab','=', $id)->count();
        $pelatih = Jadwal::where('pelatih_i','=',$id)->count();

        if($found > 0){
            $request->session()->flash('error','Gagal menghapus pelatih, pelatih masih menjadi tanggung jawab pengurus lokasi. ');    
        }else if($pelatih > 0){
            $request->session()->flash('error','Gagal menghapus pelatih, pelatih masih menjadi pelatih 1. ');    
        }else{
            User::where('status','=','pelatih')->where('is_approved','=',1)->where('id','=',$id)->delete();
            $request->session()->flash('status','Berhasil menghapus pelatih.');    
        }
        
        return redirect('pelatih');
    }

    public static function checkCount(){
        $pelatih = User::where('is_approved','=',1)->where('status','=','pelatih')->count();
        session(['pelatih' => $pelatih]);
    }
}
