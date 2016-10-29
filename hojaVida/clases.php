<?php

	class HojaVida	{
	
		var $codigoPC;
		var $fechaEntrega;
		var $fechaCompra;
		var $area;
		var $empleado;
		var $tipoPC;
		var $cpuMarca;
		var $cpuDescripcion;
		var $ram;
		var $ddMarca;
		var $ddCapacidad;
		var $monitorMarca;
		var $monitorTamano;
		var $impresoraMarca;
		var $impresoraTipo;
		var $scannerMarca;
		var $scannerTipo;
		var $copiadora;
		var $telefono;
		var $diadema;
		var $parlantes;
		var $teclado;
		var $mouse;
		var $usbMarca;
		var $usbCapacidad;
		var $sdMarca;
		var $sdCapacidad;
		var $basePortatil;
		var $equipoAudio;
		var $camara;
		var $movilMarca;
		var $movilOperador;
		var $radio;
		var $regulador;
		var $ups;

		function HojaVida ($_codigoPC, $_fechaEntrega, $_fechaCompra, $_area, $_empleado, $_tipoPC, $_cpuMarca, $_cpuDescripcion, $_ram, $_ddMarca, $_ddCapacidad, $_monitorMarca, $_monitorTamano, $_impresoraMarca, $_impresoraTipo, $_scannerMarca,  $_scannerTipo, $_copiadora, $_telefono, $_diadema, $_parlantes,  $_teclado, $_mouse, $_usbMarca, $_usbCapacidad, $_sdMarca, $_sdCapacidad, $_basePortatil, $_equipoAudio, $_camara, $_movilMarca, $_movilOperador, $_radio, $_regulador, $_ups)	{ 
				
			$this -> codigoPC = $_codigoPC;
			$this -> fechaEntrega = $_fechaEntrega;
			$this -> fechaCompra = $_fechaCompra;
			$this -> area = $_area;
			$this -> empleado = $_empleado;
			$this -> tipoPC = $_tipoPC;
			$this -> cpuMarca = $_cpuMarca;
			$this -> cpuDescripcion = $_cpuDescripcion;
			$this -> ram = $_ram;
			$this -> ddMarca = $_ddMarca;
			$this -> ddCapacidad = $_ddCapacidad;
			$this -> monitorMarca = $_monitorMarca;
			$this -> monitorTamano = $_monitorTamano;
			$this -> impresoraMarca = $_impresoraMarca;
			$this -> impresoraTipo = $_impresoraTipo;
			$this -> scannerMarca = $_scannerMarca;
			$this -> scannerTipo = $_scannerTipo;
			$this -> copiadora = $_copiadora;
			$this -> telefono = $_telefono;
			$this -> diadema = $_diadema;
			$this -> parlantes = $_parlantes;
			$this -> teclado = $_teclado;
			$this -> mouse = $_mouse;
			$this -> usbMarca = $_usbMarca;
			$this -> usbCapacidad = $_usbCapacidad;
			$this -> sdMarca = $_sdMarca;
			$this -> sdCapacidad = $_sdCapacidad;
			$this -> basePortatil = $_basePortatil;
			$this -> equipoAudio = $_equipoAudio;
			$this -> camara = $_camara;
			$this -> movilMarca = $_movilMarca;
			$this -> movilOperador = $_movilOperador;
			$this -> radio = $_radio;
			$this -> regulador = $_regulador;
			$this -> ups = $_ups;
		}
		
		public static function insertar (	$_codigoPC, 	$_fechaProceso, 	$_fechaCompra, 		$_empleado, 		$_tipoPC, 			$_cpuMarca, 		$_cpuDescripcion, 	$_ram, 	
											$_ddMarca,		$_ddCapacidad, 		$_monitorMarca, 	$_monitorTamano, 	$_impresoraMarca, 	$_impresoraTipo, 
											$_scannerMarca, $_scannerTipo, 		$_copiadora, 		$_telefono, 		$_diadema, 			$_parlantes,  
											$_teclado, 		$_mouse, 			$_usbMarca, 		$_usbCapacidad, 	$_sdMarca, 			$_sdCapacidad, 
											$_basePortatil, $_equipoAudio, 		$_camara, 			$_movilMarca, 		$_movilOperador, 	$_radio, 
											$_regulador, 	$_ups, 				$_descripcion) {
		
		
			include ("conexion.php");
			$resultado = mysqli_query ($cnn, "insert into historialhojavida 
			(codigoPC,	fechaProceso,	fechaCompra, tipoPC,	cpuMarca,	cpuDescripcion,	ram,	ddMarca, ddCapacidad, monitorMarca, monitorTamano, impresoraMarca, impresoraTipo, scannerMarca, scannerTipo, copiadora, telefono, diadema, parlantes,  teclado, mouse, usbMarca, usbCapacidad, sdMarca, sdCapacidad, basePortatil, equipoAudio, camara, movilMarca, movilOperador, radio, regulador, ups, descripcion) values ('$_codigoPC', '$_fechaProceso', '$_fechaCompra', '$_tipoPC', '$_cpuMarca', '$_cpuDescripcion', '$_ram', '$_ddMarca', '$_ddCapacidad', '$_monitorMarca', '$_monitorTamano', '$_impresoraMarca', '$_impresoraTipo', '$_scannerMarca', '$_scannerTipo', '$_copiadora', '$_telefono', '$_diadema', '$_parlantes',  '$_teclado', '$_mouse', '$_usbMarca', '$_usbCapacidad', '$_sdMarca', '$_sdCapacidad', '$_basePortatil', '$_equipoAudio', '$_camara', '$_movilMarca', '$_movilOperador', '$_radio', '$_regulador', '$_ups', '$_descripcion')");
			
			$resultado = mysqli_query ($cnn, "update hojavida set  fechaEntrega = '$_fechaProceso',	fechaCompra = '$_fechaCompra', empleado = '$_empleado', tipoPC = '$_tipoPC', cpuMarca = '$_cpuMarca', cpuDescripcion = '$_cpuDescripcion', ram = '$_ram', ddMarca = '$_ddMarca', ddCapacidad = '$_ddCapacidad', monitorMarca = '$_monitorMarca', monitorTamano = '$_monitorTamano', impresoraMarca = '$_impresoraMarca', impresoraTipo = '$_impresoraTipo', scannerMarca = '$_scannerMarca', scannerTipo = '$_scannerTipo', copiadora = '$_copiadora', telefono = '$_telefono', diadema = '$_diadema', parlantes = '$_parlantes',  teclado = '$_teclado', mouse = '$_mouse', usbMarca = '$_usbMarca', usbCapacidad = '$_usbCapacidad', sdMarca = '$_sdMarca', sdCapacidad = '$_sdCapacidad', basePortatil = '$_basePortatil', equipoAudio = '$_equipoAudio', camara = '$_camara', movilMarca = '$_movilMarca', movilOperador = '$_movilOperador', radio = '$_radio', regulador = '$_regulador', ups = '$_ups' where codigoPC = '$_codigoPC'");
			
			echo "<script type = 'text/javascript'> alert ('Registrl Almacenado'); history.back (); </script>";
		
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			if ($_opc == 1)	
			
				$consulta = "select * from hojavida";
			elseif ($_opc == 2)	
			
				$consulta = "select * from hojavida where codigoPC = '$_valor'";
				
			elseif ($_opc == 3)	
			
				$consulta = "select * from hojavida where codigoPC = '$_valor'";
				
			elseif ($_opc == 4)	
			
				$consulta = "select * from hisorialhojavida where codigoPC = '$_valor'";
				
			
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existen Hojas de Vida'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, HojaVida :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_codigoPC = $_datos ["codigoPC"];
			$_fechaEntrega = $_datos ["fechaEntrega"];
			$_fechaCompra = $_datos ["fechaCompra"];
			$_area = $_datos ["area"];
			$_empleado = $_datos ["empleado"];
			$_tipoPC = $_datos ["tipoPC"];
			$_cpuMarca = $_datos ["cpuMarca"];
			$_cpuDescripcion = $_datos ["cpuDescripcion"];
			$_ram = $_datos ["ram"];
			$_ddMarca = $_datos ["ddMarca"];
			$_ddCapacidad = $_datos ["ddCapacidad"];
			$_monitorMarca = $_datos ["monitorMarca"];
			$_monitorTamano = $_datos ["monitorTamano"];
			$_impresoraMarca = $_datos ["impresoraMarca"];
			$_impresoraTipo = $_datos ["impresoraTipo"];
			$_scannerMarca = $_datos ["scannerMarca"];
			$_scannerTipo = $_datos ["scannerTipo"];
			$_copiadora = $_datos ["copiadora"];
			$_telefono = $_datos ["telefono"];
			$_diadema = $_datos ["diadema"];
			$_parlantes = $_datos ["parlantes"];
			$_teclado = $_datos ["teclado"];
			$_mouse = $_datos ["mouse"];
			$_usbMarca = $_datos ["usbMarca"];
			$_usbCapacidad = $_datos ["usbCapacidad"];
			$_sdMarca = $_datos ["sdMarca"];
			$_sdCapacidad = $_datos ["sdCapacidad"];
			$_basePortatil = $_datos ["basePortatil"];
			$_equipoAudio = $_datos ["equipoAudio"];
			$_camara = $_datos ["camara"];
			$_movilMarca = $_datos ["movilMarca"];
			$_movilOperador = $_datos ["movilOperador"];
			$_radio = $_datos ["radio"];
			$_regulador = $_datos ["regulador"];
			$_ups = $_datos ["ups"];
			
			$hojaVida = new HojaVida ($_codigoPC, $_fechaEntrega, $_fechaCompra, $_area, $_empleado, $_tipoPC, $_cpuMarca, $_cpuDescripcion, $_ram, $_ddMarca, $_ddCapacidad, $_monitorMarca, $_monitorTamano, $_impresoraMarca, $_impresoraTipo, $_scannerMarca,  $_scannerTipo, $_copiadora, $_telefono, $_diadema, $_parlantes,  $_teclado, $_mouse, $_usbMarca, $_usbCapacidad, $_sdMarca, $_sdCapacidad, $_basePortatil, $_equipoAudio, $_camara, $_movilMarca, $_movilOperador, $_radio, $_regulador, $_ups);
			
			return $hojaVida;
			
		}
		
		public static function ingreso (	$_codigoPC, 		$_fechaEntrega, $_fechaCompra, 		$_area, 			$_empleado, 		$_tipoPC, 			$_cpuMarca,
		 									$_cpuDescripcion, 	$_ram, 			$_ddMarca,			$_ddCapacidad, 		$_monitorMarca, 	$_monitorTamano,
											$_impresoraMarca, 	$_impresoraTipo,$_scannerMarca, 	$_scannerTipo, 		$_copiadora, 		$_telefono,
											$_diadema, 			$_parlantes,  	$_teclado, 			$_mouse, 			$_usbMarca, 		$_usbCapacidad,
											$_sdMarca, 			$_sdCapacidad, 	$_basePortatil, 	$_equipoAudio, 		$_camara, 			$_movilMarca,
											$_movilOperador, 	$_radio, 		$_regulador, 		$_ups) {
		
		
			include ("conexion.php");
			
			$resultado = mysqli_query ($cnn, "select * from hojavida where codigoPc = '$_codigoPC'");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				$resultado = mysqli_query ($cnn, "insert into hojavida (codigoPC, fechaEntrega,	fechaCompra, area, empleado, tipoPC,	cpuMarca,	cpuDescripcion,	ram,	ddMarca, ddCapacidad, monitorMarca, monitorTamano, impresoraMarca, impresoraTipo, scannerMarca, scannerTipo, copiadora, telefono, diadema, parlantes,  teclado, mouse, usbMarca, usbCapacidad, sdMarca, sdCapacidad, basePortatil, equipoAudio, camara, movilMarca, movilOperador, radio, regulador, ups) values ('$_codigoPC', '$_fechaEntrega', '$_fechaCompra', '$_area', '$_empleado', '$_tipoPC', '$_cpuMarca', '$_cpuDescripcion', '$_ram', '$_ddMarca', '$_ddCapacidad', '$_monitorMarca', '$_monitorTamano', '$_impresoraMarca', '$_impresoraTipo', '$_scannerMarca', '$_scannerTipo', '$_copiadora', '$_telefono', '$_diadema', '$_parlantes',  '$_teclado', '$_mouse', '$_usbMarca', '$_usbCapacidad', '$_sdMarca', '$_sdCapacidad', '$_basePortatil', '$_equipoAudio', '$_camara', '$_movilMarca', '$_movilOperador', '$_radio', '$_regulador', '$_ups')");
			
				$resultado = mysqli_query ($cnn, "insert into historialhojavida (codigoPC, fechaProceso, fechaCompra, tipoPC, cpuMarca,	cpuDescripcion,	ram,	ddMarca, ddCapacidad, monitorMarca, monitorTamano, impresoraMarca, impresoraTipo, scannerMarca, scannerTipo, copiadora, telefono, diadema, parlantes,  teclado, mouse, usbMarca, usbCapacidad, sdMarca, sdCapacidad, basePortatil, equipoAudio, camara, movilMarca, movilOperador, radio, regulador, ups, descripcion) values ('$_codigoPC', '$_fechaEntrega', '$_fechaCompra', '$_tipoPC', '$_cpuMarca', '$_cpuDescripcion', '$_ram', '$_ddMarca', '$_ddCapacidad', '$_monitorMarca', '$_monitorTamano', '$_impresoraMarca', '$_impresoraTipo', '$_scannerMarca', '$_scannerTipo', '$_copiadora', '$_telefono', '$_diadema', '$_parlantes',  '$_teclado', '$_mouse', '$_usbMarca', '$_usbCapacidad', '$_sdMarca', '$_sdCapacidad', '$_basePortatil', '$_equipoAudio', '$_camara', '$_movilMarca', '$_movilOperador', '$_radio', '$_regulador', '$_ups', '')");
			
				echo "<script type = 'text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";
			}
			else
			
				echo "<script type = 'text/javascript'> alert ('El Registro ya Existe'); history.back (); </script>";
		}		
	}
	
	
