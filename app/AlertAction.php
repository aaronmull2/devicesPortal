<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertAction extends Model
{
    public function alertHistory(){return $this->hasMany('App\AlertHistory');}
}
