<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Kecamatan;
use App\Group;
use App\Location;
use App\Http\Requests\StoreGroup;
use App\Http\Controllers\GlobalController;
use PDF;
class GroupController extends Controller
{


    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function insertGroup(array $data)
    {
        return Group::create([
            'ketua_grup_id' => null,
            'nama_grup' => $data['nama_grup'],
            'lokasi_latihan_id' => $data['lokasi_latihan_id']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Group::paginate(10);
        $location = Location::all();
        return view('group')->with(compact('groups', 'location'));
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
    public function store(StoreGroup $request)
    {
        $this->insertGroup($request->all());
        $request->session()->flash('status','Berhasil menambahkan group.');
        return redirect('group');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::find($id);
        $users = User::where('is_approved','=',1)->where('status','=','santri')->where('grup_id','=',$id)->get();
        return view('group-show')->with(compact('group','users'));
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
        $location = Location::all();
        $santri = User::where('is_approved','=',1)->where('status','=','santri')->get(['id','name']);
        return view('group-update')->with(compact('group', 'location','santri'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGroup $request, $id)
    {
        Group::where('id','=',$id)->update($request->except(['_token', '_method']));
        $request->session()->flash('status','Berhasil mengubah grup.');
        return redirect('group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        Group::where('id','=',$id)->delete();
        $request->session()->flash('status','Berhasil menghapus grup.');
        return redirect('group');
    }

    public function print(){
        $groups = Group::all();
        $data = array(
            'groups' => $groups
        );

        $pdf = PDF::loadView('group-print', $data);
        return $pdf->download('pagarnusa-grup.pdf');

    }

    public function changeLeader($id, Request $request){
        $group = Group::find($id);
        $group->ketua_grup_id = $request->input('leader');
        $group->save();
        GlobalController::calculateSession();
        $request->session()->flash('status','Berhasil mengubah grup.');

        return redirect()->route('group.show',['id' => $id]);
    }
}
