<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Device;
use App\Site;
use App\DeviceStatus;

class DevicesController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    //Returns a view of all Devices
    public function index() {return view('devices.index',[
        'devices' => Device::orderBy('id','ASC')->get(),
        'rName' => Auth::user()->role->title,
    ]);}

    //Returns a view showing a specific Device
    public function show(Device $device) {return view('devices.show',[
        'device' => $device,
        'rName' => Auth::user()->role->title,
    ]);}

    //Returns a view to create a Device
    public function create() {return view('devices.create',[
        'statuses' => DeviceStatus::orderBy('id', 'ASC')->get(),
        'sites' => Site::orderBy('id', 'ASC')->get(),
        ]);
    }

    //Stores the above  reated Device
    public function store() {
        Device::create(request()->validate([
            'name'=>'required',
            'active'=>'required',
            'site_id'=>'exists:sites,id',
            'device_status_id'=>'exists:device_statuses,id'
        ]));
        return redirect('/devices');
    }

    //Returns a view to edit a specific Device
    public function edit(Device $device) {return view('devices.edit',[
        'device'=>$device,
        'statuses' => DeviceStatus::orderBy('id', 'ASC')->get(),
        'sites' => Site::orderBy('id', 'ASC')->get(),
        ]);}

    //Updates the above edited Device
    public function update(Device $device) {
        $device->update(request()->validate([
            'name'=>'required',
            'active'=>'required',
            'site_id'=>'required',
            'device_status_id'=>'required'
        ]));
        return redirect('/devices/' . $device->id);
    }

    //Deletes a specific Device
    public function destroy(Device $device) {
        $device->delete();
        return redirect('/devices');
    }
}
