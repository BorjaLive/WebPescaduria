<?php
	include "funcs/_secure.php";
	include "funcs/_conn.php";
	include "funcs/_elementals.php";
	
	
	$factura = getFactura($_GET["numero"]);
	
	
?>
<html>
	<head>
		<link rel="stylesheet" href="../../../css/stylefactura.css" type="text/css" />
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<title>Factura</title>
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
						<h1><?php echo $factura["id"]; ?></h1>
					</div>
					<div class="fecha">
						<p> <?php echo getFecha($factura["fecha"]); ?><p>
					</div>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td>
					<p class="prescrito">Sr/Sra. </p>
					<p class="dato"><?php echo $factura["nombre"]; ?></p>
				</td>
				<td>
					<p class="prescrito">NIF. </p>
					<p class="dato"><?php echo $factura["dni"]; ?></p>
				</td>
			</tr>
			<tr>
				<td>
					<p class="prescrito">Dirección: </p>
					<p class="dato"><?php echo $factura["direccion"]; ?></p>
				</td>
				<td>
					<p class="prescrito">Población: </p>
					<p class="dato"><?php echo $factura["poblacion"]; ?></p>
				</td>
			</tr>
		</table>
		<table class="productos">
			<tr class="titulares">
				<td>
					<p class="marcador">Cantidad</p>
				</td>
				<td>
					<p class="marcador">Número de entrada</p>
				</td>
				<td>
					<p class="marcador">Genero</p>
				</td>
				<td>
					<p class="marcador">Precio Kg</p>
				</td>
				</td>
				<td>
					<p class="marcador">Importe</p>
				</td>
			</tr>
			<?php
				$productos = explode("|",$factura["productos"]);
				for($i = 0; $i < sizeof($productos); $i++){
					$partes = explode("x",$productos[$i]);
					echo '<tr>
								<td>
									<p>'.$partes[2].'</p>
								</td>
								<td>
									<p>'.$partes[0].'</p>
								</td>
								<td>
									<p>'.getEntrada($partes[0])["genero"].'</p>
								</td>
								<td>
									<p>'.str_replace(".",",",number_format($partes[1],"2")).'&nbsp€</p>
								</td>
								<td>
									<p class="importe">'.str_replace(".",",",number_format(($partes[1]*$partes[2]),"2")).'&nbsp€</p>
								</td>
							</tr>
					';
				}
			?>
		</table>
		<table class="sumatorio">
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">Suma</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format($factura["suma"],"2")); ?>&nbsp€</td>
			</tr>
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">I.V.A. 10,00%</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format($factura["iva"],"2")); ?>&nbsp€</td>
			</tr>
			<tr>
				<td class="vacio"></td>
				<td class="titularzico">R.E. 1,4%</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format($factura["re"],"2")); ?>&nbsp€</td>
			</tr>
			<tr class="total">
				<td class="vacio"></td>
				<td class="titularzico">TOTAL</td>
				<td class="sombreado"><?php echo str_replace(".",",",number_format($factura["total"],"2")); ?>&nbsp€</td>
			</tr>
		</table>
		<br><button style="width: 12%;margin-left: 44%;margin-right: 44%" type="buton" onclick="window.print()">Imprimir factura</button>
	</body>
</html>