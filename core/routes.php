<?php

function cargarControlador($controlador)
{
  // ucwords convierte la primera en mayuscula
  $nombreControlador = ucwords($controlador) . "Controller";
  $archivoControlador = 'controllers/' . ucwords($controlador) . '.php';

  if (!is_file($archivoControlador)) {
    $archivoControlador = 'controllers/' . CONTROLADOR_PRINCIPAL . 'Controller.php';
  }
  require_once $archivoControlador;
  $controller = new $nombreControlador();
  return $controller;
}

function cargarAccion($controlador, $accion, $id = null)
{
  if (isset($accion) && method_exists($controlador, $accion)) {
    if ($id == null) {
      $controlador->$accion();
    } else {
      $controlador->$accion($id);
    }
  } else {
    $controlador->ACCION_PRINCIPAL();
  }
}
