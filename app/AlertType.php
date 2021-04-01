<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertType extends Model
{
    public function alert(){return $this->hasOne('App\Alert');}
}
