<?php
#$idGrupo = $_POST['idGrupo'];
$clave  = $_POST['clave'];
$lunes = isset($_POST['lunes']) ? $_POST['lunes'] : "";
$martes = isset($_POST['martes']) ? $_POST['martes'] : "";
$miercoles = isset($_POST['miercoles']) ? $_POST['miercoles'] : "";
$jueves = isset($_POST['jueves']) ? $_POST['jueves'] : "";
$cantidad  = $_POST['cantidad'];
$iddocente = $_POST['iddocente'];
$horario = "";
if ($lunes) {
    $horario .= $lunes;
}
if ($martes) {
    $horario .= ',' . $martes;
}
if ($miercoles) {
    $horario .= ',' . $miercoles;
}
if ($jueves) {
    $horario .= ',' . $jueves;
}

/*echo "<a>" . gettype($horario) . " - " . gettype($lunes) . "</a>";
echo "<h1> H " . $horario . " L " . $lunes . " Ma " . $martes .
    " Mi " . $miercoles . " J " . $jueves . "</h1>";*/

echo "
<link href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js'></script>
<script src='//code.jquery.com/jquery-1.11.1.min.js'></script>
";

include '../config/db/conexion.php';
$sql_query = "INSERT INTO grupo (clave, horario, cantidad, iddocente) VALUES ('$clave', '$horario', $cantidad, $iddocente)";

$existe_grupo = "SELECT * from grupo WHERE clave = '$clave'";
$resultset_grupo = mysqli_query($conn, $existe_grupo) or die("error base de en consulta:" . mysqli_error($conn));
if (mysqli_num_rows($resultset_grupo) > 0) {
    echo "
        <div class='container'>
            <div class='row text-center'>
                <div class='col-sm-6 col-sm-offset-3'>
                <br><br> <h2 class='text-warning'>Warning</h2>
                <h3>No se pudo crear el grupo !</h3>
                <p class='avisos'>El nombre de grupo ya esta registrado</p> 
                <p class='avisos'><a href='javascript:history.go(-1)' class='clase1'>Volver atrás</a></p> 
                <br><br>
                </div>
            </div>
        </div>
    ";
} else {
    $resultset = mysqli_query($conn, $sql_query) or die("error base de datos:" . mysqli_error($conn));
    if ($resultset >= 1) {
        echo "
        <div class='container'>
            <div class='row text-center'>
                <div class='col-sm-6 col-sm-offset-3'>
                <br><br> <h2 class='text-success'>Éxito</h2>
                <h3>Grupo creado !</h3>
                <p style='font-size:20px;color:#5C5C5C;'>El grupo $clave fue creado.</p>
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
                <h3>No se pudo crear el grupo !</h3>
                <p class='text-danger'>Hubo un error... $resultset.</p>
                <a href='../tutorias.php'>Volver a tutorías</a>;
                <br><br>
                </div>
            </div>
        </div>
        ";
    }
}



#echo "<script>alert(Se dió de alta el Grupo : " . $clave . "horario es: " . $horario . "cantidad es: " . $cantidad . "docente id : " . $idDocente . "');</script>";
