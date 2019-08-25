<link rel="stylesheet" href="tutoriasAlumno/tutoriasAlumno.css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="recursos/css/index.css">
<link rel="stylesheet" href="style.css">
<?php
include 'header.php';
include 'navbar.php';

if (isset($_SESSION['nom_usuario']) && isset($_SESSION['nom_rol'])) {
  if ($_SESSION['nom_rol'] == 'Administrador') {
    include 'tutoriasAlumno/alumnos.php';
  } elseif ($_SESSION['nom_rol'] == 'Alumno') {
    include 'tutoriasAlumno/alumnos.php';
  } elseif ($_SESSION['nom_rol'] == 'Docente') {
    include 'tutoriasDocente/docente.php';
  } elseif ($_SESSION['nom_rol'] == 'Jefe de Departamento') {
    echo "<a href='javascript:void(0)' onclick='cargarJefe()'>Jefe de departamento</a>";
  } elseif ($_SESSION['nom_rol'] == 'Administrativo') {
    include 'tutoriasAdministrativo/tutoriasAdministrativo.php';
  }
} else {
  echo "
          <div class='container'>
              <div class='row text-center'>
                  <div class='col-sm-6 col-sm-offset-3'>
                  <br><br> <h2 class='text-warning'>Warning!</h2>
                  <h3 class='text-warning'>No existe el usuario ...</h3>
                  <p class='text-danger'>Debes iniciar sesión! para acceder a tutorías.</p>
                  <a href='index.php'>Volver</a>
                  <br><br>
                  </div>
              </div>
          </div>
      ";
}

?>

<div id="alumno" style="display: none;">
  <?php include 'menus/alumnos.php';  ?>
</div>

<div id="docente" style="display: none;">
  <?php include 'menus/docentes.php';  ?>
</div>

<div id="jefe" style="display: none;">
  <?php include 'menus/jefe.php';  ?>
</div>

<div id="administrativo" style="display: none;">
  <?php include 'menus/alumnos.php';  ?>
</div>

<div id="empresa" style="display: none;">
  <?php include 'menus/empresas.php';  ?>
</div>

<?php include 'footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
<script type="text/javascript">
  var menuAnterior = document.getElementById('principal');

  function cargarInicioSesion() {
    var menuActual = document.getElementById('sesion');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarAlumno() {
    var menuActual = document.getElementById('alumno');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarDocente() {
    var menuActual = document.getElementById('docente');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarJefe() {
    var menuActual = document.getElementById('jefe');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarAdministrativo() {
    var menuActual = document.getElementById('administrativo');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }

  function cargarEmpresa() {
    var menuActual = document.getElementById('empresa');
    menuAnterior.style.display = 'none';
    menuActual.style.display = 'block';
    menuAnterior = menuActual;
  }
</script>