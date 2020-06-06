<?php
	if(empty($_GET["id"])){
		echo "<h1>¿Cómo has llegado hasta aquí?</h1>";
		die();
	}
	include "../funcs/_conn.php";
	$factura = getFacturaData($_GET["id"]);
	if(intercambiar($_COOKIE["gambasUsario"]) != $factura["usuario"]){
		echo("<h1>".intercambiar($_COOKIE["gambasUsario"])."!=".$factura["usuario"]."<hr>Tienes que iniciar sesión para ver la factura</h1>");
		die();
	}
	$direccion = divideDireccion($factura["direccion"]);
	$productos = dividePedido($factura["producto"]);
	
?>
<html>
	<head>
		<link rel="stylesheet" href="../css/stylefactura.css" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<title>Factura [NUMERO EXPEDICION]</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	</head>
	<body>
		<table>
			<tr>
				<td>
					<div class="logo">
						<h1>Distribuidor de pescados y mariscos</h1>
						<h2>Juan Antonio López Navarro</h2>
						<h3>NIF: xxxxxxxxX</h3>
						<h2>Avda. México, Mod 117 - Móvil 609 15 18 62</h2>
						<h2>21001 HUELVA</h2>
					</div>
				</td>
				<td class="vacio" style="width:200px"></td>
				<td>
					<div class="numero">
						<p>Número de factura</p>
						<h1><?php echo $factura["ID"]; ?></h1>
					</div>
					<div class="fecha">
						<p> <?php echo getFecha($factura["ID"]); ?><p>
					</div>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<p class="prescrito">Sr/Sra. </p>
					<p class="dato"><?php echo getUserData($factura["usuario"],2).", ".getUserData($factura["usuario"],1); ?></p>
				</td>
				<td>
					<p class="prescrito">NIF. </p>
					<p class="dato"><?php echo getUserData($factura["usuario"],10); ?></p>
				</td>
				<td>
					<p class="prescrito">Teléfono </p>
					<p class="dato"><?php echo getUserData($factura["usuario"],8); ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="prescrito">Pais: </p>
					<p class="dato"><?php echo $direccion["pais"]; ?></p>
				</td>
				<td>
					<p class="prescrito">Provincia: </p>
					<p class="dato"><?php echo $direccion["provincia"]; ?></p>
				</td>
				<td>
					<p class="prescrito">Localidad: </p>
					<p class="dato"><?php echo $direccion["localidad"]; ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="prescrito">Dirección: </p>
					<p class="dato"><?php echo $direccion["direccion1"]." ".$direccion["direccion2"]; ?></p>
				</td>
				<td>
					<p class="prescrito">CP: </p>
					<p class="dato"><?php echo $direccion["cp"]; ?></p>
				</td>
				<td>
					<p class="prescrito"><?php echo getUserData($factura["usuario"],5)=="NAN"?"Email: ":"Empresa: "; ?></p>
					<p class="dato"><?php echo getUserData($factura["usuario"],5)=="NAN"?getUserData($factura["usuario"],3):getUserData($factura["usuario"],5); ?></p>
				</td>
			</tr>
		</table>
		<table class="productos">
			<tr class="titulares">
				<td>
					<p class="marcador">Cantidad</p>
				</td>
				<td>
					<p class="marcador">ID de producto</p>
				</td>
				<td>
					<p class="marcador">Nombre</p>
				</td>
				<td>
					<p class="marcador">Precio Kg</p>
				</td>
				<td>
					<p class="marcador">Descuento</p>
				</td>
				</td>
				<td>
					<p class="marcador">Importe</p>
				</td>
			</tr>
			<?php
				$total = 0;
				foreach( $productos as $key => $value ) {
					if($productos[$key]["cocido"] == 2){
						$productos[$key]["precio"] += 1.5;
					}
					$total += ($productos[$key]["precio"]*$productos[$key]["cantidad"]) -$productos[$key]["descuento"];
					echo '
						<tr>
							<td>
								<p>'.$productos[$key]["cantidad"].'</p>
							</td>
							<td>
								<p>'.$productos[$key]["id"].'</p>
							</td>
							<td>
								<p>'.getProductoNombre($productos[$key]["id"]).'</p>
							</td>
							<td>
								<p>'.str_replace(".",",",number_format($productos[$key]["precio"],"2")).'&nbsp€</p>
							</td>
							<td>
								<p>'.str_replace(".",",",number_format($productos[$key]["descuento"],"2")).'&nbsp€</p>
							</td>
							<td>
								<p class="importe">'.str_replace(".",",",number_format(($productos[$key]["precio"]*$productos[$key]["cantidad"])-$productos[$key]["descuento"],"2")).'&nbsp€</p>
							</td>
						</tr>';
				}
			?>
		</table>
		<table class="sumatorio">
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">Suma</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format($total,"2")); ?>&nbsp€</td>
			</tr>
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">Descuento</td>
				<td class="sombreado">0,00&nbsp€</td>
			</tr>
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">Base Imponible</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format($total,"2")); ?>&nbsp€</td>
			</tr>
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">I.V.A. 10,00%</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format($total*0.1,"2")); ?>&nbsp€</td>
			</tr>
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">R.E. 1,4%</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format(getUserData($factura["usuario"],5)=="NAN"?($total*0.014):0,"2")); ?>&nbsp€</td>
			</tr>
			<tr class="total">
				<td class="vacio"></td>
				<td class="titularzico">TOTAL</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format(($total*1.1)+(getUserData($factura["usuario"],5)=="NAN"?($total*0.014):0)+(getEnvioCoste($factura["ID"])==""?0:getEnvioCoste($factura["ID"])),"2")); ?>&nbsp€</td>
			</tr>
		</table>
		<br><button style="width: 12%;margin-left: 44%;margin-right: 44%" type="buton" onclick="window.print()">Imprimir factura</button>
	</body>
</html>