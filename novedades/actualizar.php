<?
include("../conexion.php");
$consulta="update prestamoempresa set estado='$estado' where prestamoempresa.nroprestamo='$nroprestamo'";
$resultado=mysql_query($consulta)or die("Error al grabar datos ?");
$registro=mysql_affected_rows();
?>
<script language="javascript">
  alert("registros actualizado en sistema de informacion");
  open ("prestamoempresa.php?desde=<?echo $desde?>&hasta=<?echo $hasta;?>&campo=<?echo $campo;?>","_self")
</script>
<?

