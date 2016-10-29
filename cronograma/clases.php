<?php

	class Cronograma	{
	
		var $idCronograma;
		var $fecha;
		var $hora;
		var $tipo;
		var $descripcion;
		
		function Cronograma ($_idCronograma, $_fecha, $_hora, $_tipo, $_descripcion)	{
		
			$this -> idCronograma = $_idCronograma;
			$this -> fecha = $_fecha;
			$this -> hora = $_hora;
			$this -> tipo = $_tipo;
			$this -> descripcion = $_descripcion;
		}

		public static function insertar ($_fecha, $_hora, $_tipo, $_descripcion)	{
		
			include ("conexion.php");
			$resultado = mysqli_query ($cnn, "insert into cronograma (fecha, hora, tipo, descripcion, estado) values ('$_fecha', '$_hora', '$_tipo', '$_descripcion',  'Activo')");
			
			echo "<script type = 'text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			if ($_opc == 2)	
			
				$consulta = "select * from cronograma order by fecha";
			
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existe Proramacion de Actividades'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Cronograma :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_idCronograma = $_datos ["idCronograma"];
			$_fecha = $_datos ["fecha"];
			$_hora = $_datos ["hora"];
			$_tipo = $_datos ["tipo"];
			$_descripcion = $_datos ["descripcion"];
			$cronograma = new Cronograma ($_idCronograma, $_fecha, $_hora, $_tipo, $_descripcion);
			
			return $cronograma;
			
		}		
	}
?>