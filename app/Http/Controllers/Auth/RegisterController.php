<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Kecamatan;
use App\Http\Controllers\GlobalController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'no_hp' => 'required|min:10|max:16',
            'kecamatan_id' => 'required',
            'alamat' => 'required'

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'kecamatan_id' => $data['kecamatan_id'],
            'password' => bcrypt($data['password']),
            'alamat' => $data['alamat']
        ]);
    }

    public function showRegistrationForm(){
        $kecamatan = Kecamatan::all();
        return view('auth.register')->with('kecamatan', $kecamatan);
    }

    public function register(Request $request){
        
        $data = $this->validator($request->all());
        $this->create($request->all());
        GlobalController::sendMessage($request->input('no_hp'), config('smsgateway.zensiva_message'))
        $request->session()->flash('status', 'Permohonan pendaftaran telah terkirim.');

        return redirect('login');
    }

}
