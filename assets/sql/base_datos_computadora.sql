CREATE TABLE persona(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        telefono INTEGER NOT NULL,
        direccion_domicilio VARCHAR(255),
        correo VARCHAR(40),
        fecha_registro DATE
    );

CREATE TABLE persona_natural(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_persona INTEGER REFERENCES persona(id),
        apellido VARCHAR(80),
        cedula VARCHAR(25),
        nacionalidad varchar(80),
        fecha_nacimiento DATE
    );

CREATE TABLE persona_juridica(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_persona INTEGER REFERENCES persona(id),
        fecha_constitucional DATE,
        numero_ruc VARCHAR(100) NOT NULL,
        razon_social VARCHAR(250)
    );

CREATE TABLE cliente(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_persona INTEGER REFERENCES persona(id),
        tipo_cliente VARCHAR(20) NOT NULL,
        genero CHAR(25),
        foto VARCHAR(120),
        estado INTEGER
    );

CREATE TABLE proveedor(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_persona INTEGER REFERENCES persona(id),
        sector_comercial VARCHAR(50) NOT NULL,
        nacionalidad VARCHAR(50),
        estado INTEGER
    );


CREATE TABLE estado_civil(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre_estado VARCHAR(50) NOT NULL,
        descripcion VARCHAR(150)
    );

CREATE TABLE colaborador(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_persona INTEGER REFERENCES persona(id),
        codigo VARCHAR(30) NOT NULL,
        inss VARCHAR(20) NOT NULL,
        id_estado_civil INTEGER REFERENCES estado_civil(id),
        fecha_registro DATE,
        genero char(25),
        foto Varchar(80),
        estado INTEGER
    );

CREATE TABLE cargo(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        cod_cargo VARCHAR(30),
        nombre_cargo VARCHAR(80),
        descripcion VARCHAR(120),
        estado INTEGER
    );

CREATE TABLE asignacion_cargo (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cargo INTEGER REFERENCES cargo(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        fecha_asignacion DATE NOT NULL,
        fecha_termino DATE,
        estado INTEGER
    );

CREATE TABLE historial_cargo (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cargo_anterior INTEGER REFERENCES cargo(id),
        id_cargo_nuevo INTEGER REFERENCES cargo(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        fecha_cambio DATE NOT NULL,
        motivo VARCHAR(250) NOT NULL,
        estado INTEGER
    );

CREATE TABLE pago(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_colaborador INTEGER REFERENCES colaborador(id),
        id_cargo INTEGER REFERENCES cargo (id),
        fecha_cambio DATE NOT NULL,
        salario DECIMAL(3, 2) NOT NULL,
        salario_anterior DECIMAL(3, 2) NOT NULL,
        estado INTEGER NOT NULL
    );

CREATE TABLE categoria_producto(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(80),
        estado INTEGER
    );

CREATE TABLE sub_categoria_producto(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(120) NOT NULL,
        id_categoria INTEGER REFERENCES categoria_producto(id),
        estado INTEGER
    );

CREATE TABLE marca(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(80) NOT NULL,
        siglas VARCHAR(80),
        estado INTEGER
    );

CREATE TABLE unidad_medida(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(80) NOT NULL,
        siglas VARCHAR(80),
        estado INTEGER
    );

/*SI SON DE PARED, DE PISO , PALETAS, ETC*/
CREATE TABLE categoria_estantes
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(120) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    estado INTEGER NOT NULL
);
CREATE TABLE Ubicacion(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(120) NOT NULL,
        descripcion VARCHAR(250) NOT NULL,
        estado INTEGER
    );

CREATE TABLE sub_ubicacion
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_ubicacion INTEGER REFERENCES ubicacion(id),
    nombre VARCHAR(120) NOT NULL,
    descripcion VARCHAR(250),
    estado INTEGER
);

