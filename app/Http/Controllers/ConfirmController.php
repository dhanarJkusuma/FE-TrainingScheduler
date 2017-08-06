<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ConfirmController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        $users = User::where('is_approved','=',0)->where('status','=','santri')->paginate(10);
        return view('confirm')->with('users', $users);
    }

    public function approve(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->is_approved = true;
        $user->save();

        $this->checkConfirmation();

        $request->session()->flash('status', 'Berhasil menyetujui calon santri.');

        return redirect('confirm');
    }

    public function remove(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->delete();

        $this->checkConfirmation();

        $request->session()->flash('status', 'Berhasil menghapus calon santri.');

        return redirect('confirm');
    }
    
    public static function checkConfirmation(){
        $users = User::where('is_approved','=',0)->where('status','=','santri')->count();
        session(['confirm' => $users]);
    }
}

