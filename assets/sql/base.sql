CREATE TABLE sucursal (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(80) NOT NULL,
    descripcion VARCHAR(250),
    direccion VARCHAR(250),
    telefono INTEGER NOT NULL,
    estado INTEGER
);

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
        genero CHAR,
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
        foto VARCHAR(120),
        estado INTEGER
    );

    CREATE TABLE salario_cliente
    (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cliente INTEGER REFERENCES cliente(id),
        salario_actual DECIMAL(10,2) NOT NULL,
        salario_anterior DECIMAL(10,2),
        estado INTEGER NOT NULL
    );

CREATE TABLE centro_trabajo_cliente(
    id INTEGER NOT NULL auto_increment PRIMARY KEY,
    id_cliente INTEGER REFERENCES cliente(id),
    empresa VARCHAR(50)NOT NULL,
    abreviatura VARCHAR(20),
    telefono VARCHAR(20),
    correo VARCHAR(30),
    direccion INT NOT NULL
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
        id_sucursal INTEGER REFERENCES sucursal(id),
        id_estado_civil INTEGER REFERENCES estado_civil(id),
        codigo VARCHAR(30) NOT NULL,
        inss VARCHAR(20) NOT NULL,
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

CREATE TABLE categoria_servicio(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(80),
        estado INTEGER
    );

CREATE TABLE servicios(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_categoria INTEGER REFERENCES categoria_servicio(id),
        cod_servicio VARCHAR(20) NOT NULL,
        nombre VARCHAR(80) NOT NULL,
        descripcion VARCHAR(100),
        fecha_ingreso DATE,
        imagen TEXT,
        estado INTEGER
    );

CREATE TABLE  precio_servicos(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_servicios INTEGER REFERENCES servicios(id),
        fecha_precio DATE DEFAULT NOW(),
        precio_vigente DECIMAL(10, 2),
        precio_anterior DECIMAL(10, 2),
        estado INTEGER
    );
 CREATE TABLE tipo_solicitud(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NULL,
        descripcion VARCHAR(250),
        estado INTEGER
    );

CREATE TABLE solicitud_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_tipo INTEGER REFERENCES tipo_solicitud(id),
        id_trabajador INTEGER REFERENCES trabajador(id),
        revisado_Por INTEGER REFERENCES trabajador(id),
        fecha_emision DATE,
        fecha_entrega DATE NOT NULL,
        estado INTEGER
    );

create table detalle_solicitud_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_solicitud INTEGER REFERENCES solicitud_compra(id),
        id_producto INTEGER REFERENCES producto(id),
        cantidad INTEGER,
        descripcion VARCHAR(250)
    );

CREATE TABLE cotizacion_compra (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_proveedor INTEGER REFERENCES proveedor(id),
        id_solicitud INTEGER REFERENCES solicitud(id),
        elaborador INTEGER REFERENCES trabajador(id),
        cod_cotizacion_proveedor VARCHAR(120),
        fecha_cotizacion DATE,
        fecha_expiracion DATE,
        fecha_entrega DATE,
        estado INTEGER NOT NULL
    );

CREATE TABLE detalle_cotizacion (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cotizacion INTEGER REFERENCES cotizacion_compra(id),
        producto INTEGER REFERENCES producto(id),
        cantidad INTEGER NOT NULL,
        precio_unitario DECIMAL(10, 2),
        precio_total DECIMAL(10, 2),
        sub_total DECIMAL(10, 2),
        impuesto_aplicable DECIMAL(10, 2),
        descuento DECIMAL(10, 2),
        costo_total DECIMAL(10, 2)
    );

CREATE TABLE orden_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_proveedor INTEGER REFERENCES proveedor(id),
        subtotal DECIMAL(10, 2) NOT NULL,
        descuento DECIMAL(10, 2),
        iva_TOTAL DECIMAL(10, 2),
        total DECIMAL(10, 2),
        fecha DATE DEFAULT NOW(),
        estado INTEGER
    );

CREATE TABLE detalle_orden_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_orden_compra INTEGER REFERENCES orden_compra(id),
        id_producto INTEGER REFERENCES producto(id),
        cantidad INTEGER NOT NULL,
        precio_unitario DECIMAL(10, 2) NOT NULL,
        monto DECIMAL(10, 2)
    );

CREATE TABLE tipo_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100) NOT NUll,
        descripcion VARCHAR(250),
        estado INTEGER
    );

