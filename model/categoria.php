<?php
class Categoria_Model
{
    private $db;
    private $categoria;
    public function __construct()
    {
        $this->db=conectar::conexion();
        $this->categoria=array();
    }
 
    //Mostrar las categorias en la vista
    public function mostrar_categorias()
    {
        $consulta="SELECT * FROM categoria_automovil";
        $resultado=$this->db->query($consulta);
        while ($row = $resultado->fetch_assoc()) {
            $this->categoria[] = $row;
        }
        return $this->categoria;
    }
    //Insertar Categorias
    public function agregar_categoria($nombre,$descripcion,$estado)
    {
        $insertar="INSERT INTO categoria_automovil(nombre,descripcion,estado) VALUES('$nombre','$descripcion','$estado')";
        $this->db->query($insertar);
    }

}