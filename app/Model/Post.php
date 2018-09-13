<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded=[];
    
    public   $timestamps=false;
    
    function user(){
        return $this->belongsTo('App\Model\User');
    }
}
