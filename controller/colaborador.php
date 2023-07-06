<?php
class ColaboradorController
{
    public function __construct()
    {
        require_once "model/colaborador.php";
    }
    public function index()
    {
        $estado = new Colaborador_model();
        $data['estado'] = $estado->get_estados();
        $trabajador['trabajador']=$estado->index();
        require_once "view/colaborador.php";
    }

    public function crear_colaborador()
    {
        $gestion = new Colaborador_model();
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $cedula = $_POST['cedula'];
        $codigo_inss = $_POST['codigo_inss'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $genero = $_POST['genero'];
        $nacionalidad = $_POST['nacionalidad'];
        $id_estado_civil = $_POST['id_estado_civil'];
        $estado = $_POST['estado'];
        $direccion_domicilio = $_POST['direccion_domicilio'];
        $nombreArchivo = $_FILES['imagenes']['name'];
        $tipoArchivo = $_FILES['imagenes']['type'];
        $ubicacionTemporal = $_FILES['imagenes']['tmp_name'];
        // Generar nombre único
        $foto = uniqid('', true) . '.' . pathinfo($nombreArchivo, PATHINFO_EXTENSION);
        // Mover la imagen al directorio deseado
        $directorioDestino = 'assets/img/colaborador/';
        $rutaCompleta = $directorioDestino . $foto;
        move_uploaded_file($ubicacionTemporal, $rutaCompleta);
        $gestion->crear($nombre, $telefono, $direccion_domicilio, $correo, $apellido, $cedula, $genero, $nacionalidad, $fecha_nacimiento, $codigo_inss, $id_estado_civil, $foto, $estado);
        header("location:index.php?c=colaborador&a=index");
    }
}