<?php

class Post{
    function __construct(){    }
/*
    //GET
    function getAllPosts(){
        echo "Hola desde el metodo getAllPosts() de POST Controller <br>"; 
    }
    function getPostById($id){
        echo "Hola desde el metodo getPostById() de POST Controller <br>"; 
        echo "El ID del post es " .$id."<br>";
    }
    //POST
    public function createPost($data){
        echo "Hola desde el metodo createPost() de POST Controller <br>"; 
        echo "Los datos del POST son " .json_encode($data)."<br>";    
    }
    //PUT
    public function updatePost($id,$data){
        echo "Hola desde el metodo updatePost() de POST Controller <br>"; 
        echo "El ID del post es " .$id."<br>";
        echo "Los datos del POST son " .json_encode($data). "<br>";    
    }
    //DELETE
    public function deletePost($id){
        echo "Hola desde el metodo deletePost() de POST Controller <br>"; 
        echo "El ID del post es " .$id."<br>";  
    }
*/
    //GET
    function getAllPosts(){
        echo "Hola desde el metodo getAllPosts() de POST Controller <br>"; 
        $libroDAO = new LibroDAO();
        $libros=$libroDAO->obtenerLibros();
        echo var_dump($libros);
    }
    function getPostById($id){
        echo "Hola desde el metodo getPostById() de POST Controller <br>"; 
        echo "El ID del post es " .$id."<br>";
        $libroDAO = new LibroDAO();
        $libros=$libroDAO->obtenerLibroPorID($id);
        echo var_dump($libros);
    }
    //POST
    public function createPost($data){
        echo "Hola desde el metodo createPost() de POST Controller <br>"; 
        echo "Los datos del POST son " .json_encode($data)."<br>";    
        $libroDAO = new LibroDAO();
        $libroDAO->crearLibro($data);
    }
    //PUT
    public function updatePost($id,$data){
        echo "Hola desde el metodo updatePost() de POST Controller <br>"; 
        echo "El ID del post es " .$id."<br>";
        echo "Los datos del POST son " .json_encode($data)."<br>";    
        $libroDAO = new LibroDAO();
        $libroDAO->actualizarLibro($id,$data);
    }
    //DELETE
    public function deletePost($id){
        echo "Hola desde el metodo deletePost() de POST Controller <br>"; 
        echo "El ID del POST es " .$id."<br>"; 
        $libroDAO = new LibroDAO();
        $libroDAO->eliminarLibro($id);   
    }
/*
    function __construct(){
        echo "Hola desde el CONSTRUCTOR de POST Controller <br>"; 

    }
    function new(){
        echo "Hola desde el método NEW de POST Controller <br>"; 

    }
*/
}

?>