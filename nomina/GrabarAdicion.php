<?
include("../conexion.php");
$conV="select novedadnomina.* from novedadnomina,denovedanomina where
novedadnomina.codnovedad=denovedanomina.codnovedad and
novedadnomina.codnovedad='$CodNomina' and
denovedanomina.codsala='$codsala'";
$resuV=mysql_query($conV) or die ("Error al buscar validacion");
$regisV=mysql_num_rows($resuV);
if ($regisV==0):
	if($CodSala == 'NO'){
	    $con="insert into denovedanomina (codnovedad,codsala,concepto,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion)
	       values('$CodNomina','$codsala','$descripcion','$vlrhora','$nrohora','$salario','$prestacion','$tipocon','$porcentaje','$deduccion')";
	    $resultado=mysql_query($con) or die("Error al Modificar Datos del Centro  ");
	    $registros=mysql_affected_rows();
	}else{
	   $con="insert into denovedanomina (codnovedad,codsala,concepto,vlrhora,nrohora,prestacion,variacion,porcentaje,deduccion,ibcprestacional)
	       values('$CodNomina','$codsala','$descripcion','$vlrhora','$nrohora','$prestacion','$tipocon','$porcentaje','$deduccion','$salario')";
	    $resultado=mysql_query($con) or die("Error al Modificar Datos del ibc prestacional  ");
	    $registros=mysql_affected_rows(); 
	}	
	    ?>
	  <script language="javascript">
	   open("ModificarM.php?cedula=<?echo $cedula;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta?>&codzona=<?echo $codzona;?>","_self")
	  </script>
	  <?
else:
     ?>
      <script language="javascript">
        alert("Este Item ya esta en centro de novedades de este Empleado!")
        history.back()
        </script>
     <?
endif;
?>
