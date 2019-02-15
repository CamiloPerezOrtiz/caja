<?php
include 'conexion.php';
if (isset($_POST['submit'])) {   
    if(is_uploaded_file($_FILES['fichero']['tmp_name'])) { 
     
     
      // creamos las variables para subir a la db
        $ruta = "upload/"; 
        $nombrefinal= trim ($_FILES['fichero']['name']); //Eliminamos los espacios en blanco
        $nombrefinal= ereg_replace (" ", "", $nombrefinal);//Sustituye una expresión regular
        $upload= $ruta . $nombrefinal;  



        if(move_uploaded_file($_FILES['fichero']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion 
                    
                    echo "<b>Upload exitoso!. Datos:</b><br>";  
                    echo "Nombre: <i><a href=\"".$ruta . $nombrefinal."\">".$_FILES['fichero']['name']."</a></i><br>";  
                    echo "Tipo MIME: <i>".$_FILES['fichero']['type']."</i><br>";  
                    echo "Peso: <i>".$_FILES['fichero']['size']." bytes</i><br>";  
                    echo "<br><hr><br>";  
                         


                   $nombre  = $_POST["nombre"]; 
                   $description  = $_POST["description"]; 


                   $query = "INSERT INTO archivos (name,description,ruta,tipo,size) 
    VALUES ('$nombre','$description','".$nombrefinal."','".$_FILES['fichero']['type']."','".$_FILES['fichero']['size']."')"; 

       mysql_query($query) or die(mysql_error()); 
       echo "El archivo '".$nombre."' se ha subido con éxito <br>";       
        }  
    }  
 } 
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Capacitación Gerente</title> 
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
					<li><a><span class="label label-primary">  Bienvenido Gerente</span></a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
					
					<li><a href="gerente.php">Regresar</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
<h4>Documentos de Capacitación </h4>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">  
    Seleccione archivo: <input name="fichero" type="file" size="150" maxlength="150">  
    <br><br> Nombre: <input name="nombre" type="text" size="70" maxlength="70"> 
    <br><br> Descripcion: <input name="description" type="text" size="100" maxlength="250"> 
    <br><br> 
  <input name="submit" type="submit" value="SUBIR ARCHIVO">   
</form>  




<script src="../librerias/jquery-3.3.1.min.js"></script>
<script src="../librerias/bootstrap/js/bootstrap.min.js"></script>

<script src="../js/funciones.js"></script>

<script src="../librerias/alertify/alertify.js"></script>
<script src="../librerias/select2/js/select2.js"></script>


</body>
</html>