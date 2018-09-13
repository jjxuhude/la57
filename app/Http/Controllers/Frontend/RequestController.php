<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Frontend\Controller;
use App\Services\DocParser;
use Illuminate\Support\Facades\App;

class RequestController extends Controller
{

    /**
     * 首页
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function index()
    {
        return parent::index();
    }

    /**
     * path
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function path()
    {
        dump(request()->path());
    }

    /**
     * url
     */
    function url()
    {
        dump(request()->url());
    }

    /**
     * method
     */
    function method()
    {
        dump(request()->method());
    }

    /**
     * query
     */
    function query()
    {
        dump(request()->query('name'));
    }

    /**
     * doc
     *
     * @param Illuminate\Support\Facades\App $aaa            
     * @param int $bbb            
     */
    function doc($aaa = 0, $bbb = 1)
    {
        dump(resolve('docParser')->parse(new \ReflectionMethod($this, 'doc')));
    }

    /**
     * phpinfo
     */
    function p()
    {
        phpinfo();
    }
    
    /**
     * @desc 加密解密
     */
    function crypt(){
        $enString=encrypt('user01');
        dump($enString);
        $deString= decrypt($enString);
        dump($deString);
        
    }
}

