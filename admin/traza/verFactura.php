<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			$NPaginas = getNPaginas("facturas");
			if(empty($_GET["page"])){
				header("Location: ?page=".($NPaginas==0?"1":$NPaginas));
			}else{
				$facturas = getFacturas($_GET["page"]);
			}
		?>
	</head>
	<body>
		<h1 style="text-align:center;">Lista de facturas</h1>
		
		<table border="1" align="center" style="text-align: center;">
			<tr>
				<td width="75"><strong>Número</strong></td>
				<td width="75"><strong>Fecha</strong></td>
				<td width="150"><strong>Nombre</strong></td>
				<td width="125"><strong>Población</strong></td>
				<td width="125"><strong>Dirección</strong></td>
				<td width="75"><strong>DNI</strong></td>
				<td width="50"><strong>Suma</strong></td>
				<td width="50"><strong>I.V.A.</strong></td>
				<td width="50"><strong>R.E.</strong></td>
				<td width="50"><strong>Total</strong></td>
			</tr>
			<?php
				if($facturas != null){
					foreach( $facturas as $key => $value ) {
						echo "	<tr>
									<td>".$facturas[$key]["id"]."</td>
									<td>".$facturas[$key]["fecha"]."</td>
									<td>".$facturas[$key]["nombre"]."</td>
									<td>".$facturas[$key]["poblacion"]."</td>
									<td>".$facturas[$key]["direccion"]."</td>
									<td>".$facturas[$key]["dni"]."</td>
									<td>".$facturas[$key]["suma"]."</td>
									<td>".$facturas[$key]["iva"]."</td>
									<td>".$facturas[$key]["re"]."</td>
									<td>".$facturas[$key]["total"]."</td>
									<td><input type='button' value='Editar' onclick='window.location.replace(\"editarFactura.php?numero=".$facturas[$key]["id"]."\");' /></td>
									<td><input type='button' value='Imprimir' onclick='window.open(\"imprimirFactura.php?numero=".$facturas[$key]["id"]."\",\"_blank\");' /></td>
								<tr>";
					}
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