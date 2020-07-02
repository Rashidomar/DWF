<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Registrar extends Authenticatable
{
    protected $guard = 'registrar';
}
