<?php 
class MarcaController
{
    public function __construct()
    {
        require_once "model/marca.php";
    }

    //Instanciar el objeto de la clase categoria
    public function index()
    {
        $categoria = new Marca_Model();
        $categorias['categoria']=$categoria->mostrar_marca();
        require_once "view/marca.php";
    }

    public function guardar()
    {
        $siglas=$_POST['siglas'];
        $descripcion=$_POST['descripcion'];
        $estado=$_POST['estado'];
        $categoria = new Marca_Model();
        $categoria->agregar_marca($descripcion,$siglas,$estado);
        header("Location:index.php?c=marca");
    }

}