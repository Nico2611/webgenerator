<?php 
	$sql = mysqli_connect("mattprofe.com.ar","3905","cabra.arce.camion","3905");
	$query = "DELETE FROM `webs` WHERE dominio = '".$_GET["web"]."'";
	$res = mysqli_query($sql,$query);
				
	shell_exec('rm -r '.$_GET["web"]);
	header('location: panel.php');

 ?>