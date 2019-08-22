<div class="row" id="principal">
  <div class="container-fluid col-sm-12">
    <div class="col-sm-12 col-md-4 text-center">
      <a href="javascript:void(0)" onclick="cargarTutorias()"><img src="recursos/img/tutorias/tutorias.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Que son las tutorías?</p>
    </div>
    <div class="col-sm-12 col-md-4 text-center">
      <a href="javascript:void(0)" onclick="cargarTutor()"><img src="recursos/img/tutorias/unirse.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Perfil Tutor</p>
    </div>
    <div class="col-sm-12 col-md-4 text-center">
      <a href="javascript:void(0)" onclick="cargarMiGrupo()"><img src="recursos/img/tutorias/grupos.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Mí grupo de tutorías</p>
    </div>
    <div class="col-sm-12 col-md-4 text-center">
      <a href="javascript:void(0)" onclick="cargarMisActividades()"><img src="recursos/img/tutorias/tutorias.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Mis actividades</p>
    </div>
    <div class="col-sm-12 col-md-4 text-center">
      <a href="javascript:void(0)" onclick="cargarMisActividadesEvaluadas()"><img src="recursos/img/tutorias/unirse.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Mis actividades evaluadas</p>
    </div>
    <!--div class="col-sm-6 col-md-3 text-center">
      <a href="javascript:void(0)" onclick="cargarActividades()"><img src="recursos/img/tutorias/actividades.png" class="img-circle" alt="Cinque Terre"></a>
      <p>Actividades y evaluaciones</p>
    </div-->
  </div>
</div>

<div id="queson" style="display: none;">
  <?php include 'queson.php';  ?>
</div>

<div id="perfilTutor" style="display: none;">
  <?php include 'perfilTutor.php';  ?>
</div>

<div id="migrupo" style="display: none;">
  <?php include 'migrupo.php';  ?>
</div>

<!--div id="actyeva" style="display: none;">
  <? #php include 'actyeva.php';  
  ?>
</div-->

<div id="misact" style="display: none;">
  <?php include 'misact.php';  ?>
</div>

<div id="misacteval" style="display: none;">
  <?php include 'misacteval.php';  ?>
</div>

<div id="sesion" style="display: none;">
  <?php include '/auth/login.php';  ?>
</div>

<script type="text/javascript">
  var menuAnterior = document.getElementById('principal');

  function cargarAlumno() {
    var menuActual = document.getElementById('principal');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarTutorias() {
    var menuActual = document.getElementById('queson');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarTutor() {
    var menuActual = document.getElementById('perfilTutor');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarMiGrupo() {
    var menuActual = document.getElementById('migrupo');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarActividades() {
    var menuActual = document.getElementById('actyeva');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarInicioSesion() {
    var menuActual = document.getElementById('sesion');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarMisActividades() {
    var menuActual = document.getElementById('misact');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarMisActividadesEvaluadas() {
    var menuActual = document.getElementById('misacteval');
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