<?php
    if(isset($_POST['enviar']))
    {
        # Se manda a llamar el archivo de conexion a la base de datos #
        include 'bd/conexion.php';
        # Se estable una varaible para la conexion de base de datos #
        $conexion = conexion();
        # Se recupera los datos enviados a traves del formulario #
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];
        $confirmar_contrasena = $_POST['confirmar_contrasena'];
        $gerente = $_POST['gerente'];
        $usuario = $_POST['usuario'];
        # Se evalua si las contraseñas son iguales de lo contrario se notifica al usuario #
        if($contrasena === $confirmar_contrasena)
        {
            # Se encrypta la contraseña utilizando el metodo password_hash #
            $contrasena_encryptada = password_hash($contrasena, PASSWORD_DEFAULT);
            # Se hace la consulta para insertar los datos #
            $insertar = "INSERT INTO usuario(nombre, password, gerente, tipo) 
                VALUES ('$nombre','$contrasena_encryptada', '$gerente', '$usuario')";
            # Antes de insertar se hace una evaluacion para saber si el nombre ya existe o no #
            $verificar = mysqli_query($conexion, "SELECT nombre FROM usuario WHERE nombre = '$nombre'");
            if (mysqli_num_rows($verificar) > 0)
            {
                echo '<script> 
                        alert("El nombre ya esta registrado.");
                        window.history.go(-1);
                     </script>
                     ';
                exit;
            }
            $resultado = mysqli_query($conexion, $insertar);
            if(!$resultado)
                echo '<script> 
                        alert("Problemas con el servidor intente mas tarde");
                     </script> 
                     ';
            else
                echo '<script> 
                        alert("Usuario registrado con exito.");
                        location.href ="gerente.php";
                     </script> 
                     ';
        }
        else
            echo '<script> 
                        alert("Las contrtaseñas no coinciden. Por favor vuelva a intentarlo.");
                        window.history.go(-1);
                     </script> 
                     ';
        mysqli_close($conexion);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Caja-Corte </title>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-jp"> 
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link href="librerias/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>
<body> 
    <!--Barra de navegacion -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a><span class="label label-primary">  Bienvenido Gerente</span></a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="well">
                    <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <!--action_nombre de la pagina y se crea una variable global el formulario a la misma pagina -->
                        <legend class="text-center header">Registro</legend>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Nombre</label>
                                <input id="nombre" name="nombre" type="text" placeholder="Nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Contraseña</label>
                                <input id="contrasena" name="contrasena" type="password" placeholder="Contraseña" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Confirmar contraseña</label>
                                <input id="confirmar_contrasena" name="confirmar_contrasena" type="password" placeholder="Confirmar contraseña" class="form-control" required>
                            </div>
                        </div>
                          
                          <div class="form-group">
                            <div class="col-md-12">
                                <label>Gerente</label>
                                <select class="form-control" name="gerente" id="gerente" required>
                                    <option value="1">Roberto</option>
                                    <option value="2">Martin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Tipo de usuario</label>
                                <select class="form-control" name="usuario" id="usuario" required>
                                    <option value="1">Gerente</option>
                                    <option value="2">Agente</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary" name="enviar">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    <script src="librerias/jquery-3.3.1.min.js"></script>
    <script src="librerias/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
