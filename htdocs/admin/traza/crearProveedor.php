<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			if(!empty($_GET["mod"])){
				$barcos = "";
				$i = 1;
				while(!empty($_POST["barco".$i])){
					$barcos .= ($barcos==""?"":"|").$_POST["barco".$i];
					echo ($barcos==""?"":"|").$_POST["barco".$i]."<br>" ;
					$i++;
				}
				crearProveedor($_POST["nombre"],$barcos);
				Sleep(1);
				header("Location: verProveedor.php");
				die();
			}			
		?>
		<script>
			var n = 1;
			function agregarBarco(){
				barcos = new Array();
				for(i = 1; i <= n; i++){
					barcos[i] = document.getElementById("barco"+i).value;
				}
				n++;
				document.getElementById("barcos").innerHTML += 'Nombre del barco '+n+'<br><input type="text" id="barco'+n+'" name="barco'+n+'" value=""><br>';
				for(i = 1; i < n; i++){
					document.getElementById("barco"+i).value = barcos[i];
				}
			}
		</script>
	</head>
	<body>
		<h1 style="text-align:center;">Crear un nuevo proveedor</h1>
		
		<form action="?mod=true" method="post">
			<fieldset>
				<legend>Datos del proveedor</legend>
				Nombre<br>
				<input type="text" name="nombre" placeholder="EJ: Mariscolastico" value=""><br>
			</fieldset>
			<fieldset>
				<legend>Barcos</legend>
				<div id="barcos">
					Nombre del barco 1<br>
					<input type="text" id="barco1" name="barco1" value=""><br>
				</div>
				<br><input type="button" value="Agregar basco" onclick='agregarBarco();' />
			</fieldset>
			<input type="submit" value="Crear proveedor">
		</form>
		
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("panel.php");' />
	</body>
</html>