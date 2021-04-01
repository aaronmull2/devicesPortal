<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDelete;

class Role extends Model
{
    public function user(){return $this->hasMany('App\User');}
}
