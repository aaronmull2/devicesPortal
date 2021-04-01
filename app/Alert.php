<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use SoftDeletes;
    //protected $fillable = [ ];
    protected $guarded = [];

    public function alertAllocation(){return $this->hasOne('App\AlertAllocation');}
    public function alertComment(){return $this->hasMany('App\AlertComment');}
    public function alertHistory(){return $this->hasMany('App\AlertHistory');}

    public function user(){return $this->belongsTo('App\User');}
    public function alertType(){return $this->belongsTo('App\AlertType');}
    public function alertStatus(){return $this->belongsTo('App\AlertStatus');}
    public function device(){return $this->belongsTo('App\Device');}
}
