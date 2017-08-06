<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PelatihController;
use App\Http\Controllers\SantriController;
class DashboardController extends Controller
{
	public function __construct(){
        $this->middleware(['auth','admin']);
        ConfirmController::checkConfirmation();
        LocationController::checkCount();
        PelatihController::checkCount();
        SantriController::checkCount();
    }
	

    public function index(){
    	return view('dashboard');
    }
}
