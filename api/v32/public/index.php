<?php

require '../core/Router.php';

require '../app/controller/Post.php';

$url = $_SERVER['QUERY_STRING'];

//echo 'Kaixo desde MVC! esto es una API! V32 DB <br>';

//echo 'URL = ' . $url . '<br>';

require '../app/model/DAO/LibroDAO.php';

echo 'Hola mundo desde index.php V3 <br>';
//obtenerLibros()
//echo "obtenerLibros() <br>";
//$libroDAO = new LibroDAO();
//$libros=$libroDAO->obtenerLibros();
//echo var_dump($libros);

$router = new Router();
//echo get_class($router)
$router->add('/public/post/get',array(         //GET para todos los posts
        'controller' => 'Post',
        'action' => 'getAllPosts'
    )
);
$router->add('/public/post/get/{id}',array(    //GET para un post
        'controller' => 'Post',
        'action' => 'getPostById'
    )
);
$router->add('/public/post/create',array(      //POST para un post
        'controller' => 'Post',
        'action' => 'createPost'
    )
);
$router->add('/public/post/update/{id}',array(    //PUT para un post
        'controller' => 'Post',
        'action' => 'updatePost'
    )
);
$router->add('/public/post/delete/{id}',array(    //DELETE para un post
        'controller' => 'Post',
        'action' => 'deletePost'
    )
);

$urlParams = explode('/', $url); //explode separa en parámetros la url del navegador a través de la '/'

$urlArray = array( //query que voy a recibir a través del navegador desglosada
    'HTTP' => $_SERVER['REQUEST_METHOD'], //para obtener el método HTTP
    'path' => $url,                      //url que viene por el navegador para comprobar en mi router
    'controller' => '',
    'action' => '',
    'params' => ''
);
//FRONT CONTROLLER
//hacemos una validación de que lo que nos entra por el navegador es lo que queremos
//No nos interesa que el controlador venga vacío

if (!empty($urlParams[2])) { //Lo que recibo en posición 2 del navegador no ha de estar vacío (controlador)
    $urlArray['controller'] = ucwords($urlParams[2]); //Si el controlador no está vacío, guardamos el controlador con mayúsculas (ucword)
    if (!empty($urlParams[3])) {                      //Si la no acción está vacía 
        $urlArray['action'] = $urlParams[3];          //la guardamos en el campo action
        if (!empty($urlParams[4])) {                  //Si hay parámetros
            $urlArray['params'] = $urlParams[4];      //lo guardamos en params
        }
    } else {
        $urlArray['action'] = 'index';
    }
} else {                                 //Si el controlador viene vacio: el controlador será Home y el método (action) index
    $urlArray['controller'] = 'Home';    //Controladores con mayúsculas (Clases)
    $urlArray['action'] = 'index';       //Métodos en minúsculas
}

