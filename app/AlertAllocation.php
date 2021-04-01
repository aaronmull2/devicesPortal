<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlertAllocation extends Model
{
    public function user(){return $this->belongsTo('App\User');}
    public function userAllocated(){return $this->belongsTo('App\User', 'allocated_user_id');}
    public function alert(){return $this->belongsTo('App\Alert');}
}
