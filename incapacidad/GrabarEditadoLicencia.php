<?php
include("../conexion.php");
$FechaP = date('Y-m-d');
$Nota= strtoupper($Nota);
/*codigo que busca el tipo de proceso*/
$conP="select salario.desala  from salario
where salario.codsala='$TipoLicencia'";
$resP=mysql_query($conP) or die("Error al el tipo de proceso");
$filaP=mysql_fetch_array($resP);
$Concepto=$filaP["desala"];
/*fin codigo*/
$Dias = strtotime($Hasta)- strtotime($Desde );
$Diferencia_dias=intval($Dias/60/60/24) +1 ;
$Con="update licencia set codsala='$TipoLicencia',concepto='$Concepto',fechainicio='$Desde',fechafinal='$Hasta',dias='$Diferencia_dias',afectaauxilio='$Afecta',
usuariomodifico='$codigo',fechaeditado='$FechaP',nota='$Nota' where licencia.idlicencia='$NroId'";
$res=mysql_query($Con)or die("Error al validar la licencia");
?>
<script language="javascript">
	alert("Se actualizo el registro con exito en el sistema..! ?")
	open("DetalleLicencia.php?Cedula=<?echo $Cedula;?>&codigo=<?echo $codigo;?>","_self");
</script>



