<?
	//////////Jornada//////////
	/////////////////////////
	class Jornada	{
	
		public $idJornada;
		public $nombreJornada;
		public $dial;
		public $diam;
		public $diaw;
		public $diaj;
		public $diav;
		public $dias;
		public $diad;
		public $observacion;
		
		function Jornada ($_idJornada, $_nombreJornada, $_dial,	$_diam, $_diaw, $_diaj, $_diav, $_dias, $_diad, $_observacion)	{
		
			$this -> idJornada = $_idJornada;
			$this -> nombreJornada = $_nombreJornada;
			$this -> dial = $_dial;
			$this -> diam = $_diam;
			$this -> diaw = $_diaw;
			$this -> diaj = $_diaj;
			$this -> diav = $_diav;
			$this -> dias = $_dias;
			$this -> diad = $_diad;
			$this -> observacion = $_observacion;
		}
		
		public static function insertar ($_nombreJornada, $_dial, $_diam, $_diaw, $_diaj, $_diav, $_dias, $_diad, $_observacion)	{
			
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarJornada ('$_nombreJornada')") or die ("Consulta Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("../conexion/conexion.php");
				$_nombreJornada = ucwords (strtolower ($_nombreJornada));
				$_observacion = ucwords (strtolower ($_observacion));
				$resultado = mysqli_query ($cnn, "call insertarJornada ('$_nombreJornada', '$_dial', '$_diam', '$_diaw', '$_diaj', '$_diav', '$_dias', '$_diad' ,'$_observacion', 'Activo')") or die ("Insercion Incorrecta");
				?>
                	<script type = "text/javascript">
						alert ("Registro Almacenado Correctamente");
						history.back ();
					</script>
				<?	
			}
			else {

				?>
                	<script type = "text/javascript">
						alert ("Jornada ya Existe");
						history.back ();
					</script>
				<?	
			}
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 3)	
			
				$consulta = "call listarJornada ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Jornada");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Jornada :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idJornada = $datos ["idJornada"];	
			$_nombreJornada = $datos ["nombreJornada"];	
			$_dial = $datos ["dial"];
			$_diam = $datos ["diam"];
			$_diaw = $datos ["diaw"];
			$_diaj = $datos ["diaj"];
			$_diav = $datos ["diav"];
			$_dias = $datos ["dias"];
			$_diad = $datos ["diad"];
			$_observacion = $datos ["observacion"];
			
			$jornada = new Jornada ($_idJornada, $_nombreJornada, $_dial, $_diam, $_diaw, $_diaj, $_diav, $_dias, $_diad, $_observacion);
			
			return $jornada;
		}
	}
	
	//////////Tipo Horario//////////
	/////////////////////////
	class TipoHorario	{
	
		public $idTipo;
		public $nombreTipo;

		function TipoHorario ($_idTipo, $_nombreTipo)	{
		
			$this -> idTipo = $_idTipo;
			$this -> nombreTipo = $_nombreTipo;
		}	
	
		public static function listar ($_opc)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 13)	
			
				$consulta = "call listarTipo ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Tipo de Horario");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, TipoHorario :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idTipo = $datos ["idTipo"];	
			$_nombreTipo = $datos ["nombreTipo"];	
			
			$tipoHorario = new TipoHorario ($_idTipo, $_nombreTipo);
			
			return $tipoHorario;
		}
	}

	//////////Horario//////////
	/////////////////////////
	class Horario	{
	
		public $idHorario;
		public $nombreHorario; 
		public $horarioInicial; 
		public $idTipoI; 
		public $horarioFinal;
		public $idTipoF;
		public $observacion;
		public $idJornada;
		public $nombreJornada;
		
		function Horario ($_idHorario, $_nombreHorario, $_horarioInicial, $_idTipoI, $_horarioFinal, $_idTipoF, $_observacion, $_idJornada, $_nombreJornada)	{
		
			$this -> idHorario = $_idHorario; 
			$this -> nombreHorario = $_nombreHorario; 
			$this -> horarioInicial = $_horarioInicial; 
			$this -> idTipoI = $_idTipoI; 
			$this -> horarioFinal = $_horarioFinal;
			$this -> idTipoF = $_idTipoF;
			$this -> observacion = $_observacion;
			$this -> idJornada = $_idJornada; 
			$this -> nombreJornada = $_nombreJornada;
		}
		
		public static function insertar ($_nombreHorario, $_horarioInicial, $_idTipoI, $_horarioFinal, $_idTipoF, $_observacion,  $_idJornada)	{
			
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarHorario ('$_nombreHorario')") or die ("Consulta Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("../conexion/conexion.php");
				$_nombreHorario = ucwords (strtolower ($_nombreHorario));
				$_observacion = ucwords (strtolower ($_observacion));
				$resultado = mysqli_query ($cnn, "call insertarHorario ('$_nombreHorario', '$_horarioInicial', '$_idTipoI', '$_horarioFinal', '$_idTipoF', '$_observacion', '$_idJornada', 'Activo')") or die ("Insercion Incorrecta");
				?>
                	<script type = "text/javascript">
						alert ("Registro Almacenado Correctamente");
						history.back ();
					</script>
				<?	
			}
			else {

				?>
                	<script type = "text/javascript">
						alert ("Horario ya Existe");
						history.back ();
					</script>
				<?	
			}
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 23)	
			
				$consulta = "call listarHorario ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Horario");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Horario :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idHorario = $datos ["idHorario"];	
			$_nombreHorario = $datos ["nombreHorario"];	
			$_horarioInicial = $datos ["horarioInicial"];
			$_idTipoI = $datos ["idTipoI"];
			$_horarioFinal = $datos ["horarioFinal"];
			$_idTipoF = $datos ["idTipoF"];
			$_observacion = $datos ["observacion"];
			$_idJornada = $datos ["idJornada"];	
			$_nombreJornada = $datos ["nombreJornada"];	
			
			$horario = new Horario ($_idHorario, $_nombreHorario, $_horarioInicial, $_idTipoI, $_horarioFinal, $_idTipoF, $_observacion, $_idJornada, $_nombreJornada);
			
			return $horario;
		}
	}

	//////////Acceso Nomina//////////
	/////////////////////////
	class AccesoNomina	{
	
		public $usuario;
		public $clave;
		
		function AccesoNomina ($_usuario, $_clave)	{
		
			$this -> usuario = $_usuario;
			$this -> clave = $_clave;
		}
		
		public static function validar ($_usuario, $_clave)	{
			
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call validar ('$_usuario', '$_clave')") or die ("Validacion Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("Usuario y/o Clave Incorrectos");
						history.back ();
					</script>
				<?	
			}
			else {
				
				$_SESSION ["usuario"] = $_usuario;				
			}
		}
		
		public static function modificar ($_usuario, $_contrasena, $_contrasenaNueva)	{

			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarAcceso ('$_usuario', '$_contrasena')") or die ("Consulta Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros != 0)	{
				
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call modificarAcceso ('$_usuario', '$_contrasena', '$_contrasenaNueva')") or die ("Modificacion Incorrecta");
				$registros = mysqli_affected_rows ($cnn);
				if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("NO se modifico el Registro");
						history.back ();
					</script>
				<?	
				}
				else {
				?>
                	<script type = "text/javascript">
						alert ("Registro Modificaddo Correctamente");
						history.back ();
					</script>
				<?
				}
			}		
			else	{

				?>
                	<script type = "text/javascript">
						alert ("NO Existe el Registro");
						history.back ();
					</script>
				<?	
			}
		}
	}
	
	//////////Roles//////////
	/////////////////////////
	class Rol	{
	
		public $idRol;
		public $nombreRol; 
		
		function Rol ($_idRol, $_nombreRol)	{
		
			$this -> idRol = $_idRol; 
			$this -> nombreRol = $_nombreRol; 
		}
		
		public static function insertar ($_nombreRol)	{
			
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarRol ('$_nombreRol')") or die ("Consulta Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("../conexion/conexion.php");
				$_nombreRol = ucwords (strtolower ($_nombreRol));
				$resultado = mysqli_query ($cnn, "call insertarRol ('$_nombreRol', 'Activo')") or die ("Insercion Incorrecta");
				?>
                	<script type = "text/javascript">
						alert ("Registro Almacenado Correctamente");
						history.back ();
					</script>
				<?	
			}
			else {

				?>
                	<script type = "text/javascript">
						alert ("Rol ya Existe");
						history.back ();
					</script>
				<?	
			}
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 43)	
			
				$consulta = "call listarRol ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Rol");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Rol :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idRol = $datos ["idRol"];	
			$_nombreRol = $datos ["nombreRol"];	
			
			$rol = new Rol ($_idRol, $_nombreRol);
			
			return $rol;
		}
	}

	//////////SubMenu//////////
	/////////////////////////
	class SubMenu	{
	
		public $idSubMenu;
		public $nombreSubMenu; 
		
		function SubMenu ($_idSubMenu, $_nombreSubMenu)	{
		
			$this -> idSubMenu = $_idSubMenu; 
			$this -> nombreSubMenu = $_nombreSubMenu; 
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 63)	
			
				$consulta = "call listarSubMenu ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe SubMenu");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, SubMenu :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idSubMenu = $datos ["idSubMenu"];	
			$_nombreSubMenu = $datos ["nombreSubMenu"];	
			
			$subMenu = new SubMenu ($_idSubMenu, $_nombreSubMenu);
			
			return $subMenu;
		}
	}

	//////////Permiso//////////
	/////////////////////////
	class Permiso	{
	
		public $idPermiso;
		public $idSubMenu;
		public $nombreSubMenu;
		public $nitzona;
		public $zona;
		
		function Permiso ($_idPermiso, $_idSubMenu, $_nombreSubMenu, $_nitzona, $_zona)	{
		
			$this -> idPermiso = $_idPermiso; 
			$this -> idSubMenu = $_idSubMenu; 
			$this -> nombreSubMenu = $_nombreSubMenu; 
			$this -> nitzona = $_nitzona;
		  	$this -> zona = $_zona;
		}
		
		public static function insertar ($_idSubMenu, $_nitzona)	{
			
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarPermiso ('$_idSubMenu', '$_nitzona')") or die ("Consulta Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call insertarPermiso ('$_idSubMenu', '$_nitzona', 'Activo')") or die ("Insercion Incorrecta");
				?>
                	<script type = "text/javascript">
						alert ("Registro Almacenado Correctamente");
						history.back ();
					</script>
				<?	
			}
			else {

				?>
                	<script type = "text/javascript">
						alert ("Permiso ya Existe");
						history.back ();
					</script>
				<?	
			}
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 53)	
			
				$consulta = "call listarPermiso ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Permiso");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Permiso :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idPermiso = $datos ["idPermiso"];	
			$_idSubMenu = $datos ["idSubMenu"];	
			$_nombreSubMenu = $datos ["nombreSubMenu"];	
			$_nitzona =  $datos ["nitzona"];	
			$_zona =  $datos ["zona"];	
			
			$permiso = new Permiso ($_idPermiso, $_idSubMenu, $_nombreSubMenu, $_nitzona, $_zona);
			
			return $permiso;
		}
	}

	//////////Zona//////////
	/////////////////////////
	class Zona	{
	
		public $codzona;
		public $zona; 
		public $nitzona;
		
		function Zona ($_codzona, $_zona, $_nitzona)	{
		
			$this -> codzona = $_codzona;
			$this -> zona = $_zona; 
			$this -> nitzona = $_nitzona;
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 73)	
			
				$consulta = "call listarZona ()";	
			elseif ($_opc == 78)	
			
				$consulta = "call listarZonaPermisos ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Zona");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Zona :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_codzona = $datos ["codzona"];	
			$_zona = $datos ["zona"];	
			$_nitzona = $datos ["nitzona"];
			
			$zona = new Zona ($_codzona, $_zona, $_nitzona);
			
			return $zona;
		}
		
		public static function generar ($_valor)	{
		
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarZona ('$_valor')") or die ("Consultar incorrecto");	
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call generarZona ('$_valor')") or die ("Generador incorrecto");	
				$registros = mysqli_affected_rows ($cnn);
				?>
                	<script type = "text/javascript">
						alert ("Zona Generada");
						history.back ();
					</script>
				<?	
			}
			else	{

				?>
                	<script type = "text/javascript">
						alert ("La Zona ya esta Generada");
						history.back ();
					</script>
				<?	
			}
		}
	}
	
	//////////Empleado//////////
	/////////////////////////
	class Empleado	{
	
		public $cedemple; 
		public $codemple;
		public $nomemple;
		public $nomemple1;
		public $apemple;
		public $apemple1;
		
		public $fecha;
		public $horas;
		
		function Empleado ($_cedemple, $_codemple, $_nomemple, $_nomemple1, $_apemple, $_apemple1, $_fecha, $_horas)	{
		
			$this -> cedemple = $_cedemple; 
			$this -> codemple = $_codemple; 
			$this -> nomemple = $_nomemple; 
			$this -> nomemple1 = $_nomemple1; 
			$this -> apemple = $_apemple; 
			$this -> apemple1 = $_apemple1; 
			
			$this -> fecha =  $_fecha;
			$this -> horas = $_horas;
		}
		
		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$usuario = $_SESSION ["usuario"];
			$mat = array ();
			if ($_opc == 83)
	
				$consulta = "call listarEmpleado ('$usuario')";	
			elseif ($_opc == 88)	
			
				$consulta = "call listarEmpleadoAusencia ('$usuario')";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Empleado");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Empleado :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function listar1 ($_valor)	{
			
			$mat = array();
			include ("../conexion/conexion.php");
			$consulta = "insert into movimientoingreso (horas, fecha, cedula) select timediff(max(hora), min(hora)), fecha, cedula from controlingreso where cedula = '$_valor' group by cedula, fecha";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			
			$consulta =  "select empleado.cedemple, empleado.codemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, movimientoingreso.fecha, movimientoingreso.horas from movimientoingreso inner join empleado on movimientoingreso.cedula = empleado.cedemple where movimientoingreso.cedula =  '$_valor' group by cedula, fecha";
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");	
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Empleado");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Empleado :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_cedemple = $datos ["cedemple"];	
			$_codemple = $datos ["codemple"];	
			$_nomemple = $datos ["nomemple"];	
			$_nomemple1 = $datos ["nomemple1"];	
			$_apemple = $datos ["apemple"];	
			$_apemple1 = $datos ["apemple1"];	
			
			$_fecha = $datos ["fecha"];	
			$_horas = $datos ["horas"];	
			
			$empleado = new Empleado ($_cedemple, $_codemple, $_nomemple, $_nomemple1, $_apemple, $_apemple1, $_fecha, $_horas);
			
			return $empleado;
		}
	}

	//////////ControlIngreso//////////
	/////////////////////////
	class ControlIngreso	{
	
		public $fecha; 
		public $hora;
		public $cedula;
		
		function ControlIngreso ($_fecha, $_hora, $_cedula)	{
		
			$this -> fecha = $_fecha; 
			$this -> hora = $_hora; 
			$this -> cedula = $_cedula; 
		}
		
		public static function insertar ($_fecha, $_hora, $_cedula)	{
			
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call consultarIngreso ('$_cedula')") or die ("Consulta Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros != 0)	{
				
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call insertarIngreso ('$_fecha', '$_hora', '$_cedula')") or die ("Insercion Incorrecta");
				?>
                	<script type = "text/javascript">
						alert ("Registro Almacenado Correctamente");
						history.back ();
					</script>
				<?	
			}
			else {

				?>
                	<script type = "text/javascript">
						alert ("El Empleado no Existe");
						history.back ();
					</script>
				<?	
			}
		}
	}
	
	//////////Ausencia//////////
	/////////////////////////
	class Ausencia	{
	
		public $codEmple; 
		public $fechaSolicitud;
		public $fechaPermiso;
		public $totalHoras;
		public $codEmpleAutoriza;
		public $departamento;
		public $observacion;
		
		function Ausencia ($_codEmple, $_fechaSolicitud, $_fechaPermiso, $_totalHoras, $_codEmpleAutoriza, $_departamento, $_observacion)	{
		
			$this -> codEmple = $_codEmple; 
			$this -> fechaSolicitud = $_fechaSolicitud; 
			$this -> fechaPermiso = $_fechaPermiso; 
			$this -> totalHoras = $_totalHoras; 
			$this -> codEmpleAutoriza = $_codEmpleAutoriza; 
			$this -> departamento = $_departamento; 
			$this -> observacion = $_observacion; 
		}
		
		public static function insertar ($_codEmple, $_fechaSolicitud, $_fechaPermiso, $_totalHoras, $_codEmpleAutoriza, $_departamento, $_observacion)	{
			
			include ("../conexion/conexion.php");
			$resultado = mysqli_query ($cnn, "call insertarAusencia ('$_codEmple', '$_fechaSolicitud', '$_fechaPermiso', '$_totalHoras', '$_codEmpleAutoriza', '$_departamento', '$_observacion')") or die ("Insercion Incorrecta");
			?>
				<script type = "text/javascript">
					alert ("Registro Almacenado Correctamente");
					history.back ();
				</script>
			<?	
		}
	}
	
	//////////Periodo//////////
	/////////////////////////
	class Periodo	{
	
		public $idPeriodo; 
		public $fechaInicio;
		public $fechaFinal;
		public $nitZona;
		
		function Periodo ($_idPeriodo, $_fechaInicio, $_fechaFinal, $_nitZona)	{
		
			$this -> idPeriodo = $_idPeriodo; 
			$this -> fechaInicio = $_fechaInicio; 
			$this -> fechaFinal = $_fechaFinal; 
			$this -> nitZona = $_nitZona; 
		}
		
		public static function insertar ($_fechaInicio, $_fechaFinal)	{
			
			include ("../conexion/conexion.php");
			$_nitZona =  $_SESSION["usuario"];
			$resultado = mysqli_query ($cnn, "call consultarPeriodo ('$_fechaInicio', '$_nitZona')") or die ("Consulta Incorrecta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call insertarPeriodo ('$_fechaInicio', '$_fechaFinal', '$_nitZona')") or die ("Insercion Incorrecta");
				?>
					<script type = "text/javascript">
						alert ("Registro Almacenado Correctamente");
						history.back ();
					</script>
				<?	
			}
			else	{

				?>
                	<script type = "text/javascript">
						alert ("El Periodo ya Existe");
						history.back ();
					</script>
				<?				
			}
		}

		public static function listar ($_opc, $_campo, $_valor)	{
			
			include ("../conexion/conexion.php");
			$mat = array ();
			if ($_opc == 103)	
			
				$consulta = "call listarAsignacionPeriodo ()";	
			$resultado = mysqli_query($cnn, $consulta) or die ("Listado Incorrecto");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				?>
                	<script type = "text/javascript">
						alert ("No Existe Zona");
						history.back ();
					</script>
				<?	
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Periodo :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		public static function mostrar ($datos)	{
		
			$_idPeriodo = $datos ["idPeriodo"];	
			$_fechaInicio = $datos ["fechaInicio"];	
			$_fechaFinal = $datos ["fechaFinal"];
			$_nitZona = $datos ["nitZona"];
			
			$periodo = new Periodo ($_idPeriodo, $_fechaInicio, $_fechaFinal, $_nitZona);
			
			return $periodo;
		}
	}
	
	//////////DetalleHorario//////////
	/////////////////////////
	class DetalleHorario	{
	
		public $idDetalleHorario; 
		public $nitZona;
		public $cedEmple;
		public $idHorario;
		public $idPeriodo;
		
		function DetalleHorario ($_idDetalleHorario, $_nitZona, $_cedEmple, $_idHorario, $_idPeriodo)	{
		
			$this -> idDetalleHorario = $_idDetalleHorario; 
			$this -> nitZona = $_nitZona; 
			$this -> cedEmple = $_cedEmple; 
			$this -> idHorario = $_idHorario;
			$this -> idPeriodo = $_idPeriodo; 
		}
		
		public static function insertar ($_cedEmple, $_idHorario, $_idPeriodo)	{
			
			$_nitZona =  $_SESSION["usuario"];
			foreach ($_cedEmple as $listarDH)	{
	
				include ("../conexion/conexion.php");
				$resultado = mysqli_query ($cnn, "call consultarDetalleHorario ('$listarDH', '$_idPeriodo')") or die ("Consulta Incorrecta");
				$registros = mysqli_num_rows ($resultado);
				if ($registros == 0)	{
					
					include ("../conexion/conexion.php");
					$resultado = mysqli_query ($cnn, "call insertarDetalleHorario ('$_nitZona', '$listarDH', '$_idHorario', '$_idPeriodo')") or die ("Insercion Incorrecta")	;
				}
			}
			?>
				<script type = "text/javascript">
					alert ("Registro Almacenado Correctamente");
					history.back ();
				</script>
			<?	
		}
	}
?>