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
     * 获取有序列表,显示下标score
     * @method get
     */
    function zrange(){
        $data=Redis::ZRANGE('member1',0,-1,'WITHSCORES');
        dump($data);
    }
    
    /**
     * 添加有序集合
     * @method get
     */
    function zset(){
        $date=new \DateTime();
        $time=$date->format('Hisu');
        $result=Redis::zadd('member1',$time,'user_'.mt_rand(1,100));
        dump($result);
    }
    /**
     * 获取集合中元素的数量
     * @method get
     */
    function zcard(){
        $count=Redis::zcard('member1');
        dump($count);
    }
    
    /**
     * 获取指定下标范围内元素的数量
     * @method get
     */
    function zcount(){
        $count = Redis::zcount('member1',1,111139747880);
        dump($count);
    }
    
    /**
     * 获取集合中指定下标范围内的元素
     * @method get
     */
    function zrangebyscore(){
        $list = Redis::zrangebyscore('member1',1,111139747880);
        dump($list);
    }
    

    /**
     * 修改指定元素的下标(递增)
     * @method get
     */
    function zincrby(){
        $result = Redis::zincrby('member1',100,'user1');
        dump($result);
    }
    
    /**
     * 获取指定成员在集合中的排名
     * @method get
     */
    function zrank(){
        $n = Redis::zrank('member1','user1');
        dump($n);
    }
    
    /**
     * 删除集合中一个或者多个元素
     * @method get
     */
    function zrem(){
        $result=Redis::zrem('member1','user1','user_1');
        dump($result);
    }
    
    
    /**
     * 移除有序集合中给定的排名区间的所有成员
     * 删除前3名
     * @method get
     */
    function zremrangebyrank(){
        $result=Redis::zremrangebyrank('member1',0,2);
        dump($result);
    } 
    
    /**
     * 移除有序集合中指定下标区间里的所有成员
     * @method get
     */
    function zremrangebyscore(){
        $result = Redis::zremrangebyscore('member1',111139747280,111139747880);
        dump($result);
    }
    
    /**
     * 获取集合中指定排名区间中的所有成员（降序）
     * @method get
     */
    function zrevrange(){
        $result = Redis::zrevrange('member1',0,-1,'WITHSCORES');
        dump($result);
    } 
    
    /**
     * 返回有序集中指定分数区间内的成员，分数从高到低排序（降序）
     * @method get
     */
    function zrevrangebyscore (){
        $result = Redis::zrevrangebyscore('member1',111349777733,111139774146,'WITHSCORES');
        dump($result);
    }
    
    /**
     * 返回有序集合中指定成员的排名，有序集成员按分数值递减(从大到小)排序（降序）
     * @method get
     */
    function zrevrank(){
        $n = Redis::zrevrank('member1','user_96');
        dump($n);
    }
    
    /**
     * 返回有序集中，成员的分数值
     * @method get
     */
    function zscore(){
        $n = Redis::zscore('member1','user_96');
        dump($n);
    }

    
   
}

