<?php

namespace App\Http\Controllers\Frontend;


use App\Model\Role;
use App\Model\RolePermission;
use App\Model\User;
use App\Services\Demo;
use App\Facades\RouteConfig;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{


    function index()
    {
        return parent::index();
    }


    /**
     * list
     * @method any
     */
    function list(){
        $sort = request("sort",'id');
        $dir = request("dir",'desc');
        $limit = request("limit",10);
        $name=request("name");
        $list=Role::orderBy($sort,$dir);
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
        $role=Role::create([
            'name'=>request("name"),
            'code'=>request("code"),
        ]);
        RolePermission::where('role',request('code'))->delete();
        foreach (request('permission') as $item){
            RolePermission::insert([
                "role"=>request('code'),
                "permission"=>$item
            ]);
        }
        return $this->success($role);
    }


    /**
     * update
     * @method any
     */
    function update(){
        $role=Role::find(request('id'))->update(['name'=>request('name'),'code'=>request('code')]);
        RolePermission::where('role',request('code'))->delete();
        foreach (request('permission') as $item){
            RolePermission::insert([
                "role"=>request('code'),
                "permission"=>$item
            ]);
        }
        return $this->success($role);
    }

    /**
     * delete
     * @method any
     */
    function delete(){
        $role=Role::find(request('id'));
        RolePermission::where('role',$role->code)->delete();
        $role->delete();
        return $this->success($role);
    }

    /**
     * getPermission
     * @method any
     */
    function getPermission(){
        $role = request("role");
        $permission=RolePermission::where("role",$role)->pluck("permission");
        return $this->success($permission??[]);
    }

    /**
     * getRoleOptions
     * @method any
     */
    function getRoleOptions(){
        $options=Role::select("code","name")->get();
        return $this->success($options);
    }




}
