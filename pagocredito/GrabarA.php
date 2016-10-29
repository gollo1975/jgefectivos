<html>

<head>
  <title></title>
</head>
<body>

<?
if(empty($nuevo)):
  ?>
  <script language="javascript">
    alert("Favor digite el el nuevo saldo del trabajador.")
    history.back()
  </script>
  <?
elseif(empty($cuota)):
?>
  <script language="javascript">
    alert("Favor digite la nueva cuota para la deducción.")
    history.back()
  </script>
  <?
else:
$TotalS=($saldo+$nuevo);
      include("../conexion.php");
       $fechaP=date("Y-m-d");
       $nota=strtoupper($nota);
	          $conA="insert into actualizarsaldo (nrocredito,fechap,nvalor,cuota,nota)
                  values('$nrocredito','$fechaP','$nuevo','$cuota','$nota')";
	          $resultad=mysql_query($conA)or die("Error al grabar de actualizacion");
                  $Act="update credito set nuevo='$TotalS',tcredito='$TotalS',cuota='$cuota',nota='$nota' where nrocredito='$nrocredito'";
                  $resA=mysql_query($Act)or die("Error al actualizacion");
                  $registro=mysql_affected_rows();
	          echo "<script language=\"javascript\">";
	                    echo "open (\"../pie.php?msg=Se actualizaron $registro registros para el credito Nro: $nrocredito\",\"pie\");";
	                    echo "open (\"ActualizarSaldo.php?cedula=$cedula\",\"_self\");";
	          echo "</script>";
 endif;?>
</body>
</html>
