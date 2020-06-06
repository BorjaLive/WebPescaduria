<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel.php");
			}
			function redir(id){
				window.location.replace("panel_pedidoEditar.php?id="+id);
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
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<table border="1" align="center">
		<tr>
			<td>ID</td>
			<td>Nombre de usuario</td>
			<td>Estado</td>
		</tr>
		<?php
		include "../funcs/_conn.php";
		$productos = array_reverse(getPedidos());
		foreach( $productos as $key => $value ) { 
			echo "<tr>"."<td>".$productos[$key]["ID"]."</td>"."<td>".$productos[$key]["usuario"]."</td>"."<td>".$productos[$key]["estado"]."</td><td><button onclick='redir(".'"'.$productos[$key]["ID"].'"'.")'>Editar</button></td>"."</tr>" ; 
		} 
		?>
		</table>
	</body>
</html>