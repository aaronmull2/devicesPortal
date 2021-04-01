<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public function alert(){return $this->hasMany('App\Alert');}

    public function site(){return $this->belongsTo('App\Site');}
    public function deviceStatus(){return $this->belongsTo('App\DeviceStatus');}
}
