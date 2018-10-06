<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel.php");
			}
		</script>
	</head>
	<body>
		<?php
			if($_COOKIE["admingambas"] != "aceptacionadumbre"){
				header("Location: log.php");
				die();
			}
			
			if(!empty($_POST["nombre"])){
				include "../funcs/_conn.php";
				$link = conn();
				$id = "P".getTCode();
				$link->query("INSERT INTO `productos` (`ID`,`nombre`,`descripcion`,`categoria`,`precio`,`existencias`) VALUES ('".$id."','".$_POST["nombre"]."','".$_POST["descripcion"]."','".$_POST["categoria"]."','".$_POST["precio"]."','".$_POST["existencias"]."');");
				$link->close();
				
				move_uploaded_file($_FILES["imagenA"]["tmp_name"], "../img/productos/".$id."A.png");
				move_uploaded_file($_FILES["imagenB"]["tmp_name"], "../img/productos/".$id."B.png");
				move_uploaded_file($_FILES["imagenC"]["tmp_name"], "../img/productos/".$id."C.png");
				
				header("Location: panel_crearProducto.php");
				die();
			}
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<form action="panel_crearProducto.php" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Información general</legend>
				Nombre<br>
				<input type="text" name="nombre" value=""><br>
				Categoría<br>
				<input type="text" name="categoria" value=""><br>
				Descripción<br>
				<textarea name="descripcion" cols="40" rows="5"></textarea>
			</fieldset>
			<fieldset>
				<legend>Disponibilidad</legend>
				Precio<br>
				<input type="text" name="precio" value=""><br>
				Existencias<br>
				<input type="text" name="existencias" value=""><br>
			</fieldset>
			<fieldset>
				<legend>Imagenes</legend>
				Caja de kilo<br>
				<input type="file" name="imagenA"><br>
				Comparativa<br>
				<input type="file" name="imagenB"><br>
				Incono<br>
				<input type="file" name="imagenC"><br>
			</fieldset>
			<input type="submit" value="Crear">
		</form>
	</body>
</html>