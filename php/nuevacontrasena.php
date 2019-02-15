<?php
	require_once "../bd/conexion.php";
	$conexion=conexion();
	session_start();
    $nombre = $_SESSION['nombre'];
	$password_uno=$_POST['password_uno'];
	$password_dos=$_POST['password_dos'];
	if($password_uno === $password_dos)
    {
        # Se encrypta la contraseña utilizando el metodo password_hash #
        $contrasena_encryptada = password_hash($password_uno, PASSWORD_DEFAULT);
        # Se hace la consulta para insertar los datos #
        $actualizar = "UPDATE usuario SET password = '$contrasena_encryptada' WHERE nombre = '$nombre'";
        $resultado = mysqli_query($conexion, $actualizar);
        if(!$resultado)
            echo '<script> 
                    alert("Problemas con el servidor intente mas tarde");
                 </script> 
                 ';
        else
        {
            echo "<br>
                <div class='container'>
                <div class='col-md-12'>
                <div class='alert alert-success' aria-label='Close'>
                <a href='#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                <strong>Info!</strong> Contraseña actualizada con exito.
                </div>
                </div>
                </div>";
                session_destroy();
                header('Location: ../index.php');
        }
    }
    else
        echo '<script> 
                    alert("Las contrtaseñas no coinciden. Por favor vuelva a intentarlo.");
                    window.history.go(-1);
                 </script> 
                 ';
	$sql = "UPDATE usuario SET password='password' WHERE id=''";

	if (mysqli_query($conexion, $sql)) {
    	echo "Record updated successfully";
	} else {
    	echo "Error updating record: " . mysqli_error($conexion);
	}	mysqli_close($conexion);

?>