<div class="row">
  <div class="container-fluid">
    <div class="form-group col-md-12 col-sm-12 text-center">
      <h1>Crear grupos</h1>
    </div>
    <div class="col-md-12 col-sm-12">
      <!--form method="post" action="<?php #echo $_SERVER['PHP_SELF'] ?>" class="form-horizontal" id="formulario" enctype="multipart/form-data"-->
      <form method="post" action="creaA.php" class="form-horizontal" id="formulario" enctype="multipart/form-data">
        <div class="form-group col-md-8 col-sm-12">
          <input type="text" class="form-control" id="nombreAct" name="nombreAct" placeholder="Nombre">
        </div>
        <div class="form-group col-md-8 col-sm-12">
          <input type="text" class="form-control" id="estatus" name="estatus" placeholder="estatus">
        </div>
        <div class="form-group col-md-8 col-sm-12">
          <input type="text" class="form-control" id="fecha_entrega" name="fecha_entrega" placeholder="fecha entrega">
        </div>
        <div class="form-group col-md-8 col-sm-12">
          <input type="text" class="form-control" id="finalizado" name="finalizado" placeholder="finalizado">
        </div>
        <div class="form-group col-md-8 col-sm-12">
          <input type="text" class="form-control" id="docente" name="iddocente" placeholder="docente">
        </div>
        <div class="form-group col-md-8 col-sm-12">
          Seleccione archivo: <input name="fichero" type="file" size="150" maxlength="150">
        </div>
        <div class="form-group col-md-2 col-sm-12 text-center">
          <button id="btn-crear-act" name="btn-crear-act" type="text" class="btn btn-default">Crear actividad</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $('#btn-crear-act').click(function() {
    var url = "creaA.php";

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
  });
</script>

<div class="row">
  <div class="container-fluid text-center">
    <div class="col-sm-12">
      <a class="btn btn-default" href="javascript:void(0)" role="button" onclick="cargarPrincipal()">Volver</a>
    </div>
  </div>
</div>