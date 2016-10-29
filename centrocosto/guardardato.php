<?
include("../conexion.php");
$consulta="select decentro.* from decentro where decentro.codcentro='$codcentro' and decentro.codsala='$datos'";
$resp=mysql_query($consulta)or die ("consulta incorrecta");
$registros=mysql_affected_rows();
if($registros==0):
        $con="insert into decentro(codcentro,codsala,descripcion,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion,estado,datos,activo,permanente,agrupado)
        values('$codcentro','$datos','$descripcion','$vlrhora','$nrohora','$salario','$prestacion','$tipocon','$porcentaje','$deduccion','$control','$insertar','$activo','$permanente','$Agrupado')";
        $resultado=mysql_query($con) or die("Actualizacion Incorrecta $con  ");
        $registros=mysql_affected_rows();
       echo "<script language=\"javascript\">";
          echo "open (\"../pie.php?msg=Se actualizó $registros registro para Item: $codsala\",\"pie\");";
         // echo "open(\"modificar.php\",\"_self\");";
          echo "</script>";
          header("location: modificar.php?cedemple=$cedemple");
else:
    ?>
    <script language="javascript">
     alert("Este Item Ya existe para este Empleado ?")
     history.go(-2)
    </script>
    <?
endif;

?>
