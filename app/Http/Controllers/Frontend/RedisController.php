<?php
namespace App\Http\Controllers\Frontend;


use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{

    
    /**
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function index()
    {
        view()->share('js', 'vue.js');
        return parent::index();
    }

    /**
     * set
     * @method get
     */
    function set(){
            $result=Redis::set('name', 'Taylor');
            dd($result);
  
    }
    
    /**
     * get
     * @method get
     */
    function get(){
        $name=Redis::get('name');
        dump($name);
    }
    
    
    /**
     * 添加有序集合
     * @method get
     */
    function zset(){
        $date=new \DateTime();
        $time=$date->format('Hisu');
        $result=Redis::zadd('member1',$time,'user_'.mt_rand(1,1000));
        dump($result);
    }
    
    /**
     * 获取有序列表
     * @method get
     */
    function zrange(){
        $data=Redis::ZRANGE('member1',0,1000,'WITHSCORES');
        dump($data);
    }
    
   
}

