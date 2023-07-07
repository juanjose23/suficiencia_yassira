<?php
class modelo_Model
{
    private $db;
    private $modelo;
    public function __construct()
    {
        $this->db=conectar::conexion();
        $this->modelo=array();
    }
 
    //Mostrar las categorias en la vista
    public function mostrar_modelo()
    {
        $consulta="SELECT * FROM modelo_automovil";
        $resultado=$this->db->query($consulta);
        while ($row = $resultado->fetch_assoc()) {
            $this->modelo[] = $row;
        }
        return $this->modelo;
    }
    //Insertar Categorias
    public function agregar_modelo($siglas,$descripcion,$estado)
    {
        $insertar="INSERT INTO modelo_automovil(descripcion,siglas,estado) VALUES('$descripcion','$siglas','$estado')";
        $this->db->query($insertar);
    }

}