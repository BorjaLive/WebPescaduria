<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			if(!empty($_GET["mod"])){
				eliminarCliente($_GET["nombre"]);
				crearCliente($_POST["nombre"], $_POST["poblacion"], $_POST["direccion"], $_POST["dni"]);
				Sleep(1);
				header("Location: verCliente.php");
				die();
			}else{
				$cliente = getCliente($_GET["nombre"]);
			}
			if(!empty($_GET["del"])){
				eliminarCliente($_GET["nombre"]);
				Sleep(1);
				header("Location: verCliente.php");
				die();
			}
		?>
	</head>
	<body>
		<h1 style="text-align:center;">Editar un cliente</h1>
		
		<form action="?mod=true&nombre=<?php echo $cliente["nombre"];?>" method="post">
			<fieldset>
				<legend>Datos del cliente</legend>
				Nombre<br>
				<input type="text" name="nombre" placeholder="EJ: Restaurante Manuel S.L." value="<?php echo $cliente["nombre"];?>"><br>
				Población<br>
				<input type="text" name="poblacion" placeholder="EJ: Huelva" value="<?php echo $cliente["poblacion"];?>"><br>
				Dirección<br>
				<input type="text" name="direccion" placeholder="EJ: C. Alfonso XIII" value="<?php echo $cliente["direccion"];?>"><br>
				DNI<br>
				<input type="text" name="dni" placeholder="EJ: 49279661E" value="<?php echo $cliente["DNI"];?>"><br>
			</fieldset>
			<input type="submit" value="Modificar cliente">
			<br><br><input type="button" value="Eliminar cliente" onclick='window.location.replace("?del=true&nombre=<?php echo($_GET["nombre"]);?>");'>
		</form>
		
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("verCliente.php");' />
	</body>
</html>