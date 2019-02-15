<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Bienvenido Agente</title> 
	<link href="../librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="../librerias/alertifyjs/css/themes/default.css" rel="stylesheet" id="alertifyjs-css-themes">
	<link href="../librerias/alertify/css/alertify.css" rel="stylesheet" id="alertify-css">
	<link href="../librerias/alertifyjs/css/alertify.css" rel="stylesheet" id="alertifyjs-css">
	<link href="../librerias/select2/css/select2.css" rel="stylesheet" id="select2-css">
</head>
<body>
<nav class="navbar navbar-inverse">
  	<div class="container-fluid">
    	<div class="navbar-header">
      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>
        		<span class="icon-bar"></span>                        
      		</button>
      		<a class="navbar-brand" href="agente.php">GAM</a>
    	</div>
    	<div class="collapse navbar-collapse" id="myNavbar">
      		<ul class="nav navbar-nav">
        		<li><a href="capacitacion.php">Capacitación</a></li>
        		<li><a href="estadisticas.php">Estadisticas</a></li>
        		<li><a href="#" data-toggle="modal" data-target="#modalcambiarContrasena">Cambiar Contraseña</a></li>
      		</ul>
      		<ul class="nav navbar-nav navbar-right">
        		<li><a href="#"><span class="glyphicon glyphicon-user"></span> Bienvenido  <?php echo $nombre ?></a></li>
        		<li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
      		</ul>
    	</div>
  	</div>
</nav>