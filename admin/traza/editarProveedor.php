<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			if(!empty($_GET["mod"])){
				$barcos = "";
				$i = 1;
				while(!empty($_POST["barco".$i])){
					$barcos .= ($barcos==""?"":"|").$_POST["barco".$i];
					echo ($barcos==""?"":"|").$_POST["barco".$i]."<br>" ;
					$i++;
				}
				eliminarProveedor($_GET["nombre"]);
				crearProveedor($_POST["nombre"], $barcos);
				Sleep(1);
				header("Location: verProveedor.php");
				die();
			}else{
				$proveedor = getProveedor($_GET["nombre"]);
				$barcos = explode("|",$proveedor["barcos"]);
			}
			if(!empty($_GET["del"])){
				eliminarProveedor($_GET["nombre"]);
				Sleep(1);
				header("Location: verProveedor.php");
				die();
			}
		?>
		<script>
			var n = <?php echo sizeof($barcos);?>;
			function agregarBarco(){
				barcos = new Array();
				for(i = 1; i <= n; i++){
					barcos[i] = document.getElementById("barco"+i).value;
				}
				n++;
				document.getElementById("barcos").innerHTML += 'Nombre del barco '+n+'<br><input type="text" id="barco'+n+'" name="barco'+n+'" value=""><br>';
				for(i = 1; i < n; i++){
					document.getElementById("barco"+i).value = barcos[i];
				}
			}
		</script>
	</head>
	<body>
		<h1 style="text-align:center;">Editar un proveedor</h1>
		
		<form action="?mod=true&nombre=<?php echo $proveedor["nombre"];?>" method="post">
			<fieldset>
				<legend>Datos del proveedor</legend>
				Nombre<br>
				<input type="text" name="nombre" placeholder="EJ: Mariscolastico" value="<?php echo $proveedor["nombre"];?>"><br>
			</fieldset>
			<fieldset>
				<legend>Barcos</legend>
				<div id="barcos">
					<?php
						for($i = 1; $i <= sizeof($barcos); $i++){
							echo '
							Nombre del barco '.$i.'<br>
							<input type="text" id="barco'.$i.'" name="barco'.$i.'" value="'.$barcos[$i-1].'"><br>';
						}
					?>
					
				</div>
				<br><input type="button" value="Agregar basco" onclick='agregarBarco();' />
			</fieldset>
			<input type="submit" value="Modificar proveedor">
			<br><br><input type="button" value="Eliminar proveedor" onclick='window.location.replace("?del=true&nombre=<?php echo($_GET["nombre"]);?>");'>
		</form>
		
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("verProveedor.php");' />
	</body>
</html>