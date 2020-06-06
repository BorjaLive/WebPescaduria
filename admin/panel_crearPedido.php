<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel.php");
			}
			var n = 1;
			function set(n){
				document.getElementById("cocido0").selectedIndex = n;
			}
			function agregar(){
				id = new Array();
				cantidad = new Array();
				cocido = new Array();
				precio = new Array();
				for(var i = 0; i < n; i++){
					id[i] = document.getElementById("id"+i).value;
					cantidad[i] = document.getElementById("cantidad"+i).value;
					cocido[i] = document.getElementById("cocido"+i).value;
					precio[i] = document.getElementById("precio"+i).value;
				}
				id[i] = catalogo[0];
				cantidad[i] = "1";
				cocido[i] = "1";
				precio[i] = "0";
				document.getElementById("productos").innerHTML = "";
				n++;
				for(var j = 0; j < n; j++){
					selector = document.getElementById("selector").innerHTML;
					selector = selector.replace("[SELCTOR]","id"+j);
					selector = selector.replace("[SELCTOR]","id"+j);
					for(var k = 0; k < catalogoLen; k++){
						if(id[j]==catalogo[k]){
							selector = selector.replace("s"+k,"selected");
							console.log("Replace: s"+k);
						}else{
							selector = selector.replace("s"+k,"");
						}
					}
					document.getElementById("productos").innerHTML += "Producto<br>"+selector+'<br>Cantidad de kilos<br><input type="text" id="cantidad'+j+'" name="cantidad'+j+'" value="'+cantidad[j]+'"><br>Cocido o congelado<br><select id="cocido'+j+'" name="cocido'+j+'"><option value="1">Congelado</option><option value="2">Cocido</option></select><br>Precio (0 para el actual)<br><input type="text" id="precio'+j+'" name="precio'+j+'" value="'+precio[j]+'"><br><hr>';
					
				}
				for(i = 0; i < n; i++){
					document.getElementById("cocido"+i).selectedIndex = cocido[i]-1;
					console.log("cocido"+j+" -> "+cocido[j]);
				}
			}
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
			$pedido = "V".getTCode();
			if(!empty($_GET["mod"])){
				$n = 0;
				$material = "";
				echo $_POST["id0"]." - ".$_POST["id1"];
				while(!empty($_POST["id".$n])){
					$material .= $_POST["id".$n]."x".$_POST["cantidad".$n]."x".$_POST["cocido".$n]."x";
					if($_POST["precio".$n] == 0){
						$result = $link->query("SELECT * FROM `productos` WHERE `ID`='".$_POST["id".$n]."'");
						$row = mysqli_fetch_assoc($result);
						$material .= $row["precio"];
					}else{
						$material .= $_POST["precio".$n];
					}
					$material .= "x0";
					$n++;
					if(!empty($_POST["id".$n])){
						$material .= "|";
					}
				}
				$link->query("INSERT INTO `pedidos` (`ID`,`usuario`,`producto`,`direccion`,`anotaciones`,`estado`,`seguimiento`) VALUES ('".$pedido."','".$_POST["usuario"]."','".$material."','".$_POST["pais"]."|".$_POST["provincia"]."|".$_POST["localidad"]."|".$_POST["cp"]."|".$_POST["direccion1"]."|".$_POST["direccion2"]."','".$_POST["anotaciones"]."','".$_POST["estado"]."','".$_POST["seguimiento"]."');");
				$link->close();
				
				header("Location: panel_crearPedido.php");
				die();
			}
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<form action="panel_crearPedido.php?mod=true" method="post">
			<fieldset>
				<legend>Información general</legend>
				ID del usuario<br>
				<input type="text" name="usuario" value=""><br>
				Anotaciones<br>
				<input type="text" name="anotaciones" value=""><br>
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
			<fieldset>
				<legend>Productos</legend>
				<div id="productos">
					Producto<br>
					<select id="id0" name="id0">
						<?php
							$catalogo = getProductos();
							$cantidad = 0;
							foreach( $catalogo as $key => $value ) {
								echo "<option value='".$catalogo[$key]["ID"]."'>".$catalogo[$key]["nombre"]."</option>" ; 
								$cantidad++;
							} 
						?>
					</select>
					<br>Cantidad de kilos<br>
					<input type="text" id="cantidad0" name="cantidad0" value="1"><br>
					Cocido o congelado<br>
					<select id="cocido0" name="cocido0">
						<option select value="1">Congelado</option>
						<option value="2">Cocido</option>
					</select><br>
					Precio (0 para el actual)<br>
					<input type="text" id="precio0" name="precio0" value="0"><br><hr>
				</div>
				<input type="button" value="Agregar otro producto" onclick="agregar();" />
			</fieldset>
			<fieldset>
				<legend>Circustancias</legend>
				Estado<br>
				<select name="estado">
					<option value="1">Sin confirmar</option>
					<option select value="2">Pendiente de pago</option>
					<option value="3">Enviado</option>
					<option value="4">Finalizado</option>
					<option value="5">Cancelado</option>
				</select><br>
				Número de seguimiento<br>
				<input type="text" name="seguimiento" value=""><br>
			</fieldset>
			
			<input type="submit" value="Crear">
		</form>
		
		
		<div id="selector" style="display: none;">
				<select id="[SELCTOR]" name="[SELCTOR]">
					<?php
						$cantidad = 0;
						foreach( $catalogo as $key => $value ) {
							echo "<option s".$cantidad." value='".$catalogo[$key]["ID"]."'>".$catalogo[$key]["nombre"]."</option>" ; 
							$cantidad++;
						} 
					?>
				</select>
			</div>
			<div id="catalogoLen" style="display: none;">
				<?php echo $cantidad; ?>
			</div>
			<script>
			var catalogoLen = document.getElementById("catalogoLen").innerHTML;
			var catalogo = [
			<?php
				$primera = true;
				foreach( $catalogo as $key => $value ) {
					echo ($primera?"":",").'"'.$catalogo[$key]["ID"].'"';
					$primera = false;
				} 
			?>
			];
		</script>
	</body>
</html>