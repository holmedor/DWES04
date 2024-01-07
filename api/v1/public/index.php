<?php

require '../core/Router.php';
require '../app/controllers/Post.php';

echo 'Kaixo desde MVC! esto es una API! <br>';
$url= $_SERVER['QUERY_STRING'];
echo 'URL = ' .$url.'<br>';

$router=new Router();
//echo get_Class($router);

$router->add('/public', array(
    'controller'=>'Home',
    'action'=>'index'
    )
);

$router->add('/public/post', array(
    'controller'=>'Post',
    'action'=>'index'
    )
);

$router->add('/public/post/new', array(
    'controller'=>'Post',
    'action'=>'new'
    )
);
/*
$router->add('', array(
    'controller'=>'Home',
    'action'=>'index'
    )
);

$router->add('/posts', array(
    'controller'=>'Posts',
    'action'=>'index'
    )
);

$router->add('/posts/new', array(
    'controller'=>'Posts',
    'action'=>'new'
    )
);
*/

//echo '<pre>';
//print_r($router->getRoutes()) .'<br>';
//echo '</pre>';

$urlParams=explode('/',$url); //separa en parámetros la url a través de la /

//Probamos con la url /api/v1/public/post/show/1
/*
$urlArray=array(
    'HTTP'=>$_SERVER['REQUEST_METHOD'],
    'controller'=>$urlParams[2],       
    'action'=>$urlParams[3],     
    'params'=>$urlParams[4]       
);
*/
$urlArray=array(
    'HTTP'=>$_SERVER['REQUEST_METHOD'],
    'path'=>$url,                        //url que viene por el navegador para comprobar en mi router
    'controller'=>'',
    'action'=>'',
    'params'=>''
);

//hacemos una validación de que lo que nos entra por el navegador es lo que queremos
//No nos interesa que el controlador venga vacío


if(!empty($urlParams[2])){                                   
    $urlArray['controller']=ucwords($urlParams[2]);          
    if(!empty($urlParams[3])){                               
        $urlArray['action']=$urlParams[3];                   
        if(!empty($urlParams[4])){                           
            $urlArray['params']=$urlParams[4];               
        }
    }else{
        $urlArray['action']='index';
    }
}else{                                  //Si el controlador viene vacio
    $urlArray['controller']= 'Home';    //Controladores con mayúsculas (Clases)
    $urlArray['action']= 'index';       //Métodos en minúsculas
}

if($router->match($urlArray))
{
    $controller= $router->getParams()['controller'];    //controlador a llamar
    $action=$router->getParams()['action'];             //método a llamar

    $controller = new $controller();
    $controller->$action();

}else{
    echo "No route found for URL ".$url;
}

echo '<pre>';
print_r($urlArray) .'<br>';
echo '</pre>';

?>