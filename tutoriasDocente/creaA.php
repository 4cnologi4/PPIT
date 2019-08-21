<?php
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

      echo "<b>Upload exitoso!. Datos:</b><br>";
      echo "Nombre: <i><a href=\"/PPI/upload/" . $nombrefinal . "\">" . $_FILES['fichero']['name'] . "</a></i><br>";
      echo "Tipo MIME: <i>" . $_FILES['fichero']['type'] . "</i><br>";
      echo "Peso: <i>" . $_FILES['fichero']['size'] . " bytes</i><br>";
      echo "<br><hr><br>";

      $nombre  = $_POST["nombreAct"];
      $estatus  = $_POST["estatus"];
      $fecha_entrega = $_POST["fecha_entrega"];
      $finalizado = $_POST["finalizado"];
      $iddocente = $_POST["iddocente"];

      $query = "INSERT INTO actividades (nombreActividad,estatus,url,fecha_entrega,finalizado,iddocente) 
    VALUES ('$nombre', '$estatus', '" . $upload . "', '$fecha_entrega', '$finalizado', '$iddocente')";

      mysqli_query($conn, $query) or die(mysqli_error($conn));
      echo "El archivo '" . $nombre . "' se ha subido con éxito <br>";
    } else {
      echo "no se pudo cargar el archivo";
    }
  } else {
    echo "no se puedo mover el archivo";
  }
} else {
  echo "error en el envió del archivo";
}
