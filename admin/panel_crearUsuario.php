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
			
			if(!empty($_GET["mod"])){
				include "../funcs/_conn.php";
				$link = conn();
				$id = "U".getTCode();
				if(empty($_POST["empresa"])){
					$empresa = "NAN";
				}else{
					$empresa = $_POST["empresa"];
				}
				$link->query("INSERT INTO `usuarios` (`ID`,`nombre`,`apellido`,`email`,`hash`,`empresa`,`direccion`,`cesta`,`telefono`,`dni`,`estado`) VALUES ('".$id."','".$_POST["nombre"]."','".$_POST["apellido"]."','".$_POST["email"]."','".md5($_POST["hash"])."','".$empresa."','".$_POST["pais"]."|".$_POST["provincia"]."|".$_POST["localidad"]."|".$_POST["cp"]."|".$_POST["direccion1"]."|".$_POST["direccion2"]."','','".$_POST["telefono"]."','".$_POST["dni"]."','".$_POST["estado"]."');");
				$link->close();
				if($_POST["estado"] == 1){
					include "../funcs/mail.php";
					enviarCorreo($_POST["email"],$_POST["nombre"],"Registro en [NOMBRE_EMPRESA]","Active su cuenta en el siguiente enlace <a href='http://localhost/funcs/account_activate.php?id=".$id."'>LINK</a>","<h2>Error en el proceso de registro.</h2><h3>Por favor, pongase en contacto con el servicio de ayuda al cliente.</h3>","");

				}
				
				header("Location: panel_crearUsuario.php");
				die();
			}
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<form action="panel_crearUsuario.php?mod=true" method="post">
			<fieldset>
				<legend>Información general</legend>
				Nombre<br>
				<input type="text" name="nombre" value=""><br>
				Apellidos<br>
				<input type="text" name="apellido" value=""><br>
				Correo electrónico<br>
				<input type="text" name="email" value=""><br>
				Teléfono<br>
				<input type="text" name="telefono" value=""><br>
				Empresa (En blanco si no procede)<br>
				<input type="text" name="empresa" value=""><br>
				Contraseña<br>
				<input type="password" name="hash" value=""><br>
				Estado<br>
				<select name="estado">
					<option value="1">Sin verificar</option>
					<option select value="2">Activa</option>
					<option value="3">Cancelada</option>
				</select><br>
				DNI<br>
				<input type="text" name="dni" value="">
			</fieldset>
			<fieldset>
				<legend>Dirección</legend>
				Pais<br>
				<input type="text" name="pais" value=""><br>
				Provincia<br>
				<input type="text" name="provincia" value=""><br>
				Localidad<br>
				<input type="text" name="localidad" value=""><br>
				Código Postal<br>
				<input type="text" name="cp" value=""><br>
				Dirección 1<br>
				<input type="text" name="direccion1" value=""><br>
				Dirección 2<br>
				<input type="text" name="direccion2" value=""><br>
			</fieldset>
			<input type="submit" value="Crear">
		</form>
	</body>
</html>