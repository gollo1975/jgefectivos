<?php
include("../conexion.php");
/*CONSULTA DE LA ULTIMA NOMINA*/
$BusA="select nomina.basico,nomina.cedemple,nomina.consecutivo from nomina,empleado
where nomina.cedemple=empleado.cedemple and
      empleado.cedemple='$Cedula' and
      nomina.hasta <='$FechaC' order by nomina.consecutivo DESC limit 1";
$resN=mysql_query($BusA)or die ("Error al buscar el,ultimo salario");
$Vector=mysql_fetch_array($resN);
$UltimoSalario=$Vector["basico"];
/*TERMINA CODIGO*/
$conA="select parametroauxilio.maximo from parametroauxilio
     where parametroauxilio.estado='INACTIVO' order by conse DESC limit 1";
$resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
$Linea=mysql_fetch_array($resuA);
$Maximo=$Linea["maximo"];
$TotalDia = $Dias - $DiaLicencia;
if($UltimoSalario <= $Maximo){
   $Formula=round((($Ibc + $Auxilio)*$TotalDia)/360);
   $Interes=round((($Formula * $TotalDia)*0.12)/360);
}else{
         $Formula=round(($Ibc * $TotalDia)/360);
         $Interes=round((($Formula * $TotalDia)*0.12)/360);
}
$Nota=strtoupper($Nota);
$ConE="update cesantiainteres set fechainicio='$FechaV',dias='$Dias',salario='$Ibc',auxilio='$Auxilio',pagocesantia='$Formula',pagointeres='$Interes',nota='$Nota' where cesantiainteres.nrocesantia='$NroCesa'";
$res=mysql_query($ConE)or die("Error al editar las cesantias");
?>
<script language="javascript">
             alert("Se grabó con Exito  el registro del Empleado(a) : <?echo $nombres;?>")
             open("ListadoZonaCesa.php?CodZona=<?echo $CodZona;?>","_self")
</script>
         <?
?>


