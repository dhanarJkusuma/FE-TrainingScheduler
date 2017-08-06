<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Kecamatan;

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
            'kecamatan_id' => 'required'

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
        ]);
    }

    public function showRegistrationForm(){
        $kecamatan = Kecamatan::all();
        return view('auth.register')->with('kecamatan', $kecamatan);
    }

    public function register(Request $request){
        
        $data = $this->validator($request->all());
        $this->create($request->all());
        $this->sendMessage($request->input('no_hp'));
        $request->session()->flash('status', 'Permohonan pendaftaran telah terkirim. Mohon untuk mendatangi kantor pusat Pagar Nusa untuk konfirmasi lebih lanjut.');

        return redirect('login');
    }

    private function sendMessage($phone_no){
        $userkey = config('smsgateway.zensiva_user_key');
        $passkey = config('smsgateway.zensiva_user_pass');
        $pesan = rawurlencode(config('smsgateway.zensiva_message'));

        $url = 'https://reguler.zenziva.net/apps/smsapi.php?userkey='. $userkey .'&passkey='. $passkey .'&nohp='. $phone_no .'&pesan='. $pesan;
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec ($ch);
        $info = curl_getinfo($ch);
        $http_result = $info ['http_code'];
        curl_close ($ch);
    }
}
