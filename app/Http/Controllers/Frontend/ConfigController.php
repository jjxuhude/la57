<?php

namespace App\Http\Controllers\Frontend;


use App\Model\Config;
use App\Model\Role;
use App\Model\RolePermission;
use App\Model\User;
use App\Services\Demo;
use App\Facades\RouteConfig;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
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
        $list=Config::orderBy($sort,$dir);
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
        $role=Config::create([
            'code'=>request("code"),
            'name'=>request("name"),
            'value'=>request("value"),
            'image'=>request("image"),
        ]);
        return $this->success($role);
    }

    /**
     * get
     * @method any
     */
    function get(){
        $id= request('id');
        $role = Config::find($id);
        return $this->success($role);
    }

    /**
     * update
     * @method any
     */
    function update(){
        $role=Config::find(request('id'))->update(
            [
                'name'=>request('name'),
                'value'=>request('value'),
                'code'=>request('code'),
                'image'=>request("image"),
            ]
        );
        return $this->success($role);
    }

    /**
     * delete
     * @method any
     */
    function delete(){
        $role=Config::find(request('id'));
        $role->delete();
        return $this->success($role);
    }






}
