<?php
    include 'bd/conexion.php';
    $conexion = conexion();
    // Desactivar toda notificación de error, 0 significa que desactiva los errores en tiempo de ejecucion, el -1 te notifica
    error_reporting(0);
    session_start();  
    if(isset($_POST['iniciar_sesion']))
    {
        $nombre = htmlentities(addslashes($_POST['nombre']));
        $contrasena = htmlentities(addslashes($_POST['contrasena']));
        if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['contrasena']) && !empty($_POST['contrasena']))
        {
            $consulta_nombre = "SELECT nombre, password, tipo FROM usuario WHERE nombre='$nombre'";
            $resultado_consulta = mysqli_query($conexion,$consulta_nombre);
            $sesion = mysqli_fetch_array($resultado_consulta);
            if(password_verify($contrasena, $sesion['password']))
            {
                session_start();
                $_SESSION['nombre'] = $nombre;
                if($sesion['tipo'] == 1) 
                    header('location: php/gerente.php');
                else 
                    header("location: php/agente.php");
            }
            else{
                echo "<br>
                <div class='container'>
                <div class='col-md-12'>
                <div class='alert alert-danger' aria-label='Close'>
                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Datos incorrectos. Vuelva a intentar.
                </div>
                </div>
                </div>";
                session_destroy();
            }
        }
        else
            echo "<br>
        <div class='container'>
        <div class='col-md-12'>
        <div class='alert alert-info' aria-label='Close'>
        <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Info!</strong> Todos los campos son obligatorios.
        </div>
        </div>
        </div>";
        mysqli_close($conexion);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Caja-Corte</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="imagenes/gam.ico">
</head>
<body>    
    <div class="col-md-12" class="center-block">
        <br>
        <div class="modal-dialog" class="center-block">
            <center><img class="img-responsive" src="imagenes/imagen.jpg"></center>
            <br><br>
            <div class="modal-content" class="center-block">
                <div class="panel-heading" class="center-block">
                    <h3 class="panel-title text-center">Bienvenido  'Ingrese sus Datos'</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" role="class-form">
                        <fieldset>
                            <div class="form-group">
                                <label>Usuario</label>
                                <input class="form-control" placeholder="Usuario" name="nombre" type="text" autofocus="">
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <input class="form-control" placeholder="Contraseña" name="contrasena" type="password">
                            </div>
                            <center><button type="submit" class="btn btn-primary" name="iniciar_sesion">INGRESAR</button></center>
                            <br>
                            <p class="text-center"><a href="#">Olvidaste tu contraseña</a> </p>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container text-center">
            <span>Software GAM <sup>©</sup> Todos los Derechos Reservados.</span>
        </div>
    </footer>
    <script src="librerias/jquery-3.3.1.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove(); 
            });
        },
        4000);
    </script>
</body>
</html>