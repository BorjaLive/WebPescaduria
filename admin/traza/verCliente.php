<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			if(empty($_GET["page"])){
				header("Location: ?page=1");
			}else{
				$clientes = getClientes($_GET["page"]);
				$NPaginas = getNPaginas("clientes");
			}
		?>
	</head>
	<body>
		<h1 style="text-align:center;">Lista de clientes</h1>
		
		<table border="1" align="center" style="text-align: center;">
			<tr>
				<td width="500px"><strong>Nombre</strong></td>
				<td width="200px"><strong>Población</strong></td>
				<td width="300px"><strong>Dirección</strong></td>
				<td width="100px"><strong>DNI</strong></td>
			</tr>
			<?php
				foreach( $clientes as $key => $value ) {
					echo "	<tr>
								<td>".$clientes[$key]["nombre"]."</td>
								<td>".$clientes[$key]["poblacion"]."</td>
								<td>".$clientes[$key]["direccion"]."</td>
								<td>".$clientes[$key]["DNI"]."</td>
								<td><input type='button' value='Editar' onclick='window.location.replace(\"editarCliente.php?nombre=".$clientes[$key]["nombre"]."\");' /></td>
							<tr>";
				}
			?>
		</table>
		<br>
		<div style="text-align: center; font-size: 22px">
			<input style="margin: auto;" type="button" value="<--" onclick='window.location.replace("?page=<?php echo $_GET["page"]==1?"1":$_GET["page"]-1; ?>");' />
			Nº <?php echo $_GET["page"]."/".$NPaginas;?>
			<input style="margin: auto;" type="button" value="-->" onclick='window.location.replace("?page=<?php echo $_GET["page"]==$NPaginas?$NPaginas:$_GET["page"]+1; ?>");' />
		</div>
		
		<br><input type="button" value="Regresar al panel" onclick='window.location.replace("panel.php");' />
	</body>
</html>