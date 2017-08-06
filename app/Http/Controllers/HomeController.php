<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword(Request $request, $id){

        if(strlen($request->input('password')) >= 6 && $request->input('password') == $request->input('password_confirmation')){
            $user = User::find($id);
            $user->password = bcrypt($request->input('password'));
            $user->save();
            $request->session()->flash('status', 'Berhasil mengubah password pengguna.');
        }else if(strlen($request->input('password')) < 6){
            $request->session()->flash('status', 'Password harus 6 karakter atau lebih');
        }else{
            $request->session()->flash('status', 'Password confirmasi harus sama.');
        }
        
        if($request->input('menu') == 'santri'){
            return redirect('santri');
        }else{
            return redirect('pelatih');
        }
    }
}
