<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Location;
use App\Group;
use App\Kecamatan;
use App\Http\Requests\StoreLocation;
use App\Http\Controllers\GlobalController;
class LocationController extends Controller
{

    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    
    public function insertLocation(array $data)
    {
        return Location::create([
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'kecamatan_id' => $data['kecamatan_id'],
            'penanggung_jawab' => $data['penanggung_jawab'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude']
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

        $kecamatan = Kecamatan::all();
        $location = Location::paginate(10);
        $pelatih = User::where('status', '=', 'pelatih')->where('is_approved', '=', 1)->get(['id', 'name']);


        return view('location')->with(compact('pelatih','location','kecamatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocation $request)
    {
        $this->insertLocation($request->all());
        $request->session()->flash('status','Berhasil menambahkan lokasi latihan.');
        return redirect('location');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $location = Location::find($id);
        return view('location-show')->with(compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = Kecamatan::all();
        $location = Location::find($id);
        $pelatih = User::where('status', '=', 'pelatih')->where('is_approved', '=', 1)->get(['id', 'name']);
        return view('location-update')->with(compact('location', 'pelatih', 'kecamatan'));
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
        Location::where('id','=',$id)->update($request->except(['_token', '_method']));
        $request->session()->flash('status','Berhasil mengubah lokasi latihan.');
        return redirect('location');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $groups = Group::where('lokasi_latihan_id','=',$id)->count();
        if($groups > 0){
            $request->session()->flash('error','Gagal menghapus lokasi latihan. Lokasi masih digunakan sebagai tempat latihan.');    
        }else{
            Location::where('id','=',$id)->delete();
            $request->session()->flash('status','Berhasil menghapus lokasi latihan.');    
        }
        
        return redirect('location');
    }

    public static function checkCount(){
        $lokasi = Location::count();
        session(['lokasi' => $lokasi]);
    }
}
