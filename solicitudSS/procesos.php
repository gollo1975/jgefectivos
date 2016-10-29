<?php
	include $_SERVER ["DOCUMENT_ROOT"].'/jgefectivo/solicitudSS/clases.php';
	
	switch ($_REQUEST ["opc"])	{
	
		case 1:
			$opc = 1;
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_POST ["cedula"];
			$proceso = Empleado :: listar ($opc, $campo, $valor);
			include ("Solicitud.php");
			exit ();
			break;
			
		case 2:
		
			$cedula = $_POST ["cedula"];
			$nombre = $_POST ["nombre"];
			$zona = $_POST ["zona"];
			$fecha = $_POST ["fecha"];
			$hora = $_POST ["hora"];
			$recibe = $_POST ["recibe"];
			
			SolicitudSS :: insertar ($cedula, $nombre, $zona, $fecha, $hora, $recibe);
			exit ();
			break;
			
		case 3:
			$opc = 3;
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$proceso = SolicitudSS :: listar ($opc, $campo, $valor);
			include ("listadoSolicitud.php");
			exit ();
			break;
			
	}
?>