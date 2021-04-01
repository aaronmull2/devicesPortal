<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Site;
use App\Device;
use App\Alert;

class MapsController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    public function sitesMap() {
        return view('sites.map',[
            'sites' => Site::orderBy('id','ASC')->get(),
            'devices' => Device::orderBy('id','ASC')->get()
        ]);
    }

    public function alertsMap() {
        return view('alerts.map',[
            'alerts' => Alert::orderBy('id','ASC')->get(),
        ]);
    }
}
