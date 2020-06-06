<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			if(!empty($_GET["mod"])){
				crearCliente($_POST["nombre"], $_POST["poblacion"], $_POST["direccion"], $_POST["dni"]);
				Sleep(1);
				header("Location: verCliente.php");
				die();
			}			
		?>
	</head>
	<body>
		<h1 style="text-align:center;">Crear un nuevo cliente</h1>
		
		<form action="?mod=true" method="post">
			<fieldset>
				<legend>Datos del cliente</legend>
				Nombre<br>
				<input type="text" name="nombre" placeholder="EJ: Restaurante Manuel S.L." value=""><br>
				Población<br>
				<input type="text" name="poblacion" placeholder="EJ: Huelva" value=""><br>
				Dirección<br>
				<input type="text" name="direccion" placeholder="EJ: C. Alfonso XIII" value=""><br>
				DNI<br>
				<input type="text" name="dni" placeholder="EJ: 49279661E" value=""><br>
			</fieldset>
			<input type="submit" value="Crear cliente">
		</form>
		
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("panel.php");' />
	</body>
</html>