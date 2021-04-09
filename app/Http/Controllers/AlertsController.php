<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Alert;
use App\User;
use App\AlertStatus;
use App\AlertType;
use App\Site;
use App\Device;
use App\EngineerLocation;

class AlertsController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }

    //Returns view of all Alerts
    public function index() {return view('alerts.index', [
        'alerts' => Alert::where('complete','=',0)->orderBy('id','ASC')->get(),
        'rName' => Auth::user()->role->title,

    ]);}

    public function userIndex() {return view('alerts.index', [
        'alerts' => Alert::where('complete','=',0)->where('user_id','=',Auth::user()->id)->orderBy('id','ASC')->get(),
        'rName' => Auth::user()->role->title,
    ]);}
    

    //Returns view of specific Alert
    public function show(Alert $alert) {return view('alerts.show',[
            'alert' => Alert::where('complete','=',0)->where('id','=',$alert->id)->firstOrFail(),
            'rName' => Auth::user()->role->title,
        ]);}

    //Returns a form for creation on an alert
    public function create() {
        return view('alerts.create',[
            'statuses' => AlertStatus::orderBy('id', 'ASC')->get(),
            'types' => AlertType::orderBy('id', 'ASC')->get(),
            'users' => User::where('role_id',3)->orWhere('role_id',4)->get(),
            'sites' => Site::orderBy('id', 'ASC')->get(),
            'devices' => Device::orderBy('id', 'ASC')->get(),]);
    }

    //Stores the Alert created above in the DB
    public function store() {
        Alert::create(request()->validate([
            'title' => 'required',
            'message' => 'required',
            'user_id' => 'exists:users,id',
            'alert_type_id' => 'exists:alert_types,id',
            'alert_status_id' => 'exists:alert_statuses,id',
            'device_id' => 'exists:devices,id',
            'priority' => 'required',
        ]));
        return redirect('/alerts/');
    }

    //Returns a view to edit an Alert based on its id
    public function edit(Alert $alert) {
        return view('alerts.edit',[
            'alert' => $alert,
            'statuses' => AlertStatus::orderBy('id', 'ASC')->get(),
            'types' => AlertType::orderBy('id', 'ASC')->get(),
            'users' => User::where('role_id',3)->orWhere('role_id',4)->get()]);
    }

    //Updates the Alert on the DB
    public function update(Alert $alert) {
        $alert->update(request()->validate([
            'title'=>'required',
            'message'=>'required',
            'user_id' => 'exists:users,id',
            'alert_type_id' => 'exists:alert_types,id',
            'alert_status_id' => 'exists:alert_statuses,id'])
        );
        return redirect('/alerts/' . $alert->id);
    }

    public function complete(Alert $alert) {
        $alert->complete = 1;
        $alert->update();

        return redirect('/alerts');
    }

    //This deletes a specific user by populating the deleted_at column
    public function destroy(Alert $alert) {
        $alert->delete();
        return redirect('/alerts');
    }

    private function checkForAlert($deviceId) {
        $count = 0;
        $alerts = Alert::orderBy('id','ASC')->get();
        foreach($alerts as $alert) {
            if($alert->device_id == $deviceId) {
                $count++;
            }
        }
        if($count > 0) {return true;} else {return false;}
    }

    private function closestEngineer($device) {
        $locations = EngineerLocation::orderBy('id','ASC')->get();
        $tempUserId;
        $dArray = array();$latArray = array();$lngArray = array();
        $lowestDistance = 40075;
        $lat1 = $device->site->location->lat;
        $lng1 = $device->site->location->lng;

        foreach ($locations as $location) {
            $lat2 = $location->lat;
            $lng2 = $location->lng;

            $latArray[] = $lat2;
            $lngArray[] = $lng2;

            $theta = $lng1 - $lng2; 
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
            $dist = acos($dist); 
            $dist = rad2deg($dist); 
            $km = $dist * 60 * 1.1515 * 1.609344;

            $dArray[] = $km;

            if ($km < $lowestDistance) {
                $lowestDistance = $km;
                $tempUserId = $location->user_id;
            }
        }
        return $tempUserId;
    }
    
    public function deviceAlert($alertTypeId,$deviceId) {
        $device = Device::where('id','=',$deviceId)->firstOrFail();
        $alertType = AlertType::where('id','=',$alertTypeId)->firstOrFail();
        
        if($this->checkForAlert($deviceId) === false) {
            Alert::create([
                'title' => $device->name.' - '.$alertType->title,
                'message' => ' ',
                'user_id' => $this->closestEngineer($device),
                'alert_type_id' => $alertTypeId,
                'device_id' => $deviceId,
                'alert_status_id' => 3,
                'priority' => 1,
                'complete' => 0,
            ]);
        }
        return redirect('/alerts/');
    } 
}
