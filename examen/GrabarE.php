<input type="hidden" name="Nro" value="<? echo $Nro;?>">
<?
$TotalE=round(($CostoE-$VlrInd)+$vlrexamen);
include("../conexion.php");
 $con="update detalladoexamen set vlrexamen='$vlrexamen' where codigo='$CodProceso'";
  $resultado=mysql_query($con) or die("Actualizacion de examenes  ");
  $conA="update examen set costoe='$TotalE' where nro='$Nro'";
  $resuA=mysql_query($conA) or die("Actualizacion de examen  ");
  $registros=mysql_affected_rows();
  ?>
  <script language="javascript">
   open("DetalladoEditado.php?Nro=<?echo $Nro;?>","_self")
  </script>
  <?
?>
