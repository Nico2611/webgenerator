<?php 
	session_start();
	require 'conexion.php';
	$conexion = dbconnect();
	if (isset($_SESSION["id"])) {
		header("location: panel.php");
	}
	$msg = "";
	// $conexion = mysqli_connect("mattprofe.com.ar","3905","cabra.arce.camion","3905");
	if (isset($_POST["btnSubmit"])) {
		$query = "SELECT * FROM `usuarios`";
				$res = mysqli_query($conexion,$query);
				while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
					if ($fila["email"] == $_POST["email"] && $fila["password"] == $_POST["password"]) {
						header('Location: panel.php');
						$_SESSION["id"] = $fila["idUsuario"];
						$_SESSION["email"] = $fila["email"];
						$_SESSION["password"] = $fila["password"];
						
					} else {
						$msg = "usuario o contraseña incorrectos";
					}
				}
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<center>
		<h1>webgenerator Nicolás Breton</h1> 
	</center>

	<form action="" method="POST">
		<label>Email:</label>
		<input type="email" name="email" required>
		<br> <br>
		<label>Password:</label>
		<input type="password" name="password" required>
		<input type="submit" name="btnSubmit" value="ingresar">
	</form>
	<br>
	<?php 
	echo $msg; ?>
	<br>
	<a href="register.php">¿Aún no te has registrado?</a>
</body>
</html>