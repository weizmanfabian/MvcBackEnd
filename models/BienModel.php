<!-- framework codenater -->
<?php
class BienModel
{
  private $db;
  private $bienes;

  public function __construct()
  {
    $this->db = Conectar::conexion();
    $this->bienes = array();
  }

  public function getBienesJson()
  {
    $this->bienes = json_decode(file_get_contents(__DIR__ . "/data-1.json"), true);
    return $this->bienes;
  }

  public function insertar(
    $direccion,
    $ciudad,
    $telefono,
    $codigo_Postal,
    $tipo,
    $precio
  ) {
    try {
      $resultado = $this->db->query("INSERT INTO bien 
      (
        direccion,
        ciudad,
        telefono,
        codigo_Postal,
        tipo,
        precio   
      ) 
      VALUES
      (
        '$direccion',
        '$ciudad',
        '$telefono',
        '$codigo_Postal',
        '$tipo',
        '$precio'
      )");
      echo ("
        <script>
          alert('Registro exitoso');
        </script>"
      );
      // echo 'Registro exitoso';
    } catch (\Throwable $th) {
      echo ("
        <script>
          alert('Error al Guardar');
        </script>"
      );
      echo ('Err al insertar ' . $th);
    }
  }

  public function eliminar($id)
  {
    try {
      $resultado = $this->db->query("DELETE FROM bien WHERE id = '$id'");
      echo ("
        <script>
          alert('Eliminación correcta');
        </script>"
      );
    } catch (\Throwable $th) {
      echo ("
        <script>
          alert('Error al Eliminar');
        </script>"
      );
      echo ('Err al eliminar ' . $th);
    }
  }

  public function getBienes()
  {
    try {
      $res = array();
      $sql = "SELECT * FROM bien";
      $resultado = $this->db->query($sql);
      while ($row = $resultado->fetch_assoc()) {
        $res[] = $row;
      }
      // echo '<pre>';
      // var_dump($res);
      // echo '</pre>';
      return $res;
    } catch (\Throwable $th) {
      echo ('Err getBienes ' . $th);
    }
  }
}
