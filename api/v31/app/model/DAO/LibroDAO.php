<?php
require '../core/DatabaseSingleton.php'; //porque se asume que se llama desde index.php
require '../app/model/DTO/LibroDTO.php';

class LibroDAO{

    private $db;

    public function __construct(){
        $this->db=DatabaseSingleton::getInstance();
    }
    //CRUD
    // - read
    // - update
    // - delete
    // - write
    public function obtenerLibros(){
        $connection=$this->db->getConnection();
        $query= "SELECT * FROM libros";
        $statement=$connection->query($query);
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function obtenerLibroPorID(){
        $connection=$this->db->getConnection();
        $query= "SELECT * FROM libros JOIN autor ON libros.id_autor=autor.id_autor WHERE autor.id_autor=3";
        $statement=$connection->query($query);
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
//        return $result;
        $librosDTO=array();
        for($i=0; $i<count($result);$i++){
            $fila=$result[$i];
            $libroDTO=new libroDTO(
                $fila['id_libro'],
                $fila['titulo'],
                $fila['anio_publicacion'],
                $fila['nombre'],
                $fila['apellido']
            );
            $librosDTO[]=$libroDTO;
        }
        return $librosDTO;
    }
    public function crearLibro(){
        
    }
    public function actualizarLibro(){
        
    }
    public function eliminarLibro(){
        
    }
}