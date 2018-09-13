<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    protected $guarded=[];
    
    function user(){
        return $this->belongsTo('App\Model\User')->withDefault();
    }
    
}
