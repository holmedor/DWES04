<?php

class Router{

    protected $routes = array();
    protected $params = array();

    public function add($route, $params){
        $this->routes[$route]=$params;
    }

    public function getRoutes(){
        return $this->routes;
    }

    public function getParams(){
        return $this->params;
    }

    public function matchRoutes($url){
        foreach($this->routes as $route=>$params){
            $pattern=str_replace(['{id}','/'],['([0-9]+)','\/'], $route); //Reemplaza todas las apariciones de {id} por un valor por otro
            $pattern='/^'.$pattern.'$/';                                  //Concatena al pattern las /  /
            if(preg_match($pattern, $url['path'])){                       //comprueba si la url encaja con el pattern
                $this->params=$params;
                return true;
            }
        }
        return false;
    }
/*
    public function match($url){
        foreach($this->routes as $route=>$params){
            if($url['path'] == $route){
                if($params['controller']==$url['controller'] && $params['action']==$url['action']){
                    $this->params=$params;
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
*/

}