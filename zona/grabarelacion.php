<html>

<head>
  <title></title>
</head>
<body>
<?
if(empty($vendedor)):
     ?>
       <script language="javascript">
         alert("Seleccion un vendedor de la lista")
         history.back()
       </script>
    <?
     elseif(empty($comision)):
     ?>
       <script language="javascript">
         alert("Debe de digitar el porcetaje de la comisión")
         history.back()
       </script>
    <?
else:
       include("../conexion.php");
       $fechaP=date("Y-m-d");
       $estado='ACTIVA';
       $consulta="select relacioncomision.cedulaven from relacioncomision,zona
       where relacioncomision.cedulaven='$vendedor' and
             relacioncomision.codzona='$codzona'";
       $resultado=mysql_query($consulta)or die("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
	          $consulta="insert into relacioncomision(codzona,zona,cedulaven,comision,compartida,fechap,estado)
	          values('$codzona','$zona','$vendedor','$comision','$compartida','$fechaP','$estado')";
	          $resultad=mysql_query($consulta)or die("Error al grabar datos");
	          $registro=mysql_affected_rows();
	          echo "<script language=\"javascript\">";
	                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
	                    echo "open (\"relacionzona.php\",\"_self\");";
	          echo "</script>";
        else:
          ?>
	       <script language="javascript">
	         alert("Esta zona ya fue asignada a  este mismo vendedor")
	         history.back()
	       </script>
	    <?
        endif;
 endif;
       ?>
</body>
</html>
