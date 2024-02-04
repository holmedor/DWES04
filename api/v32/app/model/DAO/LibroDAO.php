<?php
require '../core/DatabaseSingleton.php'; //porque se asume que se llama desde index.php
require '../app/model/DTO/LibroDTO.php';

class LibroDAO
{

    private $db; //LibroDAO.php juega el rol de index.php

    public function __construct()
    {
        $this->db = DatabaseSingleton::getInstance();
    }
    //CRUD
    // - read
    // - update
    // - delete
    // - write
    public function obtenerLibros()
    {
        $connection = $this->db->getConnection();
        $query = "SELECT * FROM libros";
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        print_r($result);
        echo count($result);
        if (count($result)!=0){
            echo "GET CORRECTA!!!";
        }else{
            echo "ERROR EN GET!!!";
        }
}
    public function obtenerLibroPorID($id)
    {
        $connection = $this->db->getConnection();
        //        $query= "SELECT * FROM libros JOIN autor ON libros.id_autor=autor.id_autor WHERE autor.id_autor=3";
        $query = "SELECT * FROM libros WHERE id_libro=" . $id;
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //        return $result;
        $librosDTO = array();
        for ($i = 0; $i < count($result); $i++) {
            $fila = $result[$i];
            $libroDTO = new libroDTO(
                $fila['id_libro'],
                $fila['titulo'],
                $fila['anio_publicacion'],
                $fila['id_autor'],
                $fila['created_at'],
                $fila['updated_at']
            );
            $librosDTO[] = $libroDTO;
        }
        print_r($result);
        echo count($result);
        if (count($result)==1){
            echo "GET ID CORRECTA!!!";
        }else{
            echo "ERROR EN GET ID!!!";
        }

        return $librosDTO;
    }
    public function crearLibro($data)
    {
        //Añadir los datos a la BD
        $connection = $this->db->getConnection();
        $mydata = json_encode($data);
        $nuevolibro = json_decode($mydata);
        $id_libro = $nuevolibro->id_libro;
        $titulo = $nuevolibro->titulo;
        $anio_publicacion = $nuevolibro->anio_publicacion;
        $id_autor = $nuevolibro->id_autor;
        echo "JSON INI";
        echo $id_libro;
        echo $titulo;
        echo $anio_publicacion;
        echo $id_autor;
        echo "JSON FIN <br>";
        $query = "SELECT * FROM libros WHERE id_libro=" . $id_libro;
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        echo $query;
        if (count($result)!=0) {
            echo "EXISTE LIBRO con ID: ".$id_libro;
            echo "NO SE DA DE ALTA";
        } else{
            echo "NO EXISTE LIBRO con ID: ".$id_libro;
            echo "SE DA DE ALTA";
            $query = "INSERT INTO libros (id_libro,titulo,anio_publicacion,id_autor) VALUES (" . $id_libro . ",\"" . $titulo . "\"," . $anio_publicacion . "," . $id_autor . ");";    
            $statement = $connection->query($query);
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            print_r($result);
            echo count($result);
            if (count($result)==0){
                echo "ALTA CORRECTA!!!";
            }else{
                echo "ERROR EN ALTA!!!";
            }
        }
        //        return $result;
        //             if ($existe != false) {
        //                 echo "El MEDIO con ID " . $id . " YA EXISTE. NO SE CREA <br>";
        //             } else {
        //                 echo "Procedo a dar de alta el MEDIO con ID " . $id . "<br>";
        //             }              
    }
    public function actualizarLibro($id, $data)
    {
        //Actualizar los datos a la BD
        $connection = $this->db->getConnection();
        $mydata = json_encode($data);
        $libroact = json_decode($mydata);
        $id_libro = $id;
        $titulo = $libroact->titulo;
//        $anio_publicacion = $libroact->anio_publicacion;
//        $id_autor = $libroact->id_autor;
        echo "JSON INI";
        echo $id_libro;
        echo $titulo;
//        echo $anio_publicacion;
//        echo $id_autor;
        echo "JSON FIN <br>";
//        $query = "UPDATE libros (titulo,anio_publicacion,id_autor) VALUES (\"" . $titulo . "\"," . $anio_publicacion . "," . $id_autor . ") WHERE id_libro =" . $id . ";";
        $query = "UPDATE libros SET titulo=\"" . $titulo . "\" WHERE id_libro =" . $id_libro . ";";
//        $query = "UPDATE libros SET anio_publicacion=" . $anio_publicacion . " WHERE id_libro =" . $id . ";";
//        $query = "UPDATE libros SET id_autor=" . $id_autor . " WHERE id_libro =" . $id . ";";
        echo $query;
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
        echo count($result);
        if (count($result)==0){
            echo "ACTUALIZACIÓN CORRECTA!!!";
        }else{
            echo "ERROR EN ACTUALIZACIÓN!!!";
        }

    }
    public function eliminarLibro($id)
    {
        $connection = $this->db->getConnection();
        $query = "DELETE from libros WHERE id_libro=" . $id;
        $statement = $connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
        echo count($result);
        if (count($result)==0){
            echo "BORRADO CORRECTO!!!";
        }else{
            echo "ERROR EN BORRADO!!!";
        }
        return $result;
    }
}
