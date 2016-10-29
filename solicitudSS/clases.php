<?php

class Empleado	{
	
		var $cedula;
		var $nombre;
		var $zona;

		function Empleado	($_cedula, $_nombre, $_zona)	{
		
			$this -> cedula =  $_cedula;
			$this -> nombre = $_nombre;
			$this -> zona = $_zona;
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			if ($_opc == 1)	
			
				$consulta = "select empleado.cedemple, concat(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) 'nombre', contrato.zona  from empleado inner join contrato on empleado.codemple = contrato.codemple where empleado.cedemple = '$_valor'";
			
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existe empleado'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Empleado :: mostrar ($datos));
				}
				return $mat;
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_cedula = $_datos ["cedemple"];
			$_nombre = $_datos ["nombre"];
			$_zona = $_datos ["zona"];
			$empleado = new Empleado ($_cedula, $_nombre, $_zona);
			
			return $empleado;
		}
	}

	class SolicitudSS	{
	
		var $idSolicitud;
		var $cedula;
		var $nombre;
		var $zona;
		var $fecha;
		var $hora;
		var $recibe;
		var $estado;
		
		function SolicitudSS ($_idSolicitud, $_cedula, $_nombre, $_zona, $_fecha, $_hora, $_recibe, $_estado)	{
		
			$this -> idSolicitud = $_idSolicitud;
			$this -> cedula =  $_cedula;
			$this -> nombre = $_nombre;
			$this -> zona = $_zona;
			$this -> fecha = $_fecha;
			$this -> hora = $_hora;
			$this -> recibe = $_recibe;
			$this -> estado = $_estado;
		}
		
		public static function insertar ($_cedula, $_nombre, $_zona, $_fecha, $_hora, $_recibe)	{
		
			include ("conexion.php");
			$resultado = mysqli_query ($cnn, "insert into solicitudSS (cedemple, nombre, zona, fecha, hora, recibe, estado) values ('$_cedula', '$_nombre', '$_zona', '$_fecha', '$_hora', '$_recibe', 'Activo')");
			echo "<script type = 'text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			if ($_opc == 3)	
			
				$consulta = "select * from solicitudSS";
			
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existe empleado'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, SolicitudSS :: mostrar ($datos));
				}
				return $mat;
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_idSolicitud = $_datos ["idSolicitud"];
			$_cedula = $_datos ["cedemple"];
			$_nombre = $_datos ["nombre"];
			$_zona = $_datos ["zona"];
			$_fecha = $_datos ["fecha"];
			$_hora = $_datos ["hora"];
			$_recibe = $_datos ["recibe"];
			$_estado = $_datos ["estado"];
			
			$solicitudSS = new SolicitudSS ($_idSolicitud, $_cedula, $_nombre, $_zona, $_fecha, $_hora, $_recibe, $_estado);
			
			return $solicitudSS;
		}
	}			
?>