CREATE TABLE niveles_estantes
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(120) NOT NULL,
    descripcion VARCHAR(120),
    peso_maximo VARCHAR(50),
    estado INTEGER 
);
CREATE TABLE estantes(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_sub_ubicacion INTEGER REFERENCES sub_ubicacion(id),
    id_categoria INTEGER REFERENCES categoria_estantes(id),
    id_nivel INTEGER REFERENCES niveles_estantes(id),
    nombre VARCHAR(120) NOT NULL,
    descripcion VARCHAR(250),
    estado INTEGER NOT NULL
);
CREATE TABLE detalle_estantes(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_estantes INTEGER REFERENCES estantes(id),
    media VARCHAR(250),
    cantidad INTEGER NOT NULL
);

CREATE TABLE producto(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        cod_producto VARCHAR(20) NOT NULL,
        nombre VARCHAR(80) NOT NULL,
        descripcion VARCHAR(100),
        id_categoria INTEGER REFERENCES categoria_producto(id),
        id_presentacion INTEGER REFERENCES marca(id),
        id_unidad_medida INTEGER REFERENCES unidad_medida(id),
        id_estantes INTEGER REFERENCES estantes(id),
        fecha_ingreso DATE,
        imagen TEXT,
        estado INTEGER
    );

CREATE TABLE  precio_producto(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_producto INTEGER REFERENCES producto,
        fecha_precio DATE DEFAULT NOW(),
        gasto NUMERIC(10, 2) NOT NULL,
        precio_compra DECIMAL(10, 2),
        margen_ganancia DECIMAL(10, 2),
        precio_venta DECIMAL(10, 2),
        estado INTEGER
    );

CREATE TABLE caducidad(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_producto INTEGER REFERENCES producto(id),
        fecha_entrada DATE DEFAULT NOW(),
        fecha_de_caducidad DATE NOT NULL,
        estado INTEGER
    );

CREATE TABLE  lote_producto(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_caducidad INTEGER REFERENCES caducidad(id),
        id_producto INTEGER REFERENCES producto(id),
        existencia INTEGER NOT NULL,
        fecha_de_ingreso DATE DEFAULT NOW(),
        estado INTEGER
    );


CREATE TABLE  solicitud_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_producto INTEGER REFERENCES producto(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        fecha DATE DEFAULT NOW(),
        fecha_vigencia DATE NOT NULL,
        cantidad INTEGER NOT NULL,
        estado INTEGER
    );
/**
*Por si la compra es planeada, imendiata etc
*/
CREATE TABLE  tipo_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(100),
        estado INTEGER
    );

CREATE TABLE  orden_compra(
      id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_proveedor INTEGER REFERENCES proveedor(id),
        id_orden INTEGER REFERENCES tipo_compra(id),
        num_orden INTEGER NOT NULL,
        subtotal NUMERIC(10, 2) NOT NULL,
        descuento NUMERIC(10, 2),
        iva_TOTAL NUMERIC(10, 2),
        total NUMERIC(10, 2),
        fecha DATE DEFAULT NOW(),
        estado INTEGER
    );

CREATE TABLE  detalle_orden_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_orden_compra INTEGER REFERENCES orden_compra(id),
        id_producto INTEGER REFERENCES producto(id),
        cantidad INTEGER NOT NULL,
        precio_unitario NUMERIC(10, 2) NOT NULL,
        monto NUMERIC(10, 2)
    );

CREATE TABLE compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_proveedor INTEGER REFERENCES proveedor(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        id_orden_compra INTEGER REFERENCES orden_compra(id),
        fecha_compra TIMESTAMP DEFAULT NOW(),
        descripcion VARCHAR(255) NOT NULL,
        descuento NUMERIC(10, 2) NOT NULL,
        subtotal NUMERIC(10, 2) NOT NULL,
        iva_total NUMERIC(10, 2),
        total NUMERIC(10, 2),
        estado INTEGER
    );

CREATE TABLE  detalle_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_compra INTEGER REFERENCES compra(id),
        id_producto INTEGER REFERENCES producto(id),
        cantidad INTEGER NOT NULL,
        precio INTEGER NOT NULL,
        monto NUMERIC(10, 2) NOT NULL
    );

CREATE TABLE devolucion_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_compra INTEGER REFERENCES compra(id),
        id_proveedor INTEGER REFERENCES proveedor(id),
        motivo VARCHAR(250) NOT NULL,
        fecha DATE DEFAULT NOW(),
        autorizado INTEGER REFERENCES trabajador(id)
    );

