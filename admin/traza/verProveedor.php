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
				$proveedor = getProveedores($_GET["page"]);
				$NPaginas = getNPaginas("proveedores");
			}
		?>
	</head>
	<body>
		<h1 style="text-align:center;">Lista de proveedores</h1>
		
		<table border="1" align="center" style="text-align: center;">
			<tr>
				<td width="500px"><strong>Nombre</strong></td>
				<td width="500px"><strong>Población</strong></td>
			</tr>
			<?php
				foreach( $proveedor as $key => $value ) {
					echo "	<tr>
								<td>".$proveedor[$key]["nombre"]."</td>
								<td>".acomar($proveedor[$key]["barcos"])."</td>
								<td><input type='button' value='Editar' onclick='window.location.replace(\"editarProveedor.php?nombre=".$proveedor[$key]["nombre"]."\");' /></td>
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