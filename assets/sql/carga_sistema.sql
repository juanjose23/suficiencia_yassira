/*Insertar estado civiles*/
INSERT INTO estado_civil (nombre_estado) 
VALUES ('Soltero/a'),
       ('Casado/a'),
       ('Unión civil'),
       ('Separado/a'),
       ('Divorciado/a'),
       ('Viudo/a');
INSERT INTO grupo_usuario (nombre, descripcion, estado)
VALUES
    ('Administradores', 'Grupo de usuarios con privilegios de administración', 1),
    ('Supervisores', 'Grupo de usuarios con funciones de supervisión', 1),
    ('Gestión de Personal', 'Grupo de usuarios encargados de la gestión del personal', 1);

INSERT INTO sub_grupo_usuario (id_grupo, nombre, descripcion, estado)
VALUES
    (1, 'Superadministradores', 'Subgrupo de superadministradores con máximos privilegios', 1),
    (1, 'Administradores de Área', 'Subgrupo de administradores de áreas específicas', 1),
    (2, 'Supervisores de Ventas', 'Subgrupo de supervisores de ventas', 1),
    (2, 'Supervisores de Operaciones', 'Subgrupo de supervisores de operaciones', 1),
    (3, 'Gestores de Recursos Humanos', 'Subgrupo de gestores de recursos humanos', 1);



/*Insertar modulos*/
INSERT INTO modulo (nombre, descripcion, fecha_registro, icono, estado)
VALUES 
('Inicio', 'Modulo para la gestión de inicio del sistema', NOW(), 'fa fa-home', 1),
('Gestion Vehiculos', 'Modulo para la gestión de los vehiculos', NOW(), 'fa fa-car', 1),
('Gestion servicio', 'Modulo para la gestión de los servicios', NOW(), 'fa fa-tasks', 1),
('Gestion Compra', 'Modulo para la gestión de las compras', NOW(), 'fa fa-shopping-cart', 1),
('Gestion de venta', 'Modulo para la gestión de las ventas', NOW(), 'fa fa-line-chart', 1),
('Gestion de negocio', 'Modulo para la gestión del negocio en general', NOW(), 'fa fa-briefcase', 1),
('Gestion de usuario', 'Modulo para la gestión de los usuarios en el sistema', NOW(), 'fa fa-users', 1),
('Gestion de Credito', 'Modulo para la gestión de créditos', NOW(), 'fa fa-credit-card', 1),
('Gestion de Garantias', 'Modulo para la gestión de garantías', NOW(), 'fa fa-wrench', 1),
('Ajuste sistema', 'Modulo para los ajustes del sistema', NOW(), 'fa fa-cogs', 1);



INSERT INTO sub_modulo(id_modulo, nombre, descripcion,enlaces,estado)
VALUES(1, 'Dasboard', 'Inicio del sistema','index.php?c=inicio',1);

