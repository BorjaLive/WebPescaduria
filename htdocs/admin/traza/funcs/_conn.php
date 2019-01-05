<?php
	header('Access-Control-Allow-Origin: *');
	$nombre_meses = array('01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre');


	Function _conn(){
		global $sql_host,$sql_user,$sql_pass,$sql_base;
		return new mysqli("localhost", "root", "", "trazabilidad");
	}

	function getNPaginas($tabla){
		Global $ElementosPorPagina;
		$link = _conn();
		$result = $link->query("SELECT COUNT(*) FROM `".$tabla."`");
		$row = $result->fetch_assoc();
		$cantidad = $row["COUNT(*)"];
		$link->close();
		$paginas = 0;
		while($cantidad > 0){
			$cantidad -= $ElementosPorPagina;
			$paginas++;
		}
		return $paginas;
	}
	
	function acomar($elemento){
		$elementos = explode("|",$elemento);
		$cadena = "";
		for($i = 0; $i < sizeof($elementos); $i++){
			$cadena .= $elementos[$i].($i==sizeof($elementos)-1?"":", ");
		}
		return $cadena;
	}
	
	function getSiguiente($tipo){
		$link = _conn();
		$result = $link->query("SELECT * FROM `ultimos` WHERE `tipo`='".$tipo."'");
		$row = $result->fetch_assoc();
		$link->close();
		return $row["ultimo"];
	}
	function plusSiguiente($tipo){
		$link = _conn();
		$result = $link->query("SELECT * FROM `ultimos` WHERE `tipo`='".$tipo."'");
		$row = $result->fetch_assoc();
		$actual = $row["ultimo"];
		$nueva = date("y",time())."_".formatoTres(substr($actual, 3, 3)+1);
		$link->query("DELETE FROM `ultimos` WHERE `tipo`='".$tipo."'");
		$link->query("INSERT INTO `ultimos` (`tipo`, `ultimo`) VALUES ('".$tipo."', '".$nueva."');");
		$link->close();
	}
	
	function getFechaActual(){
		return date("d/m/y",time());
	}
	
	function formatoTres($n){
		if($n >= 100){
			return "".$n;
		}else{
			if($n >= 10){
				return "0".$n;
			}else{
				return "00".$n;
			}
		}
	}
	
	function getFecha($id){
	global $nombre_meses;
	$fecha = substr($id,0,2)." de ".$nombre_meses[substr($id,3,2)]." de 20".substr($id,6,2);
	return $fecha;
}
?>