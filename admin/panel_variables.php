<html>
	<head>
		<title>Administración</title>
		<script>
			function regresar() {
				window.location.replace("panel.php");
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
			$link = conn();
			
			if(!empty($_GET["mod"])){
				$result = $link->query("SELECT * FROM `vars`");
				while ($row = $result->fetch_assoc()){
					if(!empty($_POST[$row["clave"]]) and $row["valor"] != $_POST[$row["clave"]]){
						$link->query("DELETE FROM `vars` WHERE `clave`='".$row["clave"]."';");
						$link->query("INSERT INTO `vars` (`clave`,`valor`) VALUES ('".$row["clave"]."','".$_POST[$row["clave"]]."');");
					}
				}
				$link->close();
				header("Location: panel_variables.php");
				die();
			}
			
			$result = $link->query("SELECT * FROM `vars`;");
			$valores = Array();
			while($row = $result->fetch_assoc()){
				$valores[$row["clave"]] = $row["valor"];
			}
		?>
		<input type="button" value="Regresar al panel" onclick="regresar();" />
		
		<form action="panel_variables.php?mod=true" method="post">
			<fieldset>
				<legend>Productos en escaparate</legend>
				<?php
					$catalogo = getProductos();
					for($i = 1; $i <= 4; $i++){
						echo 'Producto '.$i.'
							<select name="escaparate'.$i.'">';
						foreach( $catalogo as $key => $value ) {
							echo "<option ".($valores["escaparate".$i]==$catalogo[$key]["ID"]?"selected":"")." value='".$catalogo[$key]["ID"]."'>".$catalogo[$key]["nombre"]."</option>" ; 
						}
						echo("</select><br>");
					}
				?>
			</fieldset>
			<fieldset>
				<legend>Costes predefinidos</legend>
				Costes de envio estimados<br>
				<input type="text" name="costeEnvio" value="<?php echo $valores["costeEnvio"];?>"><br>
				Costes de cocer un kilo<br>
				<input type="text" name="costeCocedura" value="<?php echo $valores["costeCocedura"];?>">
			</fieldset>
			<input type="submit" value="Modificar">
		</form>
	</body>
</html>