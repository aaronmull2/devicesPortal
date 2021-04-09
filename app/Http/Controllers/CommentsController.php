<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;

use App\AlertComment;
use App\Alert;

class CommentsController extends Controller
{
    public function __construct() {$this->middleware('auth');}

    public function index(Alert $alert) {
        return view('alerts.comments',[
            'comments'=> AlertComment::where('alert_id','=',$alert->id)->get(),
            'alert' => Alert::where('id','=',$alert->id)->firstOrFail(),
        ]);
    }

    public function store(Alert $alert) {
        $rMessage = request()->validate(['message' => 'required']);
        AlertComment::create([
            'user_id' => Auth::user()->id,
            'alert_id' => $alert->id,
            'message' => $rMessage['message'],
        ]);

        return redirect('/alerts/'.$alert->id.'/comments');
    }
}
