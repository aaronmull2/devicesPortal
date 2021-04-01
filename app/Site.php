<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Site extends Model
{
    use SoftDeletes;
    //protected $fillable = ['name','email','role','password'];
    protected $guarded = [];

    public function device(){return $this->hasMany('App\Device');}

    public function alert(){return $this->hasManyThrough('App\Device', 'App\Alert');}

    public function company(){return $this->belongsTo('App\Company');}
    public function location(){return $this->belongsTo('App\Location');}
}
