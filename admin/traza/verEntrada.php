<html>
	<head>
		<title>Administración</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<?php
			include "funcs/_secure.php";
			include "funcs/_conn.php";
			include "funcs/_elementals.php";
			
			$NPaginas = getNPaginas("entradas");
			if(empty($_GET["page"])){
				header("Location: ?page=".($NPaginas==0?"1":$NPaginas));
			}else{
				$entradas = getEntradas($_GET["page"]);
			}
		?>
	</head>
	<body>
		<h1 style="text-align:center;">Lista de entradas</h1>
		
		<table border="1" align="center" style="text-align: center;">
			<tr>
				<td width="75"><strong>Número</strong></td>
				<td width="75"><strong>Fecha</strong></td>
				<td width="125"><strong>Genero</strong></td>
				<td width="50"><strong>Kg</strong></td>
				<td width="75"><strong>Escandallo</strong></td>
				<td width="125"><strong>Proveedor</strong></td>
				<td width="125"><strong>Barco</strong></td>
				<td width="50"><strong>Marea</strong></td>
				<td width="100px"><strong>Envase</strong></td>
				<td width="100px"><strong>Etiquetado</strong></td>
				<td width="100px"><strong>Caducidad</strong></td>
				<td width="25"><strong>Aspecto</strong></td>
				<td width="100px"><strong>Temperatura</strong></td>
				<td width="25"><strong>Kg en almacén</strong></td>
			</tr>
			<?php
				if($entradas != null){
					foreach( $entradas as $key => $value ) {
						echo "	<tr>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["id"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["fecha"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["genero"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["kg"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["escandallo"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["proveedor"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["barco"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["marea"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["envase"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["etiquetado"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["caducidad"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["aspecto"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".$entradas[$key]["temperatura"]."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." >".($entradas[$key]["restante"]<0.1?"0":$entradas[$key]["restante"])."</td>
									<td ".($entradas[$key]["restante"]>=0.5?"style='background:#dddddd'":"")." ><input type='button' value='Editar' onclick='window.location.replace(\"editarEntrada.php?numero=".$entradas[$key]["id"]."\");' /></td>
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