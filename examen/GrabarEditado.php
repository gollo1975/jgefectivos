<input type="hidden" value="<?echo $NitProve;?>" name="NitProve">
<input type="hidden" value="<?echo $CodMuni;?>" name="CodMuni">
<?
$descripcion=strtoupper($descripcion);
include("../conexion.php");
$con="update examenglobal set descripcion='$descripcion',valor='$valor',estado='$EstadoE',codmuni='$CodMunicipio' where examenglobal.conse='$codigo'";
  $resultado=mysql_query($con) or die("Actualizacion Incorrecta $con  ");
  $registros=mysql_affected_rows();
  ?>
  <script language="javascript">
   open("ModificarAdmon.php?NitProve=<?echo $NitProve;?>&CodMuni=<?echo $CodMuni;?>","_self")
  </script>
  <?
?>
