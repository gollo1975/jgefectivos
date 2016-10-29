<?php

	class Procesos	{
	
		var $idProceso;
		var $nombreProceso;
		
		function Procesos ($_idProceso, $_nombreProceso)	{
		
			$this -> idProceso = $_idProceso;
			$this -> nombreProceso = $_nombreProceso;
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			echo $UsuarioSistema;
			if ($_opc == 3)	
			
				$consulta = "select idProceso, nombreProceso from procesos order by nombreProceso";
			
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existen Procesos'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Procesos :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_idProceso = $_datos ["idProceso"];
			$_nombreProceso = $_datos ["nombreProceso"];
			$procesos = new Procesos ($_idProceso, $_nombreProceso);
			
			return $procesos;
			
		}
	}

	class Requisito	{
	
		var $idRequisito;
		var $nombreRequisito;
		var $total;
		
		function Requisito ($_idRequisito, $_nombreRequisito, $_total)	{
		
			$this -> idRequisito = $_idRequisito;
			$this -> nombreRequisito = $_nombreRequisito;
			$this -> total = $_total;
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			if ($_opc == 13)	
			
				$consulta = "select idRequisito, nombreRequisito, total from requisito order by nombreRequisito";
			else if ($_opc == 24)
				
				$consulta = "select requisito.idRequisito, requisito.nombreRequisito, count(*) 'total' from requisito inner join solicitud on requisito.idRequisito = solicitud.idRequisito inner join procesos on solicitud.idProceso = procesos.idProceso where solicitud.estado <> 'Cerrado' group by idRequisito";
			
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existen Requisitos'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Requisito :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_idRequisito = $_datos ["idRequisito"];
			$_nombreRequisito = $_datos ["nombreRequisito"];
			$_total = $_datos ["total"];
			$requisito = new Requisito ($_idRequisito, $_nombreRequisito, $_total);
			
			return $requisito;
			
		}
	}

	class Solicitud	{
	
		var $idSolicitud;
		var $fecha;
		var $hora;
		var $idProceso;
		var $nombreProceso;
		var $idRequisito;
		var $nombreRequisito;
		var $solicitante;
		var $solicitud;
		var $estado;
		var $respuesta;
		var $fechaTerminacion;
		var $horaTermina;
		var $usuariofinalizado;

		
		function Solicitud ($_idSolicitud, $_fecha, $_hora, $_idProceso, $_nombreProceso, $_idRequisito, $_nombreRequisito, $_solicitante, $_solicitud, $_estado, $_respuesta, $_fechaTerminacion, $_horaTermina, $_usuariofinalizado)	{
		
			$this -> idSolicitud = $_idSolicitud;
			$this -> fecha = $_fecha;
			$this -> hora = $_hora;
			$this -> idProceso = $_idProceso;
			$this -> nombreProceso = $_nombreProceso;
			$this -> idRequisito = $_idRequisito;
			$this -> nombreRequisito = $_nombreRequisito;
			$this -> solicitante = $_solicitante;
			$this -> solicitud = $_solicitud;
			$this -> estado = $_estado;
			$this -> respuesta = $_respuesta;;
			$this -> fechaTerminacion =  $_fechaTerminacion;
			$this -> horaTermina =  $_horaTermina;
			$this -> usuarioFinalizado =  $_usuariofinalizado;
		}

		public static function insertar ($_fecha, $_hora, $_idProceso, $_idRequisito, $_solicitante, $_solicitud)	{
		
			include ("conexion.php");
			$resultado = mysqli_query ($cnn, "insert into solicitud (fecha, hora, idProceso, idRequisito, solicitante, solicitud, estado) values ('$_fecha', '$_hora', '$_idProceso', '$_idRequisito', '$_solicitante', '$_solicitud', 'Activo')");
			
			echo "<script type = 'text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";
		}

		public static function listar ($_opc, $_campo, $_valor)	{
		
			$mat = array ();
			include ("conexion.php");
			if ($_opc == 25)	
			
				$consulta = "select solicitud.idSolicitud, solicitud.fecha, solicitud.hora, solicitud.idProceso, procesos.nombreProceso, solicitud.idRequisito, solicitud.solicitante, solicitud.solicitud, solicitud.estado from solicitud inner join procesos on procesos.idProceso = solicitud.idProceso where solicitud.estado <> 'Cerrado' and solicitud.idRequisito = '$_valor' group by solicitud.idSolicitud";
				
			else if ($_opc == 26)	
			
				$consulta = "select solicitud.idSolicitud, solicitud.fecha, solicitud.hora, solicitud.idProceso, procesos.nombreProceso, solicitud.idRequisito, requisito.nombreRequisito, solicitud.solicitante, solicitud.solicitud,solicitud.estado from solicitud inner join procesos on procesos.idProceso = solicitud.idProceso inner join requisito on solicitud.idRequisito =  requisito.idRequisito where solicitud.estado <> 'Cerrado' and solicitud.idSolicitud = '$_valor' group by solicitud.idSolicitud";
				
			else if ($_opc == 31)
			
				$consulta = "select solicitud.idSolicitud, solicitud.fecha, solicitud.hora, solicitud.idProceso, procesos.nombreProceso, solicitud.idRequisito, requisito.nombreRequisito, solicitud.solicitante, solicitud.solicitud, solicitud.estado, solicitud.fechaTerminacion, solicitud.horaTermina, solicitud.usuarioFinalizado from solicitud inner join procesos on procesos.idProceso = solicitud.idProceso inner join requisito on solicitud.idRequisito =  requisito.idRequisito  group by solicitud.idSolicitud order by fecha desc limit 70";
				
			else if ($_opc == 33)
			
				$consulta = "select solicitud.idSolicitud, solicitud.fecha, solicitud.hora, solicitud.idProceso, procesos.nombreProceso,
solicitud.idRequisito, requisito.nombreRequisito, solicitud.solicitante, solicitud.solicitud, solicitud.estado, solicitudseguimiento.respuesta, solicitudseguimiento.fechaTerminacion  from solicitud inner join procesos on procesos.idProceso = solicitud.idProceso inner join requisito on solicitud.idRequisito =  requisito.idRequisito  inner join solicitudseguimiento on solicitud.idSolicitud = solicitudseguimiento.idSolicitud where solicitud.idSolicitud = '$_valor' group by solicitud.idSolicitud";				
			$resultado =  mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	
			
				echo "<script type = 'text/javascript'> alert ('No Existen Requisitos'); history.back (); </script>";
			else	{
				
				for ($i = 0; $i < $registros; $i++)	{
				
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Solicitud :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($_datos)	{
		
			$_idSolicitud = $_datos ["idSolicitud"];
			$_fecha = $_datos ["fecha"];
			$_hora = $_datos ["hora"];
			$_idProceso = $_datos ["idProceso"];
			$_nombreProceso = $_datos ["nombreProceso"];
			$_idRequisito = $_datos ["idRequisito"];
			$_nombreRequisito = $_datos ["nombreRequisito"];
			$_solicitante = $_datos ["solicitante"];
			$_solicitud = $_datos ["solicitud"];
			$_estado =  $_datos ["estado"];
			$_respuesta = $_datos ["respuesta"];
			$_fechaTerminacion = $_datos ["fechaTerminacion"];
			$_horaTermina = $_datos ["horaTermina"];
			$_usuariofinalizado = $_datos ["usuarioFinalizado"];
			$solicitud = new Solicitud ($_idSolicitud, $_fecha, $_hora, $_idProceso, $_nombreProceso, $_idRequisito, $_nombreRequisito, $_solicitante, $_solicitud, $_estado, $_respuesta, $_fechaTerminacion, $_horaTermina,$_usuariofinalizado);
			
			return $solicitud;
			
		}
	}
	
	class SolicitudSeguimiento	{
	
		var $idSolicitudSeguimiento;
		var $idSolicitud;
		var $horaTerminacion;
		var $fechaTerminacion;
		var $respuesta;
		var $estado;
		var $UsuarioFinal;
		
		function SolicitudSeguimiento ($_idSolicitudSeguimiento, $_idSolicitud, $_horaTerminacion, $_fechaTerminacion, $_respuesta, $_estado,$UsuarioFinal)	{
		
			$this -> idSolicitudSeguimiento = $_idSolicitudSeguimiento;
			$this -> idSolicitud = $_idSolicitud;
			$this -> horaTerminacion = $_horaTerminacion;
			$this -> fechaTerminacion = $_fechaTerminacion;
			$this -> respuesta = $_respuesta;
			$this -> estado = $_estado;
			$UsuarioFinal = $_REQUEST["UsuarioFinal"];
		}

		public static function insertar ($_idSolicitud, $_fechaTerminacion, $_respuesta, $_estado,$UsuarioFinal)	{
		
			include ("conexion.php");
			$_horaTerminacion = date("h:i:s");
			//se trae el nombre de la tabla acceso
			$Sql="select acceso.nombre FROM acceso where  acceso.cedula='$UsuarioFinal'";
			$Rs=mysqli_query ($cnn, $Sql)or die("Error al buscar el usuario..");
			$filaU = mysqli_fetch_array($Rs);
			$Nombre =$filaU["nombre"]; 
			
			$resultado = mysqli_query ($cnn, "insert into solicitudseguimiento (idSolicitud, fechaTerminacion, horaTerminacion, respuesta,usuariofinalizado) values ('$_idSolicitud',  '$_fechaTerminacion', '$_horaTerminacion', '$_respuesta','$Nombre')");
			
			$resultado = mysqli_query ($cnn, "update solicitud set estado = '$_estado' where idSolicitud = '$_idSolicitud'");
			if ($_estado == "Cerrado"){
				$resultado = mysqli_query ($cnn, "update solicitud set fechaTerminacion = '$_fechaTerminacion', respuesta = '$_respuesta', usuariofinalizado = '$Nombre', horaTermina = '$_horaTerminacion' where idSolicitud = '$_idSolicitud'");
			}
			
			
			echo "<script type = 'text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";
		}
	}
	
?>