<html>
	<head>
		<title>Administración</title>
	</head>
	<body>
		<?php
			if(!empty($_COOKIE["admingambas"]) and $_COOKIE["admingambas"] == "aceptacionadumbre"){
				header("Location: panel.php");
				die();
			}
			if(!empty($_POST["scode"]) && $_POST["scode"] == "pescadumbre"){
				setcookie("admingambas","aceptacionadumbre",0);
				header("Location: panel.php");
				die();
			}
			if(!empty($_GET["cerar"])){
				unset($_COOKIE["admingambas"]);
				setcookie("admingambas", "", time() - 3600);
				header("Location: log.php");
				die();
			}
		?>
		<form action="log.php" method="post">
			<fieldset>
				<legend>Acceso a administración</legend>
				Código Secreto:<br>
				<input type="text" name="scode" value=""><br>
				<input type="submit" value="Entrar">
			</fieldset>
		</form>
	</body>
</html>