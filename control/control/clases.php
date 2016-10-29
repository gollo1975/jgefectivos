<?php

	class Dependencia	{
	
		var $idDependencia;
		var $nombreDependencia;
		
		function Dependencia ($_idDependencia, $_nombreDependencia)	{
		
			$this -> idDependencia = $_idDependencia;
			$this -> nombreDependencia = $_nombreDependencia;
		}
		
		public static function insertar ($_idDependencia, $_nombreDependencia)	{
		
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarDependencia ('$_idDependencia')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
			
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call insertarDependencia ('$_idDependencia', '$_nombreDependencia', 'Activo')");
				echo "<script type = 'text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";
			}
			else
			
				echo "<script type = 'text/javascript'> alert ('ya Existe el Area'); history.back (); </script>";
		}
		
		public static function listar ($opc, $campo, $valor)	{
		
			include ("../conexion/conexion.php");
			$mat = array ();
			
			if ($opc == 2)	
			
				$consulta = "call listarDependencia ()";
				
			$resultado = mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existen Registros'); history.back (); </script>";
			else	{
			
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Dependencia :: mostrar ($datos));
				}
				
				return $mat;
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idDependencia = $datos ["idDependencia"];
			$_nombreDependencia = $datos ["nombreDependencia"];
			
			$dependencia = new Dependencia ($_idDependencia, $_nombreDependencia);
			
			return $dependencia;
			
		}
	}
	
	
	class Visitante	{
	
		var $identificacion;
		var $nombre;
		var $idDependencia;
		var $motivo;
		var $codigoVisitante;
		var $fecha;
		var $horaIngreso;
		
		function Visitante ($_identificacion, $_nombre, $_idDependencia, $_motivo, $_codigoVisitante, $_fecha, $_horaIngreso)	{
		
			$this -> identificacion = $_identificacion;
			$this -> nombre = $_nombre;
			$this -> idDependencia = $_idDependencia;
			$this -> motivo = $_motivo;
			$this -> codigoVisitante = $_codigoVisitante;
			$this -> fecha = $_fecha;
			$this -> horaIngreso = $_horaIngreso;
		}
		
		public static function insertar ($_identificacion, $_nombre, $_idDependencia, $_motivo, $_codigoVisitante)	{
		
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarVisitante ('$_identificacion')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
			
				include ("../conexion/conexion.php");
				$_nombre = strtoupper ($_nombre);
				$_motivo = strtoupper ($_motivo);
				$resultado = mysqli_query ($cnn, "call insertarVisitante ('$_identificacion', '$_nombre', '$_idDependencia', '$_motivo', '$_codigoVisitante')");
				echo 	"<script type = 'text/javascript'> 
							alert ('Registro Almacenado');
							window.location.href='../control/fachada.php?opc=16';
				 		</script>";
			}
			else	{
				
				echo 	"<script type = 'text/javascript'> 
							alert ('el Visitante aun no ha salido');
							window.location.href='../control/fachada.php?opc=16';
				 		</script>";
			}
		}
		
		public static function insertarVisitante ($_identificacion, $_nombre, $_idDependencia, $_motivo, $_codigoVisitante)	{
		
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarVisitanteExistente ('$_identificacion')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
		
				include ("../conexion/conexion.php");
				$_motivo = strtoupper($_motivo);
				$resultado = mysqli_query ($cnn, "call insertarVisitanteExistente ('$_identificacion', '$_idDependencia', '$_motivo', '$_codigoVisitante')");
				echo 	"<script type = 'text/javascript'> 
							alert ('Registro Almacenado');
							window.location.href='../control/fachada.php?opc=16';
				 		</script>";
			}
			else	{
			
				echo 	"<script type = 'text/javascript'> 
							alert ('el Visitante aun no ha salido');
							window.location.href='../control/fachada.php?opc=16';
				 		</script>";
			}
		}
		
		public static function listar($opc, $campo, $valor)	{
		
			include ("../conexion/conexion.php");
			$mat = array ();
			
			if ($opc == 15)	
			
				$consulta = "call listarVisitante ()";
				
			$resultado = mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros != 0) {
			
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Visitante :: mostrar ($datos));
				}
				
				return $mat;

			}
			
		}	
		
		public static function mostrar ($datos)	{
		
			$_identificacion = $datos ["identificacion"];
			$_nombre = $datos ["nombre"];
			$_idDependencia = $datos ["idDependencia"];
			$_motivo = $datos ["motivo"];
			$_codigoVisitante = $datos ["codigoVisitante"];			
			$_fecha = $datos ["fecha"];
			$_horaIngreso = $datos ["horaIngreso"];
			
			$visitante = new Visitante ($_identificacion, $_nombre, $_idDependencia, $_motivo, $_codigoVisitante, $_fecha, $_horaIngreso);
			
			return $visitante;
			
		}
		
		public static function salida ($valor)	{
		
			include ("../conexion/conexion.php");
			$resultado =  mysqli_query($cnn, "call salidaVisitante ('$valor')");
			$registros = mysqli_affected_rows ($cnn);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No se ejecuto la salida'); history.back (); </script>";
			else
			
				echo 	"<script type = 'text/javascript'> 
							window.location.href='../control/fachada.php?opc=16';
				 		</script>";
		}
						
	}
	
	class Empleado	{
	
		var $identificacion;
		var $nombre;
		var $fecha;
		var $horaIngreso;
		
		function Empleado ($_identificacion, $_nombre, $_fecha, $_horaIngreso)	{
		
			$this -> identificacion = $_identificacion ;
			$this -> nombre = $_nombre;
			$this -> fecha = $_fecha;
			$this -> horaIngreso = $_horaIngreso;
		}
		
		public static function insertar ($_identificacion)	{
		
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarEmpleadoPlanta ('$_identificacion')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
			
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call insertarEmpleado ('$_identificacion')");
				echo 	"<script type = 'text/javascript'> 
						window.location.href='../control/fachada.php?opc=50';
				 		</script>";
			}
			else	
			
				echo "<script type = 'text/javascript'> alert ('El Usuario no ha Salido aun'); history.back (); </script>";
		}
		
		public static function listar($opc, $campo, $valor)	{
		
			include ("../conexion/conexion.php");
			$mat = array ();
			
			if ($opc == 51)	
			
				$consulta = "call listarEmpleadoPlanta ()";
			else if ($opc == 60) 
			
				$consulta = "call listarEmpleadoConsultar ('$valor')";


			$resultado = mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			
			if ($registros != 0) {
			
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Empleado :: mostrar ($datos));
				}
				
				return $mat;

			}
			else 
			
				echo "No Existen Datos en el Sistema";
		}	
		
		public static function mostrar ($datos)	{
		
			$_identificacion = $datos ["identificacion"];
			$_nombre = $datos ["nombre"];
			$_fecha = $datos ["fecha"];
			$_horaIngreso = $datos ["horaIngreso"];
			
			$empleado = new Empleado ($_identificacion, $_nombre, $_fecha, $_horaIngreso);
			
			return $empleado;
			
		}
		
		public static function salida ($valor)	{
		
			include ("../conexion/conexion.php");
			$resultado =  mysqli_query($cnn, "call salidaEmpleado('$valor')");
			$registros = mysqli_affected_rows ($cnn);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No se ejecuto la salida'); history.back (); </script>";
			else
			
				echo 	"<script type = 'text/javascript'> 
							window.location.href='../control/fachada.php?opc=50';
				 		</script>";
		}
	}
	
		class EmpleadoG	{
	
		var $identificacion;
		var $nombre;
		var $fecha;
		var $horaIngreso;
		
		function EmpleadoG ($_identificacion, $_nombre, $_fecha, $_horaIngreso)	{
		
			$this -> identificacion = $_identificacion ;
			$this -> nombre = $_nombre;
			$this -> fecha = $_fecha;
			$this -> horaIngreso = $_horaIngreso;
		}
		
		public static function listar($opc, $campo, $valor)	{
		
			include ("../conexion/conexion.php");
			$mat = array ();
			
			if ($opc == 60) 
				
					$consulta = "call listarEmpleadoConsultar ('$valor')";

			$resultado = mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			
			if ($registros != 0) {
			
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, EmpleadoG :: mostrar ($datos));
				}
				
				return $mat;

			}
			else 
			
				echo "<script type = 'text/javascript'> alert ('No Existen Registros'); history.back (); </script>";;
		}	
		
		public static function mostrar ($datos)	{
		
			$_identificacion = $datos ["identificacion"];
			$_nombre = $datos ["nombre"];
			$_fecha = $datos ["fecha"];
			$_horaIngreso = $datos ["horaIngreso"];
			
			$empleadoG = new EmpleadoG ($_identificacion, $_nombre, $_fecha, $_horaIngreso);
			
			return $empleadoG;
			
		}
	}	
	
	class Visita	{
	
		var $identificacion;
		var $nombre;
		var $idDependencia;
		var $nombreDependencia;
		var $fecha;
		var $horaIngreso;
		var $horaSalida;
		var $tiempoTotal;
		
		function Visita ($_identificacion, $_nombre, $_idDependencia, $_nombreDependencia, $_fecha, $_horaIngreso, $_horaSalida, $_tiempoTotal)	{
		
			$this -> identificacion = $_identificacion;
			$this -> nombre = $_nombre;
			$this -> idDependencia = $_idDependencia;
			$this -> nombreDependencia = $_nombreDependencia;
			$this -> fecha = $_fecha;
			$this -> horaIngreso = $_horaIngreso;
			$this -> horaSalida = $_horaSalida;
			$this -> tiempoTotal = $_tiempoTotal;
		}
		
		public static function listar($opc, $campo, $valor)	{
		
			include ("../conexion/conexion.php");
			$mat = array ();
			
			if ($opc == 70) {
			
				if ($campo == 'identificacion')	
			
					$consulta = "select  visitante.identificacion, visitante.nombre, detalleVisitante.idDependencia, dependencia.nombreDependencia, detalleVisitante.fecha,   
								detalleVisitante.horaIngreso, detalleVisitante.horaSalida, detalleVisitante.tiempoTotal from visitante inner join detalleVisitante
								on visitante.identificacion = detalleVisitante.identificacion inner join dependencia on detalleVisitante.idDependencia = 
								dependencia.idDependencia where visitante.identificacion = '$valor' order by detalleVisitante.fecha, detalleVisitante.horaIngreso, visitante.nombre";
				else
				
					$consulta = "select  visitante.identificacion, visitante.nombre, detalleVisitante.idDependencia, dependencia.nombreDependencia, detalleVisitante.fecha, 
								detalleVisitante.horaIngreso, detalleVisitante.horaSalida, detalleVisitante.tiempoTotal from visitante inner join detalleVisitante
								on visitante.identificacion = detalleVisitante.identificacion inner join dependencia on detalleVisitante.idDependencia = 
								dependencia.idDependencia where visitante.nombre like '%$valor%'  order by detalleVisitante.fecha,  detalleVisitante.horaIngreso, visitante.nombre";
			}
			else if  ($opc == 71)
			
					$consulta = "select  visitante.identificacion, visitante.nombre, detalleVisitante.idDependencia, dependencia.nombreDependencia,
								detalleVisitante.horaIngreso, detalleVisitante.horaSalida, detalleVisitante.tiempoTotal from visitante inner join detalleVisitante
								on visitante.identificacion = detalleVisitante.identificacion inner join dependencia on detalleVisitante.idDependencia =
								dependencia.idDependencia where detalleVisitante.idDependencia = '$valor' and detallevisitante.fecha = current_date() and detalleVisitante.horaSalida = '00:00:00'";

			$resultado = mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0) 
			
				echo "<script type = 'text/javascript'> alert ('No Existen Registros'); history.back(); </script>";
				
			else {
			
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Visita :: mostrar ($datos));
				}
				
				return $mat;

			}
		}	
		
		public static function mostrar ($datos)	{
		
			$_identificacion = $datos ["identificacion"];
			$_nombre = $datos ["nombre"];
			$_idDependencia = $datos ["idDependencia"];
			$_nombreDependencia = $datos ["nombreDependencia"];
			$_fecha  = $datos ["fecha"];
			$_horaIngreso = $datos ["horaIngreso"];
			$_horaSalida = $datos ["horaSalida"];
			$_tiempoTotal = $datos ["tiempoTotal"];
			
			$visita = new Visita ($_identificacion, $_nombre, $_idDependencia, $_nombreDependencia, $_fecha, $_horaIngreso, $_horaSalida, $_tiempoTotal);
			
			return $visita;
			
		}
	}

?>