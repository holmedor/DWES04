<?php

class AutorEntity{

    private $id_autor;
    private $nombre;
    private $apellido;
    private $nacionalidad;
    private $created_at;
    private $updated_at;

    public function __construct($nombre, $apellido, $nacionalidad=null){
        $this->$nombre=$nombre;
        $this->$apellido=$apellido;
        $this->$nacionalidad=$nacionalidad;
        
    }

    /**
     * Get the value of id_autor
     */
    public function getIdAutor()
    {
        return $this->id_autor;
    }

    /**
     * Set the value of id_autor
     */
    public function setIdAutor($id_autor): self
    {
        $this->id_autor = $id_autor;

        return $this;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     */
    public function setNombre($nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set the value of apellido
     */
    public function setApellido($apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get the value of nacionalidad
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * Set the value of nacionalidad
     */
    public function setNacionalidad($nacionalidad): self
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    /**
     * Get the value of created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     */
    public function setCreatedAt($created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set the value of updated_at
     */
    public function setUpdatedAt($updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}