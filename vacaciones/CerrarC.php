<?php
include("../conexion.php");
$ConE="update periodocesantia set estado='$Estado' where periodocesantia.nroc='$NroP'";
$res=mysql_query($ConE)or die("Error al cerrar periodo");
 ?>
          <script language="javascript">
             alert("Se grabó con Exito  el registro del Periodo, con fecha : <?echo $Desde;?> hasta <?echo $Hasta;?>")
             open("CerrarPeriodoCesa.php","_self")
          </script>
?>

