<?php
class LoginController
{
    public function __construct()
    {
        require_once "model/login.php";
    }
    public function index()
    {
        require_once "view/login.php";
    }
    public function validar_login()
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return;
        }

        $usuarios = $_POST['usuario'];
        $contraseña = $_POST['contraseña'];
        $ip = $_SERVER['REMOTE_ADDR'];

        // Crear una instancia del modelo
        $login_model = new Login_Model();
        $activo = $login_model->tiene_conexion_activa($usuarios);

        switch ($activo) {
            case 0:
                // Validar el usuario
                if ($login_model->validar_usuario($usuarios)) {
                    // Validar la contraseña
                    if ($login_model->validar_contraseña($usuarios, $contraseña)) {
                        $_SESSION['verificar'] = $login_model->verificar_usuario($usuarios);

                        $usuario = $login_model->obtener_nombre_y_foto($usuarios);
                        $_SESSION['nombre'] = $usuario['nombre'];
                        $_SESSION['foto'] = $usuario['foto'];
                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['id_trabajador'] = $usuario['id_trabajador'];
                        $conexion = $login_model->registrar_inicio_sesion($usuario['id'], $ip);
                        $_SESSION['permisos'] = $login_model->permisos_usuarios($usuarios);
                        $_SESSION['privilegios'] = $login_model->obtener_privilegio($usuarios);
                        $_SESSION['modulos'] = $login_model->obtener_modulos_submodulos_usuario($usuario['id']);
                        header("Location: index.php?c=inicio&a=inicio");
                    } else {
                        header("Location: index.php?c=login");
                    }
                } else {
                    header("Location: index.php?c=page&a=login");
                }
                break;
            default:
                header("Location: index.php?c=errores&a=error400");
                break;
        }
    }


    public function cerra_session()
    {
        $id_usuario = $_GET['id'];
        // Iniciar la sesión
        session_start();


        // Eliminar todas las variables de sesión
        session_unset();
        // Destruir la sesión
        session_destroy();
        $estado = 0;
        $cerra = new Login_Model();
        $cerra->cerrar_session($estado, $id_usuario);
    }
}
