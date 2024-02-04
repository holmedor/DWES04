<?php

class Router
{

    protected $routes = array(); //array donde definimos nuestras rutas
    protected $params = array(); //array con parametros para definir nuestra ruta

    public function add($route, $params)
    { //recibimos la ruta y le añadimos unos parámetros
        $this->routes[$route] = $params;
    }
    public function getRoutes()
    {
        return $this->routes;
    }
    public function getParams()
    {
        return $this->params;
    }
    //cuando recibimos una ruta en nuestro navegador, comprobamos si coincide con una ruta declarada en nuestro router
    //a través de los parámetros indicaremos a qué método llamar

    public function match($url) //gestiona si la url está dada de alta dentro del router
    {
        foreach ($this->routes as $route => $params) {
            if ($url['path'] == $route) { //si lo que recibimos del front controller coincide con una ruta declarada en nuestro router
                if ($params['controller'] == $url['controller'] && $params['action'] == $url['action']) {
                    $this->params = $params;
                    return true;
                } else {
                    return false;
                }
//            }else{                        //si lo que recibimos del front controller NO coincide con una ruta declarada en nuestro router
//                return false;
            }
        }
    }

    public function matchRoutes($url)
    {
        foreach ($this->routes as $route => $params) {
            $pattern = str_replace(['{id}', '/'], ['([0-9]+)', '\/'], $route); //Reemplaza todas las apariciones de un valor por otro
            $pattern = '/^' . $pattern . '$/';

            if (preg_match($pattern, $url['path'])) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }



}
