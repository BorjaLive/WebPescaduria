<?php
	$ElementosPorPagina = 20;

	function crearCliente($nombre, $poblacion, $direccion, $dni){
		$link = _conn();
		$link->query("INSERT INTO `clientes` (`Nombre`, `Direccion`, `Poblacion`, `DNI`) VALUES ('".$nombre."', '".$direccion."', '".$poblacion."', '".$dni."')");
		$link->close();
	}
	function eliminarCliente($nombre){
		$link = _conn();
		$link->query("DELETE FROM `clientes` WHERE `Nombre` = '".$nombre."'");
		$link->close();
	}
	function getCliente($nombre){
		$link = _conn();
		$result = $link->query("SELECT * FROM `clientes` WHERE `Nombre`='".$nombre."'");
		$row = $result->fetch_assoc();
		$cliente = array('nombre' => $row['Nombre'], 'poblacion' => $row['Poblacion'], 'direccion' => $row['Direccion'], 'DNI' => $row['DNI']);
		$link->close();
		return $cliente;
	}
	function getClientes($pagina){
		Global $ElementosPorPagina;
		$link = _conn();
		$result = $link->query("SELECT * FROM `clientes`");
		$actual = 0;
		while($row = $result->fetch_assoc()){
			if($pagina != 0 and $actual == $pagina*$ElementosPorPagina ){
				break;
			}
			if($pagina == 0 or $actual >= ($pagina-1)*$ElementosPorPagina ){
				$clientes[] = array('nombre' => $row['Nombre'], 'poblacion' => $row['Poblacion'], 'direccion' => $row['Direccion'], 'DNI' => $row['DNI']);
			}
			$actual++;
		}
		$link->close();
		return $clientes;
	}

	function crearProveedor($nombre, $barcos){
		$link = _conn();
		$link->query("INSERT INTO `proveedores` (`Nombre`, `Barcos`) VALUES ('".$nombre."', '".$barcos."')");
		$link->close();
	}
	function eliminarProveedor($nombre){
		$link = _conn();
		$link->query("DELETE FROM `proveedores` WHERE `Nombre` = '".$nombre."'");
		$link->close();
	}
	function getProveedor($nombre){
		$link = _conn();
		$result = $link->query("SELECT * FROM `proveedores` WHERE `Nombre`='".$nombre."'");
		$row = $result->fetch_assoc();
		$proveedor = array('nombre' => $row['Nombre'], 'barcos' => $row['Barcos']);
		$link->close();
		return $proveedor;
	}
	function getProveedores($pagina){
		Global $ElementosPorPagina;
		$link = _conn();
		$result = $link->query("SELECT * FROM `proveedores`");
		$actual = 0;
		while($row = $result->fetch_assoc()){
			if($pagina != 0 and $actual == $pagina*$ElementosPorPagina ){
				break;
			}
			if($pagina == 0 or $actual >= ($pagina-1)*$ElementosPorPagina ){
				$proveedores[] = array('nombre' => $row['Nombre'], 'barcos' => $row['Barcos']);
			}
			$actual++;
		}
		$link->close();
		return $proveedores;
	}

	function crearEntrada($id, $fecha, $genero, $kg, $escandallo, $proveedor, $barco, $marea, $envase, $etiquetado, $caducidad, $aspecto, $temperatura, $restante = -1){
		$link = _conn();
		$link->query("INSERT INTO `entradas` (`ID`, `Fecha`, `Genero`, `Kg`, `Escandallo`, `Proveedor`, `Barco`, `Marea`, `Envase`, `Etiquetado`, `Caducidad`, `Aspecto`, `Temperatura`, `Restante`) VALUES ('".$id."', '".$fecha."', '".$genero."', '".$kg."', '".$escandallo."', '".$proveedor."', '".$barco."', '".$marea."', '".$envase."', '".$etiquetado."', '".$caducidad."', '".$aspecto."', '".$temperatura."', '".($restante==-1?$kg:$restante)."');");
		$link->close();
	}
	function eliminarEntrada($id){
		$link = _conn();
		$link->query("DELETE FROM `entradas` WHERE `ID` = '".$id."'");
		$link->close();
	}
	function getEntrada($id){
		$link = _conn();
		$result = $link->query("SELECT * FROM `entradas` WHERE `ID`='".$id."'");
		$row = $result->fetch_assoc();
		$entrada = array('id' => $row['ID'], 'fecha' => $row['Fecha'], 'genero' => $row['Genero'], 'kg' => $row['Kg'], 'escandallo' => $row['Escandallo'], 'proveedor' => $row['Proveedor'], 'barco' => $row['Barco'], 'marea' => $row['Marea'], 'envase' => $row['Envase'], 'etiquetado' => $row['Etiquetado'], 'caducidad' => $row['Caducidad'], 'aspecto' => $row['Aspecto'], 'temperatura' => $row['Temperatura'], 'restante' => $row['Restante']);
		$link->close();
		return $entrada;
	}
	function getEntradas($pagina){
		Global $ElementosPorPagina;
		$link = _conn();
		$result = $link->query("SELECT * FROM `entradas`");
		$actual = 0;
		while($row = $result->fetch_assoc()){
			if($pagina != 0 and $actual == $pagina*$ElementosPorPagina ){
				break;
			}
			if($pagina == 0 or $actual >= ($pagina-1)*$ElementosPorPagina ){
				$entradas[] = array('id' => $row['ID'], 'fecha' => $row['Fecha'], 'genero' => $row['Genero'], 'kg' => $row['Kg'], 'escandallo' => $row['Escandallo'], 'proveedor' => $row['Proveedor'], 'barco' => $row['Barco'], 'marea' => $row['Marea'], 'envase' => $row['Envase'], 'etiquetado' => $row['Etiquetado'], 'caducidad' => $row['Caducidad'], 'aspecto' => $row['Aspecto'], 'temperatura' => $row['Temperatura'], 'restante' => $row['Restante']);
			}
			$actual++;
		}
		if($actual == 0){
			$entradas = null;
		}
		$link->close();
		return $entradas;
	}

	function crearFactura($id, $fecha, $nombre, $direccion, $poblacion, $dni, $productos, $suma, $iva, $re, $total){
		$link = _conn();
		$link->query("INSERT INTO `facturas` (`ID`, `Fecha`, `Nombre`, `Direccion`, `Poblacion`, `DNI`, `Productos`, `Suma`, `IVA`, `RE`, `Total`) VALUES ('".$id."', '".$fecha."', '".$nombre."', '".$direccion."', '".$poblacion."', '".$dni."', '".$productos."', '".$suma."', '".$iva."', '".$re."', '".$total."');");
		$link->close();
	}
	function eliminarFactura($id){
		$link = _conn();
		$link->query("DELETE FROM `facturas` WHERE `ID` = '".$id."'");
		$link->close();
	}
	function getFactura($id){
		$link = _conn();
		$result = $link->query("SELECT * FROM `facturas` WHERE `ID`='".$id."'");
		$row = $result->fetch_assoc();
		$factura = array('id' => $row['ID'], 'fecha' => $row['Fecha'], 'nombre' => $row['Nombre'], 'poblacion' => $row['Poblacion'], 'direccion' => $row['Direccion'], 'dni' => $row['DNI'], 'productos' => $row['Productos'], 'suma' => $row['Suma'], 'iva' => $row['IVA'], 're' => $row['RE'], 'total' => $row['Total']);
		$link->close();
		return $factura;
	}
	function getFacturas($pagina){
		Global $ElementosPorPagina;
		$link = _conn();
		$result = $link->query("SELECT * FROM `facturas`");
		$actual = 0;
		$facturas = Array();
		while($row = $result->fetch_assoc()){
			if($pagina != 0 and $actual == $pagina*$ElementosPorPagina ){
				break;
			}
			if($pagina == 0 or $actual >= ($pagina-1)*$ElementosPorPagina ){
				$facturas[] = array('id' => $row['ID'], 'fecha' => $row['Fecha'], 'nombre' => $row['Nombre'], 'poblacion' => $row['Poblacion'], 'direccion' => $row['Direccion'], 'dni' => $row['DNI'], 'productos' => $row['Productos'], 'suma' => $row['Suma'], 'iva' => $row['IVA'], 're' => $row['RE'], 'total' => $row['Total']);
			}
			$actual++;
		}
		$link->close();
		return $facturas;
	}

	function creaSalida($entrada, $fecha, $genero, $escandallo, $kg, $proveedor, $barco, $marea, $id, $envase, $etiquetado, $caducidad, $aspecto, $temperatura){
		$link = _conn();
		$link->query("INSERT INTO `salidas` (`Entrada`, `Fecha`, `Genero`, `Escandallo`, `Kg`, `Proveedor`, `Barco`, `Marea`, `ID`, `Envase`, `Etiquetado`, `Caducidad`, `Aspecto`, `Temperatura`) VALUES ('".$entrada."', '".$fecha."', '".$genero."', '".$escandallo."', '".$kg."', '".$proveedor."', '".$barco."', '".$marea."', '".$id."', '".$envase."', '".$etiquetado."', '".$caducidad."', '".$aspecto."', '".$temperatura."');");
		$link->close();
	}
	function eliminarSalida($id){
		$link = _conn();
		$link->query("DELETE FROM `salidas` WHERE `ID` = '".$id."'");
		$link->close();
	}
	function getSalida($id){
		$link = _conn();
		$result = $link->query("SELECT * FROM `salidas` WHERE `ID`='".$id."'");
		$row = $result->fetch_assoc();
		$salida = array('entrada' => $row['Entrada'], 'fecha' => $row['Fecha'], 'escandallo' => $row['Escandallo'], 'aspecto' => $row['Aspecto'], 'genero' => $row['Genero'], 'kg' => $row['Kg'], 'proveedor' => $row['Proveedor'], 'barco' => $row['Barco'], 'marea' => $row['Marea'], 'id' => $row['ID'], 'envase' => $row['Envase'], 'etiquetado' => $row['Etiquetado'], 'caducidad' => $row['Caducidad'], 'temperatura' => $row['Temperatura']);
		$link->close();
		return $salida;
	}
	function getSalidas($pagina){
		Global $ElementosPorPagina;
		$link = _conn();
		$result = $link->query("SELECT * FROM `salidas`");
		$actual = 0;
		$salidas = Array();
		while($row = $result->fetch_assoc()){
			if($pagina != 0 and $actual == $pagina*$ElementosPorPagina ){
				break;
			}
			if($pagina == 0 or $actual >= ($pagina-1)*$ElementosPorPagina ){
				$salidas[] = array('entrada' => $row['Entrada'], 'fecha' => $row['Fecha'], 'escandallo' => $row['Escandallo'], 'aspecto' => $row['Aspecto'], 'genero' => $row['Genero'], 'kg' => $row['Kg'], 'proveedor' => $row['Proveedor'], 'barco' => $row['Barco'], 'marea' => $row['Marea'], 'id' => $row['ID'], 'envase' => $row['Envase'], 'etiquetado' => $row['Etiquetado'], 'caducidad' => $row['Caducidad'], 'temperatura' => $row['Temperatura']);
			}
			$actual++;
		}
		$link->close();
		return $salidas;
	}
?>
