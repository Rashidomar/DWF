<?php

namespace App;



// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Dean extends Authenticatable
{
    protected $guard = 'dean';
}
