<?
$prestacion=strtoupper($prestacion);
include("../conexion.php");
$consulta="select denomina.consecutivo from denomina where denomina.consecutivo='$codigo' and denomina.codsala='$datos'";
$resp=mysql_query($consulta)or die ("consulta incorrecta");
$registros=mysql_affected_rows();
if($registros==0):
        $con="insert into denomina(consecutivo,codsala,descripcion,vlrhora,nrohora,salario,porcentaje,deduccion,prestacion)
        values('$codigo','$datos','$descripcion','$vlrhora','$nrohora','$salario','$porcentaje','$deduccion','$prestacion')";
        $resultado=mysql_query($con) or die("Error al grabar item a la nóina ");
        $registros=mysql_affected_rows();
       echo "<script language=\"javascript\">";
          echo "open (\"../pie.php?msg=Se actualizó $registros registro para Item: $descripcion\",\"pie\");";
         // echo "open(\"modificar.php\",\"_self\");";
          echo "</script>";
          header("location: detalladomodificar.php?cedula=$cedula&codigo=$codigo&desde=$desde&hasta=$hasta&");
else:
    ?>
    <script language="javascript">
     alert("Este Item Ya existe para este Empleado en la nomina ?")
     history.go(-2)
    </script>
    <?
endif;

?>
