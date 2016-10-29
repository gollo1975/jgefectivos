<?
$prestacion=strtoupper($prestacion);
include("../conexion.php");
$consulta="select denovedanomina.* from denovedanomina where denovedanomina.codnovedad='$codnovedad' and denovedanomina.codsala='$datos'";
$resp=mysql_query($consulta)or die ("consulta incorrecta");
$registros=mysql_affected_rows();
if($registros==0):
        $con="insert into denovedanomina(codnovedad,codsala,concepto,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion)
        values('$codnovedad','$datos','$descripcion','$vlrhora','$nrohora','$salario','$prestacion','$tipocon','$porcentaje','$deduccion')";
        $resultado=mysql_query($con) or die("Error al grabar novedades  ");
        $registros=mysql_affected_rows();
        $consN="select centro.* from centro where centro.cedemple='$cedula'";
	$respN=mysql_query($consN)or die ("Error al buscar centro");
        $filasN=mysql_fetch_array($respN);
        $codcentro=$filasN["codcentro"];
        $conC="insert into decentro(codcentro,codsala,descripcion,vlrhora,salario,prestacion,variacion,porcentaje,deduccion,estado,datos)
        values('$codcentro','$datos','$descripcion','$vlrhora','$salario','$prestacion','$tipocon','$porcentaje','$deduccion','$control','$insertar')";
        $resuC=mysql_query($conC) or die("Error al grabar centos de costos  ");
        $registros=mysql_affected_rows();
       echo "<script language=\"javascript\">";
          echo "open (\"../pie.php?msg=Se actualizó $registros registro para Item: $descripcion\",\"pie\");";
         // echo "open(\"modificar.php\",\"_self\");";
          echo "</script>";
          header("location: NovedadEmpresa.php?cedula=$cedula&desde=$desde&hasta=$hasta&");
else:
    ?>
    <script language="javascript">
     alert("Este Item Ya existe para este Empleado ?")
     history.back()
    </script>
    <?
endif;

?>
