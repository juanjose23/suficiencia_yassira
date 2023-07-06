<?php
class Login_Model
{

    private $db;
    public function __construct()
    {
        $this->db = conectar::conexion();
    }
    //Validar usuario
    function validar_usuario($usuario)
    {
        $usuario = $this->db->real_escape_string($usuario);
        $sql = "SELECT * FROM usuario WHERE usuario='$usuario' AND estado=1 ";
        $resultado = $this->db->query($sql);

        if ($resultado->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }
    //Validar contraseña
    function validar_contraseña($usuario, $contraseña)
    {
        $usuario = $this->db->real_escape_string($usuario);
        $sql1 = "SELECT id FROM usuario WHERE usuario='$usuario' AND estado=1 ";
        $resultado1 = $this->db->query($sql1);
        if ($resultado1->num_rows == 1) {
            $fila1 = $resultado1->fetch_assoc();
            $id_usuario = $fila1['id'];
            $sql = "SELECT contraseña_actual FROM detalle_usuario WHERE id_usuario='$id_usuario'";
            $resultado = $this->db->query($sql);
            if ($resultado->num_rows == 1) {
                $fila = $resultado->fetch_assoc();
                $contraseña_hash = $fila['contraseña_actual'];
                if (password_verify($contraseña, $contraseña_hash)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    //Obtener de la session nombre y foto
    public function obtener_nombre_y_foto($usuario)
    {

        $usuario = $this->db->real_escape_string($usuario);
        $sql = "SELECT id_persona, id FROM usuario WHERE usuario = '$usuario'";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
        $id_persona = $fila['id_persona'];
        $id_usuario = $fila['id'];


        $sql = "SELECT id AS id_trabajador,foto FROM trabajador WHERE id_persona = $id_persona";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
        $foto = $fila['foto'];
        $id_trabajador=$fila['id_trabajador'];


        $sql = "SELECT nombre FROM persona WHERE id = $id_persona";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombre'];


        $privilegios = $this->obtener_privilegio($usuario);

        // Devolver un arreglo asociativo con el nombre, la foto y los submódulos
        return array("nombre" => $nombre, "foto" => $foto, "id" => $id_persona, "id_trabajador" =>$id_trabajador);
    }
    //Obtener el privilegio de usuarios
    public function obtener_privilegio($usuario)
    {

        $privilegios = array();
        $usuario = $this->db->real_escape_string($usuario);
        $sql = "SELECT id FROM usuario WHERE usuario = '$usuario'";
        $result = $this->db->query($sql);
        if ($result->num_rows == 0) {
            // Si no se encontró el usuario, retornar el array vacío
            return $privilegios;
        }
        $row = $result->fetch_assoc();
        $id_usuario = $row['id'];

        // Obtener los privilegios del usuario
        $query = "SELECT m.id AS modulo_id, m.nombre AS modulo_nombre, m.icono AS modulo_icono, 
        sm.id AS submodulo_id, sm.nombre AS submodulo_nombre, sm.enlaces AS submodulo_enlaces
            FROM privilegio_usuario pu 
            JOIN sub_modulo sm ON sm.id = pu.id_sub_modulo
            JOIN modulo m ON m.id = sm.id_modulo
            WHERE pu.id_usuario = $id_usuario
            ";

        $result = $this->db->query($query);
        $modulos = array();
        while ($row = $result->fetch_assoc()) {
            $modulo_id = $row['modulo_id'];
            $submodulo_id = $row['submodulo_id'];
            if (!isset($modulos[$modulo_id])) {
                $modulos[$modulo_id] = array(
                    'id' => $modulo_id,
                    'nombre' => $row['modulo_nombre'],
                    'icono' => $row['modulo_icono'],
                    'submodulos' => array()
                );
            }
            if (!empty($submodulo_id)) {
                $submodulo = array(
                    'id' => $submodulo_id,
                    'nombre' => $row['submodulo_nombre'],
                    'enlace' => $row['submodulo_enlaces']
                );
                $modulos[$modulo_id]['submodulos'][] = $submodulo;
            }
        }

        $privilegios = $modulos;
        return $privilegios;
    }
    //Funcion para obtener los permisos del usuario.
    public function permisos_usuarios($usuario)
    {
        $permisos = array();
        $sql = "SELECT id FROM usuario WHERE usuario = '$usuario'";
        $result = $this->db->query($sql);
        if (!$result) {
            die('Error de consulta: ' . $this->db->error);
        }
        if ($result->num_rows == 0) {
            return $permisos;
        }
        $row = $result->fetch_assoc();
        $id_usuario = $row['id'];
        $query = "SELECT id_permiso, id_modulo FROM privilegio_permiso_usuario WHERE id_usuario ='$id_usuario'";
        $resultado = $this->db->query($query);
        if (!$resultado) {
            die('Error de consulta: ' . $this->db->error);
        }
        while ($fila = $resultado->fetch_assoc()) {
            $permisos[] = array(
                'id_permiso' => $fila['id_permiso'],
                'id_modulo' => $fila['id_modulo']
            );
        }

        // Retornar el arreglo con los id_permiso e id_modulo
        return $permisos;
    }
    //Verificar el submodulo
    public function obtener_modulos_submodulos_usuario($id_usuario)
    {
        $modulos_submodulos = array();
        $query = "SELECT id_modulo, id_sub_modulo FROM privilegio_usuario WHERE id_usuario = '$id_usuario'";
        $resultado = $this->db->query($query);
        if (!$resultado) {
            die('Error de consulta: ' . $this->db->error);
        }
        while ($fila = $resultado->fetch_assoc()) {
            $modulos_submodulos[] = array(
                'id_modulo' => $fila['id_modulo'],
                'id_sub_modulo' => $fila['id_sub_modulo']
            );
        }

        // Retornar el arreglo con los id_modulo e id_sub_modulo
        return $modulos_submodulos;
    }

    //Funcion para verificar el usuario, esta sirve para validar el grupo de cliente y area administrativas
    public function verificar_usuario($usuario)
    {
        $sql = "SELECT id_grupo FROM usuario  WHERE usuario = '$usuario'";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows == 0) {
            return null;
        }
        $fila = $resultado->fetch_assoc();
        $id_sub= $fila['id_grupo'];
        $sql1 = "SELECT id_grupo FROM sub_grupo_usuario WHERE id = '$id_sub'";
        $resultado = $this->db->query($sql1);
        if ($resultado->num_rows == 0) {
            return null;
        }
        $fi= $resultado->fetch_assoc();
        return $fi['id_grupo'];
    }
    public function tiene_conexion_activa($usuario)
    {
        $sql = "SELECT id FROM usuario  WHERE usuario = '$usuario'";
        $resultado = $this->db->query($sql);
        if ($resultado->num_rows == 0) {
            return null;
        }
        $fila = $resultado->fetch_assoc();
        $id= $fila['id'];
        $sql1 = "SELECT estado FROM conexion WHERE id_usuario = '$id' AND estado =1";
        $resultado = $this->db->query($sql1);
        if ($resultado->num_rows == 0) {
            return 0;
        }
        $fi= $resultado->fetch_assoc();
        return $fi['estado'];
    }
    //Para levantar el inicio de session
    public function registrar_inicio_sesion($id_usuario, $ip)
    {
        $sql = "INSERT INTO conexion (id_usuario, ip,  fecha_ingreso,estado) VALUES ('$id_usuario', '$ip',NOW(), '1')";
        $result = $this->db->query($sql);
        if ($result) {
            $lastId = $this->db->insert_id;
           return $lastId;
        } else {
            return false;
        }
    }
    public function cerrar_session($estado,$id)
    {
    
        // Actualizar el estado de la sesión en la tabla de historial de sesiones
        $sql = "UPDATE conexion SET estado = $estado WHERE id_usuario = '$id' AND estado =1";
        $this->db->query($sql);
        header("Location: index.php?c=login");
      
    }
    public function obtener_nombre_y_foto_cliente($usuario)
    {

        $usuario = $this->db->real_escape_string($usuario);
        $sql = "SELECT id_persona, id FROM usuario WHERE usuario = '$usuario'";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
        $id_persona = $fila['id_persona'];
        $id_usuario = $fila['id'];


        $sql = "SELECT id AS id_cliente,foto FROM cliente WHERE id_persona = $id_persona";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
        $foto = $fila['foto'];
        $id_cliente=$fila['id_cliente'];


        $sql = "SELECT nombre FROM persona WHERE id = $id_persona";
        $resultado = $this->db->query($sql);
        $fila = $resultado->fetch_assoc();
        $nombre = $fila['nombre'];
        // Devolver un arreglo asociativo con el nombre, la foto y los submódulos
        return array("nombre" => $nombre, "foto" => $foto, "id" => $id_usuario, "id_cliente" =>$id_cliente);
    }
}