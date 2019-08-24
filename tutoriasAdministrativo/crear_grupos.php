<?php
include 'config/db/conexion.php';
$docentes = "SELECT *, nom_usuario from docente as d
join usuarios as u on d.idusuario = u.idusuarios";
$docentes_query = mysqli_query($conn, $docentes);
#$docentes_json = mysqli_fetch_assoc($docentes_query);

?>

<div class="row col-md-offset-3">
  <div class="container-fluid">
    <div class="form-group col-md-12 col-sm-12">
      <h1>Crear grupos</h1>
    </div>
    <div class="col-md-12 col-sm-12">
      <form method="post" action="tutoriasAdministrativo/crearG.php" class="form-horizontal" id="formulario">
        <!--div class="form-group col-md-8 col-sm-12">
          <input type="text" class="form-control" id="idGrupo" name="idGrupo" placeholder="id del grupo">
        </div-->
        <div class="form-group col-md-8 col-sm-12">
          <input required type="text" maxlength="1" class="form-control" id="clave" name="clave" placeholder="clave">
        </div>
        <div class="form-group col-md-8 col-sm-12">
          <!--input required type="text" class="form-control" id="horario" name="horario" placeholder="horario"-->
          <label class="checkbox-inline">
            <input type="checkbox" id="lunes" name="lunes" value="Lunes"> Lunes
          </label>
          <label class="checkbox-inline">
            <input type="checkbox" id="martes" name="martes" value="Martes"> Martes
          </label>
          <label class="checkbox-inline">
            <input type="checkbox" id="miercoles" name="miercoles" value="Miercoles"> Miércoles
          </label>
          <label class="checkbox-inline">
            <input type="checkbox" id="jueves" name="jueves" value="Jueves"> Jueves
          </label>
        </div>
        <div class="form-group col-md-8 col-sm-12">
          <input required type="number" min="1" max="30" class="form-control" id="cantidad" name="cantidad" placeholder="cantidad">
        </div>
        <div class="form-group col-md-8">
          <label for="" class="col-md-4">Selecciona el docente:</label>
          <select required class="col-md-4 form-control" name="iddocente">
            <?php
            while ($docentes_json = mysqli_fetch_assoc($docentes_query)) {
              ?>
            <option class="text-center" value="<?php echo $docentes_json['iddocente']; ?>">
              <?php echo $docentes_json['nom_usuario']; ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <!--div class="form-group col-md-8 col-sm-12">
          <input type="text" class="form-control" id="idDocente" name="iddocente" placeholder="docente">
        </div-->
        <div class="form-group col-md-12 col-sm-12">
          <button id="btn-crear" type="text" class="btn btn-default">Crear grupo</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  /*$('#btn-crear').click(function() {
    var url = "tutoriasAdministrativo/crearG.php";

    $.ajax({
      type: "POST",
      url: url,
      data: $("#formulario").serialize(),
      beforeSend: function() {
        alert("Procesando, espere por favor...");
      },
      success: function(data, res) {
        res.send("grupo creado...");
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