<html>
	<head>
		<title>Administración</title>
		<script>
			function cerar_sesion() {
				window.location.replace("log.php?cerar=true");
			}
		</script>
	</head>
	<body>
		<?php
			if($_COOKIE["admingambas"] != "aceptacionadumbre"){
				header("Location: log.php");
				die();
			}
		?>
		<table border="1" align="center">
			<tr>
				<td>Gestión de productos</td>
				<td>Control de pedidos</td>
				<td>Control de usuarios</td>
				<td>Página</td>
			</tr>
			<tr>
				<td><a href="panel_crearProducto.php">Crear nuevo producto</a></td>
				<td><a href="panel_crearPedido.php">Crear nuevo pedido</a></td>
				<td><a href="panel_crearUsuario.php">Crear nuevo usuario</a></td>
				<td><a href="panel_variables.php">Cambiar variables</a></td>
			</tr>
			<tr>
				<td><a href="panel_verProductos.php">Visualizar y editar productos</a></td>
				<td><a href="panel_verPedidos.php">Visualizar y editar pedidos</a></td>
				<td><a href="panel_verUsuarios.php">Visualizar y editar usuarios</a></td>
				<td><a href="panel_descuentos.php">Gestionar descuentos</a></td>
			</tr>
			<tr>
				<td><a href="panel_edicionMasiva.php">Actualizar precios y existencias</a></td>
			</tr>
		</table>
		
		<input type="button" value="Ir a trazabilidad y facturación" style="font-size: 18px;margin:auto;display:block;" onclick="window.location.replace('http://localhost/admin/traza/');" /><br>
		
		
		<input type="button" value="Cerrar sesion" onclick="cerar_sesion();" />
	</body>
</html>