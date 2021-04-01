<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertHistory extends Model
{
    public function user(){return $this->belongsTo('App\User');}
    public function alert(){return $this->belongsTo('App\Alert');}
    public function alertAction(){return $this->belongsTo('App\AlertAction');}

}}
