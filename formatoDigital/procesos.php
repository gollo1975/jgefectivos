
<?php
    $UsuarioSistema =$UsuarioSistema;
	$UsuarioFinal = $_REQUEST["UsuarioFinal"];
   	include $_SERVER ['DOCUMENT_ROOT'].'/jgefectivo/formatoDigital/clases.php';
	switch ($_REQUEST ["opc"])	{
	  
		case 3:
			$opcP = 3;
			$campoP = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorP = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoP = Procesos :: listar ($opcP, $campoP, $valorP);
			
			$opcR = 13;
			$campoR = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorR = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoR = Requisito :: listar ($opcR, $campoR, $valorR,$UsuarioSistema);
			
			include ("formatoDigital.php");
			exit ();
			break;
			
		case 23:
			
			$fecha = $_POST ["fecha"];	
			$hora = $_POST ["hora"];	
			$idProceso = $_POST ["idProceso"];	
			$idRequisito = $_POST ["idRequisito"];	
			$solicitante = $_POST ["solicitante"];	
			$solicitud = $_POST ["solicitud"];	
			
			Solicitud :: insertar ($fecha, $hora, $idProceso, $idRequisito, $solicitante, $solicitud);
			exit ();
			break;

		case 24:

			$opcR = 24;
			$UsuarioFinal = $_REQUEST["UsuarioFinal"];
			$campoR = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorR = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoR = Requisito :: listar ($opcR, $campoR, $valorR,$UsuarioFinal);

			include ("listadoRequisitos.php");
			exit ();
			break;
			
		case 25:

			$opcS = 25;
			$UsuarioFinal = $_REQUEST["UsuarioFinal"];
			$campoS = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorS = $_REQUEST["valor"];
			$procesoS = Solicitud :: listar ($opcS, $campoS, $valorS,$UsuarioFinal);

			include ("listadoSolicitud.php");
			exit ();
			break;

		case 26:

			$opcS = 26;
			$UsuarioFinal = $_REQUEST["UsuarioFinal"];
			$campoS = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorS = $_REQUEST["valor"];
			$procesoS = Solicitud :: listar ($opcS, $campoS, $valorS,$UsuarioFinal);

			include ("seguimientoCasos.php");
			exit ();
			break;

		case 30:
			$UsuarioFinal = $_REQUEST["UsuarioFinal"];
			$idSolicitud = $_POST ["idSolicitud"];
			$fechaTerminacion = $_POST ["fechaTerminacion"];	
			$respuesta = $_POST ["respuesta"];
			$estado = $_POST ["estado"];
			
			SolicitudSeguimiento :: insertar ($idSolicitud, $fechaTerminacion, $respuesta, $estado, $UsuarioFinal);
			exit ();
			break;

		case 31:

			$opcS = 31;
			$campoS = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorS = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoS = Solicitud :: listar ($opcS, $campoS, $valorS);

			include ("listadoSolicitudGral.php");
			exit ();
			break;

		case 33:

			$opcS = 33;
			$campoS = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorS = $_REQUEST["valor"];
			$procesoS = Solicitud :: listar ($opcS, $campoS, $valorS,$UsuarioFinal);

			include ("RespuestaCasos.php");
			exit ();
			break;
			
	}

?>