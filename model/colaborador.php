<?php
class Colaborador_Model
{
    private $db;
    private $gestion;
    private $estado;
    private $cargo;
    public function __construct()
    {
        $this->db = conectar::conexion();
        $this->gestion = array();
        $this->estado = array();
        $this->cargo = array();
    }
    public function index()
    {
        $sql = "SELECT persona.id, persona.nombre, persona.telefono, persona.direccion_domicilio, persona.correo, persona.fecha_registro, persona_natural.apellido, persona_natural.cedula, persona_natural.genero, persona_natural.nacionalidad, persona_natural.fecha_nacimiento, trabajador.codigo, trabajador.inss, estado_civil.nombre_estado,trabajador.id, trabajador.foto ,trabajador.fecha_registro, trabajador.estado, trabajador.foto
        FROM persona
        JOIN persona_natural ON persona.id = persona_natural.id_persona
        JOIN colaborador AS trabajador ON persona.id = trabajador.id_persona
        JOIN estado_civil ON trabajador.id_estado_civil = estado_civil.id";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->gestion[] = $row;
                }
                return $this->gestion;
            } else {
                return null; // Si no hay datos, retornar null o un mensaje de error, según convenga
            }
        }
    }

    public function get_estados()
    {

        $sql = "SELECT * FROM estado_civil";
        $resultado = $this->db->query($sql);
        while ($row = $resultado->fetch_assoc()) {
            $this->estado[] = $row;
        }
        return $this->estado;
    }
    public function generar_codigo_trabajador()
    {
        $codigo_trabajador = '';
        $codigo_existe = true;
        while ($codigo_existe) {

            $numero_aleatorio = rand(10000, 99999);
            // Comprobar si el número ya existe en la base de datos
            $consulta = $this->db->query("SELECT cod_trabajador FROM trabajador WHERE cod_trabajador = $numero_aleatorio");
            if ($consulta->num_rows == 0) {
                $codigo_trabajador = $numero_aleatorio;
                $codigo_existe = false;
            }
        }
        return $codigo_trabajador;
    }

    public function crear($nombre, $telefono, $direccion_domicilio, $correo, $apellido, $cedula, $genero, $nacionalidad, $fecha_nacimiento, $codigo_inss, $id_estado_civil, $foto, $estado)
    {
        // Escapar valores para evitar inyección SQL
        $nombre = $this->db->real_escape_string($nombre);
        $telefono = $this->db->real_escape_string($telefono);
        $direccion_domicilio = $this->db->real_escape_string($direccion_domicilio);
        $correo = $this->db->real_escape_string($correo);
        $apellido = $this->db->real_escape_string($apellido);
        $cedula = $this->db->real_escape_string($cedula);
        $genero = $this->db->real_escape_string($genero);
        $nacionalidad = $this->db->real_escape_string($nacionalidad);
        $fecha_nacimiento = $this->db->real_escape_string($fecha_nacimiento);
        $codigo_inss = $this->db->real_escape_string($codigo_inss);
        $id_estado_civil = $this->db->real_escape_string($id_estado_civil);
        $estado = $this->db->real_escape_string($estado);
        $cod_trabajador = $this->generar_codigo_trabajador();
        $foto = $this->db->real_escape_string($foto);
        // Insertar en tabla persona
        $sql_persona = "INSERT INTO persona (nombre, telefono, direccion_domicilio, correo, fecha_registro) VALUES ('$nombre', $telefono, '$direccion_domicilio', '$correo',  NOW())";
        $this->db->query($sql_persona);

        // Obtener el ID de la persona insertada
        $id_persona = $this->db->insert_id;

        // Insertar en tabla persona_natural
        $sql_persona_natural = "INSERT INTO persona_natural (id_persona,apellido, cedula, genero, nacionalidad, fecha_nacimiento) VALUES ($id_persona, '$apellido', '$cedula', '$genero', '$nacionalidad', '$fecha_nacimiento')";
        $this->db->query($sql_persona_natural);

        // Insertar en tabla trabajador
        $sql_trabajador = "INSERT INTO colaborador (id_persona, id_sucursal, id_estado_civil, codigo, inss, fecha_registro, genero, foto, estado) VALUES ($id_persona,1,$id_estado_civil,'$cod_trabajador','$codigo_inss',  NOW(),'$genero','$foto', $estado)";
        $this->db->query($sql_trabajador);
    }
    public function generarCodigoCargo($nombreCargo)
    {
        // Convertir el nombre del cargo a mayúsculas y eliminar espacios
        $nombreCargo = str_replace(' ', '', strtoupper($nombreCargo));
        // Obtener la fecha actual en formato 'Ymd' (ejemplo: 20220314)
        $fechaActual = date('Ymd');
        // Generar un número aleatorio entre 1000 y 9999
        $numeroAleatorio = rand(1000, 9999);
        // Combinar los valores para formar el código de cargo (ejemplo: MGR-20220314-1234)
        $codigoCargo = substr($nombreCargo, 0, 3) . '-' . $fechaActual . '-' . $numeroAleatorio;
        return $codigoCargo;
    }

    public function crear_cargo($cod_cargo, $nombre_cargo, $descripcion, $salario, $estado)
    {
        // Escapar los parámetros para evitar inyecciones SQL
        $cod_cargo = $this->db->real_escape_string($cod_cargo);
        $nombre_cargo = $this->db->real_escape_string($nombre_cargo);
        $descripcion = $this->db->real_escape_string($descripcion);
        $salario = (float) $salario;
        $estado = (int) $estado;

        // Insertar en tabla cargo
        $sql_cargo = "INSERT INTO cargo (cod_cargo,nombre_cargo, descripcion, salario, estado) VALUES ('$cod_cargo','$nombre_cargo', '$descripcion', $salario, $estado)";
        $this->db->query($sql_cargo);
    }
    public function crearHistorialCargo($id_cargo, $id_trabajador, $fecha, $motivo, $estado)
    {
        $id_cargo = $this->db->real_escape_string($id_cargo);
        $id_trabajador = $this->db->real_escape_string($id_trabajador);
        $fecha = $this->db->real_escape_string($fecha);
        $motivo = $this->db->real_escape_string($motivo);
        $estado = (int) $estado;
        $sql = "INSERT INTO historial_cargo_trabajador (id_cargo, id_trabajador, fecha, motivo, estado) VALUES ($id_cargo, $id_trabajador, '$fecha', '$motivo', $estado)";
        $this->db->query($sql);
    }

    public function mostrarcargos()
    {
        $sql = "SELECT id,cod_cargo,nombre_cargo, descripcion, estado FROM cargo";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->cargo[] = $row;
                }
                return $this->cargo;
            } else {
                return null; // Si no hay datos, retornar null o un mensaje de error, según convenga
            }
        }
    }
    public function asignarcargos()
    {
    }

    public function trabajador()
    {
        $sql = "SELECT trabajador.id, persona.nombre, persona_natural.apellido FROM trabajador INNER JOIN persona ON trabajador.id_persona = persona.id INNER JOIN persona_natural ON persona.id = persona_natural.id_persona WHERE trabajador.estado = 1";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->cargo[] = $row;
                }
                return $this->cargo;
            } else {
                return null; // Si no hay datos, retornar null o un mensaje de error, según convenga
            }
        }
    }
    public function cargos_tra()
    {
        $sql = "SELECT id, nombre_cargo FROM cargo WHERE estado=1";
        $resultado = $this->db->query($sql);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->cargo[] = $row;
                }
                return $this->cargo;
            } else {
                return array(); // Si no hay datos, retornar null o un mensaje de error, según convenga
            }
        }
    }

   
}