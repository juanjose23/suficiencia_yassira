INSERT INTO persona (id, nombre, telefono, direccion_domicilio,correo, fecha_registro) VALUES
(1, 'Yassira Lucia', 12345678, 'Masaya', 'yassira@gmail.com', '2023-07-06');

INSERT INTO persona_natural (id, id_persona, apellido, cedula, genero, nacionalidad, fecha_nacimiento) VALUES
(1, 1, 'Guillen', '12345678', 'F', 'NI', '2003-04-18');

INSERT INTO colaborador (id, id_persona, id_sucursal, id_estado_civil, codigo, inss, fecha_registro, genero, foto, estado) VALUES
(1, 1, 1, 1, '54289', '123', '2023-07-06', 'F', 'yassira.jpg', 1);


INSERT INTO usuario (id, id_persona, id_grupo, usuario, fecha_registro, estado) VALUES
(1, 1, 4, 'yassira@gmail.com', '2023-07-06 22:56:12', 1);

INSERT INTO detalle_usuario (id, id_usuario, contraseña_anterior, contraseña_actual, fecha) VALUES
(1, 1, '', '$2y$10$yjmy7f8A9a.5UbJBcLPY3.LMPc35wEOvvFbHUMwfd83SVwogOB/.K', '2023-07-06');





INSERT INTO privilegio_usuario (id, id_modulo, id_sub_modulo, id_usuario, autorizacion) VALUES
(1, 1, 1, 1, 0),
(2, 2, 2, 1, 0),
(3, 2, 3, 1, 0),
(4, 2, 4, 1, 0),
(5, 2, 5, 1, 0),
(6, 2, 6, 1, 0),
(7, 2, 7, 1, 0),
(8, 2, 8, 1, 0),
(9, 3, 9, 1, 0),
(10, 3, 10, 1, 0),
(11, 3, 11, 1, 0),
(12, 4, 12, 1, 0),
(13, 4, 13, 1, 0),
(14, 4, 14, 1, 0),
(15, 4, 15, 1, 0),
(16, 4, 16, 1, 0),
(17, 4, 17, 1, 0),
(18, 4, 18, 1, 0),
(19, 4, 19, 1, 0),
(20, 5, 20, 1, 0),
(21, 5, 21, 1, 0),
(22, 6, 22, 1, 0),
(23, 6, 23, 1, 0),
(24, 6, 24, 1, 0),
(25, 7, 25, 1, 0),
(26, 7, 26, 1, 0),
(27, 7, 27, 1, 0),
(28, 7, 28, 1, 0),
(29, 8, 29, 1, 0),
(30, 9, 30, 1, 0),
(31, 10, 31, 1, 0);

INSERT INTO privilegio_permiso_usuario (id, id_modulo, id_permiso, id_usuario, autorizacion) VALUES
(1, 2, 1, 1, 1),
(2, 2, 2, 1, 1),
(3, 2, 3, 1, 1),
(4, 3, 1, 1, 1),
(5, 3, 2, 1, 1),
(6, 3, 3, 1, 1),
(7, 4, 1, 1, 1),
(8, 4, 2, 1, 1),
(9, 4, 3, 1, 1),
(10, 5, 1, 1, 1),
(11, 5, 2, 1, 1),
(12, 5, 3, 1, 1),
(13, 6, 1, 1, 1),
(14, 6, 2, 1, 1),
(15, 6, 3, 1, 1),
(16, 7, 1, 1, 1),
(17, 7, 2, 1, 1),
(18, 7, 3, 1, 1),
(19, 8, 1, 1, 1),
(20, 8, 2, 1, 1),
(21, 8, 3, 1, 1),
(22, 9, 1, 1, 1),
(23, 9, 2, 1, 1),
(24, 9, 3, 1, 1),
(25, 10, 1, 1, 1),
(26, 10, 2, 1, 1),
(27, 10, 3, 1, 1);