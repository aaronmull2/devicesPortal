<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];
    //protected $guarded = []

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function alertAllocation(){return $this->hasOne('App\AlertAllocation');}
    public function alertAllocationsAllocated(){return $this->hasOne('App\AlertAllocation', 'allocated_user_id');}
    public function alertComment(){return $this->hasMany('App\AlertComment');}
    public function alertHistory(){return $this->hasMany('App\AlertHistory');}
    public function alert(){return $this->hasMany('App\Alert');}
    public function engineerLocation(){return $this->hasMany('App\EngineerLocation');}

    public function role(){return $this->belongsTo('App\Role');}
}
