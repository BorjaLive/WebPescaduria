<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel_verProductos.php");
			}
		</script>
	</head>
	<body>
		<?php
			if($_COOKIE["admingambas"] != "aceptacionadumbre"){
				header("Location: log.php");
				die();
			}
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		<?php
		include "../funcs/_conn.php";
		$link = conn();
		if(!empty($_POST["nombre"])){
			$link->query("DELETE FROM `productos` WHERE `ID`='".$_GET["id"]."';");
			$link->query("INSERT INTO `productos` (`ID`,`nombre`,`descripcion`,`categoria`,`precio`,`existencias`) VALUES ('".$_GET["id"]."','".$_POST["nombre"]."','".$_POST["descripcion"]."','".$_POST["categoria"]."','".$_POST["precio"]."','".$_POST["existencias"]."');");
			$link->close();
			move_uploaded_file($_FILES["imagenA"]["tmp_name"], "../img/productos/".$_GET["id"]."A.png");
			move_uploaded_file($_FILES["imagenB"]["tmp_name"], "../img/productos/".$_GET["id"]."B.png");
			move_uploaded_file($_FILES["imagenC"]["tmp_name"], "../img/productos/".$_GET["id"]."C.png");
			$link->close();
			header("Location: panel_productoEditar.php?id=".$_GET["id"]);
			die();
		}
		$result = $link->query("SELECT * FROM `productos` WHERE `ID`='".$_GET["id"]."'");
		$row = $result->fetch_assoc();
		?>
		<form action="panel_productoEditar.php?id=<?php echo $_GET["id"]; ?>" method="post" enctype="multipart/form-data">
			<fieldset>
				<legend>Información general</legend>
				Nombre<br>
				<input type="text" name="nombre" value="<?php echo $row["nombre"]; ?>"><br>
				Categoría<br>
				<input type="text" name="categoria" value="<?php echo $row["categoria"]; ?>"><br>
				Descripción<br>
				<textarea name="descripcion" cols="40" rows="5"><?php echo $row["descripcion"]; ?></textarea>
			</fieldset>
			<fieldset>
				<legend>Disponibilidad</legend>
				Precio<br>
				<input type="text" name="precio" value="<?php echo $row["precio"]; ?>"><br>
				Existencias<br>
				<input type="text" name="existencias" value="<?php echo $row["existencias"]; ?>"><br>
			</fieldset>
			<fieldset>
				<legend>Imagenes</legend>
				Caja de kilo<br>
				<img src="../img/productos/<?php echo $_GET["id"]; ?>A.png" width="250" height=auto>
				<input type="file" name="imagenA"><br>
				Comparativa<br>
				<img src="../img/productos/<?php echo $_GET["id"]; ?>B.png" width="250" height=auto>
				<input type="file" name="imagenB"><br>
				Incono<br>
				<img src="../img/productos/<?php echo $_GET["id"]; ?>C.png" width="250" height=auto>
				<input type="file" name="imagenC"><br>
			</fieldset>
			<input type="submit" value="Modificar">
		</form>
		<?php
			$link->close();
		?>
	</body>
</html>