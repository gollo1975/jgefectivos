<?php

	include $_SERVER ['DOCUMENT_ROOT'].'/jgefectivo/cronograma/clases.php';
	
	switch ($_REQUEST ["opc"])	{
	
		case 1:
			
			$fecha = $_POST ["fecha"];	
			$hora = $_POST ["hora"];	
			$tipo = $_POST ["tipo"];	
			$descripcion = $_POST ["descripcion"];	
			
			Cronograma :: insertar ($fecha, $hora, $tipo, $descripcion);
			exit ();
			break;
			
		case 2:
		
			$opcC = 2;
			$campoC = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorC = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoC = Cronograma :: listar ($opcC, $campoC, $valorC);
			
			include ("listadoCronograma.php");
			exit ();
			break;			
	}
?>