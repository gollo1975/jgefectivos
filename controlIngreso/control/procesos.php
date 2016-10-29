<? session_start (); ?>

<?
	include $_SERVER["DOCUMENT_ROOT"].'/controlIngreso/control/clases.php';
	
	switch ($_REQUEST["opc"])	{

	//////////Jornada//////////
	/////////////////////////
		case 2:
		
			$nombreJornada = $_POST["nombreJornada"];
			$dial = (empty($_POST ["dial"]))?"N":"S";
			$diam = (empty($_POST ["diam"]))?"N":"S";
			$diaw = (empty($_POST ["diaw"]))?"N":"S";
			$diaj = (empty($_POST ["diaj"]))?"N":"S";
			$diav = (empty($_POST ["diav"]))?"N":"S";
			$dias = (empty($_POST ["dias"]))?"N":"S";
			$diad = (empty($_POST ["diad"]))?"N":"S";
			$observacion = $_POST["observacion"]; 
			
			Jornada :: insertar ($nombreJornada, $dial,	$diam, $diaw, $diaj, $diav, $dias, $diad, $observacion);
			
			exit ();
			break;
			
		case 3:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];

			$proceso_j = Jornada :: listar ($opc, $campo, $valor);
			
			include ("../Vista/listarJornada.php");
			exit ();
			break;
			
	//////////Horario//////////
	/////////////////////////
		case 21:
			
			$opc_j = 3;	
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];
			
			$proceso_j = Jornada :: listar ($opc_j, $campo, $valor);
			
			$opc_t = 13;	
			
			$proceso_ti = TipoHorario :: listar ($opc_t);

			$opc_t = 13;	
			
			$proceso_tf = TipoHorario :: listar ($opc_t);
			
			include ("../Vista/insertarHorario.php");
			exit ();
			break;
			
		case 22:
		
			$nombreHorario = $_POST ["nombreHorario"];
      		$horarioInicial = $_POST ["horarioInicial"];
			$idTipoI = $_POST ["idTipoI"];
			$horarioFinal = $_POST ["horarioFinal"];
      		$idTipoF = $_POST ["idTipoF"];
			$observacion = $_POST ["observacion"];
			$idJornada = $_POST ["idJornada"];			
			
			Horario :: insertar ($nombreHorario, $horarioInicial, $idTipoI, $horarioFinal, $idTipoF, $observacion, $idJornada);
			exit ();
			break;

		case 23:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];

			$proceso_h = Horario :: listar ($opc, $campo, $valor);
			
			include ("../Vista/listarHorario.php");
			exit ();
			break;

	//////////Acceso Nomina//////////
	/////////////////////////
		case 32:
		
			$usuario = $_POST ["usuario"];
			$clave = $_POST ["clave"];	
			
			$proceso = accesoNomina :: validar ($usuario, $clave);
			include ("../vista/menu.php");
			exit ();
			break;
			
	//////////Rol//////////
	/////////////////////////
		case 42:
		
			$nombreRol = $_POST ["nombreRol"];
			
			Rol :: insertar ($nombreRol);
			exit ();
			break;

		case 43:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];

			$proceso_r = Rol :: listar ($opc, $campo, $valor);
			
			include ("../Vista/listarRol.php");
			exit ();
			break;

	//////////Permiso//////////
	/////////////////////////			
		case 51:
		
			$opc_z = 78;	
			$campo_z = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor_z = (empty($_POST ["valor"]))?0:$_POST["valor"];
			
			$proceso_z = Zona :: listar ($opc_z, $campo_z, $valor_z);
			
			$opc_s = 63;	
			$campo_s = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor_s = (empty($_POST ["valor"]))?0:$_POST["valor"];
			
			$proceso_s = SubMenu :: listar ($opc_s, $campo_s, $valor_s);
		
			include ("../vista/insertarPermiso.php");
			exit ();
			break;

		case 52:

			$idSubMenu = $_POST ["idSubMenu"];
			$nitzona = $_POST ["nitzona"];
			
			Permiso :: insertar ($idSubMenu, $nitzona);
			exit ();
			break;

			break;

		case 53:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];

			$proceso_p = Permiso :: listar ($opc, $campo, $valor);
			
			include ("../Vista/listarPermiso.php");
			exit ();
			break;

	//////////Zona//////////
	/////////////////////////
		case 73:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];

			$proceso_z = Zona :: listar ($opc, $campo, $valor);
			
			include ("../Vista/listarZona.php");
			exit ();
			break;
			
		case 77:
		
			$valor = $_REQUEST ["valor"];

			Zona :: generar ($valor);
			break;

	//////////Empleado//////////
	/////////////////////////			
		case 83:

			$opc = $_REQUEST["opc"];
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];
			
			$proceso_e = Empleado :: listar ($opc, $campo, $valor);
			
			include ("../Vista/listarEmpleado.php");
			exit ();
			break;
			
		case 88:
			
			$valor = $_REQUEST ["valor"];
			$proceso_mi = Empleado :: listar1 ($valor);
			
			include ("../vista/listarEmpleadoHoras.php");
			exit ();
			break;

	//////////Control Ingreso//////////
	/////////////////////////			
		case 92:
			
			$fecha = $_POST ["fecha"];
			$hora = $_POST ["hora"];
			$cedula = $_POST ["cedula"];
			
			ControlIngreso :: insertar ($fecha, $hora, $cedula);
			exit ();
			break;

	//////////Ausencia//////////
	/////////////////////////			

		case 101:
		
			$opc =  88;
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];
			
			$proceso_e = Empleado :: listar ($opc, $campo, $valor);
			include ("../vista/insertarAusencia.php");
			
			exit ();
			break;
		
		case 102:
		
			$codEmple = $_POST["codEmple"];
			$fechaSolicitud = $_POST["fechaSolicitud"];
			$fechaPermiso = $_POST["fechaPermiso"];
			$totalHoras = $_POST["totalHoras"];
			$codEmpleAutoriza = $_POST["codEmpleAutoriza"];
			$departamento = $_POST["departamento"];
			$observacion = $_POST["observacion"];
			
			Ausencia :: insertar ($codEmple, $fechaSolicitud, $fechaPermiso, $totalHoras, $codEmpleAutoriza, $departamento, $observacion);
		
			exit ();
			break;
			
			
	//////////Periodo//////////
	/////////////////////////			

		case 111:
		
			$opc =  $_REQUEST["opc"];
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];
			
			$proceso_p = Periodo :: listar ($opc, $campo, $valor);
			include ("../vista/insertarPeriodo.php");
			
			exit ();
			break;
		
		case 112:
		
			$fechaInicio = $_POST["fechaInicio"];
			$fechaFinal = $_POST["fechaFinal"];
			
			Periodo :: insertar ($fechaInicio, $fechaFinal);
		
			exit ();
			break;
			
		case 113:
		
			$opc_h = 23;
			$campo_h = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor_h = (empty($_POST ["valor"]))?0:$_POST["valor"];

			$proceso_h = Horario :: listar ($opc_h, $campo_h, $valor_h);
			
			$opc_p = 103;
			$campo_p = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor_p = (empty($_POST ["valor"]))?0:$_POST["valor"];

			$proceso_p = Periodo :: listar ($opc_p, $campo_p, $valor_p);
			
			$opc = 83;
			$campo = (empty($_POST ["campo"]))?0:$_POST["campo"];
			$valor = (empty($_POST ["valor"]))?0:$_POST["valor"];
			
			$proceso_e = Empleado :: listar ($opc, $campo, $valor);

			include ("../vista/insertarAsignacionHorarios.php");
			
			exit ();
			break;
			
		case 114:
		
			$cedEmple = $_POST["cedEmple"];
			$idHorario = $_POST["idHorario"];
			$idPeriodo = $_POST["idPeriodo"];
			
			DetalleHorario :: insertar ($cedEmple, $idHorario, $idPeriodo);
			
			exit ();
			break;
			
		case 122:
		
			$usuario = $_POST["usuario"];
			$contrasena = $_POST["contrasena"];
			$contrasenaNueva = $_POST["contrasenaNueva"];
			
			AccesoNomina :: modificar ($usuario, $contrasena, $contrasenaNueva);
			
			exit ();
			break;
	}
?>