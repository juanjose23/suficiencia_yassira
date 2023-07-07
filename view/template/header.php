<?php
$lifetime = 60 * 60 * 8; // 8 horas en segundos

if (session_status() == PHP_SESSION_NONE) {
    session_set_cookie_params($lifetime);
    session_start();

    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $lifetime)) {
        // La duración de la cookie ha expirado, se cierra la sesión
        session_unset();
        session_destroy();

        // Redirecciona a la página de cierre de sesión
        header("Location: index.php?c=login&a=cerra_session&id=" . $_SESSION['id']);
        exit();
    }

    // Actualiza la marca de tiempo de la última actividad
    $_SESSION['last_activity'] = time();
}


if (!isset($_SESSION['nombre'])) {
    header('Location: index.php?c=page&a=login');
}



if (isset($_SESSION['nombre']) && isset($_SESSION['foto']) && isset($_SESSION['id'])) {
    // Acceder a las claves 'nombre', 'foto' y 'submodulo' y utilizar sus valores
    $nombre = $_SESSION['nombre'];
    $foto = $_SESSION['foto'];
    $id = $_SESSION['id'];
    $id_trabajador = $_SESSION['id_trabajador'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Suficiencia de Software</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/Html/AdminLTE-master/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/Html/AdminLTE-master/dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php?c=login&a=cerra_session&id=<?php echo $_SESSION['id']; ?>" class="nav-link">Cerra session</a>
                </li>
            </ul>


        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="assets/Html/AdminLTE-master/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="assets/img/colaborador/<?php echo $_SESSION['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['nombre'] ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <?php foreach ($_SESSION['privilegios'] as $modulo) : ?>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon <?php echo $modulo['icono']; ?>"></i>
                                    <p>
                                        <?php echo $modulo['nombre']; ?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <?php if (!empty($modulo['submodulos'])) : ?>
                                    <ul class="nav nav-treeview">
                                        <!-- Iteración del arreglo de submódulos para construir los elementos del menú -->
                                        <?php foreach ($modulo['submodulos'] as $submodulo) : ?>
                                            <li class="nav-item">
                                                <a href="<?php echo $submodulo['enlace']; ?>" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p><?php echo $submodulo['nombre']; ?></p>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">