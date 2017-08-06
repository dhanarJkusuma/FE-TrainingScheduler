<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\SantriController;

class GlobalController extends Controller
{
    public function __construct(){
    	
    }

    public static function calculateSession(){
    	ConfirmController::checkConfirmation();
        LocationController::checkCount();
        PelatihController::checkCount();
        SantriController::checkCount();
    }

    public static function sendMessage($phone_no, $message){
        $userkey = config('smsgateway.zensiva_user_key');
        $passkey = config('smsgateway.zensiva_user_pass');
        $pesan = rawurlencode($message);

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
