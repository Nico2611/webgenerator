<?php 
 function dbconnect(){
	$conexion = mysqli_connect("localhost", "adm_webgenerator", "webgenerator2020", "webgenerator");

 	return $conexion;
}
?>
