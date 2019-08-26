<?php
include 'config/db/conexion.php';
$usuario = $_SESSION['nom_usuario'];
#$usuario = 'Fernando';
$usuario_actual_query = "SELECT idusuarios from usuarios where nom_usuario = '$usuario'";
$usuario_actual_id = mysqli_query($conn, $usuario_actual_query) or die("error en consulta: " . mysqli_error($conn));
$usuario_actual_json = mysqli_fetch_assoc($usuario_actual_id);
$id_user = $usuario_actual_json['idusuarios'];

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

#obtengo el id del grupo actual y del docente
$id_grupo = $id_grupo_user['idgrupo'];
$id_docente_grupo_query = "SELECT doc.idusuario, doc.iddocente from grupo as gru
join docente as doc on doc.iddocente=gru.iddocente
join usuarios as us on doc.idusuario=us.idusuarios
where idGrupo = $id_grupo";
$id_docente_grupo_exec = mysqli_query($conn, $id_docente_grupo_query) or die("error en consulta: " . mysqli_error($conn));
$id_docente_grupo_json = mysqli_fetch_assoc($id_docente_grupo_exec);
$id_docente_grupo = $id_docente_grupo_json['idusuario'];

$query_actividades_evaluadas = "SELECT la.idactividad, alu.idusuario, la.idalumno, la.idgrupo, 
nombreActividad, ruta, fecha_entrega, estatus, estado, calificacion, accion 
        from listaActividades as la
        join grupo as gru on la.idgrupo=gru.idGrupo
        join actividades as act on la.idactividad=act.idactividad
        join alumno as alu on la.idalumno=alu.idalumno
        join usuarios as us on alu.idusuario=us.idusuarios
        where la.idgrupo = $id_grupo and la.idalumno = $alumno_actual";

$query_grupo_exec = mysqli_query($conn, $query_actividades_evaluadas);

$query_clave = "SELECT clave 
from listaGrupos as lg
join grupo as g on g.idgrupo=lg.idgrupo
where g.idgrupo = " . intval($id_grupo);

$query_clave_exec = mysqli_query($conn, $query_clave);
$query_clave_json = mysqli_fetch_assoc($query_clave_exec);
?>


<div class="row">
  <div class="col-sm-12 col-md-8 text-center">
    <h2>Mi Grupo de tutorías: Clave <?php echo $query_clave_json['clave']; ?> Actividades</h2>
  </div>
</div>

<div class="container-fluid">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th class="text-center">Nombre Actividad</th>
        <!--th class="text-center">Archivo</th-->
        <th class="text-center">Fecha Entrega</th>
        <th class="text-center">Estatus</th>
        <th class="text-center">Estado</th>
        <th class="text-center">Calificacion</th>
        <th class="text-center">Accion</th>
        <th class="text-center">Opciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($comen_activi_json = mysqli_fetch_assoc($query_grupo_exec)) {
        #obtener comentarios
        $actividades_id = $comen_activi_json['idactividad'];
        $grupos_id = $comen_activi_json['idgrupo'];
        $usuarios_id = $comen_activi_json['idusuario'];
        $notifica = $comen_activi_json['calificacion'] == 0 ? 'bg-danger' : 'bg-success';

        $comentarios = "SELECT idComentario, texto, nom_usuario from comentarios as com
      join usuarios as us on com.idusuario=us.idusuarios
      WHERE (com.idgrupo = $grupos_id and com.idactividad= $actividades_id and com.idusuario = $id_docente_grupo)
      or (com.idgrupo = $grupos_id and com.idactividad= $actividades_id and com.idusuario = $id_user)";
        $comentarios_query = mysqli_query($conn, $comentarios) or die("error en base de datos" . mysqli_error($conn));
        ?>
      <tr class="<?php echo $notifica ?>">
        <td class="text-center"><?php echo $comen_activi_json['nombreActividad']; ?></td>
        <td class="text-center"><?php echo $comen_activi_json['fecha_entrega']; ?></td>
        <td class="text-center"><?php echo $comen_activi_json['estatus']; ?></td>
        <td class="text-center"><?php echo $comen_activi_json['estado']; ?></td>
        <td class="text-center"><?php echo $comen_activi_json['calificacion']; ?></td>
        <td class="text-center"><?php echo $comen_activi_json['accion']; ?></td>
        <td class="text-center">
          <button class="btn btn-default" type="button" data-toggle="collapse" data-target="#<?php echo $comen_activi_json['idactividad'] . $comen_activi_json['idusuario'] . $comen_activi_json['idgrupo']; ?>" aria-expanded="false" aria-controls="collapseExample">
            Ver
          </button>
        </td>
      </tr>
      <tr>
        <td colspan="7">
          <div class="collapse" id="<?php echo $comen_activi_json['idactividad'] . $comen_activi_json['idusuario'] . $comen_activi_json['idgrupo']; ?>">
            <div class="well">
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
              <form onsubmit="validaComentario();" method="post" action="tutoriasAlumno/comentaAct.php" class="form-inline" id="formulario" enctype="multipart/form-data">
                <input class="text-center" name="idactividad" style="visibility:hidden" value="<?php echo $comen_activi_json['idactividad'];
                                                                                                  ?>" />
                <input class="text-center" name="idusuario" style="visibility:hidden" value="<?php echo $id_user
                                                                                                ?>" />
                <input class="text-center" name="idgrupo" style="visibility:hidden" value="<?php echo $comen_activi_json['idgrupo']
                                                                                              ?>" />
                <div class="row">
                  <div class="col-md-8 col-md-offset-4">
                    <div class="form-group">
                      <label for="">Comentar:</label>
                      <textarea name="text-comentario" class="form-control" id="text-comentario<?php echo $comen_activi_json['idactividad'] ?>" cols="30" rows="3"></textarea>
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

<div class="row">
  <div class="container-fluid text-center">
    <div class="col-sm-12">
      <a class="btn btn-default" href="javascript:void(0)" role="button" onclick="cargarPrincipal()">Volver</a>
    </div>
  </div>
</div>