CREATE TABLE  pedido(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cliente INTEGER REFERENCES cliente(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        observacion VARCHAR(250),
        estado INTEGER
    );

CREATE TABLE  detalle_pedido(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_pedido INTEGER REFERENCES pedido(id),
        id_producto INTEGER REFERENCES producto(id),
        cantidad INTEGER NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        monto DECIMAL(10, 2)
    );

/*Garantias del producto*/
CREATE TABLE tipo_garantia(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(250) NOT NULL,
    descripcion VARCHAR(250),
    estado INTEGER
);
CREATE TABLE garantia_proveedor(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_tipo INTEGER REFERENCES tipo_garantia(id),
    id_proveedor INTEGER REFERENCES proveedor(id),
    nombre VARCHAR(120) NOT NULL,
    fecha_actual DATE NOT NULL,
    fecha_expiracion DATE NOT NULL,
    estado INTEGER 
);

CREATE TABLE detalle_garantia_proveedor(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_garantia INTEGER REFERENCES garantia_proveedor(id),
    condiciones VARCHAR (250),
    cobertura VARCHAR(250),
    limitaciones VARCHAR(250),
     restriciones VARCHAR(250)
);

CREATE TABLE  venta(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cliente INTEGER REFERENCES cliente(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        subtotal NUMERIC(10, 2),
        descuento NUMERIC(10, 2),
        impuesto NUMERIC(10, 2),
        total NUMERIC(10, 2) NOT NULL,
        fecha_venta DATE DEFAULT NOW(),
        tipo_venta VARCHAR(20),
        estado INTEGER
    );

CREATE TABLE   detalle_venta(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_venta INTEGER REFERENCES venta(id),
        id_producto INTEGER REFERENCES producto(id),
        cantidad INTEGER NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        monto DECIMAL(10, 2)
    );

CREATE TABLE solicitud();
    CREATE TABLE garantia_cliente(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_tipo INTEGER REFERENCES tipo_garantia(id),
    id_venta INTEGER REFERENCES venta(id),
    id_cliente INTEGER REFERENCES cliente(id),
    nombre VARCHAR(120) NOT NULL,
    fecha_actual DATE NOT NULL,
    fecha_expiracion DATE NOT NULL,
    estado INTEGER 
);

CREATE TABLE detalle_garantia_cliente(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_garantia INTEGER REFERENCES garantia_cliente(id),
    condiciones VARCHAR (250),
    cobertura VARCHAR(250),
    limitaciones VARCHAR(250),
    restriciones VARCHAR(250),
    Condiciones_de_mantenimiento VARCHAR(250)
);
    /*SOLO PARA CONTROLAR SI ES POR ENTRADA O SALIDA o lo mueven de ubicacion*/
CREATE TABLE tipo_movimientos(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(120),
    descripcion VARCHAR(250),
    estado INTEGER NOT NULL
);
CREATE TABLE movientos_productos(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_producto INTEGER REFERENCES producto(id),
        id_tipo_movimiento INTEGER REFERENCES tipos_movimientos(id),
        autorizado INTEGER REFERENCES colaborador(id),
        fecha_movimiento DATE NOT NULL,
        cod_documento VARCHAR(80) NOT NULL,
        cantidad INTEGER NOT NULL,
        tipo_movimiento VARCHAR(80)
    );

CREATE TABLE inventario(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_movimiento INTEGER REFERENCES movimientos_productos(id),
        fecha DATE NOT NULL,
        entradas INTEGER NOT NULL,
        salidas INTEGER NOT NULL,
        saldo INTEGER NOT NULL,
        estado INTEGER
    );

CREATE TABLE detalle_inventario(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_inventario INTEGER REFERENCES inventario(id),
        id_producto INTEGER REFERENCES producto(id),
        STOCK_MIN INTEGER NOT NULL,
        STOCK_MAX INTEGER NOT NULL,
        existencia INTEGER NOT NULL
    );

CREATE TABLE caja(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        estado INTEGER,
        autorizado_por INTEGER REFERENCES colaborador(id),
        tipo_caja VARCHAR(40),
        fecha_registro TIMESTAMP DEFAULT NOW()
    );

CREATE TABLE apertura_caja(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_caja INTEGER REFERENCES caja(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        fecha_apertura DATE,
        estado INTEGER
    );

CREATE TABLE detalle_apertura_caja(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_apertura_caja INTEGER REFERENCES apertura_caja(id),
        monto_cordobas NUMERIC(10, 2),
        monto_dolares NUMERIC(10, 2)
    );

CREATE TABLE  movimiento_caja(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_caja INTEGER REFERENCES caja(id),
        autorizado INTEGER REFERENCES colaborador(id),
        numero_mov INTEGER NOT NULL,
        fecha_movimiento DATE DEFAULT NOW(),
        concepto VARCHAR(100) NOT NULL,
        monto NUMERIC(10, 2)
    );

CREATE TABLE arqueo_caja(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_caja INTEGER REFERENCES caja(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        fecha_arqueo DATE,
        total NUMERIC(10, 2)
    );

CREATE TABLE cierre_caja(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_caja INTEGER REFERENCES caja(id),
        id_estado INTEGER,
        monto NUMERIC(10, 2)
    );

CREATE TABLE detalle_cierre_caja(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cierre_caja INTEGER REFERENCES cierre_caja(id),
        id_colaborador INTEGER REFERENCES colaborador(id),
        fecha_cierre DATE,
        autorizado_por INTEGER REFERENCES colaborador(id)
    );

CREATE TABLE grupo_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(80) NOT NULL,
        descripcion VARCHAR(100),
        estado INTEGER
    );

CREATE TABLE sub_grupo_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_grupo INTEGER REFERENCES grupo_usuario(id),
        nombre VARCHAR(150) NOT NULL,
        descripcion VARCHAR(150),
        estado INTEGER
    );

CREATE TABLE usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_persona INTEGER REFERENCES persona(id),
        id_grupo INTEGER REFERENCES sub_grupo_usuario(id),
        usuario VARCHAR(40) NOT NULL,
        fecha_registro TIMESTAMP NOT NULL,
        estado INTEGER
    );

CREATE TABLE  detalle_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_usuario INTEGER REFERENCES usuario(id),
        contraseña VARCHAR(60) NOT NULL,
        contaseña_anterior VARCHAR(60) NOT NULL,
        fecha DATE DEFAULT NOW()
    );

