<div class="container-fluid">
  <div class="col-sm-12 col-md-8 text-center">
    <h2>Mis actividades</h2>
  </div>
  <table id="data_table" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th class="text-center">Nombre actividad</th>
        <th class="text-center">Fecha de entrega</th>
        <th class="text-center">Alumno</th>
        <th class="text-center">Grupo</th>
      </tr>
    </thead>
    <tbody>
      <?php
      #test 
      #include '../config/db/conexion.php';
      #$u_actual = $_SESSION['iddocente'];
      include 'config/db/conexion.php';

      /*$doc_nom = $_SESSION['nom_usuario'];
      $id_doc = "SELECT iddocente, nom_usuario from usuarios as u
        join docente as d on u.idusuarios = d.idusuario where nom_usuario = '$doc_nom'";
      $id_doc_query = mysqli_query($conn, $id_doc);
      $id_doc_json = mysqli_fetch_assoc($id_doc_query);
      #print_r($id_doc_json);
      $id = $id_doc_json['iddocente'];*/


      $sql_query = "SELECT nombreActividad, fecha_entrega, nom_usuario, clave from listaActividades as la
        join grupo as gru on la.idgrupo=gru.idGrupo
        join actividades as act on la.idactividad=act.idactividad
        join alumno as alu on la.idalumno=alu.idalumno
        join usuarios as us on alu.idusuario=us.idusuarios
        where estado = 'no-revisada'";

      /*$sql_query = "SELECT clave, nombreActividad, estatus, fecha_entrega, url from grupo as g
        join docente as d on g.iddocente=d.iddocente
        join actividades as a on d.iddocente=a.iddocente
        WHERE g.iddocente = " . intval($id);*/

      $resultset = mysqli_query($conn, $sql_query) or die("error base de datos:" . mysqli_error($conn));
      while ($actividades = mysqli_fetch_assoc($resultset)) {
        ?>
      <tr>
        <td class="text-center"><?php echo $actividades['nombreActividad']; ?></td>
        <td class="text-center"><?php echo $actividades['fecha_entrega']; ?></td>
        <td class="text-center"><?php echo $actividades['nom_usuario']; ?></td>
        <td class="text-center"><?php echo $actividades['clave']; ?></td>
        <!--td class="text-center"> <a href="<?#php echo substr($actividades['url'], 22); ?>"><i class="glyphicon glyphicon-save"></i></a> </td-->
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