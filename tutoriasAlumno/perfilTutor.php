<?php
include 'config/db/conexion.php';
$usuario = $_SESSION['nom_usuario'];
$sql_resp = "SELECT idalumno FROM usuarios 
JOIN alumno as a ON a.idusuario = usuarios.idusuarios
WHERE usuarios.nom_usuario = '$usuario'";
$userac = mysqli_query($conn, $sql_resp);
$alumn_assoc = mysqli_fetch_assoc($userac);
$alumno_actual = $alumn_assoc['idalumno'];

$perfil_tutor = "SELECT rfc, nom_escolaridad, nom_usuario from listaGrupos as lg
join grupo as g on g.idgrupo = lg.idgrupo
join docente as d on d.iddocente = g.iddocente
join escolaridad as e on e.idescolaridad = d.idescolaridad
join usuarios as u on d.idusuario = u.idusuarios
where idalumno = $alumno_actual;";
$perfil_tutor_query = mysqli_query($conn, $perfil_tutor);
$perfil_tutor_json = mysqli_fetch_assoc($perfil_tutor_query);
#print_r($perfil_tutor_json);
?>

<div class="row">
  <div class="container-fluid">
    <div class="col-sm-12 col-md-4 text-center">
      <img src="recursos/img/rol_docente.png" width="80%" height="80%" class="img-circle img-responsive" alt="Cinque Terre">
    </div>
    <div class="col-sm-12 col-md-8 text-center">
      <p class="lead">Mi tutor <?php echo $perfil_tutor_json['nom_usuario'] ?> </p>
      <p class="lead">Escolaridad <?php echo $perfil_tutor_json['nom_escolaridad'] ?> </p>
      <p class="lead">RFC <?php echo $perfil_tutor_json['rfc'] ?></p>
    </div>
  </div>
</div>

<div class="row">
  <div class="container-fluid text-center">
    <div class="col-sm-12">
      <a class="btn btn-default" href="javascript:void(0)" role="button" onclick="cargarPrincipal()">Volver</a>
    </div>
  </div>
</div>