CREATE TABLE   modulo (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(80) NOT NULL,
        descripcion VARCHAR(100),
        fecha_registro DATE DEFAULT NOW(),
        icono varchar(60) NOT NULL,
        estado INTEGER
    );

CREATE TABLE sub_modulo (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_modulo INTEGER REFERENCES modulo(id),
        nombre VARCHAR(80),
        descripcion VARCHAR(120),
        enlaces VARCHAR(250),
        estado INTEGER NOT NULL
    );

CREATE TABLE permiso (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(80) NOT NULL,
        descripcion VARCHAR(100)
    );

CREATE TABLE  privilegio_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_modulo INTEGER REFERENCES modulo(id),
        id_sub_modulo INTEGER REFERENCES sub_modulo(id),
        id_usuario INTEGER REFERENCES usuario(id),
        autorizacion INTEGER REFERENCES colaborador(id)
    );

CREATE TABLE  privilegio_permiso_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_modulo INTEGER REFERENCES modulo(id),
        id_permiso INTEGER REFERENCES permiso(id),
        id_usuario INTEGER REFERENCES usuario(id),
        autorizacion INTEGER REFERENCES colaborador(id)
    );
CREATE TABLE conexion(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_usuario INTEGER REFERENCES usuario(id),
        ip VARCHAR(250) NOT NULL,
        fecha_ingreso DATE DEFAULT NOW(),
        estado INTEGER
    );

CREATE TABLE bloqueo_usuario(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_usuario INTEGER REFERENCES usuario(id),
    motivo VARCHAR(250),
    estado INTEGER NOT NULL
);