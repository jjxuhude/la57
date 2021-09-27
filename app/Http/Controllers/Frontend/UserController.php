<?php

namespace App\Http\Controllers\Frontend;


use App\Model\User;
use App\Services\Demo;
use App\Facades\RouteConfig;

class UserController extends Controller
{


    function index(){
        return parent::index();
    }
    
    /**
     * 登录
     * @method post
     */
    function login(){
        $password= User::where("name",request("name"))->value("password");
        if($password){
            return response()->json([
                "code"=>1,
                "data"=>[
                    "token"=>$password
                ]
            ]);
        }else{
            return response()->json([
                "code"=>0,
                "message"=>"用户名或者密码错误!!"
            ]);
        }
    }
    


    
}
