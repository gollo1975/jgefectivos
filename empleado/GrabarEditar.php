<input type="hidden" name="cedemple" value="<? echo $cedemple;?>">
<?
$nombres=strtoupper($nombres);
$fechaE=date("Y-m-d");
include("../conexion.php");
$con="update detallehijo set nombre='$nombres',fechanac='$fechanac',parentezco='$parentezco',fechaeditado='$fechaE'where detallehijo.codigo='$codigo'";
  $resultado=mysql_query($con) or die("Actualizacion Incorrecta $con  ");
  $registros=mysql_affected_rows();
  ?>
  <script language="javascript">
   open("ModificarDetalle.php?cedemple=<?echo $cedemple;?>&estado=<?echo $estado;?>","_self")
  </script>
  <?
?>
