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


<div class="row col-md-offset-4">
  <div class="container-fluid">
    <div class="form-group col-md-12 col-sm-12">
      <h1>Subir Actividad</h1>
    </div>
    <div class="col-md-12 col-sm-12">
      <form method="post" action="tutoriasDocente/creaA.php" class="form-horizontal" id="formulario" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="" class="col-md-4">Nombre Actividad:</label>
              <div class="col-md-8">
                <div class="col-md-8">
                  <input required type="text" class="form-control" id="nombreAct" name="nombreAct" placeholder="Nombre">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 col-sm-12">
            <div class="form-group">
              <label for="" class="col-md-4">Ingresa la fecha de entrega:</label>
              <div class="col-md-8 col-sm-12">
                <div class="col-md-8">
                  <input required type="date" class="form-control" id="fecha" name="fecha_entrega">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="" class="col-md-4">Selecciona el grupo:</label>
              <div class="col-md-8">
                <div class="col-md-8">
                  <select required class="form-control" name="idgrupo">
                    <?php
                    while ($mis_grupos_id_json = mysqli_fetch_assoc($mis_grupos_id_query)) {
                      ?>
                    <option class="text-center" value="<?php echo $mis_grupos_id_json['idGrupo']; ?>">
                      <?php echo $mis_grupos_id_json['clave']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-8 col-sm-12 col-md-offset-1">
            <div class="form-group">
              <input required class="btn btn-primary" name="fichero" type="file" size="150" maxlength="150">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="form-group">
            <div class="col-md-2 col-sm-12 col-md-offset-2">
              <button id="btn-crear-act" name="btn-crear-act" type="text" class="btn btn-default">Crear actividad</button>
            </div>
          </div>
        </div>

        <div class="form-group col-md-8 col-sm-12">
          <input style="visibility:hidden;" type="text" class="form-control" id="docente" name="iddocente" value="<?php echo $id ?>">
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