<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script>
			function regresar() {
				window.location.replace("panel_verPedidos.php");
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
					document.getElementById("productos").innerHTML += "Producto<br>"+selector;
					document.getElementById("productos").innerHTML += '<br>Cantidad de kilos<br><input type="text" id="cantidad'+j+'" name="cantidad'+j+'" value="'+cantidad[j]+'"><br>Cocido o congelado<br><select id="cocido'+j+'" name="cocido'+j+'"><option value="1">Congelado</option><option value="2">Cocido</option></select><br>Precio (-1 para el actual)<br><input type="text" id="precio'+j+'" name="precio'+j+'" value="'+precio[j]+'"><br>';
					document.getElementById("productos").innerHTML += "<hr>";
					
					for(i = 0; i < n; i++){
						document.getElementById("cocido"+i).selectedIndex = cocido[i]-1;
						console.log("cocido"+j+" -> "+cocido[j]);
					}
				}
				//document.getElementById("productos").innerHTML += '<hr>Producto<br><input type="text" name="id'+n+'" value=""><br>Cantidad de kilos<br><input type="text" name="cantidad'+n+'" value=""><br>Precio (-1 para el actual)<br><input type="text" name="precio'+n+'" value=""><br>';
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
			
			if(!empty($_GET["mod"])){
				$n = 0;
				$productos = "";
				while(!empty($_POST["id".$n])){
					$productos .= $_POST["id".$n]."x".$_POST["cantidad".$n]."x".$_POST["cocido".$n]."x";
					if($_POST["precio".$n] == -1){
						$result = $link->query("SELECT * FROM `productos` WHERE `ID`='".$_POST["id".$n]."'");
						$row = mysqli_fetch_assoc($result);
						$productos .= $row["precio"];
					}else{
						$productos .= $_POST["precio".$n];
					}
					$n++;
					if(!empty($_POST["id".$n])){
						$productos .= "|";
					}
				}
				$link->query("DELETE FROM `pedidos` WHERE `ID`='".$_GET["id"]."';");
				$link->query("INSERT INTO `pedidos` (`ID`,`usuario`,`producto`,`direccion`,`anotaciones`,`estado`,`seguimiento`) VALUES ('".$_GET["id"]."','".$_POST["usuario"]."','".$productos."','".$_POST["pais"]."|".$_POST["provincia"]."|".$_POST["localidad"]."|".$_POST["cp"]."|".$_POST["direccion1"]."|".$_POST["direccion2"]."','".$_POST["anotaciones"]."','".$_POST["estado"]."','".$_POST["seguimiento"]."');");
				$link->query("DELETE FROM `vars` WHERE `clave`='".$_GET["id"]."';");
				$link->query("INSERT INTO `vars` (`clave`,`valor`) VALUES ('".$_GET["id"]."','".$_POST["costes"]."');");
				$link->close();
				
				switch($_POST["estado"]){
					case 2:
						$array_remplazo = array('ID' => $_GET["id"]);
						sendMail("",$_POST["usuario"],"","pedidoAceptado",$array_remplazo,"Pedido aceptado en [NOMBRE DE EMPRESA]","");
					break;
					case 3:
						$array_remplazo = array('ID' => $_GET["id"]);
						sendMail("",$_POST["usuario"],"","pedidoEnviado",$array_remplazo,"Pedido enviado en [NOMBRE DE EMPRESA]","");
					break;
					case 5:
						$array_remplazo = array('ID' => $_GET["id"], 'MOTIVO' => $_POST["comentario"]);
						sendMail("",$_POST["usuario"],"","pedidoCancelado",$array_remplazo,"Cancelacion del pedido en [NOMBRE DE EMPRESA]","");
					break;
				}
				
				header("Location: panel_pedidoEditar.php?id=".$_GET["id"]);
				die();
			}else{
				if(!empty($_GET["del"])){
					$link->query("DELETE FROM `pedidos` WHERE `ID`='".$_GET["id"]."';");
					$link->close();
					header("Location: panel_verPedidos.php");
					die();
				}
			}
			
			$result = $link->query("SELECT * FROM `pedidos` WHERE `ID`='".$_GET["id"]."'");
			$row = $result->fetch_assoc();
			$results = $link->query("SELECT * FROM `usuarios` WHERE `ID`='".$row["usuario"]."'");
			$rows = $results->fetch_assoc();
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<form action="panel_pedidoEditar.php?mod=true&id=<?php echo $_GET["id"]; ?>" method="post">
			<fieldset>
				<legend>Información general</legend>
				Fecha del pedido: <?php echo getFecha($_GET["id"]); ?><hr>
				ID del usuario<br>
				<input type="text" name="usuario" value="<?php echo $row["usuario"]; ?>">Nombre: <?php echo $rows["apellido"].", ".$rows["nombre"]; ?><br>
				Anotaciones<br>
				<input type="text" name="anotaciones" value="<?php echo $row["anotaciones"]; ?>"><br>
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
			<fieldset>
				<legend>Productos</legend>
				<div id="productos">
				<?php
				$catalogo = getProductos();
				$productos = explode('|',$row["producto"]);
				$cantPro = 0;
				for($i = 0; $i < sizeof($productos); $i++){
					$cantPro++;
					$partes = explode('x',$productos[$i]);
					if(sizeof($partes) != 4){
						continue;
					}
					$results = $link->query("SELECT * FROM `productos` WHERE `ID`='".$partes[0]."'");
					$rows = $results->fetch_assoc();
					echo 'Producto<br>
						<select id="id'.$i.'" name="id'.$i.'">';
					foreach( $catalogo as $key => $value ) {
						echo "<option ".($partes[0]==$catalogo[$key]["ID"]?"selected":"")." value='".$catalogo[$key]["ID"]."'>".$catalogo[$key]["nombre"]."</option>" ; 
					} 
					echo'</select><br>Cantidad de kilos<br>
						<input type="text" id="cantidad'.$i.'" name="cantidad'.$i.'" value="'.$partes[1].'"><br>
						Cocido o congelado<br>
						<select id="cocido'.$i.'" name="cocido'.$i.'">
							<option '.($partes[2]=="1"?"selected":"").' value="1">Congelado</option>
							<option '.($partes[2]=="2"?"selected":"").' value="2">Cocido</option>
						</select><br>
						Precio (-1 para el actual)<br>
						<input type="text" id="precio'.$i.'" name="precio'.$i.'" value="'.$partes[3].'"><br><hr>';
				}
				?>
				</div>
				<input type="button" value="Agregar otro producto" onclick="agregar();" />
			</fieldset>
			<fieldset>
				<legend>Circustancias</legend>
				Estado<br>
				<select name="estado" id="estadoPedido" onchange="cambiarEstado()">
					<option <?php echo $row["estado"]==1?"selected":""; ?> value="1">Sin confirmar</option>
					<option <?php echo $row["estado"]==2?"selected":""; ?> value="2">Pendiente de pago</option>
					<option <?php echo $row["estado"]==3?"selected":""; ?> value="3">Enviado</option>
					<option <?php echo $row["estado"]==4?"selected":""; ?> value="4">Finalizado</option>
					<option <?php echo $row["estado"]==5?"selected":""; ?> value="5">Cancelado</option>
				</select>
			</fieldset>
			<fieldset id="envioEstado" style="display:<?php 
										if($row["estado"]==1 or $row["estado"]==2){
											echo "none";
										}else{
											echo "block";
										}
									?>;">
				<legend>Detalles de envio</legend>
				Número de seguimiento<br>
				<input type="text" name="seguimiento" value="<?php echo $row["seguimiento"]; ?>"><br>
				Costos de envio<br>
				<input type="text" name="costes" value="<?php echo getEnvioCoste($row["ID"]); ?>">
			</fieldset>
			<fieldset id="cancelacion" style="display:none;">
				<legend>Cancelación</legend>
				Motivo de la cancelación<br>
				<textarea class="customer-comment" name="comentario" cols="60" rows="1"></textarea>
			</fieldset>
			
			<input type="submit" value="Modificar">
			
			
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
			<div id="cantPro" style="display: none;">
				<?php echo $cantPro; ?>
			</div>
			<div id="catalogoLen" style="display: none;">
				<?php echo $cantidad; ?>
			</div>
		</form><br>
		<form action="panel_pedidoEditar.php?del=true&id=<?php echo $_GET["id"]; ?>" method="post">
			<input type="submit" value="Borrar pedido">
		</form>
		<script>
			var n = document.getElementById("cantPro").innerHTML;
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
			
			cambiarEstado();
			function cambiarEstado(){
				if(document.getElementById("estadoPedido").value == 1 || document.getElementById("estadoPedido").value == 5){
					document.getElementById("envioEstado").style.display="none";
				}else{
					document.getElementById("envioEstado").style.display="block";
				}
				if(document.getElementById("estadoPedido").value == 5){
					document.getElementById("cancelacion").style.display="block";
				}else{
					document.getElementById("cancelacion").style.display="none";
				}
			}
		</script>
	</body>
</html>