<?php
namespace App\Services;

class RouteConfig
{
    
    function setController($controller,$routePrefix='')
    {
        $refClass = new \ReflectionClass($controller);
        $methods = $refClass->getMethods(\ReflectionMethod::IS_PUBLIC);
        $methods = array_filter($methods, function ($method) use ($refClass) {
            if ($method->class == $refClass->getName()) {
                return $method;
            }
        });
            
            foreach ($methods as $method) {
                
                $route = $routePrefix."/".strtolower(strstr(basename(str_replace('\\', DIRECTORY_SEPARATOR, $method->class)), 'Controller', true));
                
                // preg_match('/[\\\](\w+)Controller$/U', $method->class,$match);
                // if(isset($match[1])) $route=$match[1];
                
                
               

                $routeName=$route . '.' . $method->name;

                if ($method->name == 'index') {
                    \Route::get('/' . $route, '\\' . $method->class . "@" . $method->name)->name($route);
                }
                
                
                switch ($this->getDocParam($method, 'method')) {
                    case 'post':
                        \Route::post('/' . $route . '/' . $method->name, '\\' . $method->class . "@" . $method->name)->name($routeName);
                        break;
                    case 'put':
                        \Route::put('/' . $route . '/' . $method->name, '\\' . $method->class . "@" . $method->name)->name($routeName);
                        break;
                    case 'delete':
                        \Route::delete('/' . $route . '/' . $method->name, '\\' . $method->class . "@" . $method->name)->name($routeName);
                        break;
                    case 'option':
                        \Route::option('/' . $route . '/' . $method->name, '\\' . $method->class . "@" . $method->name)->name($routeName);
                        break;
                    case 'patch':
                        \Route::patch('/' . $route . '/' . $method->name, '\\' . $method->class . "@" . $method->name)->name($routeName);
                        break;
                    case 'get':
                        $params=resolve('docParser')->parse($method)['param'] ?? [];
                        $data=[];
                        foreach($params as $param){
                            $paramArr=explode('$',$param);
                            if(count($paramArr)==2){
                                $data[]='{'.$paramArr[1].'}';
                            }
                        }
                        $query="";
                        if(count($data)==1){
                            $query='/'.$data[0];
                        }elseif(count($data)>1){
                            $query='/'.join('/',$data);
                        }
                        \Route::get('/' . $route . '/' . $method->name.$query, '\\' . $method->class . "@" . $method->name)->name($routeName);
                        break;
                    default:
                        $params=resolve('docParser')->parse($method)['param'] ?? [];
                        $data=[];
                        foreach($params as $param){
                            $paramArr=explode('$',$param);
                            if(count($paramArr)==2){
                                $data[]='{'.$paramArr[1].'}';
                            }
                        }
                        $query="";
                        if(count($data)==1){
                            $query='/'.$data[0];
                        }elseif(count($data)>1){
                            $query='/'.join('/',$data);
                        }
                        \Route::any('/' . $route . '/' . $method->name.$query, '\\' . $method->class . "@" . $method->name)->name($routeName);
                        break;
                }
            }
    }
    
    function getDocParam($method, $name)
    {
        $string = $method->getDocComment();
        if (empty($string))
            return '';
            preg_match('/@' . $name . '(.*)/', $string, $match);
            if (isset($match[1])) {
                return trim($match[1]);
            } else {
                //return $method->name;
                return '';
            }
    }
    
    function getDocParamByControllerString($string, $name)
    {
        $data = explode('@', $string);
        if (count($data) == 2) {
            $method = new \ReflectionMethod($data[0], $data[1]);
            return $this->getDocParam($method, $name);
        }
        return '';
    }
    
    function registerFrontend($area,$routePrefix=''){
        $path='app'.DS.'Http'.DS.'Controllers'.DS.$area;
        $namespace="App\\Http\\Controllers\\".$area."\\";
        $fullPath=app()->basePath($path);
        $files=glob($fullPath.DS.'*.php');
        foreach($files as $file){
            $controller=basename($file);
            if(strpos($controller, 'Controller.php')>0){
                $this->setController($namespace.strtr($controller,['.php'=>'']),$routePrefix);
           }
        }
    }
    
    function aaa(){
        dump('2222');
    }
}

