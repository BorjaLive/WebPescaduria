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
				crearEntrada($id,$fecha,$_POST["genero"],$_POST["kg"],$_POST["escandallo"],$proveedor,$barco,$_POST["marea"],$_POST["envase"],$_POST["etiquetado"],$_POST["caducidad"],$_POST["aspecto"],$_POST["temperatura"]);
				plusSiguiente("entrada");
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
		<h1 style="text-align:center;">Crear una nueva entrada</h1>
		
		<form action="?mod=true" method="post">
			<fieldset>
				<legend>Identificación</legend>
				Número<br>
				<input type="text" name="id" placeholder="EJ: 18_001" value="">Sujerencia: <?php echo getSiguiente("entrada");?><br>
				Fecha<br>
				<input type="text" name="fecha" placeholder="EJ: 21/06/18" value="">Sujerencia: <?php echo getFechaActual();?>
			</fieldset>
			<fieldset>
				<legend>Datos del producto</legend>
				Género<br>
				<input type="text" name="genero" value=""><br>
				Kg<br>
				<input type="text" name="kg" placeholder="EJ: 50" value=""><br>
				Escandallo<br>
				<input type="text" name="escandallo" placeholder="EJ: 60-70" value="">
			</fieldset>
			<fieldset>
				<legend>Datos del procedencia</legend>
				Proveedor<br>
				<select id="nombre" onChange="proveedorCambio();" name="nombre">
					<?php
						$proveedores = getProveedores(0);
						foreach( $proveedores as $key => $value ) {
							echo '<option value="'.$proveedores[$key]["nombre"].'">'.$proveedores[$key]["nombre"].'</option>';
						}
					?>
					<option value="nuevo">Nuevo</option>
				</select><br>
				<input type="text" id="Nnombre" name="Nnombre" style="display:none;" value=""><br>
				Barco<br>
				<div id="barcosLista">
					<select id="barco" onChange="barcoCambio();" name="barco">
						<?php
							$barcos = explode("|",$proveedores[0]["barcos"]);
							for($i = 0; $i < sizeof($barcos); $i ++) {
								echo '<option value="'.$barcos[$i].'">'.$barcos[$i].'</option>';
							}
						?>
						<option value="nuevo">Nuevo</option>
					</select><br>
				</div>
				<input type="text" id="Nbarco" name="Nbarco" style="display:none;" value=""><br>
				Marea<br>
				<input type="text" name="marea" placeholder="EJ: 4/18" value="">
			</fieldset>
			<fieldset>
				<legend>Datos adicionales</legend>
				Envase<br>
				<input type="text" name="envase" value=""><br>
				Etiquetado<br>
				<input type="text" name="etiquetado" value=""><br>
				Caducidad<br>
				<input type="text" name="caducidad" value=""><br>
				Aspecto<br>
				<select name="aspecto">
					<option selected value="B">B</option>
					<option value="M">M</option>
				</select><br>
				Temperatura<br>
				<input type="text" name="temperatura" placeholder="EJ: -20" value="">
			</fieldset>
			<input type="submit" value="Crear entrada">
		</form>
		<script>
		</script>
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("panel.php");' />
	</body>
</html>