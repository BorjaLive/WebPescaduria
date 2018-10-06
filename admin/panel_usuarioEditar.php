<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel_verUsuarios.php");
			}
			var n = 0;
		</script>
	</head>
	<body>
		<?php
			if($_COOKIE["admingambas"] != "aceptacionadumbre"){
				header("Location: log.php");
				die();
			}
			include "../funcs/_conn.php";
			$link = conn();
			
			if(!empty($_GET["mod"])){
				$empresa = empty($_POST["empresa"])?"NAN":$_POST["empresa"];
				$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$_GET["id"]."'");
				$row = $result->fetch_assoc();
				if(empty($_POST["hash"])){
					$hash = $row["hash"];
				}else{
					$hash = md5($_POST["hash"]);
				}
				$link->query("DELETE FROM `usuarios` WHERE `ID`='".$_GET["id"]."';");
				$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$_GET["id"]."','".$_POST["nombre"]."','".$_POST["apellido"]."','".$_POST["email"]."','".$hash."','".$empresa."','".$_POST["pais"]."|".$_POST["provincia"]."|".$_POST["localidad"]."|".$_POST["cp"]."|".$_POST["direccion1"]."|".$_POST["direccion2"]."','".$row["cesta"]."','".$_POST["telefono"]."','".$_POST["dni"]."','".$_POST["estado"]."');");
				$link->close();
				if($_POST["estado"] == 1){
					//enviarCorreo($_POST["email"],$_POST["nombre"],"Registro en [NOMBRE_EMPRESA]","Active su cuenta en el siguiente enlace <a href='http://localhost/funcs/account_activate.php?id=".$_GET["id"]."'>LINK</a>","<h2>Error en el proceso de registro.</h2><h3>Por favor, pongase en contacto con el servicio de ayuda al cliente.</h3>","");
				}else{
					if($_POST["estado"] == 3){
						$array_remplazo = array('MOTIVO' => $_POST["comentario"]);
						sendMail($_POST["email"],"","","cancelacion",$array_remplazo,"Cancelacion [NOMBRE DE EMPRESA]","");
					}
				}
				
				header("Location: panel_usuarioEditar.php?id=".$_GET["id"]);
				die();
			}
			if(!empty($_GET["rel"])){
				$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$_GET["id"]."'");
				$row = $result->fetch_assoc();
				$link->query("DELETE FROM `usuarios` WHERE `ID`='".$_GET["id"]."';");
				$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$row["ID"]."','".$row["nombre"]."','".$row["apellido"]."','".$row["email"]."','".$row["hash"]."','".$row["empresa"]."','".$row["direccion"]."','','".$row["telefono"]."','".$row["dni"]."','".$row["estado"]."');");
				$link->close();
				header("Location: panel_usuarioEditar.php?id=".$_GET["id"]);
				die();
			}
			if(!empty($_GET["delete"])){
				$link->query("DELETE FROM `usuarios` WHERE `ID`='".$_GET["id"]."';");
				$link->close();
				header("Location: panel_verUsuarios.php");
				die();
			}
			
			$result = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$_GET["id"]."'");
			$row = $result->fetch_assoc();
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<form action="panel_usuarioEditar.php?mod=true&id=<?php echo $_GET["id"]; ?>" method="post">
			<fieldset>
				<legend>Información general</legend>
				Nombre<br>
				<input type="text" name="nombre" value="<?php echo $row["nombre"]; ?>"><br>
				Apellidos<br>
				<input type="text" name="apellido" value="<?php echo $row["apellido"]; ?>"><br>
				Correo electrónico<br>
				<input type="text" name="email" value="<?php echo $row["email"]; ?>"><br>
				Teléfono<br>
				<input type="text" name="telefono" value="<?php echo $row["telefono"]; ?>"><br>
				Empresa (En blanco si no procede)<br>
				<input type="text" name="empresa" value="<?php echo $row["empresa"]=="NAN"?"":$row["empresa"]; ?>"><br>
				Contraseña (No se almacenan contraseñas)<br>
				<input type="password" name="hash" value="">MD5: <?php echo $row["hash"]; ?><br>
				Estado<br>
				<select onChange="cambiarEstado();" id="cuentaEstado" name="estado">
					<option <?php echo $row["estado"]==1?"selected":""; ?> value="1">Sin verificar</option>
					<option <?php echo $row["estado"]==2?"selected":""; ?> value="2">Activa</option>
					<option <?php echo $row["estado"]==3?"selected":""; ?> value="3">Cancelada</option>
				</select><br>
				DNI<br>
				<input type="text" name="dni" value="<?php echo $row["dni"]; ?>">
			</fieldset>
			<fieldset id="cancelacion" style="display:none;">
				<legend>Cancelación</legend>
				Motivo de la cancelación<br>
				<textarea class="customer-comment" name="comentario" cols="60" rows="1"></textarea>
			</fieldset>
			<fieldset>
				<legend>Dirección</legend>
				<?php
				$productos = explode('|',$row["direccion"]);
				echo 'Pais<br>
					<input type="text" name="pais" value="'.$productos[0].'"><br>
					Provincia<br>
					<input type="text" name="provincia" value="'.$productos[1].'"><br>
					Localidad<br>
					<input type="text" name="localidad" value="'.$productos[2].'"><br>
					Código Postal<br>
					<input type="text" name="cp" value="'.$productos[3].'"><br>
					Dirección 1<br>
					<input type="text" name="direccion1" value="'.$productos[4].'"><br>
					Dirección 2<br>
					<input type="text" name="direccion2" value="'.$productos[5].'"><br>';
				?>
			</fieldset>
			<input type="submit" value="Modificar">
		</form><br>
		<form action="panel_usuarioEditar.php?rel=true&id=<?php echo $_GET["id"]; ?>" method="post">
			<input type="submit" value="Borrar cesta">
		</form>
		<br>
		<form action="panel_usuarioEditar.php?delete=true&id=<?php echo $_GET["id"]; ?>" method="post">
			<input type="submit" value="Borrar usuario">
		</form>
		<script>
			function cambiarEstado(){
				if(document.getElementById("cuentaEstado").value == 3){
					document.getElementById("cancelacion").style.display="block";
				}else{
					document.getElementById("cancelacion").style.display="none";
				}
			}
		</script>
	</body>
</html>