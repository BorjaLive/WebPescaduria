<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel.php");
			}
			function redir(id){
				window.location.replace("panel_descuentos.php?mod=delete&id="+id);
			}
		</script>
	</head>
	<body>
		<?php
			if($_COOKIE["admingambas"] != "aceptacionadumbre"){
				header("Location: log.php");
				die();
			}
			if(!empty($_GET["mod"])){
				include "../funcs/_conn.php";
				if($_GET["mod"] == "create"){
					$link = conn();
					$link->query("INSERT INTO `ofertas` (`Producto`, `Cantidad`, `Descuento`) VALUES ('".$_POST["producto"]."', '".$_POST["cantidad"]."', '".$_POST["descuento"]."');");
					$link->close();
					echo $_POST["producto"];
					header("Location: panel_descuentos.php");
					die();
				}else if($_GET["mod"] == "delete"){
					$link = conn();
					$link->query("DELETE FROM `ofertas` WHERE `Producto` = '".$_GET["id"]."'");
					$link->close();
					header("Location: panel_descuentos.php");
					die();
				}
			}
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<h2>Lista de descuentos activos</h2>
		<table border="1">
		<tr>
			<td>Producto</td>
			<td>Descuento</td>
			<td>Cantidad</td>
		</tr>
		<?php
		include "../funcs/_conn.php";
		$descuentos = getDescuentos();
		if($descuentos != null){
			foreach( $descuentos as $key => $value ) { 
				echo "<tr>";
				echo "<td>".getProductoNombre($descuentos[$key]["producto"])."</td>";
				echo "<td>".$descuentos[$key]["descuento"]."</td>";
				echo "<td>".$descuentos[$key]["cantidad"]."</td>";
				echo"<td><button onclick='redir(".'"'.$descuentos[$key]["producto"].'"'.")'>Eliminar</button></td>"."</tr>" ; 
			} 
		}
		
		?>
		</table>
		<hr>
		<h2>Crear descuento</h2>
		<form action="panel_descuentos.php?mod=create" method="post">
			
				Producto<br>
				<select name="producto">
					<?php
						$catalogo = getProductos();
						$cantidad = 0;
						foreach( $catalogo as $key => $value ) {
							echo "<option value='".$catalogo[$key]["ID"]."'>".$catalogo[$key]["nombre"]."</option>" ; 
							$cantidad++;
						} 
					?>
				</select><br>
				Descuento<br>
				<input type="text" name="descuento" value="">%<br>
				Cantidad<br>
				<input type="text" name="cantidad" value="">kg<br>
			<input type="submit" value="Crear">
		</form>
	</body>
</html>