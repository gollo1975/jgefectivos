<?php session_start (); ?>

<?php
	
	//include $_SERVER ['DOCUMENT_ROOT'].'/jgefectivo/empresas/clases.php';
	include ("clases.php");
	
	switch ($_REQUEST ["opc"])	{

	/*************************************
	Zona
	*************************************/	
	
		/*****************
		Listar
		*****************/
		case 3:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$_SESSION["departamento"] = $xdepto;
			$procesoZ = Zona :: listar ($opc, $campo, $valor);
			if (!empty ($procesoZ))
				include ("listarZona.php");
			
			exit ();
			break;
		
		/*****************
		Crear Carpeta
		*****************/
		case 4:

			$zona = $_REQUEST ["zona"];
			$codzona = $_REQUEST ["codzona"];
			
			$procesoZ = Zona :: crearCarpeta ($zona, $codzona);
			
			exit ();
			break;

		case 5:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			$procesoZ = Zona :: listar ($opc, $campo, $valor);
			if (!empty ($procesoZ))
				include ("listarZona.php");
			
			exit ();
			break;
			
			
			

			
	/*************************************
	Empleado
	*************************************/			
		/*****************
		listar Crear
		*****************/
		case 11:
		
			$opcE = 14;
			$campoE = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorE = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoE = Empleado :: listar ($opcE, $campoE, $valorE);
			
			include ("insertarUsuario.php");
			exit ();
			break;

		/*****************
		listar Crear
		*****************/
		case 12:
			
			$cedemple = $_POST ["cedemple"];
			
			Empleado :: insertar ($cedemple);
			
			exit ();
			break;

		/*****************
		Listar
		*****************/
		case 13:
		
			$opc = $_REQUEST ["opc"];
			$campo = $_REQUEST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			if (!empty ($procesoE))
				include ("listarEmpleado.php");
			
			exit ();
			break;

		/*****************
		Crear Carpeta
		*****************/
		case 14:

			$codzona = $_REQUEST ["codzona"];
			$ubicacion = $_REQUEST ["ubicacion"];
			$codemple = $_REQUEST ["codemple"];
			$empleado = $_REQUEST ["empleado"];
			
			$procesoE = Empleado :: crearCarpeta ($codzona, $ubicacion, $codemple, $empleado);
			
			exit ();
			break;
			
		/*****************
		Listar
		*****************/
		case 15:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			if (!empty ($procesoE))
			
				include ("listarEmpleado.php");
			
			exit ();
			break;
			
		/*****************
		Listar Faltantes
		*****************/
		case 16:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			if (!empty ($procesoE))
			
				include ("listarEmpleadoFaltante.php");
			
			exit ();
			break;			

		/*****************
		Listar
		*****************/			
		case 17:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			if (!empty ($procesoE))
			
				include ("listadoEmpleado.php");
			
			exit ();
			break;

		/*****************
		Listar empleado zona
		*****************/
		case 18:
		
			$opc = $_REQUEST ["opc"];
			$campo = $_REQUEST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			if (!empty ($procesoE))
				include ("listarEmpleadoZona.php");
			
			exit ();
			break;

		case 19:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$procesoDE = DocumentacionEmpleado :: listar ($opc, $campo, $valor);
			
			include ("listarDocumentacionEmpleadoZona.php");
			exit ();
			break;

		case 20:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoE = Empleado :: listar ($opc, $campo, $valor);
			include ("listarEmpleado.php");
			
			exit ();
			break;
		


	/*************************************
	DocumentacionEmpleado
	*************************************/

		/*****************
		Listar
		*****************/
		case 24:
		
			$opcCD = 33;
			$campoCD = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorCD = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoCD = CategoriaDocumento :: listar ($opcCD, $campoCD, $valorCD);
			
			$opcE = $_REQUEST ["opc"];
			$campoE = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorE = $_REQUEST ["valor"];
			
			$procesoE = Empleado :: listar ($opcE, $campoE, $valorE);
			
			include ("cargarDocumentos.php");
			exit ();
			break;
		
		/*****************
		Insertar
		*****************/
		case 25:
			
			$codemple = $_POST ["codemple"];
			$idCategoriaDocumento =  $_POST ["idCategoriaDocumento"];
			$archivo = $_FILES ["archivo"]["name"];
			$tipo =  $_FILES ["archivo"]["type"];
			$tamano = $_FILES ["archivo"]["size"];
			$ubicacionEmpleado = $_POST ["ubicacionEmpleado"];
			
			DocumentacionEmpleado :: insertar ($codemple, $idCategoriaDocumento,  $archivo, $tipo, $tamano, $ubicacionEmpleado);
			
			exit ();
			break;

		/*****************
		Modificar
		*****************/
		case 26:
		
			$idDocumentacion = $_POST ["idDocumentacion"];
			$archivo = $_POST ["archivo"];
			$idCategoriaDocumento = $_POST ["idCategoriaDocumento"];
			
			$proceso = DocumentacionEmpleado :: modificar ($idDocumentacion, $archivo, $idCategoriaDocumento);
			
			exit ();
			break;
	
	/*************************************
	CategoriaDocumento
	*************************************/

		/*****************
		Insertar
		*****************/
		case 32:
		
			$descripcion = $_POST ["descripcion"];
			
			CategoriaDocumento :: insertar ($descripcion);
			
			exit ();
			break;

		/*****************
		Listar
		*****************/
		case 33:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoC = CategoriaDocumento :: listar ($opc, $campo, $valor);
			if (!empty ($procesoC))
			
				include ("listarCategoria.php");
			
			exit ();
			break;
			
		/*****************
		Listar
		*****************/
		case 34:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$procesoC = CategoriaDocumento :: listar ($opc, $campo, $valor);
			if (!empty ($procesoC))
				include ("editarCategoriaDocumento.php");
			
			exit ();
			break;
			
		/*****************
		Modificar
		*****************/
		case 35:
		
			$idCategoriaDocumento = $_POST ["idCategoriaDocumento"];
			$descripcion = $_POST ["descripcion"];
			
			CategoriaDocumento :: modificar ($idCategoriaDocumento, $descripcion);

			exit ();
			break;
						
		case 36:
				
			if (empty ($_POST ["permiso"]))	
			
				echo "<script type = 'text/javascript'>	history.back (); </script>";
			else	{

				$permiso = $_POST ["permiso"];
				CategoriaDocumento :: permisos ($permiso);
			}
			exit ();
			break;
		
	/*************************************
	DocumentacionEmpleado
	*************************************/

		/*****************
		Listar
		*****************/
		case 43:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$procesoDE = DocumentacionEmpleado :: listar ($opc, $campo, $valor);
			
			include ("listarDocumentacionEmpleado.php");
			exit ();
			break;
			
		/*****************
		Eliminar
		*****************/
		case 44:
		
			$valor = $_REQUEST ["valor"];
			
			DocumentacionEmpleado :: eliminar ($valor);
			
			exit ();
			break;

		/*****************
		Listar
		*****************/
		case 46:

			$opcCD = 33;
			$campoCD = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorCD = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoCD = CategoriaDocumento :: listar ($opcCD, $campoCD, $valorCD);

			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$proceso = DocumentacionEmpleado :: listar ($opc, $campo, $valor);
			include ("editarDocumentos.php");
			
			exit ();
			break;			

		/*****************
		Listar
		*****************/
		case 47:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_REQUEST ["valor"];
			
			$procesoDE = DocumentacionEmpleado :: listar ($opc, $campo, $valor);
			
			include ("listarDocumentacionEmpleadoZona.php");
			exit ();
			break;

		case 48:
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = $_REQUEST ["valor"];
			$_SESSION ["userzona"] = $xzona;
			$procesoDE = DocumentacionEmpleado :: listar ($opc, $campo, $valor);
			
			include ("listarDocumentacionEmpleadoZona.php");
			exit ();
			break;
			
	/*************************************
	Rol
	*************************************/	
	
		/*****************
		Insertar
		*****************/
		case 52:
		
			$nombreRol = $_POST ["nombreRol"];
			
			Rol :: insertar ($nombreRol);
			
			exit ();
			break;

		/*****************
		Listar
		*****************/
		case 53:
			
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];

			$proceso_r = Rol :: listar ($opc, $campo, $valor);
			
			include ("listarRol.php");
			exit ();
			break;

	/*************************************
	Acceso
	*************************************/	
	
		/*****************
		Acceso
		*****************/
		case 64:
		
			$usuario = $_POST ["usuario"];
			$clave = $_POST ["clave"];
			
			AccesoDoc :: acceso ($usuario, $clave);
			include ("menu.php");
			
			exit ();
			break;
			
	/*************************************
	Permiso
	*************************************/	

		/*****************
		Llenado de Combos
		*****************/
		case 71:
		
			$opcR = 53;	
			$campoR = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorR = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];
			
			$procesoR = Rol :: listar ($opcR, $campoR, $valorR);
			
			$opcS = 83;	
			$campoS = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valorS = $_REQUEST ["valor"];
			
			$procesoS = SubMenu :: listar ($opcS, $campoS, $valorS);
		
			include ("insertarPermiso.php");
			exit ();
			break;


		/*****************
		Insertar
		*****************/
		case 72:

			$idRol = $_POST ["idRol"];
			$idSubMenu = $_POST ["idSubMenu"];
			
			Permiso :: insertar ($idRol, $idSubMenu);
			exit ();
			break;

		/*****************
		Listar
		*****************/
		case 73:
		
			$opc = $_REQUEST ["opc"];
			$campo = (empty ($_POST ["campo"])) ? 0 : $_POST ["campo"];
			$valor = (empty ($_POST ["valor"])) ? 0 : $_POST ["valor"];

			$proceso = Permiso :: listar ($opc, $campo, $valor);
			
			include ("listarPermiso.php");
			exit ();
			break;
	}
?>
