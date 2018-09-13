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
     * @method get
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    function path()
    {
        dump(request()->path());
    }

    /**
     * url
     * @method get
     */
    function url()
    {
        dump(request()->url());
    }

    /**
     * method
     * @method get
     */
    function method()
    {
        dump(request()->method());
    }

    /**
     * query
     * @method get
     */
    function query()
    {
        dump(request()->query('name'));
    }

    /**
     * doc
     * @method get
     * @param Illuminate\Support\Facades\App $aaa            
     * @param int $bbb            
     */
    function doc($aaa = 0, $bbb = 1)
    {
        dump(resolve('docParser')->parse(new \ReflectionMethod($this, 'doc')));
    }

    /**
     * phpinfo
     * @method get
     */
    function p()
    {
        phpinfo();
    }
    
    /**
     * @desc 加密解密
     * @method get
     */
    function crypt(){
        $enString=encrypt('user01');
        dump($enString);
        $deString= decrypt($enString);
        dump($deString);
        
    }
}

