<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel.php");
			}
			function redir(id){
				window.location.replace("panel_productoEditar.php?id="+id);
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
			<td>Categoría</td>
		</tr>
		<?php
		include "../funcs/_conn.php";
		
		$productos = getProductos();
		foreach( $productos as $key => $value ) { 
			echo "<tr>"."<td>".$productos[$key]["ID"]."</td>"."<td>".$productos[$key]["nombre"]."</td>"."<td>".$productos[$key]["categoria"]."</td><td><button onclick='redir(".'"'.$productos[$key]["ID"].'"'.")'>Editar</button></td>"."</tr>" ; 
		} 
		?>
		</table>
	</body>
</html>