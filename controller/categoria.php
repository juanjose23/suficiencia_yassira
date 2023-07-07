<?php 
class CategoriaController
{
    public function __construct()
    {
        require_once "model/categoria.php";
    }

    //Instanciar el objeto de la clase categoria
    public function index()
    {
        $categoria = new Categoria_Model();
        $categorias['categoria']=$categoria->mostrar_categorias();
        require_once "view/categoria.php";
    }

    public function guardar()
    {
        $nombre=$_POST['nombre'];
        $descripcion=$_POST['descripcion'];
        $estado=$_POST['estado'];
        $categoria = new Categoria_Model();
        $categoria->agregar_categoria($nombre,$descripcion,$estado);
        header("Location:index.php?c=categoria");
    }

}