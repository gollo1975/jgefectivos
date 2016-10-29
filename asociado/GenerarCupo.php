<td><input type="hidden" name="cedula" value="<? echo $cedula;?>"></td>
<td><input type="hidden" name="Saldo" value="<? echo $Saldo;?>"></td>
<td><input type="hidden" name="Nombres" value="<? echo $Nombres;?>" size="50"></td>
<td><input type="hidden" name="fechaI" value="<? echo $fechaI;?>"></td>
<td><input type="hidden" name="fechaC" value="<? echo $fechaC;?>"></td>
<td><input type="hidden" name="fecha" value="<? echo $fechab;?>"></td>
<td><input type="hidden" name="inicion" value="<? echo $inicion;?>"></td>
<td><input type="hidden" name="Salario" value="<? echo $Salario;?>"></td>
<td><input type="hidden" name="Documento" value="<? echo $Documento;?>"></td>
<?
include("../conexion.php");
$conA="select parametroauxilio.valor from parametroauxilio
     where parametroauxilio.estado='ACTIVO'";
$resuA=mysql_query($conA)or die ("Error en la consulta de auxilio de transporte");
$filas_A=mysql_fetch_array($resuA);
$Auxilio=$filas_A["valor"];
$Maximo=$filas_A["maximo"];
$Salario=$Salario;
$con="select nomina.*,sum(nomina.presta)'presta',empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,
    contrato.fechainic,datediff('$fechaC','$fechaI')-1'dias'
    from nomina,empleado,contrato
     where empleado.cedemple=nomina.cedemple and
     empleado.cedemple='$cedula' and
     contrato.fechater='0000-00-00' and
     empleado.codemple=contrato.codemple and
     nomina.desde between '$fechaI' and '$fechaC' group by empleado.cedemple";
$resu=mysql_query($con)or die ("Error en la consulta");
$reg=mysql_num_rows($resu);
$filas=mysql_fetch_array($resu);
$Suma=$filas["presta"];
$dia=$filas["dias"];
$Basico=round(($Suma/$dia)* 30);
/*codigo se cesantias*/
if($Salario > $Maximo):
    $AuxC= round($Basico);
    $Cesantia= round(($AuxC * $dia)/360);
else:
    $AuxC= round($Basico+$Auxilio);
    $Cesantia= round(($AuxC * $dia)/360);
endif;
/*codigo de prima*/
if($Salario > $Maximo):
     $AuxP= round($Basico);
    $Prima= round(($AuxC * $dia)/360);
else:
   $AuxP= round($Basico + $Auxilio);
   $Prima= round(($AuxC * $dia)/360);
endif;
/*codigo de vacacion*/
$AuxV= ($dia * 15)/360;
$Vacacion= round(($Salario/30)* $AuxV);
/*interes*/
$Interes= round((($Cesantia*$dia)* 0.12)/360);
$TotalP= ($Cesantia + $Prima + $Vacacion + $Interes);
/*codigo busca de primas*/
$conC="select prima.cedemple,sum(prima.total)'Tprima' from prima,empleado
              where empleado.cedemple=prima.cedemple and
              prima.fechainicio between '$fechaI' and '$fechaC' and
              empleado.cedemple='$cedula' group by empleado.cedemple";
$resC=mysql_query($conC)or die("Error al buscar primas");
$regC=mysql_num_rows($resC);
$filas_P=mysql_fetch_array($resC);
$PrimaTotal=$filas_P["Tprima"];
/*codigo de acumulado de vacaciones*/
$conV="select vacacion.cedemple,sum(vacacion.valor)'Tvacacion' from vacacion,empleado
              where empleado.cedemple=vacacion.cedemple and
              vacacion.fechai between '$fechaI' and '$fechaC' and
              empleado.cedemple='$cedula' group by empleado.cedemple ";
$resV=mysql_query($conV)or die("Error al buscar vacaciones");
$regV=mysql_num_rows($resV);
$filas_V=mysql_fetch_array($resV);
$VacacionTotal=$filas_V["Tvacacion"];
/*codigo de resulta de operacion*/
$Deuda= round($PrimaTotal + $VacacionTotal + $Saldo);
$TotalCupo=($TotalP - $Deuda);
$SumaTotal=number_format($TotalCupo,0);
/*codigo de busqueda nuevo*/
$conH="select cupocredito.* from cupocredito
              where cupocredito.cedemple='$cedula' and
              cupocredito.fechap='$fechaC'";
$resH=mysql_query($conH)or die("Error al buscar cupos de creditos");
$regH=mysql_num_rows($resH);
if($regH==0):
  	echo "<script language=\"javascript\">";
	echo "alert(\"El Empleado " .$Nombres. ", Tiene un cupo para Crédito de: $" . $SumaTotal . "\");";
	echo "</script>";
	$Datos="insert into cupocredito(cedemple,empleado,fechap,vlrcupo,documento)
	                       values('$cedula','$Nombres','$fechaC','$TotalCupo','$Documento')";
	$resD=mysql_query($Datos) or die("Error al grabar datos");
	$regD=mysql_affected_rows();
	  ?>
	         <script language="javascript">
	             alert("Datos grabados con exito en sistema.!")
	             open("consultacupo.php","_self")
	         </script>
	         <?
else:
   ?>
        <script language="javascript">
	    alert("A este empleado ya le generaron el cupo para este dia!")
            history.back()
       </script>
	         <?
endif;
?>

