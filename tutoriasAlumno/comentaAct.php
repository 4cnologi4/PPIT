<?php
include '../config/db/conexion.php';
echo "
<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
<script src='//code.jquery.com/jquery-1.11.1.min.js'></script>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
";

if (isset($_POST['btn-comentar-act'])) {
  $texto = $_POST['text-comentario'];
  $idgrupo = $_POST['idgrupo'];
  $idactividad = $_POST["idactividad"];
  $idusuario = $_POST['idusuario'];

  if (trim($texto) != '') {

    $insert_comentario = "INSERT INTO comentarios (texto, idgrupo, idusuario, idactividad) VALUES 
  ('$texto', $idgrupo, $idusuario, $idactividad)";
    $resultset_comentario = mysqli_query($conn, $insert_comentario) or die("error base de en consulta:" . mysqli_error($conn));
    #echo $texto, $idgrupo, $idusuario, $idactividad;
    if ($resultset_comentario) {
      echo "
<div class='container'>
    <div class='row text-center'>
        <div class='col-sm-6 col-sm-offset-3'>
        <br><br> <h2 class='text-success'>Éxito</h2>
        <h3 class='success'>Gracias por tu comentario!</h3>
        <p style='font-size:20px;color:#5C5C5C;'>Haz comentado esta actividad.</p>
        <a href='../tutorias.php'>Volver a tutorías</a>
        <br><br>
        </div>
    </div>
</div>";
    } else {
      echo "
<div class='container'>
    <div class='row text-center'>
        <div class='col-sm-6 col-sm-offset-3'>
        <br><br> <h2 class='text-danger'>Error</h2>
        <h3 class='danger'>No pudiste comentar!</h3>
        <p style='font-size:20px;color:#5C5C5C;'>No se pudo agregar tu comentario!.</p>
        <a href='../tutorias.php'>Volver a tutorías</a>
        <br><br>
        </div>
    </div>
</div>";
    }
  } else {
    echo "
<div class='container'>
    <div class='row text-center'>
        <div class='col-sm-6 col-sm-offset-3'>
        <br><br> <h2 class='text-danger'>Error</h2>
        <h3 class='danger'>No pudiste comentar!</h3>
        <p style='font-size:20px;color:#5C5C5C;'>El texto no puede estar vacío!.</p>
        <a href='../tutorias.php'>Volver a tutorías</a>
        <br><br>
        </div>
    </div>
</div>";
  }
}
