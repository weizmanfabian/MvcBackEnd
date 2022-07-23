<?php

$filtered = $data["bienes"];

//traer ciudades del array => array_column
$ciudades = array_unique(array_column($data["bienes"], 'Ciudad'));
$tipos = array_unique(array_column($data["bienes"], 'Tipo'));
// echo '<pre>';
// var_dump($data["consulta"]);
// echo '</pre>';

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="views/css/materialize.min.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="views/css/customColors.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="views/css/ion.rangeSlider.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="views/css/ion.rangeSlider.skinFlat.css" media="screen,projection" />
  <link type="text/css" rel="stylesheet" href="views/css/index.css" media="screen,projection" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulario</title>
</head>

<body>
  <video src="views/img/video.mp4" id="vidFondo"></video>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Bienes Intelcost</h1>
    </div>
    <div class="colFiltros">

      <form action="index.php?c=bien&a=filtrar" method="post" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Filtros</h5>
          </div>
          <div class="filtroCiudad input-field">
            <p><label for="selectCiudad">Ciudad:</label><br></p>
            <select name="ciudad" id="selectCiudad">
              <option value="" selected>Elige una ciudad</option>
              <?php foreach ($ciudades as $city) : ?>
                <option value="<?php echo $city ?>"><?php echo $city ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <p><label for="selecTipo">Tipo:</label></p>
            <br>
            <select name="tipo" id="selectTipo">
              <option selected value="">Elige un tipo</option>
              <?php foreach ($tipos as $tipo) : ?>
                <option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" value="" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>
    <div id="tabs" style="width: 75%;">
      <ul>
        <li><a href="#tabs-1">Bienes disponibles</a></li>
        <li><a href="#tabs-2">Mis bienes</a></li>
        <li><a href="#tabs-3">Reportes</a></li>
      </ul>
      <div id="tabs-1">
        <div class="colContenido" id="divResultadosBusqueda">

          <div class="tituloContenido card row" style="justify-content: center;">
            <div class="botonField">
              <a class="btn success" href="index.php?c=bien&a=index">MOSTRAR TODOS</a>
              <!-- <input class="btn success" value="MOSTRAR TODOS" id="submitButton"> -->
            </div>
            <h5>Resultados de la búsqueda:</h5>
            <div class="divider"></div>
            <form id="nuevo" name="nuevo" method="POST" autocomplete="off" action="index.php?c=bien&a=guardar">
              <?php foreach ($filtered as $row) : ?>
                <div class="card col s12">
                  <div class="col s3">
                    <!-- <img src="img/home.jpg" alt="img" /> -->
                    <img class="materialboxed" width="100%" src="<?php echo $data["img"] ?>">
                  </div>
                  <div class="col s9">
                    <div class="col s3">
                      <b>Dirección: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $row["Direccion"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Ciudad: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $row["Ciudad"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Teléfono: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row["Telefono"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Código Postal: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" id="codigo_Postal" name="codigo_Postal" value="<?php echo $row["Codigo_Postal"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Tipo: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" id="tipo" name="tipo" value="<?php echo $row["Tipo"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Precio: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $row["Precio"] ?>" readonly>
                    </div>
                    <div class="botonField col s12">
                      <input type="submit" class="btn success" name="btn-gardar" value="GUARDAR">
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </form>
          </div>

        </div>
      </div>

      <div id="tabs-2">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <h5>Bienes guardados:</h5>
            <div class="divider"></div>
            <form id="nuevo" name="nuevo" autocomplete="off">
              <?php foreach ($data["consulta"] as $fila) : ?>
                <div class="card row col s12">
                  <div class="col s3">
                    <!-- <img src="img/home.jpg" alt="img" /> -->
                    <img class="materialboxed" width="100%" src="<?php echo $data["img"] ?>">
                  </div>
                  <div class="col s9">
                    <div class="col s3">
                      <b>Dirección: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" name="direccion" value="<?php echo $fila["direccion"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Ciudad: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" name="ciudad" value="<?php echo $fila["ciudad"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Teléfono: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" name="telefono" value="<?php echo $fila["telefono"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Código Postal: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" name="codigo_Postal" value="<?php echo $fila["codigo_Postal"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Tipo: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" name="tipo" value="<?php echo $fila["tipo"] ?>" readonly>
                    </div>
                    <div class="col s3">
                      <b>Precio: </b>
                    </div>
                    <div class="col s9">
                      <input type="text" class="form-control" name="precio" value="<?php echo $fila["precio"] ?>" readonly>
                    </div>
                    <div class="botonField col s12">
                      <?php
                      echo "<a href='index.php?c=bien&a=eliminar&id=" . $fila['id'] . "'>Eliminar</a>";
                      ?>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </form>
          </div>
        </div>
      </div>
      <div id="tabs-3">
        <div class="colContenido" id="divResultadosBusqueda">
          <div class="tituloContenido card" style="justify-content: center;">
            <div class="botonField">
              <a class="btn success" href="index.php?c=bien&a=index">MOSTRAR TODOS</a>
              <!-- <input class="btn success" value="MOSTRAR TODOS" id="submitButton"> -->
            </div>
            <h5>Reportes:</h5>
            <div class="divider"></div>

            <form action="index.php?c=bien&a=exportExcel" method="post" id="formulario">
              <div class="filtrosContenido">
                <div class="tituloFiltros">
                  <h5>Filtros</h5>
                </div>
                <div class="filtroCiudad input-field">
                  <p><label for="selectCiudad">Ciudad:</label><br></p>
                  <select name="ciudad" id="selectCiudad">
                    <option value="" selected>Elige una ciudad</option>
                    <?php foreach ($ciudades as $city) : ?>
                      <option value="<?php echo $city ?>"><?php echo $city ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="filtroTipo input-field">
                  <p><label for="selecTipo">Tipo:</label></p>
                  <br>
                  <select name="tipo" id="selectTipo">
                    <option selected value="">Elige un tipo</option>
                    <?php foreach ($tipos as $tipo) : ?>
                      <option value="<?php echo $tipo ?>"><?php echo $tipo ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="botonField">
                  <input type="submit" class="btn white" name="bt-export" value="Exportar a Excel" id="submitButton">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script type="text/javascript" src="views/js/ion.rangeSlider.min.js"></script>
    <script type="text/javascript" src="views/js/materialize.min.js"></script>
    <script type="text/javascript" src="views/js/index.js"></script>
    <script type="text/javascript" src="views/js/buscador.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#tabs").tabs();
      });
    </script>
</body>

</html>