 <input type="hidden" name="Usuario" value="<?echo $Usuario?>" id="Usuario">
<?php
include("../conexion.php");
$FechaM=date("Y-m-d");
$Usuario=strtoupper($Usuario);
$Grabar="update vacacionprogramada set desde='$Desde', hasta='$Hasta', dias='$Dias',codsala='$CodSala',usuarioM='$Usuario',fecham='$FechaM' where vacacionprogramada.codigo_vacacion_programada_pk='$Id_V'";
$res=mysql_query($Grabar)or die("erro al actulizar");
 ?>
    <script language="javascript">
       alert("Registro Grabado Con Exito en el sistema.!")
       open("ProgramarVacacion.php?Usuario=<?echo $Usuario;?>","_self");
    </script>
    <?
?>

