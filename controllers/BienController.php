<?php
class BienController
{

  private $exportEx;

  public function __construct()
  {
    require_once "models/BienModel.php";
    $this->exportEx = array();
  }


  public function index()
  {
    //agregar un script y en caso de que exista no volverlo a instanciar, así evitamos errores
    $bien = new BienModel();
    $data["img"] = "views/img/home.jpg";
    $data["bienes"] = $bien->getBienesJson();
    $data["consulta"] = $bien->getBienes();
    // echo '<pre>';
    // var_dump($data["bienes"]);
    // echo '</pre>';
    require_once "views/index.php";
  }

  public function guardar()
  {
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $codigo_Postal = $_POST['codigo_Postal'];
    $tipo = $_POST['tipo'];
    $precio = $_POST['precio'];

    $bien = new BienModel();
    $bien->insertar(
      $direccion,
      $ciudad,
      $telefono,
      $codigo_Postal,
      $tipo,
      $precio
    );
    $this->filtrar();
  }

  public function filtrar()
  {
    if (empty($_POST['ciudad']) && empty($_POST['tipo'])) {
      $this->index();
    } else {
      $bien = new BienModel();
      $data["img"] = "views/img/home.jpg";
      $data["bienes"] = $bien->getBienesJson();
      $data["consulta"] = $bien->getBienes();
      if (!empty($_POST['ciudad']) && !empty($_POST['tipo'])) {
        $data["bienes"] = array_filter($data["bienes"], fn ($b) => $b['Ciudad'] === $_POST['ciudad'] && $b['Tipo'] === $_POST['tipo']);
      } else if (!empty($_POST['ciudad'])) {
        $data["bienes"] = array_filter($data["bienes"], fn ($b) => $b['Ciudad'] === $_POST['ciudad']);
      } else {
        $data["bienes"] = array_filter($data["bienes"], fn ($b) => $b['Tipo'] === $_POST['tipo']);
      }
    }
    require_once "views/index.php";
  }

  public function eliminar($id)
  {
    $bien = new BienModel();
    $bien->eliminar($id);
    $this->filtrar();
  }

  public function exportExcel()
  {

    $bien = new BienModel();
    $this->exportEx = $bien->getBienesJson();
    if (!(empty($_POST['ciudad']) && empty($_POST['tipo']))) {
      echo "if (true + true)";
      if (!empty($_POST['ciudad']) && !empty($_POST['tipo'])) {
        $this->exportEx = array_filter($this->exportEx, fn ($b) => $b['Ciudad'] === $_POST['ciudad'] && $b['Tipo'] === $_POST['tipo']);
      } else if (!empty($_POST['ciudad'])) {
        $this->exportEx = array_filter($this->exportEx, fn ($b) => $b['Ciudad'] === $_POST['ciudad']);
      } else {
        $this->exportEx = array_filter($this->exportEx, fn ($b) => $b['Tipo'] === $_POST['tipo']);
      }
    }

    header("Content-Type: application/xls");
    header("Content-Disposition: attachment; filename=reporte_bienes" .        date('Y:m:d:m:s') . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $output = "";
    if (isset($_POST['bt-export'])) {
      $output .= "
      <table>
      <thead>
        <tr>
          <th>Id</th>
          <th>Direccion</th>
          <th>Ciudad</th>
          <th>Telefono</th>
          <th>Codigo_Postal</th>
          <th>Tipo</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>";
      foreach ($this->exportEx as $e) :
        $output .= "    
          <tr>
            <td>" . $e['Id'] . "</td>
            <td>" . $e['Direccion'] . "</td>
            <td>" . $e['Ciudad'] . "</td>
            <td>" . $e['Telefono'] . "</td>
            <td>" . $e['Codigo_Postal'] . "</td>
            <td>" . $e['Tipo'] . "</td>
            <td>" . $e['Precio'] . "</td>
          </tr>
      
      ";
      endforeach;
      $output .= "
      </tbody>
      </table>
      ";
      echo $output;
    }
  }
}
