<?php

require '../app/model/DAO/LibroDAO.php';

//echo 'Hola mundo desde index.php V3 <br>';
//obtenerLibros()
//echo "obtenerLibros() <br>";
$libroDAO=new LibroDAO();
//$libros=$libroDAO->obtenerLibros();

//echo var_dump($libros);

//obtenerLibroPorID();
//echo "obtenerLibroPorID() <br>";
$libros2=$libroDAO->obtenerLibroPorID();
echo json_encode($libros2);
require '../core/Router.php';
//require '../app/controllers/Post.php';
//require '../core/Database.php';
//require '../core/DatabaseSingleton.php';
$url = $_SERVER['QUERY_STRING'];
/*
echo 'Kaixo desde MVC! esto es una API! V3 DB <br>';

echo 'URL = ' . $url . '<br>';
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

$router = new Router();

$router->add(
    '/public/post/get',
    array(         //GET para todos los posts
        'controller' => 'Post',
        'action' => 'getAllPosts'
    )
);

$router->add(
    '/public/post/get/{id}',
    array(    //GET para un post
        'controller' => 'Post',
        'action' => 'getPostById'
    )
);

$router->add(
    '/public/post/create',
    array(      //POST para un post
        'controller' => 'Post',
        'action' => 'createPost'
    )
);

$router->add(
    '/public/post/update/{id}',
    array(    //PUT para un post
        'controller' => 'Post',
        'action' => 'updatePost'
    )
);

$router->add(
    '/public/post/delete/{id}',
    array(    //DELETE para un post
        'controller' => 'Post',
        'action' => 'deletePost'
    )
);

//echo '<pre>';
//print_r($router->getRoutes()) .'<br>';
//echo '</pre>';

$urlParams = explode('/', $url); //separa en parámetros la url a través de la /

//Probamos con la url /api/v1/public/post/show/1
/*
$urlArray=array(
    'HTTP'=>$_SERVER['REQUEST_METHOD'],
    'controller'=>$urlParams[2],       
    'action'=>$urlParams[3],     
    'params'=>$urlParams[4]       
);
*/
$urlArray = array(
    'HTTP' => $_SERVER['REQUEST_METHOD'],
    'path' => $url,                        //url que viene por el navegador para comprobar en mi router
    'controller' => '',
    'action' => '',
    'params' => ''
);

//hacemos una validación de que lo que nos entra por el navegador es lo que queremos
//No nos interesa que el controlador venga vacío


if (!empty($urlParams[2])) {
    $urlArray['controller'] = ucwords($urlParams[2]);
    if (!empty($urlParams[3])) {
        $urlArray['action'] = $urlParams[3];
        if (!empty($urlParams[4])) {
            $urlArray['params'] = $urlParams[4];
        }
    } else {
        $urlArray['action'] = 'index';
    }
} else {                                  //Si el controlador viene vacio
    $urlArray['controller'] = 'Home';    //Controladores con mayúsculas (Clases)
    $urlArray['action'] = 'index';       //Métodos en minúsculas
}

//Verifica el método HTTP de la solicitud
$method = $_SERVER['REQUEST_METHOD'];



//Define los parámetros según el método HTTP
$params = [];

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

    $controller = $router->getParams()['controller'];    //controlador a llamar
    $action = $router->getParams()['action'];             //método a llamar
    $controller = new $controller();

    if (method_exists($controller, $action)) {
        $resp = call_user_func_array([$controller, $action], $params);
    } else {
        echo "El metodo no existe";
    }
}

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

print_r($url) .'<br>';

print_r($urlArray) .'<br>';

print_r($method) .'<br>';

echo '</pre>';
*/
?>