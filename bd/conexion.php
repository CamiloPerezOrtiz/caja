<?php
	function conexion()
	{
		$servidor="localhost";
		$usuario="camilo";
		$password="182018camilo18";
		$bd="caja";
		$conexion=mysqli_connect($servidor,$usuario,$password,$bd);
		return $conexion;
	}
 ?>