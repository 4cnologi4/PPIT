<?php
$nombre_user = $_SESSION['nom_usuario'];
include 'config/db/conexion.php';
$usuario_actual_query = "SELECT idusuarios from usuarios where nom_usuario = '$nombre_user'";
$usuario_actual_id = mysqli_query($conn, $usuario_actual_query) or die("error en consulta: " . mysqli_error($conn));
$usuario_actual_json = mysqli_fetch_assoc($usuario_actual_id);
$id_user = $usuario_actual_json['idusuarios'];

$id_docente = "SELECT iddocente from docente as d
              join usuarios as u on d.idusuario=u.idusuarios where nom_usuario = '$nombre_user'";
$doc_actual_id = mysqli_query($conn, $id_docente) or die("error en consulta: " . mysqli_error($conn));
$doc_actual_json = mysqli_fetch_assoc($doc_actual_id);
$id_doc = $doc_actual_json['iddocente'];

$sql_query = "SELECT  la.idactividad, alu.idusuario, la.idalumno, la.idgrupo, nombreActividad,
fecha_entrega, nom_usuario, clave, ruta, calificacion
        from listaActividades as la
        join grupo as gru on la.idgrupo=gru.idGrupo
        join actividades as act on la.idactividad=act.idactividad
        join alumno as alu on la.idalumno=alu.idalumno
        join usuarios as us on alu.idusuario=us.idusuarios
        WHERE gru.iddocente = $id_doc";
#where estado = 'no-revisada'"; #and accion = 'finalizada'";

$resultset = mysqli_query($conn, $sql_query) or die("error base de datos:" . mysqli_error($conn));
if (mysqli_num_rows($resultset) > 0) {
  ?>
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
        <th class="text-center">Calificacion</th>
        <th class="text-center">Archivo</th>
        <th class="text-center">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
        while ($actividades = mysqli_fetch_assoc($resultset)) {
          #obtener comentarios
          $actividades_id = $actividades['idactividad'];
          $grupos_id = $actividades['idgrupo'];
          $usuarios_id = $actividades['idusuario'];
          $notifica = $actividades['calificacion'] == 0 ? 'bg-danger' : 'bg-success';

          $comentarios = "SELECT idComentario, texto, nom_usuario from comentarios as com
        join usuarios as us on com.idusuario=us.idusuarios
        WHERE (com.idgrupo = $grupos_id and com.idactividad= $actividades_id and com.idusuario = $usuarios_id)
        or (com.idgrupo = $grupos_id and com.idactividad= $actividades_id and com.idusuario = $id_user)";
          $comentarios_query = mysqli_query($conn, $comentarios) or die("error en base de datos" . mysqli_error($conn));
          ?>
      <tr class="<?php echo $notifica ?>">
        <td class="text-center"><?php echo $actividades['nombreActividad']; ?></td>
        <td class="text-center"><?php echo $actividades['fecha_entrega']; ?></td>
        <td class="text-center"><?php echo $actividades['nom_usuario']; ?></td>
        <td class="text-center"><?php echo $actividades['clave']; ?></td>
        <td class="text-center"><?php echo $actividades['calificacion']; ?></td>
        <td class="text-center"> <a href="<?php echo substr($actividades['ruta'], 22); ?>"><i class="glyphicon glyphicon-save"></i></a> </td>
        <td class="text-center">
          <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#<?php echo $actividades['idactividad'] . $actividades['idalumno'] . $actividades['idgrupo'] ?>" aria-expanded="false" aria-controls="collapseExample">
            Acciones
          </button>
        </td>
      </tr>
      <tr>
        <td colspan="7">
          <div class="collapse" id="<?php echo $actividades['idactividad'] . $actividades['idalumno'] . $actividades['idgrupo']; ?>">
            <div class="well">
              <form method="post" action="tutoriasDocente/comentarCalificarAct.php" class="form-inline" id="formulario-califica">
                <input class="text-center" name="idactividad" style="visibility:hidden" value="<?php echo $actividades['idactividad']; ?>" />
                <input class="text-center" name="idalumno" style="visibility:hidden" value="<?php echo $actividades['idalumno'] ?>" />
                <input class="text-center" name="idgrupo" style="visibility:hidden" value="<?php echo $actividades['idgrupo'] ?>" />
                <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                    <div class="form-group">
                      <label for="calificaAct">Calificacion</label>
                      <input type="number" class="form-control text-center" name="input-califica-act" id="input-califica-act" placeholder="0">
                      <button id="btn-calificar-act" name="btn-calificar-act" type="submit" class="btn btn-default">Calificar</button>
                    </div>
                  </div>
                </div>
              </form>
              <?php while ($comentarios_json = mysqli_fetch_assoc($comentarios_query)) { ?>
              <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="form-group">
                    <label for="calificaAct">Usuario: <?php echo $comentarios_json['nom_usuario'] ?> </label>
                    <textarea name="comentario" class="form-control" id="<?php echo $comentarios_json['nom_usuario'] ?>Comentario" disabled cols="30" rows="3">
                      <?php echo $comentarios_json['texto'] ?>
                  </textarea>
                  </div>
                </div>
              </div>
              <?php } ?>
              <form method="post" action="tutoriasDocente/comentarCalificarAct.php" class="form-inline" id="formulario-comenta">
                <input class="text-center" name="idactividad" style="visibility:hidden" value="<?php echo $actividades['idactividad']; ?>" />
                <input class="text-center" name="idusuario" style="visibility:hidden" value="<?php echo $id_user ?>" />
                <input class="text-center" name="idgrupo" style="visibility:hidden" value="<?php echo $actividades['idgrupo'] ?>" />
                <div class="row">
                  <div class="col-md-8 col-md-offset-4">
                    <div class="form-group">
                      <label for="calificaAct">Comentar:</label>
                      <textarea name="text-comentario" class="form-control" id="text-comentario" cols="30" rows="3"></textarea>
                      <button id="btn-comentar-act" name="btn-comentar-act" type="submit" class="btn btn-default">Comentar</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<?php } else {
  echo "
  <div class='container'>
      <div class='row text-center'>
          <div class='col-sm-6 col-sm-offset-3'>
          <br><br> <h2 class='text-success'>Vacío</h2>
          <h3>No hay actividades</h3>
          <p style='font-size:20px;color:#5C5C5C;'>No hay actividades para calificar.</p>
          <br><br>
          </div>
      </div>
  </div>
";
}
?>

<div class="row">
  <div class="container-fluid text-center">
    <div class="col-sm-12">
      <a class="btn btn-default" href="javascript:void(0)" role="button" onclick="cargarPrincipal()">Volver</a>
    </div>
  </div>
</div>