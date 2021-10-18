<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    /**
     * @method get
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
   public function index()
    {
        $refClass = new \ReflectionClass($this);
        $methods = $refClass->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methods = array_filter($methods, function ($method) {
            if ($method->class == get_class($this)) {
                $router = config('app.frontend_prefix').'/'.strtolower(strstr(basename(str_replace('\\', DIRECTORY_SEPARATOR, $method->class)), 'Controller', true));
                $method->router=$router;
                $method->desc = resolve('routeConfig')->getDocParam($method, 'desc');
                $method->doc = resolve('docParser')->parse($method);
                
                return $method;
            }
        });
            
        return view('frontend.blade', [
            'methods' => $methods,
        ]);
    }

    public function success($data){
       return response()->json(["code"=>1,"data"=>$data]);
    }
    public function error($message,$data=[]){
        return response()->json(["code"=>0,"message"=>$message,"data"=>$data]);
    }
}







