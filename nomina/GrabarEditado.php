<html>

<head>
  <title></title>
</head>
<body>
<?
if(empty($trabajador)):
     ?>
       <script language="javascript">
         alert("Seleccion el trabajador de la lista")
         history.back()
       </script>
    <?
else:
       include("../conexion.php");
       $fechaP=date("Y-m-d");
	          $consulta="update comisionomina set codzona='$codzona',zona='$zona',cedemple='$trabajador',comparte='$comparte',fechap='$fechaP' where comisionomina.codigo='$nro'";
	          $resultad=mysql_query($consulta)or die("Error al grabar datos modificados");
	          $registro=mysql_affected_rows();
	          echo "<script language=\"javascript\">";
	                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
	                    echo "open (\"ModificarRelacion.php?cedula=$cedula\",\"_self\");";
	          echo "</script>";
 endif;
       ?>
</body>
</html>
