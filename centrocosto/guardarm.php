<input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
<?
$prestacion=strtoupper($prestacion);
$tipocon=strtoupper($tipocon);
include("../conexion.php");
$con="update decentro set descripcion='$descripcion',vlrhora='$vlrhora',nrohora='$nrohora',salario='$salario',prestacion='$prestacion',variacion='$tipocon',estado='$Visible',datos='$Control',porcentaje='$porcentaje',deduccion='$deduccion',activo='$Activo',
      permanente='$Permanente',agrupado='$Agrupado' where decentro.conse='$conse'";
  $resultado=mysql_query($con) or die("Error al Modificar Datos del Centro  ");
  $registros=mysql_affected_rows();
  ?>
  <script language="javascript">
   open("modificar.php?cedemple=<?echo $cedemple;?>","_self")
  </script>
  <?
?>
