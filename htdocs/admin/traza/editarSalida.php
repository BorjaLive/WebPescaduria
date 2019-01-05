<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			if(!empty($_GET["mod"])){
				$_POST["kg"] = str_replace(",",".",$_POST["kg"]);
				
				$id = empty($_POST["id"])?getSiguiente("salida"):$_POST["id"];
				$fecha = empty($_POST["fecha"])?getFechaActual():$_POST["fecha"];
				
				$salidaOld = getSalida($_GET["numero"]);
				eliminarSalida($_GET["numero"]);
				creaSalida($_POST["entrada"], $fecha, $_POST["genero"], $_POST["escandallo"], $_POST["kg"], $_POST["proveedor"], $_POST["barco"], $_POST["marea"], $id,$_POST["envase"],$_POST["etiquetado"],$_POST["caducidad"],$_POST["aspecto"],$_POST["temperatura"]);
				
				$entrada = getEntrada($_POST["entrada"]);
				eliminarEntrada($_POST["entrada"]);
				crearEntrada($entrada["id"], $entrada["fecha"], $entrada["genero"], $entrada["kg"], $entrada["escandallo"], $entrada["proveedor"], $entrada["barco"], $entrada["marea"], $entrada["envase"], $entrada["etiquetado"], $entrada["caducidad"], $entrada["aspecto"], $entrada["temperatura"],$entrada["restante"]-$_POST["kg"]+$salidaOld["kg"]);
				
				Sleep(1);
				header("Location: verSalida.php");
				die();
			}else{
				$salida = getSalida($_GET["numero"]);
			}
			if(!empty($_GET["del"])){
				$salidaOld = getSalida($_GET["numero"]);
				$entrada = getEntrada($salidaOld["entrada"]);
				eliminarEntrada($salidaOld["entrada"]);
				crearEntrada($entrada["id"], $entrada["fecha"], $entrada["genero"], $entrada["kg"], $entrada["escandallo"], $entrada["proveedor"], $entrada["barco"], $entrada["marea"], $entrada["envase"], $entrada["etiquetado"], $entrada["caducidad"], $entrada["aspecto"], $entrada["temperatura"],$entrada["restante"]+$salidaOld["kg"]);
				eliminarSalida($_GET["numero"]);
				Sleep(1);
				header("Location: verSalida.php");
				die();
			}
		?>
		<script>
			function autocompletar(){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						var datos = xmlhttp.responseText.split("|");
						document.getElementById("genero").value = datos[2];
						document.getElementById("escandallo").value = datos[4];
						document.getElementById("nombre").value = datos[5];
						document.getElementById("barco").value = datos[6];
						document.getElementById("marea").value = datos[7];
						document.getElementById("envase").value = datos[8];
						document.getElementById("etiquetado").value = datos[9];
						document.getElementById("caducidad").value = datos[10];
						document.getElementById("aspecto").value = "B";
						document.getElementById("temperatura").value = datos[11];
					}
				}
				xmlhttp.open("POST", "funcs/ajaxLib.php", true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("task=getEntradaData&nombre="+document.getElementById("entrada").value);
			}
		</script>
	</head>
	<body>
		<h1 style="text-align:center;">Editar una salida</h1>
		
		<form action="?mod=true&numero=<?php echo($_GET["numero"]);?>" method="post">
			<fieldset>
				<legend>Identificación</legend>
				Número de salida<br>
				<input type="text" name="id" value="<?php echo $salida["id"];?>"><br>
				Fecha<br>
				<input type="text" name="fecha" value="<?php echo $salida["fecha"];?>">
			</fieldset>
			<fieldset>
				<legend>Datos del producto</legend>
				Número de entrada<br>
				<input type="text" id="entrada" name="entrada" value="<?php echo $salida["entrada"];?>"><input type="button" value="Autocompletar" onclick='autocompletar();' /><br>
				Género<br>
				<input type="text" id="genero" name="genero" value="<?php echo $salida["genero"];?>"><br>
				Kg<br>
				<input type="text" name="kg" placeholder="EJ: 50" value="<?php echo $salida["kg"];?>"><br>
				Escandallo<br>
				<input type="text" id="escandallo" name="escandallo" value="<?php echo $salida["escandallo"];?>">
			</fieldset>
			<fieldset>
				<legend>Datos del procedencia</legend>
				Proveedor<br>
				<input type="text" id="nombre" name="proveedor" value="<?php echo $salida["proveedor"];?>"><br>
				Barco<br>
				<input type="text" id="barco" name="barco" value="<?php echo $salida["barco"];?>"><br>
				Marea<br>
				<input type="text" id="marea" name="marea" value="<?php echo $salida["marea"];?>">
			</fieldset>
			<fieldset>
				<legend>Datos adicionales</legend>
				Envase<br>
				<input type="text" id="envase" name="envase" value="<?php echo $salida["envase"];?>"><br>
				Etiquetado<br>
				<input type="text"id="etiquetado" name="etiquetado" value="<?php echo $salida["etiquetado"];?>"><br>
				Caducidad<br>
				<input type="text" id="caducidad" name="caducidad" value="<?php echo $salida["caducidad"];?>"><br>
				Aspecto<br>
				<input type="text" id="aspecto" name="aspecto" value="<?php echo $salida["aspecto"];?>"><br>
				Temperatura<br>
				<input type="text" id="temperatura" name="temperatura" value="<?php echo $salida["temperatura"];?>">
			</fieldset>
			<input type="submit" value="Modificar salida">
			<br><br><input type="button" value="Eliminar salida" onclick='window.location.replace("?del=true&numero=<?php echo($_GET["numero"]);?>");'>
		</form>
		<script>
		</script>
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("panel.php");' />
	</body>
</html>