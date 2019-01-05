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
				
				eliminarEntrada($_GET["numero"]);
				
				$id = empty($_POST["id"])?getSiguiente("entrada"):$_POST["id"];
				$fecha = empty($_POST["fecha"])?getFechaActual():$_POST["fecha"];
				if($_POST["nombre"] == "nuevo"){
					$proveedor = $_POST["Nnombre"];
					$barco = $_POST["Nbarco"];
					crearProveedor($proveedor,$_POST["Nbarco"]);
				}else{
					$proveedor = $_POST["nombre"];
				}
				if($_POST["barco"] == "nuevo"){
					if($_POST["nombre"] != "nuevo"){
						$barco = $_POST["Nbarco"];
						$provedorDatos = getProveedor($proveedor);
						eliminarProveedor($proveedor);
						crearProveedor($proveedor,$provedorDatos["barcos"]==""?$_POST["Nbarco"]:$provedorDatos["barcos"]."|".$_POST["Nbarco"]);
					}
					
				}else{
					$barco = $_POST["barco"];
				}
				crearEntrada($id,$fecha,$_POST["genero"],$_POST["kg"],$_POST["escandallo"],$proveedor,$barco,$_POST["marea"],$_POST["envase"],$_POST["etiquetado"],$_POST["caducidad"],$_POST["aspecto"],$_POST["temperatura"],$_POST["restante"]);
				Sleep(1);
				header("Location: verEntrada.php");
				die();
			}else{
				$entrada = getEntrada($_GET["numero"]);
			}
			if(!empty($_GET["del"])){
				eliminarEntrada($_GET["numero"]);
				Sleep(1);
				header("Location: verEntrada.php");
				die();
			}
		?>
		<script>
			function proveedorCambio(){
				if(document.getElementById("nombre").value == "nuevo"){
					document.getElementById("Nnombre").style.display = "block";
					document.getElementById("Nbarco").style.display = "block";
					document.getElementById("barcosLista").innerHTML = '<select id="barco" onChange="barcoCambio();" name="barco"><option value="nuevo">Nuevo</option></select><br>';
				}else{
					document.getElementById("Nnombre").style.display = "none";
					document.getElementById("barcosLista").innerHTML = "";
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function(){
						if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
							document.getElementById("Nbarco").style.display = "none";
							document.getElementById("barcosLista").innerHTML = '<select id="barco" onChange="barcoCambio();" name="barco">'+xmlhttp.responseText+'<option value="nuevo">Nuevo</option></select><br>';
						}
					}
					xmlhttp.open("POST", "funcs/ajaxLib.php", true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("task=getBarcosOpt&nombre="+document.getElementById("nombre").value);
				}
			}
			function barcoCambio(){
				if(document.getElementById("barco").value == "nuevo"){
					document.getElementById("Nbarco").style.display = "block";
				}else{
					document.getElementById("Nbarco").style.display = "none";
				}
			}
		</script>
	</head>
	<body>
		<h1 style="text-align:center;">Editar una entrada</h1>
		
		<form action="?mod=true&numero=<?php echo $_GET["numero"];?>" method="post">
			<fieldset>
				<legend>Datos del cliente</legend>
				Número<br>
				<input type="text" name="id" value="<?php echo $entrada["id"];?>"><br>
				Fecha<br>
				<input type="text" name="fecha" value="<?php echo $entrada["fecha"];?>">
			</fieldset>
			<fieldset>
				<legend>Datos del producto</legend>
				Género<br>
				<input type="text" name="genero" value="<?php echo $entrada["genero"];?>"><br>
				Kg<br>
				<input type="text" name="kg" value="<?php echo $entrada["kg"];?>"><br>
				Escandallo<br>
				<input type="text" name="escandallo" value="<?php echo $entrada["escandallo"];?>">
			</fieldset>
			<fieldset>
				<legend>Datos del procedencia</legend>
				Proveedor<br>
				<select id="nombre" onChange="proveedorCambio();" name="nombre">
					<?php
						$proveedores = getProveedores(0);
						$prov = 0;
						$i = 0;
						foreach( $proveedores as $key => $value ) {
							echo '<option '.($entrada["proveedor"]==$proveedores[$key]["nombre"]?"selected":"").' value="'.$proveedores[$key]["nombre"].'">'.$proveedores[$key]["nombre"].'</option>';
							if($entrada["proveedor"]==$proveedores[$key]["nombre"]){
								$prov = $i;
							}
							$i++;
						}
					?>
					<option value="nuevo">Nuevo</option>
				</select><br>
				<input type="text" id="Nnombre" name="Nnombre" style="display:none;" value=""><br>
				Barco<br>
				<div id="barcosLista">
					<select id="barco" onChange="barcoCambio();" name="barco">
						<?php
							$barcos = explode("|",$proveedores[$prov]["barcos"]);
							for($i = 0; $i < sizeof($barcos); $i ++) {
								echo '<option '.($entrada["barco"]==$barcos[$i]?"selected":"").' value="'.$barcos[$i].'">'.$barcos[$i].'</option>';
							}
						?>
						<option value="nuevo">Nuevo</option>
					</select><br>
				</div>
				<input type="text" id="Nbarco" name="Nbarco" style="display:none;" value=""><br>
				Marea<br>
				<input type="text" name="marea" value="<?php echo $entrada["marea"];?>">
			</fieldset>
			<fieldset>
				<legend>Datos adicionales</legend>
				Envase<br>
				<input type="text" name="envase" value="<?php echo $entrada["envase"];?>"><br>
				Etiquetado<br>
				<input type="text" name="etiquetado" value="<?php echo $entrada["etiquetado"];?>"><br>
				Caducidad<br>
				<input type="text" name="caducidad" value="<?php echo $entrada["caducidad"];?>"><br>
				Aspecto<br>
				<select name="aspecto">
					<option <?php echo $entrada["aspecto"]=="B"?"selected":"";?> value="B">B</option>
					<option <?php echo $entrada["aspecto"]=="M"?"selected":"";?> value="M">M</option>
				</select><br>
				Temperatura<br>
				<input type="text" name="temperatura" value="<?php echo $entrada["temperatura"];?>"><br>
				Kg en almacén<br>
				<input type="text" name="restante" value="<?php echo $entrada["restante"];?>">
			</fieldset>
			<input type="submit" value="Modificar entrada">
			<br><br><input type="button" value="Eliminar entrada" onclick='window.location.replace("?del=true&numero=<?php echo($_GET["numero"]);?>");'>
		</form>
		<script>
		</script>
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("panel.php");' />
	</body>
</html>