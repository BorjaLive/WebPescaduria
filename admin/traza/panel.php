<html>
	<head>
		<title>Administración</title>
		<script>
			function cerar_sesion() {
				window.location.replace("../log.php?cerar=true");
			}
		</script>
		<style>
			table tr td{
				font-size: 18px;
			}
		</style>
		<?php
			include "funcs/_secure.php";
		?>
	</head>
	<body>
		<table border="1" align="center">
			<tr>
				<td>Trazabilidad de entrada</td>
				<td>Trazabilidad de salida</td>
				<td>Facturas</td>
			</tr>
			<tr>
				<td><a href="verEntrada.php">Visualizar y editar entradas</a></td>
				<td><a href="verSalida.php">Visualizar y editar salidas</a></td>
				<td><a href="verFactura.php">Visualizar y editar facturas</a></td>
			</tr>
			<tr>
				<td><a href="crearEntrada.php">Crear una nueva entrada</a></td>
				<td><a href="crearSalida.php">Crear una nueva salida</a></td>
				<td><a href="CrearFactura.php">Crear una nueva factura</a></td>
			</tr>
		</table><br>
		<table border="1" align="center">
			<tr>
				<td>Clientes</td>
				<td>Proveedores</td>
			</tr>
			<tr>
				<td><a href="verCliente.php">Visualizar y editar clientes</a></td>
				<td><a href="verProveedor.php">Visualizar y editar proveedores</a></td>
			</tr>
			<tr>
				<td><a href="CrearCliente.php">Crear un nuevo cliente</a></td>
				<td><a href="CrearProveedor.php">Crear un nuevo proveedor</a></td>
			</tr>
		</table>
		
		<input type="button" value="Ir a tienda online" style="font-size: 18px;margin:auto;display:block;" onclick="window.location.replace('http://localhost/admin/');" /><br>
		
		<input type="button" value="Cerrar sesion" onclick="cerar_sesion();" />
	</body>
</html>