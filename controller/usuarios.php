<?php
class UsuariosController
{
    public function __construct()
    {
        require_once "model/usuarios.php";
    }
    public function index()
    {
            $usuario = new Usuario_Model();
            $data["usuarios"] = $usuario->usuarios();
            $date["trabajador"] = $usuario->mostrartrabajador();
            $datas["sub"] = $usuario->mostrarsubgrupos();
            require_once("view/usuarios.php");
    }
    public function guardar()
    {
        $usuario = new Usuario_Model();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_trabajador = $_POST['id_trabajador'];
            var_dump($id_trabajador);
     
            $id_sub_grupo = $_POST['id_sub'];
            $usuario_nombre = $_POST['usuario'];
            $contrasena = $_POST['contraseña'];
            
            $estado = $_POST['estado'];
           
            //Validar el id de la persona
            $id = $usuario->getIdpersona($id_trabajador);
          
            // Llamar al modelo para guardar los datos del usuario
            $resultado = $usuario->guardarusuario($id, $id_sub_grupo, $usuario_nombre, $contrasena, $estado);
            if ($resultado) {
                // Redirigir a la lista de roles con mensaje de éxito.
                header("location: index.php?c=usuarios&a=index");
            } else {
                // Mostrar mensaje de error.
                header("location: index.php?c=usuarios&a=crear");
            }

            return $resultado;
        }
    }

   
    //Verificar usuarios
    public function verificarr ()
    {  
        $id = $_GET['id'];
        $usuario = new Usuario_Model();
        $usuario->verificarusuario($id);
        header("Location: index.php?c=usuarios&a=verificar");
    }
    public function verificar()
    {
            $verificar = new Usuario_Model();
            $data["verificar"] = $verificar->usuarios_no_verificados();
            require_once("view/verificar_usuarios.php");
      
    }
    public function privilegio()
    {
       
        require_once("view/modulos.php");
      
    }
    public function asigprivilegio()
    {
       /* if (!isset($_SESSION)) {
            session_start();
        }

        $tiene_permiso = false;
        foreach ($_SESSION['permisos'] as $permiso) {
            if ($permiso['id_modulo'] == 13 && $permiso['id_permiso'] == 2) {
                $tiene_permiso = true;
                break;
            }
        }
        if ($tiene_permiso) {*/
        $privilegio = new Usuario_Model();
        $data["privilegios"] = $privilegio->mostrarModulos();
        $data["usuarios"] = $privilegio->mostrarusuarios();
        require_once("view/asignar_modulos.php");
        /*  } else {
            header("location: index.php?c=errores&a=error403");
        }*/
    }
    //Guardar privelegios y rol modulo

    public function guardarroles()
    {
        $privilegio = new Usuario_Model();
        // Verifica si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los valores del formulario
            $id_usuario = $_POST['id_usuario'];
            $id_submodulo = $_POST['id_sub_modulo'];
            $id = $_POST['id'];
            foreach ($id_submodulo as $id_submodulo) {
                $id_modulo = $privilegio->getmodulo($id_submodulo);
                $privilegio->guardarPrivilegio($id_modulo, $id_submodulo, $id_usuario, $id);
            }
            header("location: index.php?c=usuarios&a=privilegio");
        }
    }
    public function permiso()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $tiene_permiso = true;
        foreach ($_SESSION['modulos'] as $permiso) {
            if ($permiso['id_modulo'] == 13 && $permiso['id_sub_modulo'] == 51) {
                $tiene_permiso = true;
                break;
            }
        }
        if ($tiene_permiso) {
            require_once("view/permiso.php");
        } else {
            header("location: index.php?c=errores&a=error403");
        }
    }
    public function asigpermiso()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $tiene_permiso = true;
        foreach ($_SESSION['permisos'] as $permiso) {
            if ($permiso['id_modulo'] == 13 && $permiso['id_permiso'] == 2) {
                $tiene_permiso = true;
                break;
            }
        }
        if ($tiene_permiso) {
            $privilegio = new Usuario_Model();
            $data["permiso"] = $privilegio->mostrarPermisosPorModulo();
            $data["usuarios"] = $privilegio->mostrarusuarios();
            require_once("view/asignar_permiso.php");
        } else {
            header("location: index.php?c=errores&a=error403");
        }
    }
    public function guardar_permisos_usuarios()
    {
        $privilegio = new Usuario_Model();
        // Verifica si se envió el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los valores del formulario
            $id_usuario = $_POST['id_usuario'];
            $id_permisos = $_POST['id_permisos'];
            $id = $_POST['id'];

            foreach ($id_permisos as $id_permiso) {
                $id_modulo = $privilegio->getmoduloid($id_permiso);
                $id_permisoss = $privilegio->getpermiso($id_permiso);
                $privilegio->guardarPermiso($id_modulo, $id_permisoss, $id_usuario, $id);
            }
            header("location: index.php?c=usuarios&a=permiso");
        }
    }
}