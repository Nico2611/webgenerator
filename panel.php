<?php  

	session_start();
	require 'conexion.php';
	$conexion = dbconnect();
	if (!isset($_SESSION["id"])) {
		header("location: login.php");
	}

	$msg = "";
	$aux = "";
	if (isset($_POST["btnSubmit"])) {

		$query = "SELECT * FROM `webs`";
		$nweb = $_SESSION["id"].$_POST["web"];
				$res = mysqli_query($conexion,$query);
				
					while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
						if ($fila["dominio"] == $nweb) {
							$msg = "web ya creada";
							$aux = 1;
						}
					}
					if ($aux!=1) {
						$query = "INSERT INTO `webs` (`idUsuario`, `dominio`, `fechaCreacion`) VALUES ('".$_SESSION["id"]."', '".$nweb."', CURRENT_TIMESTAMP)";

						$res = mysqli_query($conexion,$query);
						var_dump($res);
						shell_exec('./wix.sh '.$nweb);
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
		<h2>Bienvenido al panel</h2>
	</center>
	<br>
	<a href="logout.php">Cerrar Sesión de <?php echo ($_SESSION["id"]) ?></a>
	<br>
	<form action="" method="POST">
		<label>Generar web de:</label><br />
		<input type="text" name="web" required>
		<input type="submit" name="btnSubmit" value="ingresar"><br />
	</form>
	<?php echo $msg; ?>
	<?php 
		$query = "SELECT * FROM `webs` WHERE idUsuario = ".$_SESSION["id"].";";
		$res = mysqli_query($conexion,$query);
					echo "Dominios: <br>";

	 	while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

			echo ('<a href="'.$fila["dominio"].'">'.$fila["dominio"].' </a>');
			echo ('<a href="downloader.php?web='.$fila["dominio"].'">Descargar web </a>');
			echo ('<a href="deleter.php?web='.$fila["dominio"].'">Eliminar </a>');
			echo "<br>";
		}

		if ($_SESSION["email"] === "admin@server.com" && $_SESSION["password"] === "serveradmin") {
				$query = "SELECT * FROM `webs`;";
				$res = mysqli_query($conexion,$query);
				echo "lista de todos los dominios: <br>";
 				while ($fila = mysqli_fetch_array($res, MYSQLI_ASSOC)) {

					echo ('<a href="'.$fila["dominio"].'">'.$fila["dominio"].' </a>');
					echo "<br>";
				}
		}




	 ?>
</body>
</html>