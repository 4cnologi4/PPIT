<?php
echo "
<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
<script src='//code.jquery.com/jquery-1.11.1.min.js'></script>
";

include '../config/db/conexion.php';
if (isset($_POST['btn-crear-act'])) {
  if (is_uploaded_file($_FILES['fichero']['tmp_name'])) {

    // creamos las variables para subir a la db
    //upload /opt/lampp/htdocs/PPI/upload
    $ruta = "/opt/lampp/htdocs/PPI/upload/";
    $nombrefinal = trim($_FILES['fichero']['name']); //Eliminamos los espacios en blanco
    #$nombrefinal = preg_replace(" ", "", $nombrefinal); //Sustituye una expresión regular
    $upload = $ruta . $nombrefinal;

    if (move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion 

      /*echo "<b>Se cargó la actividad exitosamente!</b><br>";
      echo "Nombre: <i><a href=\"/PPI/upload/" . $nombrefinal . "\">" . $_FILES['fichero']['name'] . "</a></i><br>";
      echo "Tipo MIME: <i>" . $_FILES['fichero']['type'] . "</i><br>";
      echo "Peso: <i>" . $_FILES['fichero']['size'] . " bytes</i><br>";
      echo "<br><hr><br>";
      echo "<a href='../tutorias.php'>Volver a tutorías</a>";*/
      date_default_timezone_set('America/Mexico_City');
      $nombre  = $_POST["nombreAct"];
      $estatus  = 'abierta';
      $iddocente = $_POST["iddocente"];
      $idgrupo = $_POST['idgrupo'];
      $fecha_entrega = $_POST['fecha_entrega'];

      $fecha_actual = date("Y-m-d", time());
      if ($fecha_entrega > $fecha_actual) {

        $query = "INSERT INTO actividades (nombreActividad,estatus,url,fecha_entrega,iddocente,idgrupo) 
    VALUES ('$nombre', '$estatus', '" . $upload . "', '$fecha_entrega', '$iddocente', $idgrupo)";

        mysqli_query($conn, $query) or die(mysqli_error($conn));
        #echo "El archivo '" . $nombre . "' se ha subido con éxito <br>";
        echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-success'>Éxito</h2>
              <h3>Actividad dada de alta</h3>
              <p style='font-size:20px;color:#5C5C5C;'>La actividad $nombre fue creada.</p>
              <a href='../tutorias.php'>Volver a tutorías</a>
              <br><br>
              </div>
          </div>
      </div>
  ";
      } else {
        echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-danger'>Error!</h2>
              <h3>No se pudo subir la actividad !</h3>
              <p class='text-danger'>La fecha de entrega $fecha_entrega no puede ser menor a la fecha actual $fecha_actual</p>
              <a href='../tutorias.php'>Volver a tutorías</a>
              <br><br>
              </div>
          </div>
      </div>
      ";
      }
    } else {
      echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-danger'>Error!</h2>
              <h3>No se pudo subir la actividad !</h3>
              <p class='text-danger'>No se pudo cargar el archivo... $resultset.</p>
              <a href='../tutorias.php'>Volver a tutorías</a>
              <br><br>
              </div>
          </div>
      </div>
      ";
    }
  } else {
    echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-danger'>Error!</h2>
              <h3>No se pudo subir la actividad !</h3>
              <p class='text-danger'>No se pudo mover el archivo... $resultset.</p>
              <a href='../tutorias.php'>Volver a tutorías</a>;
              <br><br>
              </div>
          </div>
      </div>
      ";
  }
} else {
  echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-danger'>Error!</h2>
              <h3>No se pudo subir la actividad !</h3>
              <p class='text-danger'>No se pudo cargar el archivo... $resultset.</p>
              <a href='../tutorias.php'>Volver a tutorías</a>;
              <br><br>
              </div>
          </div>
      </div>
      ";
}
