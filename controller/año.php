<?php 
class AñoController
{
    public function __construct()
    {
        require_once "model/año.php";
    }

    //Instanciar el objeto de la clase categoria
    public function index()
    {
        $año= new Año_Model();
        $años['años']=$año->mostrar_años();
        require_once "view/año.php";
    }

    public function guardar()
    {
        $nombre=$_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $año = new Año_Model();
        $año->agregar_año($nombre,$descripcion);
        header("Location:index.php?c=año");
    }

}