<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Kecamatan;
use App\Group;
use App\Http\Requests\StoreSantri;
use App\Http\Controllers\GlobalController;

class SantriController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function insertUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'kecamatan_id' => $data['kecamatan_id'],
            'password' => bcrypt($data['password']),
            'status' => 'santri',
            'is_approved' => 1,
            'alamat' => $data['alamat']
        ]);
    }

    public function index()
    {
        GlobalController::calculateSession();
        $groups = Group::all(['id', 'nama_grup']);
        $users = User::where('is_approved', '=', 1)->where('status', '=', 'santri')->paginate(10);
        $kecamatan = Kecamatan::all();
        return view('santri')->with(compact('users', 'kecamatan','groups'));
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
    public function store(StoreSantri $request)
    {
        $this->insertUser($request->all());
        $request->session()->flash('status','Berhasil menambahkan santri.');
        return redirect('santri');
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
        $user = User::where('status','=','santri')->where('is_approved','=', 1)->where('id','=',$id)->first();
        $kecamatan = Kecamatan::all();
        return view('santri-update')->with(compact('user', 'kecamatan'));
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
        User::where('status','=','santri')->where('is_approved','=', 1)->where('id','=',$id)->update($request->except(['_token', '_method']));
        $request->session()->flash('status','Berhasil mengubah santri.');
        return redirect('santri');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $found = Group::where('ketua_grup_id','=', $id)->count();
        if($found > 0){
            $request->session()->flash('error','Gagal menghapus santri. Santri tersebut masih menjabat sebagai ketua grup.');
        }else{
            User::where('status','=','santri')->where('is_approved','=', 1)->where('id','=',$id)->delete();
            $request->session()->flash('status','Berhasil menghapus santri.');
        }
        
        return redirect('santri');
    }

    public function chgroup($id, Request $request){
        $santri = User::where('status' , '=', 'santri')->where('is_approved', '=', 1)->where('id', '=', $id)->first();
        $santri->grup_id = $request->input('grup_id');
        $santri->save();

        $request->session()->flash('status', 'Berhasil mengganti grup santri.');
        return redirect('santri');
    }

    public static function checkCount(){
        $santri = User::where('is_approved','=',1)->where('status','=','santri')->count();
        session(['santri' => $santri]);
    }

    public function lvlup($id, Request $request){
        $isExist = Group::where('ketua_grup_id','=',$id)->count();
        if($isExist > 0){
            $request->session()->flash('error', 'Gagal menjadikan santri yang bernama "' . $user->name . '" sebagai pelatih. Hapus jabatan santri tersebut sebagai ketua grup.');    
        }else{
            $user = User::find($id);
            $user->grup_id = null;
            $user->status = 'pelatih';
            $user->save();
            $request->session()->flash('status', 'Berhasil menjadikan santri yang bernama "' . $user->name . '" sebagai pelatih.');    
        }
        
        return redirect('santri');
    }
}
