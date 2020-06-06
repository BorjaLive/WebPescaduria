<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			if(!empty($_GET["mod"])){
				eliminarFactura($_GET["numero"]);
				
				if($_POST["nombre"] == "nuevo"){
					crearCliente($_POST["Nnombre"], $_POST["poblacion"], $_POST["direccion"], $_POST["dni"]);
					$nombre = $_POST["Nnombre"];
				}else{
					$nombre = $_POST["nombre"];
				}
				$id = empty($_POST["id"])?getSiguiente("entrada"):$_POST["id"];
				$fecha = empty($_POST["fecha"])?getFechaActual():$_POST["fecha"];
				
				$productos = "";
				$i = 1;
				while(!empty($_POST["producto".$i])){
					$_POST["precio".$i] = str_replace(",",".",$_POST["precio".$i]);
					$_POST["kg".$i] = str_replace(",",".",$_POST["kg".$i]);
					
					$salida = empty($_POST["salida".$i])?"NAN":$_POST["salida".$i];
					if(isset($_POST["crearSalida"])){
						if($salida=="NAN"){
							$salida = getSiguiente("salida");
							plusSiguiente("salida");
						}
						$entrada = getEntrada($_POST["producto".$i]);
						$salidaOld = getSalida($salida);
						
						eliminarSalida($salida);
						creaSalida($_POST["producto".$i], $fecha, $salidaOld["genero"], $salidaOld["escandallo"], $_POST["kg".$i], $salidaOld["proveedor"], $salidaOld["barco"], $salidaOld["marea"], $salida,$salidaOld["envase"],$salidaOld["etiquetado"],$salidaOld["caducidad"],$salidaOld["aspecto"],$salidaOld["temperatura"]);
						eliminarEntrada($_POST["producto".$i]);
						crearEntrada($entrada["id"], $entrada["fecha"], $entrada["genero"], $entrada["kg"], $entrada["escandallo"], $entrada["proveedor"], $entrada["barco"], $entrada["marea"], $entrada["envase"], $entrada["etiquetado"], $entrada["caducidad"], $entrada["aspecto"], $entrada["temperatura"],$entrada["restante"]-$_POST["kg".$i]+$salidaOld["kg"]);
					}
					
					$productos .= ($productos==""?"":"|").$_POST["producto".$i]."x".$_POST["precio".$i]."x".$_POST["kg".$i]."x".$salida;
					$i++;
				}
				
				crearFactura($id, $fecha, $nombre, $_POST["direccion"], $_POST["poblacion"], $_POST["DNI"], $productos, $_POST["suma"], $_POST["iva"], $_POST["re"], $_POST["total"]);
				Sleep(1);
				header("Location: verFactura.php");
				die();
			}else{
				$factura = getFactura($_GET["numero"]);
			}
			if(!empty($_GET["del"])){
				$i = 1;
				$factura = getFactura($_GET["numero"]);
				$productos = explode("|",$factura["productos"]);
				for($i = 1; $i <= sizeof($productos); $i++){
					$partes = explode("x",$productos[$i-1]);
					$salida = $partes[3];
					$entrada = getEntrada($partes[0]);
					$salidaOld = getSalida($salida);
					eliminarSalida($salida);
					eliminarEntrada($partes[0]);
					crearEntrada($entrada["id"], $entrada["fecha"], $entrada["genero"], $entrada["kg"], $entrada["escandallo"], $entrada["proveedor"], $entrada["barco"], $entrada["marea"], $entrada["envase"], $entrada["etiquetado"], $entrada["caducidad"], $entrada["aspecto"], $entrada["temperatura"],$entrada["restante"]+$salidaOld["kg"]);
				}
				eliminarFactura($_GET["numero"]);
				Sleep(1);
				header("Location: verFactura.php");
				die();
			}
		?>
		<script>
			var n = 1;
			function agregarProducto(){
				productos = new Array();
				precio = new Array();
				kg = new Array();
				for(i = 1; i <= n; i++){
					productos[i] = document.getElementById("producto"+i).value;
					precio[i] = document.getElementById("precio"+i).value;
					kg[i] = document.getElementById("kg"+i).value;
				}
				n++;
				document.getElementById("productos").innerHTML += 'Producto '+n+'<br><input type="text" id="producto'+n+'" name="producto'+n+'" value=""><input type="button" value="Comprobar" onclick="comprobar('+n+');" /><div style="display:inline-block" id="genero'+n+'">Género: </div><br>Precio por Kg<br><input type="text" id="precio'+n+'" name="precio'+n+'" value=""><br>Kg<br><input type="text" id="kg'+n+'" name="kg'+n+'" value=""><input type="button" value="Comprobar" onclick="disponibilidad('+n+');" /><div style="display:inline-block" id="stock'+n+'">Stock: </div><br>Saldia asociada<br><input type="text" id="salida'+n+'" name="salida'+n+'" value=""><br><br>';
				for(i = 1; i < n; i++){
					document.getElementById("producto"+i).value = productos[i];
					document.getElementById("precio"+i).value = precio[i];
					document.getElementById("kg"+i).value = kg[i];
				}
			}
			function clienteCambio(){
				if(document.getElementById("compradorCliente").value == "nuevo"){
					document.getElementById("poblacion").value = "";
					document.getElementById("direccion").value = "";
					document.getElementById("dni").value = "";
					document.getElementById("Nnombre").style.display = "block";
				}else{
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function(){
						if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
							var datos = xmlhttp.responseText.split("|");
							document.getElementById("poblacion").value = datos[0];
							document.getElementById("direccion").value = datos[1];
							document.getElementById("dni").value = datos[2];
							document.getElementById("Nnombre").style.display = "none";
						}
					}
					xmlhttp.open("POST", "funcs/ajaxLib.php", true);
					xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
					xmlhttp.send("task=getClienteData&nombre="+document.getElementById("compradorCliente").value);
				}
			}
			function comprobar(n){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						var datos = xmlhttp.responseText.split("|");
						document.getElementById("genero"+n).innerHTML = "Género: "+datos[2]+"  "+datos[4];
					}
				}
				xmlhttp.open("POST", "funcs/ajaxLib.php", true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("task=getEntradaData&nombre="+document.getElementById("producto"+n).value);
			}
			function disponibilidad(n){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						var datos = xmlhttp.responseText.split("|");
						document.getElementById("stock"+n).innerHTML = "Stock: "+datos[12]+" Kg";
					}
				}
				xmlhttp.open("POST", "funcs/ajaxLib.php", true);
				xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
				xmlhttp.send("task=getEntradaData&nombre="+document.getElementById("producto"+n).value);
			}
			function calcularPrecios(){
				var i = 1;
				suma = 0;
				while(document.getElementById("producto"+i) != null){
					suma += document.getElementById("kg"+i).value*document.getElementById("precio"+i).value;
					i++;
				}
				document.getElementById("suma").value = suma;
				document.getElementById("iva").value = suma*0.1;
				document.getElementById("re").value = "0";
				document.getElementById("total").value = suma*1.1;
			}
		</script>
	</head>
	<body>
		<h1 style="text-align:center;">Editar una factura</h1>
		
		<form action="?mod=true&numero=<?php echo $_GET["numero"];?>" method="post">
			<fieldset>
				<legend>Datos de la factura</legend>
				Número<br>
				<input type="text" name="numero" value="<?php echo $factura["id"];?>"><br>
				Fecha<br>
				<input type="text" name="fecha" value="<?php echo $factura["fecha"];?>">
			</fieldset>
			<fieldset>
				<legend>Comprador</legend>
				Nombre del comprador<br>
				<select onchange="clienteCambio();" id="compradorCliente" name="nombre">
					<?php
						$clientes = getClientes(0);
						foreach( $clientes as $key => $value ) {
							echo '<option '.($factura["nombre"]==$clientes[$key]["nombre"]?"selected":"").' value="'.$clientes[$key]["nombre"].'">'.$clientes[$key]["nombre"].'</option>';
						}
					?>
					<option value="nuevo">Nuevo</option>
				</select><br>
				<input type="text" style="display:none" id="Nnombre" name="Nnombre" value="">
				Población<br>
				<input type="text" id="poblacion" name="poblacion" value="<?php echo $factura["poblacion"];?>">La población se completa automaticamente<br>
				Direccion<br>
				<input type="text" id="direccion" name="direccion" value="<?php echo $factura["direccion"];?>">La dirección se completa automaticamente<br>
				DNI<br>
				<input type="text" id="dni" name="DNI" value="<?php echo $factura["dni"];?>">El DNI se completa automaticamente
			</fieldset>
			<fieldset>
				<legend>Productos</legend>
				<div id="productos">
					<?php
						$productos = explode("|",$factura["productos"]);
						for($i = 1; $i <= sizeof($productos); $i++){
							$partes = explode("x",$productos[$i-1]);
							echo '	Producto '.$i.'<br>
									<input type="text" id="producto'.$i.'" name="producto'.$i.'" value="'.$partes[0].'"><input type="button" value="Comprobar" onclick="comprobar('.$i.');" /><div style="display:inline-block" id="genero'.$i.'">Género: </div><br>
									Precio por Kg<br>
									<input type="text" id="precio'.$i.'" name="precio'.$i.'" value="'.$partes[1].'"><br>
									Kg<br>
									<input type="text" id="kg'.$i.'" name="kg'.$i.'" value="'.$partes[2].'"><input type="button" value="Comprobar" onclick="disponibilidad('.$i.');" /><div style="display:inline-block" id="stock'.$i.'">Stock: </div><br>
									Salida asociada<br>
									<input type="text" id="salida'.$i.'" name="salida'.$i.'" value="'.$partes[3].'"><br><br>';
						}
					?>
				</div>
				<hr>
				<input type="button" value="Agregar producto" onclick='agregarProducto();' />
			</fieldset>
			<fieldset>
				<legend>Precios</legend>
				<input type="button" value="Calcular" onclick='calcularPrecios();' />€<br>
				Suma<br>
				<input type="text" id="suma" name="suma" value="<?php echo $factura["suma"];?>">€<br>
				I.V.A.<br>
				<input type="text" id="iva" name="iva" value="<?php echo $factura["iva"];?>">€<br>
				R.E.<br>
				<input type="text" id="re" name="re" value="<?php echo $factura["re"];?>">€<br>
				Total<br>
				<input type="text" id="total" name="total" value="<?php echo $factura["total"];?>">€
			</fieldset>
			<input type="checkbox" id="crearSalidaCheck" name="crearSalida" value="1" checked>Crear salida con los datos de la factura.<br>
			<br>
			<input type="submit" value="Modificar factura">
			<br><br><input type="button" value="Eliminar Factura" onclick='window.location.replace("?del=true&numero=<?php echo($_GET["numero"]);?>");'>
		</form>
		
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("verFactura.php");' />
	</body>
</html>