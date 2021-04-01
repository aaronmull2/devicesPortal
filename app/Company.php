<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;
    //protected $fillable = ['name','email','role','password'];
    protected $guarded = [];

    public function site(){return $this->hasMany('App\Site');}
}

