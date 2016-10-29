<?php

	include $_SERVER ['DOCUMENT_ROOT'].'/jgefectivo/hojavida/clases.php';
	
	switch ($_REQUEST ["opc"])	{
	
		case 1:
		
			$opcHV = 1;
			$campoHV = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorHV = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoHV = HojaVida :: listar ($opcHV, $campoHV, $valorHV);
			
			include ("listadoHojaVida.php");
			exit ();
			break;
			
		case 2:
		
			$opcHV = 2;
			$campoHV = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorHV = $_REQUEST["valor"];
			$procesoHV = HojaVida :: listar ($opcHV, $campoHV, $valorHV);
			
			$opcHHV = 4;
			$campoHHV = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorHHV = $_REQUEST["valor"];
			$procesoHHV = HistorialHojaVida :: listar ($opcHHV, $campoHHV, $valorHHV);
			
			include ("listadoEspecificoHojaVida.php");
			exit ();
			break;			
			
		case 3:
		
			$opcHV = 3;
			$campoHV = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorHV = $_REQUEST["valor"];
			$procesoHV = HojaVida :: listar ($opcHV, $campoHV, $valorHV);
			
			include ("agregarMantenimiento.php");
			exit ();
			break;	
			
		case 5:
		
			$codigoPC = $_POST ["codigoPC"];
			$fechaProceso = $_POST ["fechaProceso"];
			$fechaCompra = $_POST ["fechaCompra"];
			$empleado = $_POST  ["empleado"];
			$tipoPC = $_POST ["tipoPC"];
			$cpuMarca = $_POST ["cpuMarca"];
			$cpuDescripcion = $_POST ["cpuDescripcion"];
			$ram = $_POST ["ram"];
			$ddMarca = $_POST ["ddMarca"];
			$ddCapacidad = $_POST ["ddCapacidad"];
			$monitorMarca = $_POST ["monitorMarca"];
			$monitorTamano = $_POST ["monitorTamano"];
			$impresoraMarca = $_POST ["impresoraMarca"];
			$impresoraTipo = $_POST ["impresoraTipo"];
			$scannerMarca = $_POST ["scannerMarca"];
			$scannerTipo = $_POST ["scannerTipo"];
			$copiadora = $_POST ["copiadora"];
			$telefono = $_POST ["telefono"];
			$diadema = $_POST ["diadema"];
			$parlantes = $_POST ["parlantes"];
			$teclado = $_POST ["teclado"];
			$mouse = $_POST ["mouse"];
			$usbMarca = $_POST ["usbMarca"];
			$usbCapacidad = $_POST ["usbCapacidad"];
			$sdMarca = $_POST ["sdMarca"];
			$sdCapacidad = $_POST ["sdCapacidad"];
			$basePortatil = $_POST ["basePortatil"];
			$equipoAudio = $_POST ["equipoAudio"];
			$camara = $_POST ["camara"];
			$movilMarca = $_POST ["movilMarca"];
			$movilOperador = $_POST ["movilOperador"];
			$radio = $_POST ["radio"];
			$regulador = $_POST ["regulador"];
			$ups = $_POST ["ups"];
			$descripcion = $_POST ["descripcion"];	
			
			HojaVida :: insertar ($codigoPC, $fechaProceso, $fechaCompra, $empleado, $tipoPC, $cpuMarca, $cpuDescripcion, $ram, $ddMarca, $ddCapacidad, $monitorMarca, $monitorTamano, $impresoraMarca, $impresoraTipo, $scannerMarca, $scannerTipo, $copiadora, $telefono, $diadema, $parlantes, $teclado, $mouse, $usbMarca, $usbCapacidad, $sdMarca, $sdCapacidad, $basePortatil, $equipoAudio, $camara, $movilMarca, $movilOperador, $radio, $regulador, $ups, $descripcion);
			exit ();
			break;			
			
		case 10: //ingreso de Hoja de Vida
		
			$codigoPC = $_POST ["codigoPC"];
			$fechaProceso = $_POST ["fechaProceso"];
			$fechaCompra = $_POST ["fechaCompra"];
			$area = $_POST ["area"];
			$empleado = $_POST  ["empleado"];
			$tipoPC = $_POST ["tipoPC"];
			$cpuMarca = $_POST ["cpuMarca"];
			$cpuDescripcion = $_POST ["cpuDescripcion"];
			$ram = $_POST ["ram"];
			$ddMarca = $_POST ["ddMarca"];
			$ddCapacidad = $_POST ["ddCapacidad"];
			$monitorMarca = $_POST ["monitorMarca"];
			$monitorTamano = $_POST ["monitorTamano"];
			$impresoraMarca = $_POST ["impresoraMarca"];
			$impresoraTipo = $_POST ["impresoraTipo"];
			$scannerMarca = $_POST ["scannerMarca"];
			$scannerTipo = $_POST ["scannerTipo"];
			$copiadora = $_POST ["copiadora"];
			$telefono = $_POST ["telefono"];
			$diadema = $_POST ["diadema"];
			$parlantes = $_POST ["parlantes"];
			$teclado = $_POST ["teclado"];
			$mouse = $_POST ["mouse"];
			$usbMarca = $_POST ["usbMarca"];
			$usbCapacidad = $_POST ["usbCapacidad"];
			$sdMarca = $_POST ["sdMarca"];
			$sdCapacidad = $_POST ["sdCapacidad"];
			$basePortatil = $_POST ["basePortatil"];
			$equipoAudio = $_POST ["equipoAudio"];
			$camara = $_POST ["camara"];
			$movilMarca = $_POST ["movilMarca"];
			$movilOperador = $_POST ["movilOperador"];
			$radio = $_POST ["radio"];
			$regulador = $_POST ["regulador"];
			$ups = $_POST ["ups"];
			
			HojaVida :: ingreso ($codigoPC, $fechaProceso, $fechaCompra, $area, $empleado, $tipoPC, $cpuMarca, $cpuDescripcion, $ram, $ddMarca, $ddCapacidad, $monitorMarca, $monitorTamano, $impresoraMarca, $impresoraTipo, $scannerMarca, $scannerTipo, $copiadora, $telefono, $diadema, $parlantes, $teclado, $mouse, $usbMarca, $usbCapacidad, $sdMarca, $sdCapacidad, $basePortatil, $equipoAudio, $camara, $movilMarca, $movilOperador, $radio, $regulador, $ups);
			exit ();
			break;			
				
	}

?>