CREATE TABLE compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_tipo INTEGER REFERENCES tipo_compra(id),
        id_proveedor INTEGER REFERENCES proveedor(id),
        id_trabajador INTEGER REFERENCES trabajador(id),
        fecha_compra TIMESTAMP DEFAULT NOW(),
        descripcion VARCHAR(255) NOT NULL,
        descuento NUMERIC(10, 2) NOT NULL,
        subtotal NUMERIC(10, 2) NOT NULL,
        iva_total NUMERIC(10, 2),
        total NUMERIC(10, 2),
        estado INTEGER
    );

CREATE TABLE detalle_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_compra INTEGER REFERENCES compra(id),
        id_orden_compra INTEGER REFERENCES orden_compra(id),
        id_producto INTEGER REFERENCES producto(id),
        cantidad INTEGER NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        monto DECIMAL(10, 2) NOT NULL
    );

CREATE TABLE detalle_compra_directa(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_compra INTEGER REFERENCES compra(id),
        id_producto INTEGER REFERENCES producto(id),
        autorizado INTEGER REFERENCES trabajador(id),
        cantidad INTEGER NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        monto DECIMAL(10, 2)
    );

CREATE TABLE devolucion_compra(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_compra INTEGER REFERENCES compra(id),
        id_proveedor INTEGER REFERENCES proveedor(id),
        motivo VARCHAR(250) NOT NULL,
        fecha DATE DEFAULT NOW(),
        autorizado INTEGER REFERENCES trabajador(id)
    );

/*Automoviles*/
CREATE TABLE categoria_automovil(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(100),
        descripcion VARCHAR(80),
        estado INTEGER
    );

CREATE TABLE marca_automovil(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(80) NOT NULL,
        siglas VARCHAR(80),
        estado INTEGER
    );
CREATE TABLE modelo_automovil(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        descripcion VARCHAR(80) NOT NULL,
        siglas VARCHAR(80),
        estado INTEGER
    );
CREATE TABLE año
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    descripcion VARCHAR(250)
);
CREATE TABLE color
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    descripcion VARCHAR(250)
);
CREATE TABLE vehiculo
(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_categoria INTEGER REFERENCES categoria_automovil(id),
        id_marca INTEGER REFERENCES marca_automovil(id),
        id_modelo INTEGER REFERENCES modelo_automovil(id),
        id_año INTEGER REFERENCES año(id),
        id_color INTEGER REFERENCES color(id),
        cod_auto VARCHAR(20) NOT NULL,
        nombre VARCHAR(80) NOT NULL,
        descripcion VARCHAR(100),
        fecha_ingreso DATE,
        imagen TEXT,
        estado INTEGER
);

CREATE TABLE  precio_auto(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_auto INTEGER REFERENCES vehiculo(id),
        fecha_precio DATE DEFAULT NOW(),
        gasto NUMERIC(10, 2) NOT NULL,
        precio_compra DECIMAL(10, 2),
        margen_ganancia DECIMAL(10, 2),
        precio_venta DECIMAL(10, 2),
        estado INTEGER
    );
