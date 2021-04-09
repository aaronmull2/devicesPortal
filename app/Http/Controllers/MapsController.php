<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Site;
use App\Device;
use App\Alert;
use App\EngineerLocation;

class MapsController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    public function sitesMap() {
        return view('sites.map',[
            'sites' => Site::with('location')->with('device')->get(),
        ]);
    }

    public function sitesRemap() {
        return Site::with('location')->with('device')->get();
    }

    public function alertsMap() {
        return view('alerts.map',[
            'alerts' => Alert::with('device.site.location')->with('alertStatus')->with('user')->get(),
        ]);
    }

    public function alertsRemap() {
        return Alert::with('device.site.location')->with('alertStatus')->with('user')->get();
    }

    public function usersMap() {
        return view('users.map',[
            'engineers' => EngineerLocation::with('user')->get(),
        ]);
    }

    public function usersRemap() {
        return EngineerLocation::with('user')->get();
    }
}
