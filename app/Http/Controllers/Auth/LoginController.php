<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
    
        //dd( $this->getCredentials($request) );
        $authenticated = false;

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
            'is_approved' => 1
        );

        
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $authenticated = true;
        }
        


        if($authenticated){
            switch (Auth::user()->status) {
                case 'admin':
                    $this->redirectTo = 'dashboard';
                    break;
                case 'pelatih':
                    $this->redirectTo = 'home/pelatih';
                    break;
                case 'santri':
                    $this->redirectTo = 'home/santri';
                    break;
            }
            return redirect()->intended($this->redirectTo);
        }


        return redirect('/login')
            ->withErrors([
                'email' => 'Pengguna tidak ditemukan, atau belum disetujui.',
                'password' => '  '
            ]);
    }

}
