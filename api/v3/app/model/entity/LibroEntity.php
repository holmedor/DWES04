<?php

class LibroEntity{

    private $id_libro;
    private $titulo;
    private $anio_publicacion;
    private $id_autor;
    private $created_at;
    private $updated_at;

    public function __construct($titulo, $anio_publicacion){
        $this->$titulo=$titulo;
        $this->$anio_publicacion=$anio_publicacion;        
    }
    /**
     * Get the value of id_libro
     */
    public function getIdLibro()
    {
        return $this->id_libro;
    }

    /**
     * Set the value of id_libro
     */
    public function setIdLibro($id_libro): self
    {
        $this->id_libro = $id_libro;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo($titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of anio_publicacion
     */
    public function getAnioPublicacion()
    {
        return $this->anio_publicacion;
    }

    /**
     * Set the value of anio_publicacion
     */
    public function setAnioPublicacion($anio_publicacion): self
    {
        $this->anio_publicacion = $anio_publicacion;

        return $this;
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