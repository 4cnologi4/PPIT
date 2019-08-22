<?php
$doc_nom = $_SESSION['nom_usuario'];
$id_doc = "SELECT iddocente, nom_usuario from usuarios as u
  join docente as d on u.idusuarios = d.idusuario where nom_usuario = '$doc_nom'";
$id_doc_query = mysqli_query($conn, $id_doc);
$id_doc_json = mysqli_fetch_assoc($id_doc_query);
#print_r($id_doc_json);
$id = $id_doc_json['iddocente'];

$mis_grupos_id = "SELECT * from grupo where iddocente = " . intval($id);
$mis_grupos_id_query = mysqli_query($conn, $mis_grupos_id);
#$mis_grupos_id_json = mysqli_fetch_assoc($mis_grupos_id_query);


?>


<div class="row">
  <div class="container-fluid">
    <div class="form-group col-md-12 col-sm-12 text-center">
      <h1>Subir Actividad</h1>
    </div>
    <div class="col-md-12 col-sm-12">
      <form method="post" action="tutoriasDocente/creaA.php" class="form-horizontal" id="formulario" enctype="multipart/form-data">
        <div class="form-group col-md-4 col-sm-12">
          <input required type="text" class="form-control" id="nombreAct" name="nombreAct" placeholder="Nombre">
        </div>
        <div class="form-inline col-md-12 col-sm-12 text-center">
          <div class="form-group col-md-12">
            <label for="" class="col-md-4 control-label">Ingresa la fecha de entrega:</label>
          </div>
          <div class="form-group col-md-4 col-sm-12">
            <input required type="text" maxlength="4" class="form-control" id="year" name="year" placeholder="año">
          </div>
          <div class="form-group col-md-4 col-sm-12">
            <input required type="text" maxlength="2" class="form-control" id="mes" name="mes" placeholder="mes">
          </div>
          <div class="form-group col-md-4 col-sm-12">
            <input required type="text" maxlength="2" class="form-control" id="dia" name="dia" placeholder="dia">
          </div>
        </div>

        <div class="form-group col-md-12">
          <label for="" class="col-md-4 control-label">Selecciona el grupo:</label>
          <select required class="col-md-4 form-control" name="idgrupo">
            <?php
            while ($mis_grupos_id_json = mysqli_fetch_assoc($mis_grupos_id_query)) {
              ?>
            <option class="text-center" value="<?php echo $mis_grupos_id_json['idGrupo']; ?>">
              <?php echo $mis_grupos_id_json['clave']; ?>
            </option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group col-md-8 col-sm-12">
          <input required class="btn btn-primary" name="fichero" type="file" size="150" maxlength="150">
        </div>
        <div class="form-group col-md-2 col-sm-12 text-center">
          <button id="btn-crear-act" name="btn-crear-act" type="text" class="btn btn-default">Crear actividad</button>
        </div>

        <div class="form-group col-md-8 col-sm-12">
          <input style="visibility:hidden;" type="text" class="form-control" id="docente" name="iddocente" value="<?php echo $id ?>">
        </div>
        <div class="form-group col-md-8 col-sm-12">
          <input style="visibility:hidden;" type="text" class="form-control" id="estatus" value="abierta" name="estatus" placeholder="estatus">
        </div>
      </form>
    </div>

  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  /*$('#btn-crear-act').click(function() {
    var url = "crearActividad.php";

    $.ajax({
      type: "POST",
      url: url,
      data: $("#formulario").serialize(),
      beforeSend: function() {
        alert("Procesando, espere por favor...");
      },
      success: function(data, res) {
        res.send("actividad creada...");
      }
    });
  });*/
</script>

<div class="row">
  <div class="container-fluid text-center">
    <div class="col-sm-12">
      <a class="btn btn-default" href="javascript:void(0)" role="button" onclick="cargarPrincipal()">Volver</a>
    </div>
  </div>
</div>