$method = $_SERVER['REQUEST_METHOD'];
$params = [];                                           //Define los parámetros según el método HTTP
echo '<pre>';
print_r($url) . '<br>';
print_r($urlArray) . '<br>';
//print_r($method) . '<br>';
echo '</pre>';
/*
if ($router->matchRoutes($urlArray)) {                      //Verifica el método HTTP de la solicitud
    if ($method === 'GET') {
        $params[] = intval($urlArray['params']) ?? null;    //id
    } elseif ($method === 'POST') {
        $json = file_get_contents('php://input');           //lee el json del body http
        $params[] = json_decode($json, true);               //json guardado como array asociativo (deserializado)
    } elseif ($method === 'PUT') {
        $id = intval($urlArray['params']) ?? null;          //id
        $json = file_get_contents('php://input');           //lee el json del body http
        $params[] = $id;                                    //id
        $params[] = json_decode($json, true);               //json guardado como array asociativo (deserializado)
    } elseif ($method === 'DELETE') {
        $params[] = intval($urlArray['params']) ?? null;    //id
    }
    $controller = $router->getParams()['controller'];       //controlador a llamar
    $action = $router->getParams()['action'];               //método a llamar
    $controller = new $controller();

    if (method_exists($controller, $action)) {
        $resp = call_user_func_array([$controller, $action], $params);//guarda en resp si la accion existe
    } else {
        echo "El metodo no existe";
    }
}
*/
if ($router->matchRoutes($urlArray)) {
    if ($method === 'GET') {

        $params[] = intval($urlArray['params']) ?? null;
    } elseif ($method === 'POST') {

        $json = file_get_contents('php://input'); //lee el json del body http
        $params[] = json_decode($json, true);
    } elseif ($method === 'PUT') {

        $id = intval($urlArray['params']) ?? null;
        $json = file_get_contents('php://input'); //lee el json del body http
        echo "$id: ".$id;
        $params[] = $id;
        $params[] = json_decode($json, true);
    } elseif ($method === 'DELETE') {

        $params[] = intval($urlArray['params']) ?? null;
    }

    $controller = $router->getParams()['controller'];    //controlador a llamar
    $action = $router->getParams()['action'];             //método a llamar
    $controller = new $controller();

    print_r($params);
    if (method_exists($controller, $action)) {
        $resp = call_user_func_array([$controller, $action], $params);
    } else {
        echo "El metodo no existe";
    }
}
/*
$router->add(
    '/public',
    array(
        'controller' => 'Home',
        'action' => 'index'
    )
);

$router->add(
    '/public/post/new',
    array(
        'controller' => 'Post',
        'action' => 'new'
    )
);
*/
/* Estas rutas se indicaron originalmente pero ahora sólo usaremos las dos de arriba
$router->add(
    '/post',
    array(
        'controller' => 'Post',
        'action' => 'index'
    )
);

$router->add(
    '/post/new',
    array(
        'controller' => 'Post',
        'action' => 'new'
    )
);
*/
///////////////////////////////////////////

// Hemos definido 3 rutas en el array routes del Router 

//echo '<pre>';
//print_r($router->getRoutes()) . '<br>';
//echo '</pre>';

//Con los echos anteriores vemos el array routes



/*Probamos con la url /api/v1/public/post/show/1 y lo vemos en los echos del final
$urlArray = array( //query que voy a recibir a través del navegador desglosada
    'HTTP' => $_SERVER['REQUEST_METHOD'],//para obtener el método HTTP
    'path' => $url,                      //url que viene por el navegador para comprobar en mi router
    'controller'=>$urlParams[2],       
    'action'=>$urlParams[3],     
    'params'=>$urlParams[4]       
);
*/



/*
if ($router->match($urlArray)) {//carga dinámicamente un controlador u otro en función de lo que llegue por la url
    $controller=$router->getParams()['controller'];
    $action=$router->getParams()['action'];

    $controller=new $controller();
    $controller->$action();
} else {
    echo "No route found for URL " . $url . "<br>";
    echo "ERROR 404 <br>";
}
*/
/*    
if ($router->matchRoutes($urlArray)) {
    if ($method === 'GET') {

        $params[] = intval($urlArray['params']) ?? null;
    } elseif ($method === 'POST') {

        $json = file_get_contents('php://input'); //lee el json del body http
        $params[] = json_decode($json, true);
    } elseif ($method === 'PUT') {

        $id = intval($urlArray['params']) ?? null;
        $json = file_get_contents('php://input'); //lee el json del body http
        $params[] = $id;
        $params[] = json_decode($json, true);
    } elseif ($method === 'DELETE') {

        $params[] = intval($urlArray['params']) ?? null;
    }
*/




//obtenerLibroPorID();
//echo "obtenerLibroPorID() <br>";
//$libros2 = $libroDAO->obtenerLibroPorID();
//echo json_encode($libros2);
//require '../core/Database.php';
//require '../core/DatabaseSingleton.php';


/*
$db=DatabaseSingleton::getInstance();
$connection=$db->getConnection();
$query="SELECT * FROM libros ";
$statement=$connection->query($query);
$result=$statement->fetchAll(PDO::FETCH_ASSOC);
print_r($result);   
*/
//echo '<pre>'. Database::loadConfig().'</pre>';
//echo '<pre>'. var_dump(Database::connect()).'</pre>';
//echo '<pre>'. var_dump(Database::getAll()).'</pre>';


/*
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
print_r($url) . '<br>';
print_r($urlArray) . '<br>';
print_r($method) . '<br>';
echo '</pre>';
*/