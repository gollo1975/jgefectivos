<?
$prestacion=strtoupper($prestacion);
$tipocon=strtoupper($tipocon);
include("../conexion.php");
$con="update denovedanomina set nrohora='$nrohora',salario='$salario',prestacion='$prestacion',variacion='$tipocon',porcentaje='$porcentaje',deduccion='$deduccion'
       where denovedanomina.radicado='$conse'";
  $resultado=mysql_query($con) or die("Actualizacion Incorrecta del registro ");
  $registros=mysql_affected_rows();
  ?>
  <script language="javascript">
   open("modificarnovedad.php?cedula=<?echo $cedula;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&codzona=<?echo $codzona;?>","_self")
  </script>
  <?
?>
