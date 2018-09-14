<?php

namespace App\Http\Controllers\Frontend;


use App\Services\Demo;
use App\Facades\RouteConfig;

class DemoController extends Controller
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
    
    /**
     * 写入session
     * @method get
     */
    function session(){
        $time=session('time',function (){
            return [];
        });
        array_push($time, date('YmdHis'));
        session(['time'=>$time]);
        return redirect()->route('demo.session1');
    }
    
    /**
     * 获取session
     * @method get
     */
    function session1(){
        dump(session('time'));
    } 

    
}
