<div class="row" id="principal">
  <div class="container-fluid">
    <div class="col-sm-3 col-md-4 text-center">
      <a id="cargaCreaActividad" href="javascript:void(0)" onclick="cargarCrearActividad()"><img src="recursos/img/tutorias/tutorias.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Crear actividad</p>
    </div>
    <div id="cargaMiActividad" class="col-sm-3 col-md-4 text-center">
      <a href="javascript:void(0)" onclick="cargarMisActividades()"><img src="recursos/img/tutorias/unirse.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Mis actividades</p>
    </div>
    <div id="cargaCalifica" class="col-sm-3 col-md-4 text-center">
      <a href="javascript:void(0)" onclick="cargarCalificar()"><img src="recursos/img/tutorias/unirse.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Calificar Actividad</p>
    </div>
  </div>
</div>

<div id="crearact" style="display: none;">
  <?php include 'crearActividad.php';  ?>
</div>

<div id="actividades" style="display: none;">
  <?php include 'actividades.php';  ?>
</div>

<div id="calificaract" style="display: none;">
  <?php include 'calificarActividad.php';  ?>
</div>

<div id="sesion" style="display: none;">
  <?php include 'auth/login.php';  ?>
</div>

<div class="row">
  <div class="container-fluid text-center">
    <div class="col-sm-12">
      <a class="btn btn-default" href="javascript:void(0)" role="button" onclick="cargarPrincipal()">Volver</a>
    </div>
  </div>
</div>

<script type="text/javascript">
  var menuAnterior = document.getElementById('principal');

  function cargarCrearActividad() {
    var menuActual = document.getElementById('crearact');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarMisActividades() {
    var menuActual = document.getElementById('actividades');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarCalificar() {
    var menuActual = document.getElementById('calificaract');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarPrincipal() {
    var menuActual = document.getElementById('principal');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }
</script>