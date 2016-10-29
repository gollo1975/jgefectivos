<?php

	include $_SERVER['DOCUMENT_ROOT'].'/jgefectivo/centroCostos/clases.php';
	
	switch ($_REQUEST ["opc"])	{
	
		case 1:
			
			$codcosto = $_POST ["codcosto"];
			$centro = $_POST ["centro"];
			Costo :: insertar ($codcosto, $centro);
			exit ();
			break;
			
		case 2:
		
			$opcCC = $_REQUEST ["opc"];
			$campoCC = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorCC = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoCC = Costo :: listar ($opcCC, $campoCC, $valorCC);
			include ("listarCostos.php");
			exit ();
			break;
			
		case 3:

			$valorCC = $_REQUEST ["valor"]; 
			$procesoCC = Costo :: eliminar ($valorCC);
			exit ();
			break;

		case 4:
		
			$opcCC = $_REQUEST ["opc"];
			$campoCC = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorCC = $_REQUEST ["valor"];
			$procesoCC = Costo :: listar ($opcCC, $campoCC, $valorCC);
			include ("modificarCostos.php");
			exit ();
			break;

		case 5:
			
			$codcosto = $_POST ["codcosto"];
			$centro = $_POST ["centro"];
			$procesoCC = Costo :: modificar ($codcosto, $centro);
			exit ();
			break;
	}
?>