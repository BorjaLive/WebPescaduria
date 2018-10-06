<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel.php");
			}
			function redir(id){
				window.location.replace("panel_usuarioEditar.php?id="+id);
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
			<td>Nombre</td>
			<td>Empresa</td>
			<td>Email</td>
			<td>Teléfono</td>
			<td>Estado</td>
		</tr>
		<?php
		include "../funcs/_conn.php";
		$productos = getUsuarios();
		foreach( $productos as $key => $value ) { 
			echo "<tr>";
			echo "<td>".$productos[$key]["ID"]."</td>";
			echo "<td>".$productos[$key]["nombre"]."</td>";
			echo "<td>".$productos[$key]["empresa"]."</td>";
			echo "<td>".$productos[$key]["email"]."</td>";
			echo "<td>".$productos[$key]["telefono"]."</td>";
			echo "<td>".$productos[$key]["estado"]."</td>";
			echo"<td><button onclick='redir(".'"'.$productos[$key]["ID"].'"'.")'>Editar</button></td>"."</tr>" ; 
		} 
		?>
		</table>
	</body>
</html>