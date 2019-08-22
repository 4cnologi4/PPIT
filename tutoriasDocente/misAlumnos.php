<div class="container-fluid">
  <div class="col-sm-12 col-md-8 text-center">
    <h2>Mis alumnos</h2>
  </div>
  <table id="data_table" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center">num control</th>
        <th class="text-center">carrera</th>
        <th class="text-center">alumno</th>
        <th class="text-center">clave</th>
      </tr>
    </thead>
    <tbody>
      <?php
      #test 
      #include '../config/db/conexion.php';
      #$u_actual = $_SESSION['iddocente'];
      include 'config/db/conexion.php';

      $doc_sql_query = "SELECT idGrupo, d.iddocente, clave, horario, cantidad, nom_usuario, idusuarios FROM grupo as g 
        join docente as d on g.iddocente=d.iddocente
        join usuarios as u on d.idusuario=u.idusuarios WHERE nom_usuario = '$u_actual'";
      $doc_query = mysqli_query($conn, $doc_sql_query);
      $uid = mysqli_fetch_assoc($doc_query);
      $user = $uid['iddocente'];

      #print_r($uid);

      $sql_query = "SELECT idListaGrupo, num_control, nom_carrera, nom_usuario, clave  from listaGrupos as lg
        join grupo as g on g.idgrupo=lg.idgrupo
        join alumno as a on lg.idalumno=a.idalumno
        join usuarios as u on a.idalumno=u.idusuarios
        join carrera as ac on a.idcarrera=ac.idcarrera
        join docente as d on g.iddocente=d.iddocente
        WHERE d.iddocente = " . intval($user);

      $resultset = mysqli_query($conn, $sql_query) or die("error base de datos:" . mysqli_error($conn));
      while ($grupo = mysqli_fetch_assoc($resultset)) {
        ?>
      <tr id="<?php echo $grupo['idgrupo']; ?>">
        <td class="text-center"><?php echo $grupo['num_control']; ?></td>
        <td class="text-center"><?php echo $grupo['nom_carrera']; ?></td>
        <td class="text-center"><?php echo $grupo['nom_usuario']; ?></td>
        <td class="text-center"><?php echo $grupo['clave']; ?></td>
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