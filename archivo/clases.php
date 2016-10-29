<?php
	class Empleado	{
	
		var $cedemple;
		var $nombre;
		var $zona;
		var $fechainic;
	
		function Empleado ($_cedemple, $_nombre, $_zona, $_fechainic)	{
		
			$this -> cedemple = $_cedemple;
			$this -> nombre = $_nombre;
			$this -> zona = $_zona;
			$this -> fechainic = $_fechainic;
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			include ("conexion.php");
			$mat = array ();
			if ($_opc == 1)
			
				$consulta = "select empleado.cedemple, concat(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) 'nombre',  zona.zona, contrato.fechainic from empleado left join detallempleado on empleado.cedemple = detallempleado.cedemple inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona where detallempleado.cedemple is null and contrato.fechater = '0000-00-00' order by zona.zona, empleado.nomemple";
			
			$resultado = mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existen Empleados'); history.back (); </script>";
			else {
				
				for ($i = 0; $i <= $registros; $i++) {
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Empleado :: mostrar ($datos));
				}
				
				return $mat;
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_cedemple = $datos ["cedemple"];
			$_nombre = $datos ["nombre"];
			$_zona = $datos ["zona"];
			$_fechainic = $datos ["fechainic"];
			
			$empleado = new Empleado ($_cedemple, $_nombre, $_zona, $_fechainic);
			
			return $empleado;
		
		}
	}
?>
