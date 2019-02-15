<?php 
    include_once'../bd/conexion.php';
    $conexion=conexion();
    session_start();
    $nombre = $_SESSION['nombre'];
    $fecha=$_POST['fecha'];
    $prospecto=$_POST['prospecto'];
    $cita=$_POST['cita'];
    $llamada=$_POST['llamada'];
    $solicitud=$_POST['solicitud'];
    $solicitudp=$_POST['solicitudp'];
    $sql="INSERT into registro(fecha, nombre, prospecto, cita, llamada, solicitud, solicitudp) VALUES ('$fecha', '$nombre', '$prospecto', '$cita', '$llamada', '$solicitud', '$solicitudp')";
    $result=mysqli_query($conexion,$sql);
 ?>