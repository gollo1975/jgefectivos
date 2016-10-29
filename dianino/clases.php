<?php
	class Empleado	{
	
		var $cedemple;
		var $nombre;
		var $zona;
		var $municipio;
		var $nombrehijo;
		var $fechanac;
		var $edad;
	
		function Empleado ($_cedemple, $_nombre, $_zona, $_municipio, $_nombrehijo, $_fechanac, $_edad)	{
		
			$this -> cedemple = $_cedemple;
			$this -> nombre = $_nombre;
			$this -> zona = $_zona;
			$this -> municipio = $_municipio;
			$this -> nombrehijo = $_nombrehijo;
			$this -> fechanac = $_fechanac;
			$this -> edad = $_edad;
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			include ("conexion.php");
			$mat = array ();
			if ($_opc == 1)
			
				$consulta = "call listarEmpleadoEdad ()";
			
			else if ($_opc == 2) {
			
				$consulta = "select empleado.cedemple, concat(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) 'nombre',  zona.zona, municipio.municipio, detallehijo.nombre 'nombrehijo', detallehijo.fechanac, detallehijo.parentezco, timestampdiff(year, detallehijo.fechanac, '2014-10-31') 'edad' from empleado inner join detallehijo on empleado.cedemple = detallehijo.cedemple inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona inner join municipio on zona.codmuni = municipio.codmuni where timestampdiff(year, detallehijo.fechanac, '2014-10-31') <= 12 and contrato.fechater = '0000-00-00' and ";
				if ($_campo == 'cedemple')
				
					$consulta .= " empleado.cedemple = '$_valor' order by zona.zona, empleado.nomemple";
				else if ($_campo == 'nomemple')
				
					$consulta .= " empleado.nomemple like '%$_valor%' order by zona.zona, empleado.nomemple";
				else if ($_campo == 'zona')
				
					$consulta .= " zona.zona like '%$_valor%' order by zona.zona, empleado.nomemple";
				else if ($_campo == 'municipio')
				
					$consulta .= " municipio.municipio like '%$_valor%' order by zona.zona, empleado.nomemple";
			}
			else if ($_opc == 3)	{
	
				$dep = $_SESSION ["departamento"];
				
				$consulta = "select empleado.cedemple, concat(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) 'nombre', zona.zona, municipio.municipio, detallehijo.nombre 'nombrehijo', detallehijo.fechanac, timestampdiff(year, detallehijo.fechanac, '2014-10-31') 'edad' 
from empleado inner join detallehijo on empleado.cedemple = detallehijo.cedemple inner join contrato on empleado.codemple = contrato.codemple
inner join zona on empleado.codzona = zona.codzona inner join municipio on zona.codmuni = municipio.codmuni where timestampdiff(year, detallehijo.fechanac, '2014-10-31') <= 12 and contrato.fechater = '0000-00-00' and zona.estado = 'Activa' and zona.codsucursal = '$dep' order by zona.zona, empleado.nomemple";
			}
			else if ($_opc == 4) {
	
				$dep = $_SESSION ["departamento"];
				$consulta = "select empleado.cedemple, concat(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) 'nombre',  zona.zona, municipio.municipio, detallehijo.nombre 'nombrehijo', detallehijo.fechanac, timestampdiff(year, detallehijo.fechanac, '2014-10-31') 'edad' from empleado inner join detallehijo on empleado.cedemple = detallehijo.cedemple inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona inner join municipio on zona.codmuni = municipio.codmuni where timestampdiff(year, detallehijo.fechanac, '2014-10-31') <= 12 and contrato.fechater = '0000-00-00' and zona.estado = 'Activa' and zona.codsucursal = '$dep' and ";
				if ($_campo == 'cedemple')
				
					$consulta .= " empleado.cedemple = '$_valor' order by zona.zona, empleado.nomemple";
				else if ($_campo == 'nomemple')
				
					$consulta .= " empleado.nomemple like '%$_valor%' order by zona.zona, empleado.nomemple";
				else if ($_campo == 'zona')
				
					$consulta .= " zona.zona like '%$_valor%' order by zona.zona, empleado.nomemple";
				else if ($_campo == 'municipio')
				
					$consulta .= " municipio.municipio like '%$_valor%' order by zona.zona, empleado.nomemple";
			}
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
			$_municipio = $datos ["municipio"];
			$_nombrehijo = $datos ["nombrehijo"];
			$_fechanac = $datos ["fechanac"];
			$_edad = $datos ["edad"];
			
			$empleado = new Empleado ($_cedemple, $_nombre, $_zona, $_municipio, $_nombrehijo, $_fechanac, $_edad);
			
			return $empleado;
		
		}
	}
?>
