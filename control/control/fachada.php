<?php 

	include $_SERVER['DOCUMENT_ROOT'] . '/jgefectivo/control/control/clases.php';
	
	switch ($_REQUEST["opc"])	{
	
		case 1:
		
			$idDependencia = $_POST["idDependencia"];
			if (empty($idDependencia))
				echo "<script type='text/javascript'> alert('Debe de Digitar el codigo de la Dependencia'); history.back();</script>";
				
			$nombreDependencia = $_POST["nombreDependencia"];
			if (empty($nombreDependencia))
				echo "<script type='text/javascript'> alert('debe Digitar el Nombre de la Dependencia'); history.back();</script>";
			
			Dependencia :: insertar ($idDependencia, $nombreDependencia);
			exit ();
			break;
			
		case 2:
		
			$opc = $_REQUEST["opc"];
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = empty($_POST["valor"]) ? 0 : $_POST["valor"];
			$procesoDependencia = Dependencia :: listar ($opc, $campo, $valor);
			include ("../vista/listadoArea.php");
			exit ();
			break;
			
			
		case 10:
			
			$opc = 2;
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = empty($_POST["valor"]) ? 0 : $_POST["valor"];
			$procesoDependencia = Dependencia :: listar ($opc, $campo, $valor);
			include ("../vista/visitante.php");
			exit ();
			break;
			
		case 11:
		
			$identificacion = $_POST["identificacion"];
			$procesoEmpleado = Visitante :: listar ($opc, $campo, $valor);
			include ("../vista/visitante.php");			
			exit ();
			break;
			
		case 12:
		
			$identificacion = $_POST["identificacion"];
			if (empty($identificacion))
				echo "<script type='text/javascript'> alert('Debe de Digitar una Identificacion'); history.back();</script>";
				
			$nombre = $_POST["nombre"];
			if (empty($nombre))
				echo "<script type='text/javascript'> alert('Debe de Digitar un Nombre'); history.back();</script>";
				
			$idDependencia = $_POST["idDependencia"];
			$motivo = $_POST["motivo"];
			if (empty($motivo))
				echo "<script type='text/javascript'> alert('Debe de Digitar un Motivo de Visita'); history.back();</script>";
				
			$codigoVisitante = $_POST["codigoVisitante"];
			if (empty($codigoVisitante))
				echo "<script type='text/javascript'> alert('Debe de Digitar un Codigo del Visitante'); history.back();</script>";
				
			Visitante :: insertar ($identificacion, $nombre, $idDependencia, $motivo, $codigoVisitante);
			exit ();
			break;
			
		case 14:
		
			$identificacion = $_POST["identificacion"];
			if (empty($identificacion))
				echo "<script type='text/javascript'> alert('Debe de Digitar una Identificacion'); history.back();</script>";
				
			$nombre = $_POST["nombre"];
			if (empty($nombre))
				echo "<script type='text/javascript'> alert('Debe de Digitar un Nombre'); history.back();</script>";
				
			$idDependencia = $_POST["idDependencia"];
			$motivo = $_POST["motivo"];
			if (empty($motivo))
				echo "<script type='text/javascript'> alert('Debe de Digitar un Motivo de Visita'); history.back();</script>";
				
			$codigoVisitante = $_POST["codigoVisitante"];
			if (empty($codigoVisitante))
				echo "<script type='text/javascript'> alert('Debe de Digitar un Codigo del Visitante'); history.back();</script>";
				
			Visitante :: insertarVisitante ($identificacion, $nombre, $idDependencia, $motivo, $codigoVisitante);
			exit ();
			break;
			
		case 13:
			
			$opc = 2;
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = empty($_POST["valor"]) ? 0 : $_POST["valor"];
			$procesoDependencia = Dependencia :: listar ($opc, $campo, $valor);
			include ("../vista/visitanteAntiguo.php");
			exit ();
			break;
			
		case 16:
			
			$opc = 15;
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = empty($_POST["valor"]) ? 0 : $_POST["valor"];
			$procesoVisitante = Visitante :: listar ($opc, $campo, $valor);
			include ("../vista/IdentificacionVisitante.php");
			exit ();
			break;
			
		case 17:
		
			$valor = $_REQUEST["valor"];
			$procesoVisitante = Visitante :: salida ($valor);
			exit ();
			break;		
			
		case 50:
			
			$opc = 51;
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = empty($_POST["valor"]) ? 0 : $_POST["valor"];
			$procesoEmpleado = Empleado :: listar ($opc, $campo, $valor);
			include ("../vista/Identificacion.php");
			
			exit ();
			break;
		
		
		case 52:
		
			$identificacion = $_POST["identificacion"];
			Empleado :: insertar ($identificacion);
			exit ();
			break;
			
		case 53:
		
			$valor = $_REQUEST["valor"];
			$procesoEmpleado = Empleado :: salida ($valor);
			exit ();
			break;
			
		case 60:
		
			$opc = $_REQUEST["opc"];
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = empty($_POST["valor"]) ? 0 : $_POST["valor"];
			$procesoEmpleado = EmpleadoG :: listar ($opc, $campo, $valor);
			include ("../vista/listadoPlanta.php");
			
			exit ();
			break;
			
		case 70:
		
			$opc = $_REQUEST["opc"];
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = $_REQUEST["valor"];
			$procesoVisita = Visita :: listar ($opc, $campo, $valor);
				
			include ("../vista/consultaVisita.php");
			exit ();
			break;
			
		case 71:
		
			$opc = $_REQUEST["opc"];
			$campo = empty($_POST["campo"]) ? 0 : $_POST["campo"];
			$valor = empty($_POST["valor"]) ? 0 : $_POST["valor"];
			$procesoVisita = Visita :: listar ($opc, $campo, $valor);
			
			if 	(!empty($procesoVisita))
			include ("../vista/listadoPendientes.php");
			exit ();
			break;			
	}
?>