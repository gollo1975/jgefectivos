<?php
include("../conexion.php");
/*CODIGO QUE PERMITE DESCONTAR LOS DIAS AUSENTISMO*/
if (Control=='SI'){
	$Sql="select parametrolicenciapermiso.* FROM parametrolicenciapermiso
					 where parametrolicenciapermiso.estado='ACTIVO'";
	$Rs=mysql_query($Sql)or die("Error al validar los datos");
	$TotalDiasDescontar = 0; $TotalDias = 0; $TotalDiasReal=0;
	while($Fila=mysql_fetch_array($Rs)){
				  $CodSalario = $Fila["codsala"];
				  $Buscar="select SUM(denomina.nrohora) 'Total' from denomina,nomina
						  where  nomina.consecutivo=denomina.consecutivo and
						  nomina.cedemple='$Cedula' and
						  denomina.codsala='$CodSalario' and
						  nomina.desde between '$FechaV' and '$FechaC' group by nomina.cedemple";
				 $Sr=mysql_query($Buscar)or die("Error al buscar codigos de salarios");
				 $fil=mysql_fetch_array($Sr);
				$TotalDiasDescontar += $fil["Total"];
	}
	$TotalDias = round($TotalDiasDescontar/8);
}	
$TotalDiasReal = ($Dias - $TotalDias);
/*CODIGO DE AUXILIO*/
$conA="select parametroauxilio.maximo from parametroauxilio
     where parametroauxilio.estado='ACTIVO'";
$resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
$Linea=mysql_fetch_array($resuA);
$Maximo=$Linea["maximo"];
/*CODIGO DE SAALARIO*/
$sql="select empleado.basico from empleado
where  empleado.cedemple='$Cedula'";
$Rs=mysql_query($sql)or die("Error al buscar alario del empleado");
$filaS=mysql_fetch_array($Rs);
$Salariobasico = $filaS["basico"];
if($Salariobasico >= $Maximo):
         $Formula=round(($Ibc*$TotalDiasReal)/360);
     else:
        $Formula=round((($Ibc+$Auxilio)* $TotalDiasReal)/360);
endif;
$ConE="update prima set fechainicio='$FechaV',dias='$Dias',salario='$Ibc',total='$Formula',prima='$Formula',diadeduccion='$TotalDias' where prima.nroprima='$NroPrima'";
$res=mysql_query($ConE)or die("Error al editar la prima");
if($Validar==1):
         ?>
          <script language="javascript">
             alert("Se grabó con Exito  el registro del Empleado(a) : <?echo $nombres;?>")
             open("modificarprima.php","_self")
          </script>
         <?
else:
         ?>
          <script language="javascript">
             alert("Se grabó con Exito  el registro del Empleado(a) : <?echo $nombres;?>")
             open("ListadoZona.php?CodZona=<?echo $CodZona;?>","_self")
          </script>
         <?
endif;
?>

