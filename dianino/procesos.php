<?php session_start (); ?>

<?php

	//include $_SERVER ["DOCUMENT_ROOT"].'/jgefectivo/dianino/clases.php';
	include ("clases.php");
	
	switch ($_REQUEST ["opc"]) {
	
		case 1:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			include ("listarEmpleado.php");
			exit ();
			break;
			
		case 2:
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			include ("listarEmpleado.php");
			exit ();
			break;
			
		case 3:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$_SESSION["departamento"] = $xdepto;
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			include ("listarEmpleado.php");
			exit ();
			break;
			
		case 4:
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$_SESSION["departamento"] = $xdepto;
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			include ("listarEmpleado.php");
			exit ();
			break;			
	}
?>