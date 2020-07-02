<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    public function staff(){

        return $this->belongsTo('App\Staff');
    }


}
