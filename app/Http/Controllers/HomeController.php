<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\Alert;
use App\Device;

class HomeController extends Controller
{
    public function __construct(){$this->middleware('auth');}

    public function alertCount() {
        $count = 0;
        $alerts = Alert::orderBy('id','ASC')->get();

        foreach ($alerts as $alert) {
            $count++;
        }
        return $count;
    }

    public function userAlertCount() {
        $count = 0;
        $alerts = Alert::orderBy('id','ASC')->get();

        foreach ($alerts as $alert) {
            if(Auth::user()->id === $alert->user_id) {
                $count++;
            }
        }
        return $count;
    }

    public function devicesDown() {
        $count = 0;
        $devices = Device::orderBy('id','ASC')->get();

        foreach ($devices as $device) {
            if ($device->active === 0) {
                $count++;
            }
        }
        return $count;
    }

    public function index() {
        if(Auth::user()->role->title === "basic") {
            return view('home');
        } else {
            return view('dashboard',[
                'userAlertCount'=>$this->userAlertCount(),
                'alertCount'=>$this->alertCount(),
                'devicesDown'=>$this->devicesDown(),
        ]);}
    }
}
