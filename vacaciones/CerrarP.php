<?php
include("../conexion.php");
$ConE="update periodoprima set estado='$Estado' where periodoprima.nrop='$NroP'";
$res=mysql_query($ConE)or die("Error al cerrar periodo");
 ?>
          <script language="javascript">
             alert("Se grabó con Exito  el registro del Periodo, con fecha : <?echo $Desde;?> hasta <?echo $Hasta;?>")
             open("CerrarPeriodo.php","_self")
          </script>
?>

