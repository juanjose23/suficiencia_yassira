<?php 
class ModeloController
{
    public function __construct()
    {
        require_once "model/modelo.php";
    }

    //Instanciar el objeto de la clase categoria
    public function index()
    {
        $modelos = new modelo_Model();
        $modelo['modelo']=$modelos->mostrar_modelo();
        require_once "view/modelo.php";
    }

    public function guardar()
    {
        $nombre=$_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $estado=$_POST['estado'];
        $modelo = new modelo_Model();
        $modelo->agregar_modelo($nombre,$descripcion,$estado);
        header("Location:index.php?c=modelo");
    }

}