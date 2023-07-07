<?php
require_once "config/config.php";
require_once "core/core.php";
require_once "config/database.php";
require_once "controller/login.php";
require_once "controller/colaborador.php";
require_once "controller/inicio.php";
require_once "controller/marca.php";
require_once "controller/categoria.php";
require_once "controller/año.php";
require_once "controller/modelo.php";

if (isset($_GET['c'])) {

    $controlador = cargarControlador($_GET['c']);

    if (isset($_GET['a'])) {
        if (isset($_GET['id'])) {
            cargarAccion($controlador, $_GET['a'], $_GET['id']);
        } else {
            cargarAccion($controlador, $_GET['a']);
        }
    } else {
        cargarAccion($controlador, ACCION_PRINCIPAL);
    }
} else {

    $controlador = cargarControlador(CONTROLADOR_PRINCIPAL);
    $accionTmp = ACCION_PRINCIPAL;
    $controlador->$accionTmp();
}
