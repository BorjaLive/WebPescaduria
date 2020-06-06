<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			$NPaginas = getNPaginas("salidas");
			if(empty($_GET["page"])){
				header("Location: ?page=".($NPaginas==0?"1":$NPaginas));
			}else{
				$salidas = getSalidas($_GET["page"]);
			}
		?>
	</head>
	<body>
		<h1 style="text-align:center;">Lista de salidas</h1>
		
		<table border="1" align="center" style="text-align: center;">
			<tr>
				<td width="75"><strong>Número de entrada</strong></td>
				<td width="75"><strong>Fecha</strong></td>
				<td width="125"><strong>Genero</strong></td>
				<td width="50"><strong>Kg</strong></td>
				<td width="75"><strong>Escandallo</strong></td>
				<td width="125"><strong>Proveedor</strong></td>
				<td width="125"><strong>Barco</strong></td>
				<td width="50"><strong>Marea</strong></td>
				<td width="75"><strong>Número de salida</strong></td>
				<td width="100px"><strong>Envase</strong></td>
				<td width="100px"><strong>Etiquetado</strong></td>
				<td width="100px"><strong>Caducidad</strong></td>
				<td width="25"><strong>Aspecto</strong></td>
				<td width="100px"><strong>Temperatura</strong></td>
			</tr>
			<?php
				if($salidas != null){
					foreach( $salidas as $key => $value ) {
						echo "	<tr>
									<td>".$salidas[$key]["entrada"]."</td>
									<td>".$salidas[$key]["fecha"]."</td>
									<td>".$salidas[$key]["genero"]."</td>
									<td>".$salidas[$key]["kg"]."</td>
									<td>".$salidas[$key]["escandallo"]."</td>
									<td>".$salidas[$key]["proveedor"]."</td>
									<td>".$salidas[$key]["barco"]."</td>
									<td>".$salidas[$key]["marea"]."</td>
									<td>".$salidas[$key]["id"]."</td>
									<td>".$salidas[$key]["envase"]."</td>
									<td>".$salidas[$key]["etiquetado"]."</td>
									<td>".$salidas[$key]["caducidad"]."</td>
									<td>".$salidas[$key]["aspecto"]."</td>
									<td>".$salidas[$key]["temperatura"]."</td>
									<td><input type='button' value='Editar' onclick='window.location.replace(\"editarSalida.php?numero=".$salidas[$key]["id"]."\");' /></td>
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