class HistorialHojaVida	{
	
		var $codigoPC;
		var $fechaProceso;
		var $fechaCompra;
		var $tipoPC;
		var $cpuMarca;
		var $cpuDescripcion;
		var $ram;
		var $ddMarca;
		var $ddCapacidad;
		var $monitorMarca;
		var $monitorTamano;
		var $impresoraMarca;
		var $impresoraTipo;
		var $scannerMarca;
		var $scannerTipo;
		var $copiadora;
		var $telefono;
		var $diadema;
		var $parlantes;
		var $teclado;
		var $mouse;
		var $usbMarca;
		var $usbCapacidad;
		var $sdMarca;
		var $sdCapacidad;
		var $basePortatil;
		var $equipoAudio;
		var $camara;
		var $movilMarca;
		var $movilOperador;
		var $radio;
		var $regulador;
		var $ups;
		var $descripcion;

		function HistorialHojaVida ($_codigoPC, $_fechaProceso, $_fechaCompra, $_tipoPC, $_cpuMarca, $_cpuDescripcion, $_ram, $_ddMarca, $_ddCapacidad, $_monitorMarca, $_monitorTamano, $_impresoraMarca, $_impresoraTipo, $_scannerMarca,  $_scannerTipo, $_copiadora, $_telefono, $_diadema, $_parlantes,  $_teclado, $_mouse, $_usbMarca, $_usbCapacidad, $_sdMarca, $_sdCapacidad, $_basePortatil, $_equipoAudio, $_camara, $_movilMarca, $_movilOperador, $_radio, $_regulador, $_ups, $_descripcion)	{ 
				
			$this -> codigoPC = $_codigoPC;
			$this -> fechaProceso = $_fechaProceso;
			$this -> fechaCompra = $_fechaCompra;
			$this -> tipoPC = $_tipoPC;
			$this -> cpuMarca = $_cpuMarca;
			$this -> cpuDescripcion = $_cpuDescripcion;
			$this -> ram = $_ram;
			$this -> ddMarca = $_ddMarca;
			$this -> ddCapacidad = $_ddCapacidad;
			$this -> monitorMarca = $_monitorMarca;
			$this -> monitorTamano = $_monitorTamano;
			$this -> impresoraMarca = $_impresoraMarca;
			$this -> impresoraTipo = $_impresoraTipo;
			$this -> scannerMarca = $_scannerMarca;
			$this -> scannerTipo = $_scannerTipo;
			$this -> copiadora = $_copiadora;
			$this -> telefono = $_telefono;
			$this -> diadema = $_diadema;
			$this -> parlantes = $_parlantes;
			$this -> teclado = $_teclado;
			$this -> mouse = $_mouse;
			$this -> usbMarca = $_usbMarca;
			$this -> usbCapacidad = $_usbCapacidad;
			$this -> sdMarca = $_sdMarca;
			$this -> sdCapacidad = $_sdCapacidad;
			$this -> basePortatil = $_basePortatil;
			$this -> equipoAudio = $_equipoAudio;
			$this -> camara = $_camara;
			$this -> movilMarca = $_movilMarca;
			$this -> movilOperador = $_movilOperador;
			$this -> radio = $_radio;
			$this -> regulador = $_regulador;
			$this -> ups = $_ups;
			$this -> descripcion = $_descripcion;
		}
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			if ($_opc == 4)	
			
