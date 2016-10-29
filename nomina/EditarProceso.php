<html>

<head>
  <title></title>
</head>
<body>
<?
      include("../conexion.php");
       $fechaP=date("Y-m-d");
	          $consulta="update procesonomina set horafinal='$fechahora',fechafinal='$fechaP',estado='$estado' where codproceso='$CodProceso'";
	          $resultad=mysql_query($consulta)or die("Error al actualizar datos");
	          $registro=mysql_affected_rows();
	          echo "<script language=\"javascript\">";
	                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
                            if($Auxiliar==''):
                              echo "open (\"menu1.php?Documento=$Documento&Auxiliar=$Auxiliar\",\"_self\");";
                            else:
	                       echo "open (\"MenuAuxiliar.php?Documento=$Documento&Auxiliar=$Auxiliar\",\"_self\");";
                           endif;
	          echo "</script>";
 ?>
</body>
</html>
