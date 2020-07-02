<?php

namespace App;

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Staff extends  Authenticatable
{
    protected $guard = 'staff';

    public function document(){

        return $this->hasMany('App\Document');
    }
}
