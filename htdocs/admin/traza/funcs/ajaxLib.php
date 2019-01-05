<?php
	include "_conn.php";

	switch($_POST["task"]){
		case "getBarcosOpt":
			$link = _conn();
			$result = $link->query("SELECT * FROM `proveedores` WHERE `Nombre`='".$_POST["nombre"]."'");
			$row = $result->fetch_assoc();
			$barcos = explode("|",$row['Barcos']);
			$options = "";
			for($i = 0; $i < sizeof($barcos); $i++){
				$options .= '<option value="'.$barcos[$i].'">'.$barcos[$i].'</option>';
			}
			$link->close();
			echo $options;
		break;
		case "getClienteData":
			$link = _conn();
			$result = $link->query("SELECT * FROM `clientes` WHERE `Nombre`='".$_POST["nombre"]."'");
			$row = $result->fetch_assoc();
			$link->close();
			echo $row["Poblacion"]."|".$row["Direccion"]."|".$row["DNI"];
		break;
		case "getEntradaData":
			$link = _conn();
			$result = $link->query("SELECT * FROM `entradas` WHERE `ID`='".$_POST["nombre"]."'");
			$row = $result->fetch_assoc();
			$link->close();
			echo $row["ID"]."|".$row["Fecha"]."|".$row["Genero"]."|".$row["Kg"]."|".$row["Escandallo"]."|".$row["Proveedor"]."|".$row["Barco"]."|".$row["Marea"]."|".$row["Envase"]."|".$row["Etiquetado"]."|".$row["Caducidad"]."|".$row["Temperatura"]."|".$row["Restante"];
		break;
		default:
			echo "TaskError";
		break;
	}
?>