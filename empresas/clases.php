<?php session_start();?>

<?php
	/*************************************
	Zona
	*************************************/
	class Zona	{
	
		var $codzona;
		var $zona;
		var $nitzona;
		var $ubicacion;
		var $estado;
		
		/*****************
		Constructor
		*****************/
		function Zona ($_codzona, $_zona, $_nitzona, $_ubicacion, $_estado)	{
		
			$this -> codzona = $_codzona;
			$this -> zona = $_zona;
			$this -> nitzona = $_nitzona;
			$this -> ubicacion = $_ubicacion;
			$this -> estado = $_estado;
		}

		/*****************
		Listar
		*****************/
		public static function listar ($_opc, $_campo, $_valor)	{

			$mat = array ();
			include ("conexion.php");
			if ($_opc == 3)	{
			
				$dep = $_SESSION ["departamento"];
				$resultado = @mysqli_query ($cnn, "select distinct zona.codzona, zona.zona, zona.nitzona, ubicacion.ubicacion, ubicacion.estado from zona left join ubicacion on zona.codzona = ubicacion.codzona where zona.estado = 'Activa' and zona.codsucursal = '$dep' order by zona.zona;");
			}
			else if ($_opc == 5)	{
			
				$resultado = @mysqli_query ($cnn, "select distinct zona.codzona, zona.zona, zona.nitzona, ubicacion.ubicacion, ubicacion.estado from zona left join ubicacion on zona.codzona = ubicacion.codzona where zona.estado = 'Activa' order by zona.zona;");
			}
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
			
				echo "<script type='text/javascript'> alert ('No Existen Zonas Disponibles'); history.back (); </script>";
			}
			else	{
			
				for ($i = 0; $i < $registros; $i++)	{

					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Zona :: mostrar ($datos));				
				}
				
				return $mat;
				
			}
		}

		/*****************
		Mostrar
		*****************/
		public static function mostrar ($datos)	{
		
			$_codzona = $datos ["codzona"];
			$_zona = $datos ["zona"];
			$_nitzona = $datos ["nitzona"];
			$_ubicacion = $datos ["ubicacion"];
			$_estado = $datos ["estado"];
			$zona = new Zona ($_codzona, $_zona, $_nitzona, $_ubicacion, $_estado);
			
			return $zona;
			
		}

		/*****************
		Crear Carpeta
		*****************/
		public static function crearCarpeta ($_zona, $_codzona)	{
		
			$_zona = str_replace("�", "N", $_zona);
			$nombre_carpeta="../../zonas/".$_zona;
    		if	(!is_dir ($nombre_carpeta))	{

	        	mkdir("$nombre_carpeta", 0777, true);
				$estado = "SI";
				Zona :: insertarCarpeta ($_codzona, $nombre_carpeta, $estado);
				echo "<script type='text/javascript'> alert ('Carpeta Creada Correctamente'); history.back (); </script>";
    		}
			else	{
			
				echo "<script type='text/javascript'> alert ('Ya Existe la Carpeta'); history.back (); </script>";
    		}
		}
		
		/*****************
		Insertar Carpeta
		*****************/
		public static function insertarCarpeta ($_codzona, $nombre_carpeta, $estado)	{
		
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call insertarCarpeta ('$_codzona', '$nombre_carpeta', '$estado')");
			echo "<script type='text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";			
		}
	}
	
	/*************************************
	Empleado
	*************************************/
	class Empleado	{
	
		var $codemple;
		var $cedemple;
		var $nomemple;
		var $nomemple1;
		var $apemple;
		var $apemple1;
		var $codzona;
		var $zona;
		var $ubicacion;
		var $ubicacionEmpleado;
		var $estado;
		var $fechater;
		var $fechainic;

		/*****************
		Constructor
		*****************/
		function Empleado ($_codemple, $_cedemple, $_nomemple, $_nomemple1, $_apemple, $_apemple1, $_codzona, $_zona, $_ubicacion, $_ubicacionEmpleado, $_estado,  $_fechater, $_fechainic)	{
		
			$this -> codemple = $_codemple;
			$this -> cedemple = $_cedemple;
			$this -> nomemple = $_nomemple;
			$this -> nomemple1 = $_nomemple1;
			$this -> apemple = $_apemple;
			$this -> apemple1 = $_apemple1;
			$this -> codzona = $_codzona;
			$this -> zona = $_zona;
			$this -> ubicacion = $_ubicacion;
			$this -> ubicacionEmpleado = $_ubicacionEmpleado;
			$this -> estado = $_estado;
			$this -> fechater = $_fechater;
			$this -> fechainic = $_fechainic;
		}

		/*****************
		Insertar
		*****************/
		public static function insertar ($_cedemple)	{
				
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call consultarEmpleadoAcc ('$_cedemple')");
			$registros =  mysqli_num_rows ($resultado);
			if ($registros == 0)	{

				include ("conexion.php");	
				$resultado = @mysqli_query ($cnn, "call insertarEmpleadoAcc ('$_cedemple')");
				echo "<script type='text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";				
			}
			else	{
			
				echo "<script type='text/javascript'> alert ('El Registro ya Existe'); history.back (); </script>";				
			}
		}
		
		/*****************
		Listar
		*****************/
		public static function listar ($_opc, $_campo, $_valor)	{

			$mat = array ();
			include ("conexion.php");
			if ($_opc == 13)

				$consulta = "call listarEmpleadoZona ('$_valor')";
			elseif ($_opc == 14)
				
				$consulta = "call listarEmpleadoAcc ()";				
			elseif ($_opc == 15)	{
			
				if ($_campo == 'codemple' || $_campo == 'cedemple')	{
				
					$consulta = "select empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, zona.codzona, zona.zona, ubicacionempleado.estado, contrato.fechater  from empleado inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona inner join ubicacion on ubicacion.codzona = zona.codzona left join ubicacionempleado on empleado.codemple =  ubicacionempleado.codemple where contrato.fechater='0000-00-00' and empleado.$_campo = '$_valor'";
				}
				else{
				
					$consulta = "select empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, zona.codzona, zona.zona, ubicacionempleado.estado, contrato.fechater  from empleado inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona inner join ubicacion on ubicacion.codzona = zona.codzona left join ubicacionempleado on empleado.codemple =  ubicacionempleado.codemple where contrato.fechater='0000-00-00' and empleado.$_campo like '%$_valor%'";
				}
			}
			elseif ($_opc == 16){
			
				$consulta = "select distinct empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, zona.codzona, zona.zona, ubicacionempleado.estado, contrato.fechater, contrato.fechainic  from empleado inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona inner join ubicacion on ubicacion.codzona = zona.codzona left join ubicacionempleado on empleado.codemple =  ubicacionempleado.codemple where contrato.fechater='0000-00-00' and empleado.codzona = '$_valor' and ubicacionempleado.codemple is null order by empleado.nomemple";
			}	
			elseif ($_opc == 17)	{
			
				if ($_campo == 'codemple' || $_campo == 'cedemple')	{
				
					$consulta = "select empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, contrato.fechater, zona.codzona, zona.zona, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, ubicacionempleado.estado, contrato.fechater from empleado inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona left join ubicacionempleado on ubicacionempleado.codemple = empleado.codemple left join ubicacion on ubicacion.codzona = zona.codzona where empleado.$_campo = '$_valor' order by contrato.fechater, empleado.nomemple";
				}
				else{
				
					$consulta = "select distinct empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, contrato.fechater, zona.codzona, zona.zona, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, ubicacionempleado.estado, contrato.fechater  from empleado inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona left join ubicacionempleado on ubicacionempleado.codemple = empleado.codemple left join ubicacion on ubicacion.codzona = zona.codzona where empleado.$_campo = '$_valor' order by contrato.fechater, empleado.nomemple";
				}
			}
			elseif ($_opc == 18)

				$consulta = "call listarEmpleadoZona ('$_valor')";
			
			elseif ($_opc == 19)	{
				
				if ($_campo = 'cedemple')	{
				
					$consulta = "select empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, contrato.fechater, zona.codzona, zona.zona, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, ubicacionempleado.estado, contrato.fechater from empleado inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona left join ubicacionempleado on ubicacionempleado.codemple = empleado.codemple left join ubicacion on ubicacion.codzona = zona.codzona where empleado.$_campo = '$_valor' and empleado.codzona = '$usuario' order by contrato.fechater, empleado.nomemple";
				}
				else{
				
					$consulta = "select distinct empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple, empleado.apemple1, contrato.fechater, zona.codzona, zona.zona, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, ubicacionempleado.estado, contrato.fechater  from empleado inner join contrato on empleado.codemple = contrato.codemple inner join zona on empleado.codzona = zona.codzona left join ubicacionempleado on ubicacionempleado.codemple = empleado.codemple left join ubicacion on ubicacion.codzona = zona.codzona where empleado.$_campo = '$_valor'  and empleado.codzona = '$usuario' order by contrato.fechater, empleado.nomemple";
				}
			}
elseif ($_opc == 20)	{
			
				if ($_campo == 'codemple' || $_campo == 'cedemple')	{
				
					$consulta = "select empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple,
empleado.apemple1, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, zona.codzona,
zona.zona, ubicacionempleado.estado from empleado inner join zona on empleado.codzona = zona.codzona
inner join ubicacion on ubicacion.codzona = zona.codzona left join ubicacionempleado on empleado.codemple =  ubicacionempleado.codemple
where empleado.$_campo = '$_valor'";
				}
				else{
				
					$consulta = "select empleado.codemple, empleado.cedemple, empleado.nomemple, empleado.nomemple1, empleado.apemple,
empleado.apemple1, ubicacionempleado.ubicacion 'ubicacionEmpleado', ubicacion.ubicacion, zona.codzona, zona.zona,
ubicacionempleado.estado from empleado inner join zona on empleado.codzona = zona.codzona inner join
ubicacion on ubicacion.codzona = zona.codzona
left join ubicacionempleado on empleado.codemple =  ubicacionempleado.codemple where empleado.$_campo like '%$_valor%'";
				}
			}			
			elseif ($_opc == 24){
			
				$consulta = "call listarEmpleadoDoc ('$_valor')";
			}
			$resultado = @mysqli_query ($cnn, $consulta) or die ("Listado Incorrecto $consulta");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
			
				echo "<script type='text/javascript'> alert ('No Existen Empleados Disponibles'); history.back (); </script>";				
			}
			else	{
			
				for ($i = 0; $i < $registros; $i++)	{

					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Empleado :: mostrar ($datos));				
				}
				
				return $mat;
				
			}
		}

		/*****************
		Mostrar
		*****************/
		public static function mostrar ($datos)	{
		
			$_codemple = $datos ["codemple"];
			$_cedemple = $datos ["cedemple"];
			$_nomemple = $datos ["nomemple"];
			$_nomemple1 = $datos ["nomemple1"];
			$_apemple = $datos ["apemple"];
			$_apemple1 = $datos ["apemple1"];
			$_codzona = $datos ["codzona"];
			$_zona = $datos ["zona"];
			$_ubicacion = $datos ["ubicacion"];
			$_ubicacionEmpleado = $datos ["ubicacionEmpleado"];
			$_estado = $datos ["estado"];
			$_fechater = $datos ["fechater"];
			$_fechainic = $datos ["fechainic"];
			
			$empleado = new Empleado ($_codemple, $_cedemple, $_nomemple, $_nomemple1, $_apemple, $_apemple1, $_codzona, $_zona, $_ubicacion, $_ubicacionEmpleado, $_estado, $_fechater, $_fechainic);
			
			return $empleado;
			
		}

		/*****************
		Crear Carpeta
		*****************/
		public static function crearCarpeta ($_codzona, $_ubicacionEmpleado, $_codemple, $_empleado)	{
		
			$_empleado = str_replace("�", "N", $_empleado);

			$nombre_carpeta=$_ubicacionEmpleado."/".$_codemple."_".$_empleado;
			
    		if	(!is_dir	($nombre_carpeta))	{

	        	mkdir("$nombre_carpeta", 0777, true);
				$estado = "SI";
				Empleado :: insertarCarpeta ($_codzona, $nombre_carpeta, $_codemple, $estado);
				echo "<script type='text/javascript'> alert ('Carpeta Creada Correctamente'); history.back (); </script>";								
    		}
			else	{

				echo "<script type='text/javascript'> alert ('Ya Existe la Carpeta'); history.back (); </script>";											
    		}
		}
		
		/*****************
		Insertar Carpeta
		*****************/
		public static function insertarCarpeta ($_codzona, $nombre_carpeta, $_codemple, $estado)	{
		
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call insertarCarpetaEmpleado ('$_codzona', '$nombre_carpeta', '$_codemple', '$estado')");
			echo "<script type='text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";														
		}
		
		/*****************
		Insertar Documento
		*****************/
		
		public static function insertarDocumento ($_codemple, $_idCategoriaDocumento,  $_archivo, $_tipo, $_tamano, $_ubicacionEmpleado)	{
		
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call insertarDocumentacionEmpleado ('$_codemple', '$_idCategoriaDocumento',  '$_archivo', '$_tipo', '$_tamano', '$_ubicacionEmpleado')");
			echo "<script type='text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";																	
		}		
	}
	
	/*************************************
	CategoriaDocumento
	*************************************/
	class CategoriaDocumento	{
	
		var $idCategoriaDocumento;
		var $descripcion;
		var $permiso;
		
		/*****************
		Constructor
		*****************/
		function CategoriaDocumento ($_idCategoriaDocumento, $_descripcion, $_permiso)	{
		
			$this -> idCategoriaDocumento = $_idCategoriaDocumento;
			$this -> descripcion = $_descripcion;
			$this -> permiso = $_permiso;
		}
		
		/*****************
		Insertar
		*****************/
		public static function insertar ($_descripcion)	{
		
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call consultarCategoriaDocumento ('$_descripcion')");
			$registros =  mysqli_num_rows ($resultado);
			if ($registros == 0)	{

				include ("conexion.php");	
				$_descripcion = strtoupper ($_descripcion);		
				$resultado = @mysqli_query ($cnn, "call insertarCategoriaDocumento ('$_descripcion')");
				echo "<script type='text/javascript'> alert ('Registro Almacenado'); history.back (); </script>";														
			}
			else	{
			
				echo "<script type='text/javascript'> alert ('El Registro ya Existe'); history.back (); </script>";														
			}
		}
		
		/*****************
		Listar
		*****************/
		public static function listar ($_opc, $_campo, $_valor)	{

			$mat = array ();
			include ("conexion.php");
			if ($_opc == 33)

				$consulta = "call listarCategoriaDocumento ()";
			elseif ($_opc == 34)

				$consulta = "call consultarCategoriaDocumentoId ('$_valor')";
			$resultado = @mysqli_query ($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
			
				echo "<script type='text/javascript'> alert ('No Existen Categorias de Documentos'); history.back (); </script>";														
			}
			else	{
			
				for ($i = 0; $i < $registros; $i++)	{

					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, CategoriaDocumento :: mostrar ($datos));				
				}
				
				return $mat;
				
			}
		}
		
		/*****************
		Mostrar
		*****************/
		public static function mostrar ($datos)	{
		
			$_idCategoriaDocumento = $datos ["idCategoriaDocumento"];
			$_descripcion = $datos ["descripcion"];
			$_permiso = $datos ["permiso"];
			$categoriaDocumento = new CategoriaDocumento ($_idCategoriaDocumento, $_descripcion, $_permiso);
			
			return $categoriaDocumento;
		}
		
		/*****************
		Permiso
		*****************/
		public static function permisos ($_permiso)	{
		
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call asignarPermisosNo ()");
			foreach ($_permiso as $listar)	{
			
				$resultado = @mysqli_query ($cnn, "call asignarPermisos ('$listar')");
			}
			echo "<script type='text/javascript'> alert ('se Modifico El Registro'); history.back (); </script>";																	
		}

		/*****************
		Modificar
		*****************/
		public static function modificar ($_idCategoriaDocumento, $_descripcion)	{
		
			include ("conexion.php");
			$_descripcion = strtoupper ($_descripcion);	
			
			$resultado = @mysqli_query ($cnn, "call modificarCategoriaDocumento ('$_idCategoriaDocumento', '$_descripcion')");
			$registros = mysqli_affected_rows ($cnn);
			if ($registros == 0)	{

				echo "<script type='text/javascript'> alert ('El Registro no se Modifico'); history.back (); </script>";																				
			}
			else	{

				echo "<script type='text/javascript'> alert ('Registro Modificado Correctamente'); history.back (); </script>";																				
			}
		}
	}
	
	/*************************************
	DocumentacionEmpleado
	*************************************/
	class DocumentacionEmpleado	{
	
		var $idDocumentacion;
		var $codemple;
		var $idCategoriaDocumento;
		var $archivo;
		var $tipo;
		var $tamano;
		var $fecha;
		var $ubicacionEmpleado;
		var $descripcion;
		
		/*****************
		Documentacion Empleado
		*****************/
		function DocumentacionEmpleado ($_idDocumentacion, $_codemple, $_idCategoriaDocumento,  $_archivo, $_tipo, $_tamano, $_fecha, $_ubicacionEmpleado, $_descripcion)	{
		
			$this -> idDocumentacion = $_idDocumentacion;
			$this -> codemple = $_codemple;
			$this -> idCategoriaDocumento = $_idCategoriaDocumento;
			$this -> archivo = $_archivo;
			$this -> tipo = $_tipo;
			$this -> tamano = $_tamano;
			$this -> fecha = $_fecha;
			$this -> ubicacionEmpleado = $_ubicacionEmpleado;
			$this -> descripcion = $_descripcion;
		}
		
		/*****************
		Insertar
		*****************/
		public static function insertar ($_codemple, $_idCategoriaDocumento,  $_archivo, $_tipo, $_tamano, $_ubicacionEmpleado)	{
		
			$status = "";
			$fecha = date("Y-m-d");
			$destino =  $_ubicacionEmpleado."/".$_archivo;
			$archivo = $_archivo;
			copy($_FILES['archivo']['tmp_name'], $destino);
			
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call insertarDocumentacionEmpleado ('$_codemple', '$_idCategoriaDocumento', '$_archivo', '$_tipo', '$_tamano', '$_ubicacionEmpleado', '$fecha')") or die ("Insercion Incorrecto");
			echo "<script type='text/javascript'> alert ('Registro Almacenados'); history.back (); </script>";																							
		}

		/*****************
		Listar
		*****************/
		public static function listar ($_opc, $_campo, $_valor)	{

			$mat = array ();
			include ("conexion.php");
			if ($_opc == 43)	{

				$consulta = "call listarDocumentacionEmpleado ('$_valor')";
			}
			elseif ($_opc == 46)	{
			
				$consulta = "call consultarDocumentacionEmpleado ('$_valor')";
			}
			if ($_opc == 47)	{

				$consulta = "select documentacionempleado.idDocumentacion, documentacionempleado.codemple, documentacionempleado.idCategoriaDocumento,  documentacionempleado.archivo, documentacionempleado.tipo, documentacionempleado.tamano, documentacionempleado.ubicacion, categoriadocumento.descripcion, documentacionempleado.fecha from documentacionempleado inner join categoriadocumento on documentacionempleado.idCategoriaDocumento = categoriadocumento.idCategoriaDocumento  where documentacionempleado.codemple = '$_valor' and categoriadocumento.permiso = 'NO'";
			}
			elseif ($_opc == 48)	{
				
				$user = $_SESSION ["userzona"]; 
				if ($_campo == 'cedemple')	{
				
					$consulta = "select documentacionempleado.idDocumentacion, documentacionempleado.codemple, documentacionempleado.idCategoriaDocumento,  documentacionempleado.archivo, documentacionempleado.tipo, documentacionempleado.tamano, documentacionempleado.ubicacion, categoriadocumento.descripcion, documentacionempleado.fecha from documentacionempleado inner join categoriadocumento on documentacionempleado.idCategoriaDocumento = categoriadocumento.idCategoriaDocumento inner join empleado on documentacionempleado.codemple = empleado.codemple where empleado.$_campo = '$_valor' and categoriadocumento.permiso = 'NO' and empleado.codzona = '$user'";
				}
				else{
				
					$consulta = "select documentacionempleado.idDocumentacion, documentacionempleado.codemple, documentacionempleado.idCategoriaDocumento,  documentacionempleado.archivo, documentacionempleado.tipo, documentacionempleado.tamano, documentacionempleado.ubicacion, categoriadocumento.descripcion, documentacionempleado.fecha from documentacionempleado inner join categoriadocumento on documentacionempleado.idCategoriaDocumento = categoriadocumento.idCategoriaDocumento inner join empleado on documentacionempleado.codemple = empleado.codemple where empleado.$_campo like '%$_valor%' and categoriadocumento.permiso = 'NO' and empleado.codzona = '$user'";
				}
			}	
			$resultado = @mysqli_query ($cnn, $consulta) or die ($consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{

				echo "<script type='text/javascript'> alert ('No Existen Docuentos Cargados para este Empleado'); history.back (); </script>";
			}
			else	{
			
				for ($i = 0; $i < $registros; $i++)	{

					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, DocumentacionEmpleado :: mostrar ($datos));				
				}
				
				return $mat;
				
			}
		}
		
		/*****************
		Mostrar
		*****************/
		public static function mostrar ($datos)	{
		
			$_idDocumentacion = $datos ["idDocumentacion"];
			$_codemple = $datos ["codemple"];
			$_idCategoriaDocumento = $datos ["idCategoriaDocumento"];
			$_archivo = $datos ["archivo"];
			$_tipo = $datos ["tipo"];
			$_tamano = $datos ["tamano"];
			$_fecha = $datos ["fecha"];
			$_ubicacionEmpleado =  $datos ["ubicacion"];
			$_descripcion =  $datos ["descripcion"];
			$documentacionEmpleado = new documentacionEmpleado ($_idDocumentacion, $_codemple, $_idCategoriaDocumento,  $_archivo, $_tipo, $_tamano, $_fecha, $_ubicacionEmpleado, $_descripcion);
			
			return $documentacionEmpleado;
			
		}

		/*****************
		Eliminar
		*****************/
		public static function eliminar ($_valor)	{
		
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call eliminarDocumentacionEmpleado ('$_valor')");
			$registros = mysqli_affected_rows ($cnn);
			if ($registros == 0)	{
			
				echo "<script type='text/javascript'> alert ('No se Elimino el Registro'); history.back (); </script>";																										
			}
			else	{
			
				echo "<script type='text/javascript'> alert ('Registro Eliminado'); history.back (); </script>";																														
			}
		}

		/*****************
		Modificar
		*****************/
		public static function modificar ($_idDocumentacion, $_archivo, $_idCategoria)	{
		
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call modificarDocumentacionEmpleado ('$_idDocumentacion', '$_idCategoria')");
			$registros = mysqli_affected_rows ($cnn);
			if ($registros == 0)	{
			
				echo "<script type='text/javascript'> alert ('No se Modifico el Registro'); history.back (); </script>";																														
			}
			else	{
			
				echo "<script type='text/javascript'> alert ('Registro Modificado'); history.back (); </script>";																														
			}
		}
	}
	
	/*************************************
	Rol
	*************************************/
	class Rol	{
	
		var $idRol;
		var $nombreRol; 
		
		/*****************
		Constructor
		*****************/		
		function Rol ($_idRol, $_nombreRol)	{
		
			$this -> idRol = $_idRol; 
			$this -> nombreRol = $_nombreRol; 
		}
		
		/*****************
		Insertar
		*****************/		
		public static function insertar ($_nombreRol)	{
			
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call consultarRolDoc ('$_nombreRol')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("conexion.php");
				$_nombreRol = strtoupper ($_nombreRol);
				$resultado = @mysqli_query ($cnn, "call insertarRolDoc ('$_nombreRol', 'Activo')");
				echo "<script type='text/javascript'> alert ('Registro Almacenado Correctamente'); history.back (); </script>";																																		
			}
			else {

				echo "<script type='text/javascript'> alert ('Rol ya Existe'); history.back (); </script>";																																		
			}
		}
		
		/*****************
		Listar
		*****************/		
		public static function listar ($_opc, $_campo, $_valor)	{

			include ("conexion.php");
			$mat = array ();
			if ($_opc == 53)	
			
				$consulta = "call listarRolDoc ()";	
			$resultado = @mysqli_query($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				echo "<script type='text/javascript'> alert ('No Existe Rol'); history.back (); </script>";																																		
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Rol :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		/*****************
		Mostrar
		*****************/		
		public static function mostrar ($datos)	{
		
			$_idRol = $datos ["idRol"];	
			$_nombreRol = $datos ["nombreRol"];	
			
			$rol = new Rol ($_idRol, $_nombreRol);
			
			return $rol;
			
		}
	}
	
	/*************************************
	Acceso Doc
	*************************************/
	class AccesoDoc	{
	
		var $usuario;
		var $clave;
		
		function AccesoDoc ($_usuario, $_clave)	{
		
			$this -> usuario = $_usuario;
			$this -> clave = $_clave;
		}
		
		public static function acceso ($_usuario, $_clave)	{
			
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call accesoDoc ('$_usuario', '$_clave')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				echo "<script type='text/javascript'> alert ('Usuario y/o Clave Incorrectos'); history.back (); </script>";																																		
			}
			else {
				
				$_SESSION ["usuario"] = $_usuario;				
			}
		}
	}
	
	/*************************************
	Permiso
	*************************************/
	class Permiso	{
	
		var $idPermiso;
		var $idRol;
		var $nombreRol;
		var $idSubMenu;
		var $nombreSubMenu;
		
		/*****************
		Constructor
		*****************/		
		function Permiso ($_idPermiso, $_idRol, $_nombreRol, $_idSubMenu, $_nombreSubMenu)	{
		
			$this -> idPermiso = $_idPermiso; 
			$this -> idRol = $_idRol; 
			$this -> nombreRol = $_nombreRol; 
			$this -> idSubMenu = $_idSubMenu; 
			$this -> nombreSubMenu = $_nombreSubMenu; 
		}

		/*****************
		Insertar
		*****************/		
		public static function insertar ($_idRol, $_idSubMenu)	{
			
			include ("conexion.php");
			$resultado = @mysqli_query ($cnn, "call consultarPermisoDoc ('$_idRol', '$_idSubMenu')");
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				include ("conexion.php");
				$resultado = @mysqli_query ($cnn, "call insertarPermisoDoc ('$_idRol', '$_idSubMenu', 'Activo')");
				echo "<script type='text/javascript'> alert ('Registro Almacenado Correctamente'); history.back (); </script>";																																						
			}
			else {

				echo "<script type='text/javascript'> alert ('Permiso ya Existe'); history.back (); </script>";																																										
			}
		}

		/*****************
		Listar
		*****************/		
		public static function listar ($_opc, $_campo, $_valor)	{

			include ("conexion.php");
			$mat = array ();
			if ($_opc == 53)	
			
				$consulta = "call listarPermiso ()";	
			$resultado = @mysqli_query($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				echo "<script type='text/javascript'> alert ('No Existe Permiso'); history.back (); </script>";																																										
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, Permiso :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}

		/*****************
		Mostrar
		*****************/		
		public static function mostrar ($datos)	{
		
			$_idPermiso = $datos ["idPermiso"];	
			$_idRol = $datos ["idRol"];	
			$_nombreRol = $datos ["nombreRol"];	
			$_idSubMenu = $datos ["idSubMenu"];	
			$_nombreSubMenu = $datos ["nombreSubMenu"];	
			
			$permiso = new Permiso ($_idPermiso, $_idRol, $_nombreRol, $_idSubMenu, $_nombreSubMenu);
			
			return $permiso;
			
		}
	}
	
	/*************************************
	Submenu
	*************************************/
	class SubMenu	{
	
		var $idSubMenu;
		var $nombreSubMenu; 
		var $nombreMenu;
		
		/*****************
		Constructor
		*****************/				
		function SubMenu ($_idSubMenu, $_nombreSubMenu, $_nombreMenu)	{
		
			$this -> idSubMenu = $_idSubMenu; 
			$this -> nombreSubMenu = $_nombreSubMenu; 
			$this -> nombreMenu = $_nombreMenu; 
		}
		
		/*****************
		Listar
		*****************/				
		public static function listar ($_opc, $_campo, $_valor)	{

			include ("conexion.php");
			$mat = array ();
			if ($_opc == 83)	
			
				$consulta = "call listarSubMenu ()";	
			$resultado = @mysqli_query($cnn, $consulta);
			$registros = mysqli_num_rows ($resultado);
			if ($registros == 0)	{
				
				echo "<script type='text/javascript'> alert ('No Existe SubMenu'); history.back (); </script>";																																										
			}
			else {
				
				for($i = 0; $i < $registros; $i++)	{
					
					$datos = mysqli_fetch_array ($resultado);
					array_push ($mat, SubMenu :: mostrar ($datos));
				}
				
				return $mat;
				
			}
		}
		
		/*****************
		Mostrar
		*****************/				
		public static function mostrar ($datos)	{
		
			$_idSubMenu = $datos ["idSubMenu"];	
			$_nombreSubMenu = $datos ["nombreSubMenu"];	
			$_nombreMenu = $datos ["nombreMenu"];	
			
			$subMenu = new SubMenu ($_idSubMenu, $_nombreSubMenu, $_nombreMenu);
			
			return $subMenu;
			
		}
	}
?>
