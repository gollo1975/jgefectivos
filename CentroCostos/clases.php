<?php

	class Costo	{
	
		var $codcosto;
		var $centro;
		
		function Costo ($_codcosto, $_centro)	{
		
			$this -> codcosto = $_codcosto;
			$this -> centro = $_centro;
		}
		
		public static function insertar ($_codcosto, $_centro)	{
		
			include ("../conexion1.php");
			$resultado = mysqli_query ($cnn, "call consultarCC ('$_codcosto')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
			
				include ("../conexion1.php");
				$_centro = strtoupper ($_centro);
				$resultado = mysqli_query ($cnn, "call insertarCC ('$_codcosto', '$_centro')");
				echo "<script type='text/javascript'> alert ('Registro Guardado Correctamente'); history.back (); </script>";
			}
			else	
			
				echo "<script type='text/javascript'> alert ('El Registro ya existe'); history.back (); </script>";
		}
	
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("../conexion1.php");
			if ($_opc == 2)	
			
				$consulta = "call listarCC ()"; 
			else if ($_opc == 4)
			
				$consulta = "call consultarCC ('$_valor')"; 
			$resultado = mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				echo "<script type='text/javascript'> alert ('No Existen Centros de Costos'); history.back (); </script>";
			}
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Costo :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_codcosto = $datos ["codcosto"];
			$_centro = $datos ["centro"];
			$costo = new Costo ($_codcosto, $_centro);
			
			return $costo;
			
		}
		
		public static function eliminar ($_valor)	{
		
			include ("../conexion1.php");
			$resultado = mysqli_query ($cnn, "call eliminarCC ('$_valor')");
			$registros = mysqli_affected_rows ($cnn);
			if ($registros == 0)	
			
				echo "<script type='text/javascript'> alert ('No se Eliminó el registro'); history.back (); </script>";
			else	

				echo "<script type='text/javascript'> alert ('Se Eliminó Correctamente'); history.back (); </script>";
		}

		public static function modificar ($_codcosto, $_centro)	{
		
			include ("../conexion1.php");
			$_centro = strtoupper ($_centro);
			$resultado = mysqli_query ($cnn, "call modificarCC ('$_codcosto', '$_centro')");
			$registros = mysqli_affected_rows ($cnn);
			if ($registros == 0)	
			
				echo "<script type='text/javascript'> alert ('No se Modificó el registro'); history.back (); </script>";
			else	

				echo "<script type='text/javascript'> alert ('Se Modificó Correctamente'); history.back (); </script>";
		}
	}
?>