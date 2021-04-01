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

class AlertsController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    //Returns view of all Alerts
    public function index() {return view('alerts.index', [
        'alerts' => Alert::where('complete','=',0)->orderBy('id','ASC')->get(),
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
            'priority' => 'required'
        ]));
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
}
