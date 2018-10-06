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
			include "../funcs/_conn.php";
			if(!empty($_GET["mod"])){
				$link = conn();
				$result = $link->query("SELECT * FROM `productos`");
				while ($row = $result->fetch_assoc()) {
						$id = $row["ID"];
						$nombre=$row["nombre"]; 
						$descripcion=$row["descripcion"]; 
						$categoria=$row["categoria"]; 
						$precio=$_POST[$id."P"]; 
						$existencias=$_POST[$id."E"];
						$link->query("DELETE FROM `productos` WHERE `ID`='".$id."';");
						$link->query("INSERT INTO `productos` (`ID`,`nombre`,`descripcion`,`categoria`,`precio`,`existencias`) VALUES ('".$id."','".$nombre."','".$descripcion."','".$categoria."','".$precio."','".$existencias."');");
				}
				$link->close();
			}
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<form action="panel_edicionMasiva.php?mod=true" method="post">
		<table border="1" align="center">
		<tr>
			<td>ID</td>
			<td>Nombre</td>
			<td>Categoría</td>
			<td>Precio</td>
			<td>Existencias</td>
		</tr>
		<?php
		$productos = getProductosPlus();
		foreach( $productos as $key => $value ) {
			echo "<tr>" ;
			echo "<td>".$productos[$key]["ID"]."</td>" ;
			echo "<td>".$productos[$key]["nombre"]."</td>" ;
			echo "<td>".$productos[$key]["categoria"]."</td>" ;
			echo "<td><input type='text' size='4' name='".$productos[$key]["ID"]."P' value='".$productos[$key]["precio"]."'><br></td>" ;
			echo "<td><input type='text' size='4' name='".$productos[$key]["ID"]."E' value='".$productos[$key]["existencias"]."'><br></td>" ;
			echo "</tr>" ;
		} 
		?>
		</table>
		<input type="submit" value="Modificar">
		</form>
	</body>
</html>