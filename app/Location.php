<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes;
    //protected $fillable = ['name','email','role','password'];
    protected $guarded = [];

    public function site(){return $this->hasOne('App\Site');}
}
