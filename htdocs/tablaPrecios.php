<?php
	include "funcs/_conn.php";
?>
<html>
	<head>
		<title>[Nombre de Empresa]</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="css/stylefactura.css" type="text/css" />
		<style>
			table{
				width: 500px;
			}
			td {
			  text-align: center;
			  vertical-align: middle;
			}
			.precio {
			  text-align: center;
			  vertical-align: middle;
			}
			p{
				font: 550 20px/22px Arial, Helvetica, sans-serif;
				text-align: center;
			}
			.primera{
				font: 700 25px/22px Arial, Helvetica, sans-serif;
			}
			.producto{
				font: 50 20px/22px Arial, Helvetica, sans-serif;
			}
		</style>
	</head>
	<body>
		<p>Los precios fluctuan diariamente, si deseas revisarlos todos. Aquí se muestran listados por categorías.</p>
		<table>
			<tr class="primera">
				<td>Clasificación</td>
				<td>Nombre</td>
				<td>Precio Kg/€</td>
			<tr>
			<?php
				$productos = getProductosPlus();
				foreach( $productos as $key => $value ) {
					echo '
						<tr class="producto">
							<td>'.$productos[$key]["categoria"].'</td>
							<td>'.$productos[$key]["nombre"].'</td>
							<td class="precio">'.str_replace(".",",",number_format($productos[$key]["precio"])).' €</td>
						<tr>
					';
				}
			?>
		<table>
	</body>
</html>