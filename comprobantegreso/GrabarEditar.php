<input type="hidden" name="Usuario" value="<?echo $Usuario;?>">
<?php
include("../numeros.php");
$letras=num2letras($pagado);
$letras=strtoupper($letras);
include("../conexion.php");
$Grabar="update maestrocomprobante set fechapago='$fechapago',vlrpagado='$pagado',codmuni='$CodMuni', letras='$letras',id='$TipoC',usuario='$Usuario' where maestrocomprobante.nro='$Nro'";
$Res=mysql_query($Grabar)or die ("Error al grabar");
$reg=mysql_affected_rows();
?>
   <script language="javascript">
     alert("Datos Grabados en el sistema de Información")
     open("ModificarGrupal.php?Usuario=<?echo $Usuario;?>","_self")
   </script>
<?


