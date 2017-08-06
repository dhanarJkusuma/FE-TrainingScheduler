<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Message;
class MessageController extends Controller
{

	public function insertBroadcast(array $data, $id)
    {
        return Message::create([
            'jadwal_id' => $id,
            'status' => 'biasa',
            'pelatih' => Auth::user()->id,
            'pesan' => $data['pesan']
        ]);
    }

    public function insertCancelation(array $data, $id)
    {
        return Message::create([
            'jadwal_id' => $id,
            'status' => 'batal',
            'pelatih' => Auth::user()->id,
            'pesan' => $data['pesan']
        ]);
    }

    public function sendBroadcast(Request $request, $id){


        $this->validate($request, [
            'pesan' => 'required'
        ]);

        
        if($request->input('pesan') != null){
          	$this->insertBroadcast($request->all(), $id);
          	$request->session()->flash('status', 'Berhasil mengirimkan pesan.');
            return redirect('home/pelatih');
        }


        return redirect('/')
            ->withErrors([
                'pesan' => 'Pesan tidak boleh kosong.'
            ]);
    }

    public function sendCancelation(Request $request, $id){
    	$this->validate($request, [
            'pesan' => 'required'
        ]);

        
        if($request->input('pesan') != null){
          	$this->insertCancelation($request->all(), $id);
          	$request->session()->flash('status', 'Berhasil mengirimkan pesan pembatalan jadwal.');
            return redirect('home/pelatih');
        }


        return redirect('/')
            ->withErrors([
                'pesan_batal' => 'Pesan tidak boleh kosong.'
            ]);
    }

    public function send($number, $name, $message)
    {
        abort_if(!function_exists('curl_init'), 400, 'CURL is not installed.');
 
        $curl = curl_init('http://smsgateway.me/api/v3/messages/send');
 
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, [
            'email'    => config('smsgateway.email'),
            'password' => config('smsgateway.password'),
            'device'   => config('smsgateway.device'),
            'number'   => $number,
            'name'     => $name,
            'message'  => $message,
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
        $response = json_decode(curl_exec($curl));
 
        curl_close($curl);
 
    }


}
