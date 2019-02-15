<?php 
	error_reporting(0);//
	session_start();
	$nombre = $_SESSION['nombre']; // para mandar a llamar el nombre del usuario que a entrado al portal
	//Comprobamos existencia de sesión
	if (!isset($_SESSION['nombre'])) 
	  	header('location: index.php');
	mysqli_set_charset($conexion,'utf8'); //Esta linea arregla que los acentos combobits
	if ($conexion->connect_error) //verificamos si hubo un error al conectar, recuerden que pusimos el @ para evitarlo
	{
	  die('Error de conexión: ' . $conexion->connect_error); //si hay un error termina la aplicación y mostramos el error
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Bienvenido Gerente</title> 
	<link href="../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="../librerias/alertifyjs/css/themes/default.css" rel="stylesheet" id="alertifyjs-css-themes">
	<link href="../librerias/alertify/css/alertify.css" rel="stylesheet" id="alertify-css">
	<link href="../librerias/alertifyjs/css/alertify.css" rel="stylesheet" id="alertifyjs-css">
	<link href="../librerias/select2/css/select2.css" rel="stylesheet" id="select2-css">
</head>
<body>
	<!--Barra de navegacion -->
	<nav class="navbar navbar-default" role="navigation">
		<div class="container-fluid">
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><a><span class="label label-primary">  Bienvenido gERENTE <?php echo $nombre ?> </span></a></li>
          <input hidden id="nombre" value="<?php echo $nombre ?>">

				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="../registro.php">Agregar Usuario</a></li> 
					<li><a href="CapacitacionGe.php">Capacitación Gerente</a></li>
					<li><a href="logout.php">Salir</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>



<script src="../librerias/jquery-3.3.1.min.js"></script>
<script src="../librerias/bootstrap/js/bootstrap.min.js"></script>

<script src="../js/funciones.js"></script>

<script src="../librerias/alertify/alertify.js"></script>
<script src="../librerias/select2/js/select2.js"></script>


</body>
</html>
