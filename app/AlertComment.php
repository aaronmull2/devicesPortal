<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertComment extends Model
{
    public function user(){return $this->belongsTo('App\User');}
    public function alert(){return $this->belongsTo('App\Alert');}
}
