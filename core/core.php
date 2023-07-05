<?php
//Esta funcion recibe el parametro del controlador que se necesita
function cargarControlador($controlador)
{
    //Aqui se busca el nombre del controlador, lo que realiza ucwords es convertir en minuscula la primera letra   
    $nombreControlador = ucwords($controlador) . "Controller";
    $archivoControlador = 'controller/' . ucwords($controlador) . '.php';
    //Verifica que el archivo del controller existe
    if (!is_file($archivoControlador)) {
        $archivoControlador = 'controller/' . CONTROLADOR_PRINCIPAL . '.php';
    }
    //se manda a llamar el controlador
    require_once $archivoControlador;
    $control = new $nombreControlador();
    return $control;
}

//Esta funcion realiza carga la accion a ejecutar en el sistema
function cargarAccion($controller, $accion, $id = null){
	//busca la accion si existe se crea la url para navegar en el sistema	
    if(isset($accion) && method_exists($controller, $accion)){
       //funciona para verficar que realizara una segunda accion
        if($id == null){
            $controller->$accion();
            } else {
            //Si hay una segunda accion lo carga
            $controller->$accion($id);
            }
        }
        else 
        {
        //Cargar la accion por defecto en esta caso el login
        $controller->ACCION_PRINCIPAL();
        
    }	
}