<?php
include("../conexion.php");
$conA="update examen set estado='$Cerrar' where examen.nro='$NroExamen'";
$resuA=mysql_query($conA) or die("Actualizacion de examen  ");
?>
<script language="javascript">
alert("Registro anulado en sistemas.")
open("ModificarRegistro.php?cedemple=<?echo $Documento;?>&CodUsuario=<?echo $CodUsuario;?>","_self")
</script>
<?
?>


