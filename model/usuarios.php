<?php
class Usuario_Model
{
    private $db;
    private $usuarios;
    private $modulos;
    private $subgrupo;
    private $grupo;
    private $trabajador;
    public function __construct()
    {
        $this->db = conectar::conexion();
        $this->usuarios = array();
        $this->modulos = array();
        $this->subgrupo = array();
        $this->grupo = array();
        $this->trabajador = array();
    }
    //Usuarios
    public function usuarios()
    {
        $sql = "SELECT usuario.id, persona.nombre AS nombre_persona, sub_grupo_usuario.nombre AS nombre_subgrupo, grupo_usuario.nombre AS nombre_grupo, usuario.usuario, usuario.fecha_registro, usuario.estado
        FROM usuario
        JOIN persona ON usuario.id_persona = persona.id
        JOIN sub_grupo_usuario ON usuario.id_grupo = sub_grupo_usuario.id
        JOIN grupo_usuario ON sub_grupo_usuario.id_grupo = grupo_usuario.id";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->usuarios[] = $row;
                }
                return $this->usuarios;
            } else {
                return null;
            }
        }
    }
    //Usuarios no verificados
    public function usuarios_no_verificados()
    {
        $sql = "SELECT usuario.id, persona.nombre AS nombre_persona, sub_grupo_usuario.nombre AS nombre_subgrupo, grupo_usuario.nombre AS nombre_grupo, usuario.usuario, usuario.fecha_registro, usuario.estado
        FROM usuario
        JOIN persona ON usuario.id_persona = persona.id
        JOIN sub_grupo_usuario ON usuario.id_grupo = sub_grupo_usuario.id
        JOIN grupo_usuario ON sub_grupo_usuario.id_grupo = grupo_usuario.id
        WHERE usuario.estado = 0";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->usuarios[] = $row;
                }
                return $this->usuarios;
            } else {
                return array();
            }
        }
    }
    public function mostrarsubgrupos()
    {
        $query = "SELECT gu.id AS id_grupo, gu.nombre AS nombre_grupo, gu.descripcion AS descripcion_grupo, sgu.id AS id_subgrupo, sgu.nombre AS nombre_subgrupo, sgu.descripcion AS descripcion_subgrupo
        FROM grupo_usuario gu
        LEFT JOIN sub_grupo_usuario sgu ON gu.id = sgu.id_grupo
        WHERE gu.estado = 1 AND sgu.estado = 1 
        ";

        $resultado = $this->db->query($query);

        // Verificar si se obtuvieron resultados
        if ($resultado && $resultado->num_rows > 0) {
            // Crear un array asociativo para almacenar los datos de los grupos y subgrupos
            $grupos = array();
            while ($row = $resultado->fetch_assoc()) {
                $grupo_id = $row['id_grupo'];
                $grupo_nombre = $row['nombre_grupo'];
                $grupo_descripcion = $row['descripcion_grupo'];
                $subgrupo_id = $row['id_subgrupo'];
                $subgrupo_nombre = $row['nombre_subgrupo'];
                $subgrupo_descripcion = $row['descripcion_subgrupo'];

                // Si el grupo ya está en el array, agregar el subgrupo correspondiente
                if (array_key_exists($grupo_id, $grupos)) {
                    array_push(
                        $grupos[$grupo_id]['subgrupos'],
                        array(
                            'id' => $subgrupo_id,
                            'nombre' => $subgrupo_nombre,
                            'descripcion' => $subgrupo_descripcion
                        )
                    );
                } else {
                    // Si el grupo no está en el array, crear una nueva entrada con su subgrupo correspondiente
                    $grupos[$grupo_id] = array(
                        'id' => $grupo_id,
                        'nombre' => $grupo_nombre,
                        'descripcion' => $grupo_descripcion,
                        'subgrupos' => array(
                            array(
                                'id' => $subgrupo_id,
                                'nombre' => $subgrupo_nombre,
                                'descripcion' => $subgrupo_descripcion
                            )
                        )
                    );
                }
            }
            // Devolver el array asociativo de grupos y sus subgrupos
            return $grupos;
        } else {
            // Si no hay resultados, devolver un array vacío o lanzar una excepción según sea necesario.
            return array();
        }
    }
    public function mostrarPermisosPorModulo()
    {
        $query = "SELECT pm.id AS id_permiso_modulo, m.id AS id_modulo, m.nombre AS nombre_modulo, p.id AS id_permiso, p.nombre AS nombre_permiso, p.descripcion AS descripcion_permiso
              FROM modulo m
              INNER JOIN permiso_modulo pm ON m.id = pm.id_modulo
              INNER JOIN permiso p ON pm.id_permiso = p.id
              WHERE m.estado = 1";

        $resultado = $this->db->query($query);
        if ($resultado && $resultado->num_rows > 0) {
            $permisos = array();
            while ($row = $resultado->fetch_assoc()) {
                $id_permiso_modulo = $row['id_permiso_modulo'];
                $modulo_id = $row['id_modulo'];
                $modulo_nombre = $row['nombre_modulo'];
                $permiso_id = $row['id_permiso'];
                $permiso_nombre = $row['nombre_permiso'];
                $permiso_descripcion = $row['descripcion_permiso'];

                // Si el módulo ya está en el array, agregar el permiso correspondiente
                if (array_key_exists($modulo_nombre, $permisos)) {
                    array_push(
                        $permisos[$modulo_nombre]['permisos'],
                        array(
                            'id_permiso_modulo' => $id_permiso_modulo,
                            'id' => $permiso_id,
                            'nombre' => $permiso_nombre,
                            'descripcion' => $permiso_descripcion
                        )
                    );
                } else {
                    $permisos[$modulo_nombre] = array(
                        'id' => $modulo_id,
                        'nombre' => $modulo_nombre,
                        'permisos' => array(
                            array(
                                'id_permiso_modulo' => $id_permiso_modulo,
                                'id' => $permiso_id,
                                'nombre' => $permiso_nombre,
                                'descripcion' => $permiso_descripcion
                            )
                        )
                    );
                }
            }

            $modulos_con_permisos = array_values($permisos);

            return $modulos_con_permisos;
        } else {
            return array();
        }
    }


    public function mostrartrabajador()
    {
        $sql = "SELECT trabajador.id, persona.nombre, persona_natural.apellido
        FROM persona
        JOIN persona_natural ON persona.id = persona_natural.id_persona
        JOIN colaborador AS trabajador ON persona.id = trabajador.id_persona
        WHERE NOT EXISTS (
            SELECT * FROM usuario 
            WHERE usuario.id_persona = persona.id
        )";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->trabajador[] = $row;
                }
                return $this->trabajador;
            } else {
                return null; // Si no hay datos, retornar null o un mensaje de error, según convenga
            }
        }
    }

    //Buscar id de la persona
    public function getIdpersona($id_trabajador)
    {
        // Consulta SQL para obtener el ID de ubicación
        $sql = "SELECT id_persona FROM  colaborador WHERE id = " . $id_trabajador;
        $result = $this->db->query($sql);
        if ($result === false) {
            echo $this->db->error; // para verificar si hay algún error en la consulta
        }
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Obtener el resultado como una matriz asociativa
            $row = $result->fetch_assoc();
            // Devolver el valor de id_ubicaciones
            return $row["id_persona"];
        } else {
            // Si no hay resultados, devolver null
            return null;
        }
    }
    public function guardarusuario($id_persona, $id_sub, $usuario, $contrasena, $estado)
    {
        $id_persona = $this->db->real_escape_string($id_persona);
        $id_sub = $this->db->real_escape_string($id_sub);
        $usuario = $this->db->real_escape_string($usuario);
        $contrasena = $this->db->real_escape_string($contrasena);
        $estado = $this->db->real_escape_string($estado);
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        $fecha_registro = date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO usuario (id_persona, id_grupo, usuario,fecha_registro, estado) 
                VALUES ('$id_persona', '$id_sub', '$usuario','$fecha_registro', '$estado')";
        $resultado = $this->db->query($sql);
        $id_usuario = $this->db->insert_id;
        //Insertar en detalle usuario
        $sql_detalle_usuario = "INSERT INTO detalle_usuario(id_usuario,contraseña_actual)VALUES ($id_usuario,'$hash')";
        $this->db->query($sql_detalle_usuario);
        return $resultado;
    }
    public function verificarusuario($id)
    {
        $resultado = $this->db->query("UPDATE usuario SET estado=1 WHERE id=$id");
    }

    //Grupos de usuarios
    public function getgrupo()
    {
        $sql = "SELECT sub_grupo_usuario.id, grupo_usuario.nombre as nombre_grupo, sub_grupo_usuario.nombre, sub_grupo_usuario.descripcion, sub_grupo_usuario.estado
        FROM sub_grupo_usuario
        JOIN grupo_usuario ON sub_grupo_usuario.id_grupo = grupo_usuario.id";
        $resultado = $this->db->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $this->subgrupo[] = $row;
            }
        } else {
            // Si no hay resultados, devolver un array vacío o lanzar una excepción según sea necesario.
            $this->subgrupo;
        }
        return $this->subgrupo;
    }
    public function grupo()
    {
        $sql = "SELECT id,nombre FROM grupo_usuario";
        $resultado = $this->db->query($sql);
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $this->grupo[] = $row;
            }
        } else {
            // Si no hay resultados, devolver un array vacío o lanzar una excepción según sea necesario.
            $this->grupo;
        }
        return $this->grupo;
    }
    public function guardarSubGrupo($id_grupo, $nombre, $descripcion, $estado)
    {
        // Escapar los valores para evitar inyección de SQL
        $id_grupo = $this->db->real_escape_string($id_grupo);
        $nombre = $this->db->real_escape_string($nombre);
        $descripcion = $this->db->real_escape_string($descripcion);
        $estado = (int) $estado;

        // Insertar en tabla sub_grupo_usuario
        $sql = "INSERT INTO sub_grupo_usuario (id_grupos, nombre, descripcion, estado) VALUES ('$id_grupo', '$nombre', '$descripcion', $estado)";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            return $this->db->insert_id;
        } else {
            return false;
        }
    }
    public function getGruposConSubgrupos()
    {
        $query = "SELECT g.id AS grupo_id, g.nombre AS grupo_nombre, sg.id AS subgrupo_id, sg.nombre AS subgrupo_nombre
        FROM grupo_usuario g
        JOIN sub_grupo_usuario sg ON g.id = sg.id_grupo
        WHERE g.estado = 1 AND sg.estado = 1
    ";

        $resultado = $this->db->query($query);

        // Verificar si se obtuvieron resultados
        if ($resultado && $resultado->num_rows > 0) {
            // Crear un array asociativo para almacenar los datos de los grupos y sus subgrupos
            $grupos = array();
            while ($row = $resultado->fetch_assoc()) {
                $grupo_id = $row['grupo_id'];
                $grupo_nombre = $row['grupo_nombre'];
                $subgrupo_id = $row['subgrupo_id'];
                $subgrupo_nombre = $row['subgrupo_nombre'];

                // Si el grupo ya está en el array, agregar el subgrupo correspondiente
                if (array_key_exists($grupo_id, $grupos)) {
                    array_push(
                        $grupos[$grupo_id]['subgrupos'],
                        array(
                            'id' => $subgrupo_id,
                            'nombre' => $subgrupo_nombre
                        )
                    );
                } else {
                    // Si el grupo no está en el array, crear una nueva entrada con su subgrupo correspondiente
                    $grupos[$grupo_id] = array(
                        'id' => $grupo_id,
                        'nombre' => $grupo_nombre,
                        'subgrupos' => array(
                            array(
                                'id' => $subgrupo_id,
                                'nombre' => $subgrupo_nombre
                            )
                        )
                    );
                }
            }
            // Devolver el array asociativo de grupos y sus subgrupos
            return $grupos;
        } else {
            // Si no hay resultados, devolver un array vacío o lanzar una excepción según sea necesario.
            return array();
        }
    }

    #privilegios
    public function mostrarmodulos()
    {
        $query = "SELECT m.id AS modulo_id, m.nombre AS modulo_nombre, 
                sm.id AS submodulo_id, sm.nombre AS submodulo_nombre
            FROM modulo m LEFT JOIN sub_modulo sm ON m.id = sm.id_modulo";

        $result = $this->db->query($query);
        $modulos = array();
        while ($row = $result->fetch_assoc()) {
            $modulo_id = $row['modulo_id'];
            $submodulo_id = $row['submodulo_id'];
            if (!isset($modulos[$modulo_id])) {
                $modulos[$modulo_id] = array(
                    'id' => $modulo_id,
                    'nombre' => $row['modulo_nombre'],
                    'submodulos' => array()
                );
            }
            if (!empty($submodulo_id)) {
                $submodulo = array(
                    'id' => $submodulo_id,
                    'nombre' => $row['submodulo_nombre']
                );
                $modulos[$modulo_id]['submodulos'][] = $submodulo;
            }
        }
        return array_values($modulos);
    }

    public function mostrarusuarios()
    {
        $sql = "SELECT id, usuario FROM usuario WHERE estado = 1  AND id_grupo NOT IN (10,11)";
        $resultado = $this->db->query($sql);
        $usuarioss = array();
        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $usuarioss[] = $row;
            }
        }
        return $usuarioss;
    }
    #Privilegios
    public function guardarPrivilegio($id_modulo, $id_sub_modulo, $id_usuario, $autorizacion)
    {
        // Escapar los valores para evitar inyección de SQL
        $id_modulo = (int)$id_modulo;
        $id_sub_modulo = (int)$id_sub_modulo;
        $id_usuario = $this->db->real_escape_string($id_usuario);
        $autorizacion = $this->db->real_escape_string($autorizacion);
        // Insertar en tabla privilegio_usuario
        $sql2 = "INSERT INTO privilegio_usuario (id_modulo,id_sub_modulo,id_usuario, autorizacion) VALUES ('$id_modulo','$id_sub_modulo','$id_usuario', '$autorizacion')";
        $resultado2 = $this->db->query($sql2);

        // Retornar true si ambos insert fueron exitosos
        return $resultado2;
    }
    public function guardarPermiso($id_modulo, $id_permiso, $id_usuario, $autorizacion)
    {
        // Escapar los valores para evitar inyección de SQL
        $id_modulo = (int)$id_modulo;
        $id_permiso = (int)$id_permiso;
        $id_usuario = $this->db->real_escape_string($id_usuario);
        $autorizacion = $this->db->real_escape_string($autorizacion);
        // Insertar en tabla privilegio_usuario
        $sql2 = "INSERT INTO  privilegio_permiso_usuario (id_modulo,id_permiso,id_usuario, autorizacion) VALUES ('$id_modulo','$id_permiso','$id_usuario', '$autorizacion')";
        $resultado2 = $this->db->query($sql2);

        // Retornar true si ambos insert fueron exitosos
        return $resultado2;
    }
    public function getModuloId($id_permiso)
    {
        // Consulta SQL para obtener el ID de modulo
        $sql = "SELECT id_modulo FROM permiso_modulo WHERE id = " . $id_permiso;
        $result = $this->db->query($sql);
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Obtener el resultado como una matriz asociativa
            $row = $result->fetch_assoc();
            // Devolver el valor de id_modulo
            return $row["id_modulo"];
        } else {
            // Si no hay resultados, devolver null
            return null;
        }
    }
    public function getpermiso($id_permiso)
    {
        // Consulta SQL para obtener el ID de modulo
        $sql = "SELECT id_permiso FROM permiso_modulo WHERE id = " . $id_permiso;
        $result = $this->db->query($sql);
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Obtener el resultado como una matriz asociativa
            $row = $result->fetch_assoc();
            // Devolver el valor de id_modulo
            return $row["id_permiso"];
        } else {
            // Si no hay resultados, devolver null
            return null;
        }
    }
    public function getModulo($id_permiso)
    {
        // Consulta SQL para obtener el ID de modulo
        $sql = "SELECT id_modulo FROM sub_modulo WHERE id = " . $id_permiso;
        $result = $this->db->query($sql);
        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Obtener el resultado como una matriz asociativa
            $row = $result->fetch_assoc();
            // Devolver el valor de id_modulo
            return $row["id_modulo"];
        } else {
            // Si no hay resultados, devolver null
            return null;
        }
    }
}