				$consulta = "select * from historialhojavida where codigoPC = '$_valor'";
				
			
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existen Hojas de Vida'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, HistorialHojaVida :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_codigoPC = $_datos ["codigoPC"];
			$_fechaProceso = $_datos ["fechaProceso"];
			$_fechaCompra =  $_datos ["fechaCompra"];
			$_tipoPC = $_datos ["tipoPC"];
			$_cpuMarca = $_datos ["cpuMarca"];
			$_cpuDescripcion = $_datos ["cpuDescripcion"];
			$_ram = $_datos ["ram"];
			$_ddMarca = $_datos ["ddMarca"];
			$_ddCapacidad = $_datos ["ddCapacidad"];
			$_monitorMarca = $_datos ["monitorMarca"];
			$_monitorTamano = $_datos ["monitorTamano"];
			$_impresoraMarca = $_datos ["impresoraMarca"];
			$_impresoraTipo = $_datos ["impresoraTipo"];
			$_scannerMarca = $_datos ["scannerMarca"];
			$_scannerTipo = $_datos ["scannerTipo"];
			$_copiadora = $_datos ["copiadora"];
			$_telefono = $_datos ["telefono"];
			$_diadema = $_datos ["diadema"];
			$_parlantes = $_datos ["parlantes"];
			$_teclado = $_datos ["teclado"];
			$_mouse = $_datos ["mouse"];
			$_usbMarca = $_datos ["usbMarca"];
			$_usbCapacidad = $_datos ["usbCapacidad"];
			$_sdMarca = $_datos ["sdMarca"];
			$_sdCapacidad = $_datos ["sdCapacidad"];
			$_basePortatil = $_datos ["basePortatil"];
			$_equipoAudio = $_datos ["equipoAudio"];
			$_camara = $_datos ["camara"];
			$_movilMarca = $_datos ["movilMarca"];
			$_movilOperador = $_datos ["movilOperador"];
			$_radio = $_datos ["radio"];
			$_regulador = $_datos ["regulador"];
			$_ups = $_datos ["ups"];
			$_descripcion =  $_datos ["descripcion"];
			
			$historialHojaVida = new HistorialHojaVida ($_codigoPC, $_fechaProceso, $_fechaCompra, $_tipoPC, $_cpuMarca, $_cpuDescripcion, $_ram, $_ddMarca, $_ddCapacidad, $_monitorMarca, $_monitorTamano, $_impresoraMarca, $_impresoraTipo, $_scannerMarca,  $_scannerTipo, $_copiadora, $_telefono, $_diadema, $_parlantes,  $_teclado, $_mouse, $_usbMarca, $_usbCapacidad, $_sdMarca, $_sdCapacidad, $_basePortatil, $_equipoAudio, $_camara, $_movilMarca, $_movilOperador, $_radio, $_regulador, $_ups, $_descripcion);
			
			return $historialHojaVida;
			
		}
	}
?>