<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeltes;

class DeviceStatus extends Model
{
    public function device(){return $this->hasOne('App\Device');}

}