/*Submodulo de gestion de habitaciones*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,enlaces, estado)
VALUES(2, 'Categoria Vehiculo', 'Categoria de autos','index.php?c=categoria', 1),
      (2, 'Marca', 'Marca de vehiculos','index.php?c=marca', 1),
      (2, 'Año', 'año','index.php?c=año', 1),
      (2, 'Modelo', 'modelo','index.php?c=modelo',1),
      (2, 'Color', 'Color','index.php?c=color',1),
      (2, 'Precio', 'precios','index.php?c=precios',1),
      (2, 'Vehiculos', 'Permite gestionar el estado de los vehiculos','index.php?c=vehiculo', 1);

/* Modulo de servicio*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,enlaces,  estado)
VALUES(3, 'Categoria Mantenimiento', 'Permite registrar el ingreso de los huéspedes al hotel','index.php?c=categoria_servicio', 1),
      (3, 'Mantenimientos', 'Permite registrar la salida de los huéspedes del hotel','index.php?c=servicio', 1),
      (3, 'Precios Mantenimientos', 'Permite registrar la salida de los huéspedes del hotel','index.php?c=precio_servicio', 1);
/*Modulo de compras*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,estado)
VALUES(4, 'Tipo solicitud', 'Permite generar solicitudes para compras',1),
      (4, 'Solicitud compra', 'Permite generar solicitudes para compras',1),
      (4, 'Cotizacion', 'Permite crear cotizaciones', 1),
      (4, 'Orden  compra', 'Permite generar órdenes de compra de productos y materiales', 1),
      (4, 'Tipos  compras', 'Permite clasificar las compras según su tipo o categoría',1),
      (4, 'Compras', 'Permite registrar las compras de productos y materiale', 1),
      (4, 'Recepcion compra','Permite realizar recepcion de compras',1),
      (4, 'Proveedores', 'Permite gestionar los datos de los proveedores ', 1);

/* Modulo de venta*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,enlaces, estado)
VALUES(5, 'Gestion de cliente', 'Permite gestionar los datos de los clientes','index.php?c=venta&aclientes', 1),
      (5, 'Venta', 'Permite registrar las ventas de productos y servicios ','index.php?c=venta', 1);
/*Modulo gestion de negocio*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,enlaces,  estado) 
VALUES (6, 'Colaboradores', 'Gestión de los colaboradores del negocio','index.php?c=colaborador',1),
       (6, 'Cargos', 'Gestión de los cargos dentro del negocio','index.php?c=cargos', 1),
       (6, 'Asignar cargos', 'Asignación de cargos a los colaboradores','index.php?c=asignar', 1);
/*Modulo de gestion de usuarios*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,enlaces,estado) 
VALUES 
       (7,'Asignar modulos','Gestion de privilegios de usuario','index.php?c=usuarios&a=privilegio',1),
       (7,'Asignar permisos','Gestion de privilegios de usuario','index.php?c=usuarios&a=permiso',1),
       (7, 'Usuarios', 'Gestión de usuarios del sistema','index.php?c=usuarios',1),
       (7,'Verficar Usuarios', 'Gestio de verificacion de usuarios','index.php?c=usuarios&a=verificar',1);

/* Modulo de creditos*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,estado)
VALUES(8,'Creditos','Crear cajas',1);
      
/*Modulos Garantias*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion,estado) 
VALUES (9, 'Garantias', 'Gestion de garantias', 1);


/*Modulos de gestion de pagina web*/
INSERT INTO sub_modulo(id_modulo, nombre, descripcion, estado) 
VALUES 
       (10, 'Datos generales', 'Gestión de los datos generales del negocio',1);


/*Catalogo de permisos*/
INSERT INTO permiso (nombre, descripcion) 
VALUES 
       ('Crear', 'Permiso para crear nuevos registros'),
       ('Actualizar', 'Permiso para actualizar registros existentes'),
       ('Eliminar', 'Permiso para eliminar registros'),
       ('Anular', 'Permiso para anular registros'),
       ('Arquear','Permisos para arqueo de caja'),
       ('Cerrar','Permiso para cerrar caja'),
      ('Verficar','Verficar usuarios');

/*Permisos por modulo*/
INSERT INTO permiso_modulo (id_modulo, id_permiso)
VALUES
(2, 1), (2, 2), (2, 3), (2, 4),
(3, 1), (3, 2), (3, 3),(3, 5),
(4, 1), (4, 2), (4, 3),(4, 5),
(5, 1), (5, 2), (5, 3),(5, 5),
(6, 1), (6, 2), (6, 3),
(7, 6), (7, 7), (7, 8),(7, 5),(7,9),
(8, 1), (8, 2), (8, 3), (8, 4),
(9, 1), (9, 2), (9, 3), (9, 4),(9,5),
(10, 1), (10, 2), (10, 3),(10,4),
(11, 2), (11, 3), (11, 5),
(12, 1), (12, 2), (12, 3), (12, 4),
(13, 1), (13, 2), (13, 3), (13, 4),(13,9),
(14, 1), (14, 2), (14, 3), (14, 4),
(15, 1), (15, 2), (15,3), (15, 4);
