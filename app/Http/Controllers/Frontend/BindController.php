<?php

namespace App\Http\Controllers\Frontend;


use App\Services\Demo;
use App\Facades\RouteConfig;

class BindController extends Controller
{


    function index(){
        return parent::index();
    }
    
    /**
     * 
     * @method get
     */
    function when(){
         app()->singleton('demo',Demo::class);
         dump(app()->make('demo',['aaa'=>'333']));
         dump(app()->make('demo',['aaa'=>'444']));
         RouteConfig::aaa();
    }

    
}
