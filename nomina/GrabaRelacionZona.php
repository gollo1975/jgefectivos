<html>

<head>
  <title></title>
</head>
<body>
<input type="hidden" value="<?echo $CodSucursal;?>" name="CodSucursal">
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
       $estado='ACTIVA';
       $consulta="select comisionomina.cedemple from comisionomina,zona
       where comisionomina.cedemple='$trabajador' and
             comisionomina.codzona='$codzona'";
       $resultado=mysql_query($consulta)or die("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
	          $consulta="insert into comisionomina(codzona,zona,cedemple,comparte,fechap,estado)
	          values('$codzona','$zona','$trabajador','$compartida','$fechaP','$estado')";
	          $resultad=mysql_query($consulta)or die("Error al grabar datos");
	          $registro=mysql_affected_rows();
	          echo "<script language=\"javascript\">";
	                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para la Zona: $zona\",\"pie\");";
	                    echo "open (\"ListadoZona.php?CodSucursal=$CodSucursal\",\"_self\");";
	          echo "</script>";
        else:
          ?>
	       <script language="javascript">
	         alert("Esta zona ya fue asignada a  este mismo trabajador")
	         history.back()
	       </script>
	    <?
        endif;
 endif;
       ?>
</body>
</html>
