<?php
namespace App\Http\Controllers\API;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $routePrefix;

    function index()
    {
        $refClass = new \ReflectionClass($this);
        $methods = $refClass->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methods = array_filter($methods, function ($method) {
            if ($method->class == get_class($this)) {
                $method->desc = resolve('routeConfig')->getDocParam($method, 'desc');
                $method->doc = resolve('docParser')->parse($method);
                if($this->routePrefix ){
                    $method->router=$this->routePrefix;
                }else{
                    $method->router=strtolower(strstr(basename(strstr(str_replace('\\', DIRECTORY_SEPARATOR, request()->route()->getAction('controller')),'@',true)),'Controller',true));
                }
                return $method;
            }
        });
            
            return view('frontend.blade', [
                'methods' => $methods
            ]);
    }
}
