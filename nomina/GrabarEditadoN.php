<?
include("../conexion.php");
if($CodSala=='NO'){
    $con="update denovedanomina set vlrhora='$vlrhora',nrohora='$nrohora',salario='$salario',prestacion='$prestacion',variacion='$tipocon',porcentaje='$porcentaje',deduccion='$deduccion'
       where denovedanomina.radicado='$radicado'";
    $resultado=mysql_query($con) or die("Actualizacion Incorrecta del registro ");
    $registros=mysql_affected_rows();
}else{
	$con="update denovedanomina set vlrhora='$vlrhora',nrohora='$nrohora',ibcprestacional='$salario',prestacion='$prestacion',variacion='$tipocon',porcentaje='$porcentaje',deduccion='$deduccion'
       where denovedanomina.radicado='$radicado'";
    $resultado=mysql_query($con) or die("Actualizacion Incorrecta del registro ");
    $registros=mysql_affected_rows();
}   
  ?>
  <script language="javascript">
   open("ModificarM.php?cedula=<?echo $cedula;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&codzona=<?echo $codzona;?>","_self")
  </script>
  <?
?>
