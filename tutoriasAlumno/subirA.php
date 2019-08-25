<?php
include '../config/db/conexion.php';
echo "
<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
<script src='//code.jquery.com/jquery-1.11.1.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
";
$idgrupo = $_POST['idgrupo'];
$idactividad = $_POST["idactividad"];
$idalumno = $_POST['idalumno'];
$ruta = "/opt/lampp/htdocs/PPI/upload/actividades/";

if (isset($_POST['btn-finalizar-act'])) {

  $existe_actividad = "SELECT * from listaActividades WHERE idgrupo = $idgrupo and idactividad = $idactividad 
  and idalumno = $idalumno and accion = 'finalizada'";
  $resultset_actividad = mysqli_query($conn, $existe_actividad) or die("error base de en consulta:" . mysqli_error($conn));

  $existe_actividad_update = "SELECT * from listaActividades WHERE idgrupo = $idgrupo and idactividad = $idactividad 
  and idalumno = $idalumno and accion = 'guardada'";
  $resultset_actividad_update = mysqli_query($conn, $existe_actividad_update) or die("error base de en consulta:" . mysqli_error($conn));

  if (mysqli_num_rows($resultset_actividad) > 0) {
    echo "
          <div class='container'>
              <div class='row text-center'>
                  <div class='col-sm-6 col-sm-offset-3'>
                  <br><br> <h2 class='text-warning'>Warning</h2>
                  <h3>Actividad Finalizada!</h3>
                  <p class='avisos'>La actividad ya se encuentra finalizada y no se puede modificar!</p>
                  <a href='../tutorias.php'>Volver a tutorías</a>
                  <!--p class='avisos'><a href='javascript:history.go(-1)' class='clase1'>Volver atrás</a></p--> 
                  <br><br>
                  </div>
              </div>
          </div>
      ";
  } elseif (mysqli_num_rows($resultset_actividad_update) > 0) {

    $query = "UPDATE listaActividades set accion = 'finalizada'
                  WHERE idgrupo = $idgrupo AND idactividad = $idactividad AND idalumno = $idalumno AND accion = 'guardada'";
    mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-success'>Éxito</h2>
              <h3>Actividad finalizada</h3>
              <p style='font-size:20px;color:#5C5C5C;'>La actividad fue finalizada y ya no se podrá modificar.</p>
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
              <br><br> <h2 class='text-danger'>Error</h2>
              <h3>La actividad no ha sido enviada</h3>
              <p style='font-size:20px;color:#5C5C5C;'>No haz enviado esta actividad, por tanto no se puede finalizar.</p>
              <a href='../tutorias.php'>Volver a tutorías</a>
              <br><br>
              </div>
          </div>
      </div>
  ";
  }
} elseif (isset($_POST['btn-guardar-act'])) {

  $existe_actividad_enviada = "SELECT * from listaActividades WHERE idgrupo = $idgrupo and idactividad = $idactividad 
  and idalumno = $idalumno and accion = 'finalizada'";
  $resultset_actividad_enviada = mysqli_query($conn, $existe_actividad_enviada) or die("error base de en consulta:" . mysqli_error($conn));

  $existe_actividad = "SELECT * from listaActividades WHERE idgrupo = $idgrupo and idactividad = $idactividad 
  and idalumno = $idalumno and accion = 'guardada'";
  $resultset_actividad = mysqli_query($conn, $existe_actividad) or die("error en consulta:" . mysqli_error($conn));

  if (mysqli_num_rows($resultset_actividad_enviada) > 0) {
    echo "
          <div class='container'>
              <div class='row text-center'>
                  <div class='col-sm-6 col-sm-offset-3'>
                  <br><br> <h2 class='text-warning'>Warning</h2>
                  <h3>No se pudo subir la actividad!</h3>
                  <p class='avisos'>La actividad ya fue finalizada y no se puede modificar!</p>
                  <a href='../tutorias.php'>Volver a tutorías</a>
                  <br><br>
                  </div>
              </div>
          </div>
      ";
  } elseif (mysqli_num_rows($resultset_actividad) > 0) {

    if (is_uploaded_file($_FILES['fichero']['tmp_name'])) {

      $nombrefinal = trim($_FILES['fichero']['name']); //Eliminamos los espacios en blanco
      #$nombrefinal = preg_replace(" ", "", $nombrefinal); //Sustituye una expresión regular
      $upload = $ruta . $nombrefinal;

      if (move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion 

        $query = "UPDATE listaActividades set ruta = '$upload' 
                  WHERE idgrupo = $idgrupo AND idactividad = $idactividad AND idalumno = $idalumno";

        mysqli_query($conn, $query) or die(mysqli_error($conn));
        echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-success'>Éxito</h2>
              <h3>Actividad Guardada</h3>
              <p style='font-size:20px;color:#5C5C5C;'>La actividad fue guardada.</p>
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
              <h3>No se pudo guardar la actividad !</h3>
              <p class='text-danger'>Error al subir el archivo... $resultset.</p>
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
              <h3>No se pudo guardar la actividad !</h3>
              <p class='text-danger'>Error al cargar el archivo... $resultset.</p>
              <a href='../tutorias.php'>Volver a tutorías</a>;
              <br><br>
              </div>
          </div>
      </div>
      ";
    }
  } else {

    if (is_uploaded_file($_FILES['fichero']['tmp_name'])) {

      $nombrefinal = trim($_FILES['fichero']['name']); //Eliminamos los espacios en blanco
      #$nombrefinal = preg_replace(" ", "", $nombrefinal); //Sustituye una expresión regular
      $upload = $ruta . $nombrefinal;

      if (move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion 

        $query = "INSERT INTO listaActividades (idgrupo, idactividad, idalumno, ruta) 
                VALUES ($idgrupo, $idactividad, $idalumno, '$upload')";

        mysqli_query($conn, $query) or die(mysqli_error($conn));
        #echo "El archivo '" . $nombre . "' se ha subido con éxito <br>";
        echo "
      <div class='container'>
          <div class='row text-center'>
              <div class='col-sm-6 col-sm-offset-3'>
              <br><br> <h2 class='text-success'>Éxito</h2>
              <h3>Actividad Guardada</h3>
              <p style='font-size:20px;color:#5C5C5C;'>La actividad fue guardada.</p>
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
              <p class='text-danger'>Error al subir el archivo... $resultset.</p>
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
              <p class='text-danger'>Error al cargar el archivo... $resultset.</p>
              <a href='../tutorias.php'>Volver a tutorías</a>;
              <br><br>
              </div>
          </div>
      </div>
      ";
    }
  }
}
