<?php
class Conectar
{
  public static function conexion()
  {
    try {
      $conexion = new mysqli("localhost", "root", "", "intelcost_bienes");
      return $conexion;
      echo ('Conexión exitosa');
    } catch (\Throwable $th) {
      echo ('Fallo de Conexión ' . $th);
    }
  }
}
