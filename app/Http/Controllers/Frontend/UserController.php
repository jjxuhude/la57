<?php

namespace App\Http\Controllers\Frontend;


use App\Model\RolePermission;
use App\Model\User;
use App\Services\Demo;
use App\Facades\RouteConfig;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{


    function index()
    {
        return parent::index();
    }

    /**
     * 登录
     * @method post
     */
    function login()
    {
        $password = User::where("name", request("username"))->value("password");
        if ($password) {
            return $this->success([
                "access_token" => $password,
                "token_type" => $password,
                "refresh_token" => $password,
                "expires_in" => $password,
                "expires_in" => $password,
                "scope" => $password,
                "jti" => $password,
            ]);
        } else {
            return $this->error("用户名或者密码错误!!!!!!!!!!!");
        }
    }

    /**
     * 登录
     * @method post
     */
    function logout()
    {
        return $this->success("success");
    }

    /**
     * 登录
     * @method get
     */
    function info()
    {

        $token = request("token");
        $user = User::where('password',$token)->first();
        $data = [
            "roles" => [$user->role],
            "introduction" => $user->email,
            "avatar" => 'https://wpimg.wallstcn.com/f778738c-e4f8-4870-b634-56703b4acafe.gif',
            "name" => $user->name
        ];

        return $this->success($data);
    }

    /**
     * 角色权限
     * @method any
     */
    function roles()
    {

        $token =request()->header('X-Token');
        $user = User::where('password',$token)->first();
        $permission=RolePermission::where("role",$user->role)->pluck("permission");
        return $this->success($permission??[]);
    }

    /**
     * userlist
     * @method any
     */
    function list(){
        $sort = request("sort",'id');
        $dir = request("dir",'desc');
        $limit = request("limit",10);
        $name=request("name");
        $list=User::orderBy($sort,$dir);
        if($name){
            $list->where('name',$name);
        }
        $list=$list->paginate($limit);
        return $this->success(['items'=>$list->items(),'total'=>$list->total()]);
    }

    /**
     * create
     * @method any
     */
    function create(){
        $user=User::create([
            'name'=>request("name"),
            'email'=>"user".uniqid()."@163.com",
            'password'=>request("name"),
            'role'=>request("role"),
        ]);
        return $this->success($user);
    }


    /**
     * update
     * @method any
     */
    function update(){
        $user=User::find(request('id'))->update(['name'=>request('name'),'role'=>request('role')]);
        return $this->success($user);
    }

    /**
     * delete
     * @method any
     */
    function delete(){
        $user=User::find(request('id'))->delete();
        return $this->success($user);
    }




}