CREATE TABLE tipo_venta(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(250),
    estado INTEGER
);
CREATE TABLE venta(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_tipo INTEGER REFERENCES tipo_venta(id),
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

CREATE TABLE detalle_venta_servicio(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_venta INTEGER REFERENCES venta(id),
        id_servicios INTEGER REFERENCES servicios(id),
        cantidad INTEGER NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        monto DECIMAL(10, 2)
    );

CREATE TABLE detalle_venta_auto(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_venta INTEGER REFERENCES venta(id),
        id_automovil INTEGER REFERENCES vehiculo(id),
        cantidad INTEGER NOT NULL,
        precio DECIMAL(10, 2) NOT NULL,
        monto DECIMAL(10, 2)
    );

CREATE TABLE devolucion_venta (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_venta INTEGER REFERENCES venta(id),
    id_autorizado INTEGER REFERENCES trabajador(id),
    motivo VARCHAR(250) NOT NULL,
    monto DECIMAL(10,2),
    fecha_registro DATE
);
CREATE TABLE detalle_devolucion_venta (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_devolucion INTEGER REFERENCES devolucion_venta(id),
    id_automovil INTEGER REFERENCES automovil(id),
    cantidad INTEGER,
    precio_unitario DECIMAL(10,2),
    motivo VARCHAR(250),
    estado INTEGER
);


CREATE TABLE garantia_cliente(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_venta INTEGER REFERENCES venta(id),
    id_cliente INTEGER REFERENCES cliente(id),
    nombre VARCHAR(120) NOT NULL,
    fecha_actual DATE NOT NULL,
    fecha_expiracion DATE NOT NULL,
    estado INTEGER 
);

CREATE TABLE detalle_garantia_cliente(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    condiciones VARCHAR (250),
    cobertura VARCHAR(250),
    limitaciones VARCHAR(250),
    restriciones VARCHAR(250),
    Condiciones_de_mantenimiento VARCHAR(250)
);

CREATE TABLE solicitud_credito_cliente(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_cliente INTEGER REFERENCES trabajador(id),
        revisado_Por INTEGER REFERENCES cliente(id),
        fecha_emision DATE,
        fecha_entrega DATE NOT NULL,
        estado INTEGER
    );

create table detalle_solicitud_credito_cliente(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_solicitud INTEGER REFERENCES solicitud_credito_cliente(id),
        id_automovil INTEGER REFERENCES automovil(id),
        cantidad INTEGER,
        precio_unitario decimal(10,2),
        monto_total decimal(10,2),
        descripcion VARCHAR(250)
    );

CREATE TABLE credito_venta_cliente
(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_venta INTEGER REFERENCES venta(id),
    id_cliente INTEGER REFERENCES cliente(id),
    id_fiador INTEGER REFERENCES cliente(id),
    id_colaborador INTEGER REFERENCES colaborador(id),
    monto_credito DECIMAL(10,2) NOT NULL,
    monto_prima DECIMAL(10,2) NOT NULL,
    estado INTEGER
);


CREATE TABLE detalle_credito_cliente(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_credito INTEGER REFERENCES credito_venta_cliente(id),
    numero_coutas INTEGER NOT NULL,
    fecha_tope_pago DATE NOT NULL,
    monto_cuotas DECIMAL(10,2)  
);

CREATE TABLE documento_hipotecario_credito(
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    id_credito INTEGER REFERENCES credito_venta_cliente(id),
    codigo VARCHAR(50) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    descripcion VARCHAR(250),
    valor_documento DECIMAL(10,2)
);
CREATE TABLE
    grupo_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        nombre VARCHAR(80) NOT NULL,
        descripcion VARCHAR(100),
        estado INTEGER
    );

CREATE TABLE
    sub_grupo_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_grupo INTEGER REFERENCES grupo_usuario(id),
        nombre VARCHAR(150) NOT NULL,
        descripcion VARCHAR(150),
        estado INTEGER
    );

CREATE TABLE
    usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_persona INTEGER REFERENCES persona(id),
        id_grupo INTEGER REFERENCES sub_grupo_usuario(id),
        usuario VARCHAR(40) NOT NULL,
        fecha_registro TIMESTAMP NOT NULL,
        estado INTEGER
    );

CREATE TABLE
    detalle_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_usuario INTEGER REFERENCES usuario(id),
        contraseña_anterior VARCHAR(60) NOT NULL,
        contraseña_actual VARCHAR(60) NOT NULL,
        fecha DATE DEFAULT NOW()
    );

CREATE TABLE modulo (
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

CREATE TABLE permiso_modulo(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_modulo INTEGER REFERENCES modulo(id),
        id_permiso INTEGER REFERENCES permiso(id)
    );

CREATE TABLE privilegio_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_modulo INTEGER REFERENCES modulo(id),
        id_sub_modulo INTEGER REFERENCES sub_modulo(id),
        id_usuario INTEGER REFERENCES usuario(id),
        autorizacion INTEGER REFERENCES trabajador(id)
    );

CREATE TABLE privilegio_permiso_usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_modulo INTEGER REFERENCES modulo(id),
        id_permiso INTEGER REFERENCES permiso_modulo(id),
        id_usuario INTEGER REFERENCES usuario(id),
        autorizacion INTEGER REFERENCES trabajador(id)
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
        descripcion VARCHAR(250),
        estado INTEGER
    );

CREATE TABLE historial_de_session(
        id INTEGER PRIMARY KEY AUTO_INCREMENT,
        id_usuario INTEGER REFERENCES usuario(id),
        ip VARCHAR(250),
        accion VARCHAR (120),
        descripcion VARCHAR(250),
        fecha DATE
);