<?php

include 'config/db/conexion.php';
$usuario = $_SESSION['nom_usuario'];
$sql_resp = "SELECT idalumno
FROM usuarios 
JOIN alumno as a ON a.idusuario = usuarios.idusuarios
WHERE usuarios.nom_usuario = '$usuario'";
$userac = mysqli_query($conn, $sql_resp);
$alumn_assoc = mysqli_fetch_assoc($userac);
$alumno_actual = $alumn_assoc['idalumno'];
$obtener_id_grupo = "SELECT idgrupo from listaGrupos where idalumno = $alumno_actual;";
$obtener_id_grupo_exec = mysqli_query($conn, $obtener_id_grupo);
$id_grupo_user = mysqli_fetch_assoc($obtener_id_grupo_exec);

$id_grupo = $id_grupo_user['idgrupo'];

$query_grupo = "SELECT clave, nom_usuario, num_control, nom_carrera, semestre 
  from listaGrupos as lg
  join grupo as g on g.idgrupo=lg.idgrupo
  join alumno as a on a.idalumno=lg.idalumno
  join usuarios as u on a.idalumno=u.idusuarios 
  join carrera as c on c.idcarrera=a.idcarrera
  where g.idgrupo = " . intval($id_grupo);
$query_grupo_exec = mysqli_query($conn, $query_grupo);

$query_clave = "SELECT clave 
from listaGrupos as lg
join grupo as g on g.idgrupo=lg.idgrupo
where g.idgrupo = " . intval($id_grupo);

$query_clave_exec = mysqli_query($conn, $query_clave);
$query_clave_json = mysqli_fetch_assoc($query_clave_exec);
?>


<div class="row">
  <div class="col-sm-12 col-md-8 text-center">
    <h2>Mi Grupo de tutorías: Clave <?php echo $query_clave_json['clave']; ?></h2>
  </div>
</div>

<div class="container-fluid">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Matrícula</th>
        <th>carrera</th>
        <th>semestre</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($query_json = mysqli_fetch_assoc($query_grupo_exec)) {
        ?>
      <tr>
        <td><?php echo $query_json['nom_usuario']; ?></td>
        <td><?php echo $query_json['num_control']; ?></td>
        <td><?php echo $query_json['nom_carrera']; ?></td>
        <td><?php echo $query_json['semestre']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<div class="row">
  <div class="container-fluid text-center">
    <div class="col-sm-12">
      <a class="btn btn-default" href="javascript:void(0)" role="button" onclick="cargarPrincipal()">Volver</a>
    </div>
  </div>
</div>