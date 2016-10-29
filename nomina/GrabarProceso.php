<html>

<head>
  <title></title>
</head>
<body>
<?
      include("../conexion.php");
       $fechaP=date("Y-m-d");
	          $consulta="insert into procesonomina (codzona,fechainicio,horainicio,usuario,cedemple,registro,estado)
                  values('$codzona','$fechaP','$fechahora','$Auxiliar','$Documento','$Contador','$estado')";
	          $resultad=mysql_query($consulta)or die("Error al grabar datos modificados");
	          $registro=mysql_affected_rows();
	          echo "<script language=\"javascript\">";
	                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
	                    echo "open (\"abrirproceso.php?Documento=$Documento&Auxiliar=$Auxiliar\",\"_self\");";
	          echo "</script>";
 ?>
</body>
</html>
