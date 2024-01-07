<?php

class LibroDTO implements JsonSerializable{

    private $id_libro;
    private $titulo;
    private $anio_publicacion;
    private $nombre_autor;
    private $apellido_autor;

    public function __construct($id_libro, $titulo, $anio_publicacion, $nombre_autor, $apellido_autor){
        $this->$id_libro=$id_libro;
        $this->$titulo=$titulo;
        $this->$anio_publicacion=$anio_publicacion;        
        $this->$nombre_autor=$nombre_autor;
        $this->$apellido_autor=$apellido_autor;
    }

    public function jsonSerialize(): mixed{
        return get_object_vars($this);
    }

    /**
     * Get the value of id_libro
     */
    public function getIdLibro()
    {
        return $this->id_libro;
    }



    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }



    /**
     * Get the value of anio_publicacion
     */
    public function getAnioPublicacion()
    {
        return $this->anio_publicacion;
    }



    /**
     * Get the value of nombre_autor
     */
    public function getNombreAutor()
    {
        return $this->nombre_autor;
    }



    /**
     * Get the value of apellido_autor
     */
    public function getApellidoAutor()
    {
        return $this->apellido_autor;
    }


}