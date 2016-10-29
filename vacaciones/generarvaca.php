<td><input type="hidden" name="Cedula" value="<? echo $Cedula;?>"></td>
<td><input type="hidden" name="Nombre" value="<? echo $Nombre;?>" size="44"></td>
<td><input type="hidden" name="fechai" value="<? echo $fechai;?>"></td>
<td><input type="hidden" name="fechac" value="<? echo $fechac;?>"></td>
<td><input type="hidden" name="FinalNomina" value="<? echo $FinalNomina;?>"></td>
<td><input type="hidden" name="inicion" value="<? echo $inicion;?>"></td>
<td><input type="hidden" name="Salario" value="<? echo $Salario;?>"></td>
<script language="javascript">
            function imprimir(numero)// para declara funcion
             {
              pagina='imprimir.php?codvaca=' + numero
                tiempo=40
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
               }
</script>
<?
if($fechac==$inicion):
  ?>
    <script language="javascript">
	    alert ("Error, La fecha de Inicio de Nómina no puede ser Igual a la fecha de Retiro!")
	    history.back()
   </script>
  <?
elseif(empty($EstadoVal)):
   ?>
   <script language="javascript">
	    alert ("Seleccion el estado de vacación a generar.!")
	    history.back()
   </script>
   <?
elseif(empty($G_Deduccion)):
   ?>
   <script language="javascript">
	    alert ("Seleccion si el empleado presenta deducciones en el sistema.!")
	    history.back()
   </script>
   <?
else:

	include("../conexion.php");
	$ConR="select vacacion.cedemple from empleado,vacacion
	    where  empleado.cedemple=vacacion.cedemple and
	               empleado.cedemple='$Cedula' and
	               vacacion.fechai='$fechai' and
	               vacacion.fechac='$fechac'";
	$ResR=mysql_query($ConR)or die("Error al buscar prestaciones");
	$RegiR=mysql_num_rows($ResR);
	if($RegiR==0):
    	     $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
		      where empleado.cedemple=nomina.cedemple and
			    empleado.cedemple='$Cedula' and
			    nomina.fechainicioc between '$inicion' and '$FinalNomina' group by empleado.cedemple";
	     $resuB=mysql_query($conB)or die ("Error en la consulta");
	     $FilasN=mysql_fetch_array($resuB);
	     $Devengado=$FilasN["ConPresta"];
             $fechaInicio=date("d/m/Y",  strtotime($fechai));
	     $fechaActual = date("d/m/Y",  strtotime($fechac));
	     $diaActual = substr($fechaActual, 0, 2);
	     $mesActual = substr($fechaActual, 3, 5);
	     $anioActual = substr($fechaActual, 6, 10);
	     $diaInicio = substr($fechaInicio, 0, 2);
	     $mesInicio = substr($fechaInicio, 3, 5);
	     $anioInicio = substr($fechaInicio, 6, 10);
	     $b = 0;
		$mes = $mesInicio-1;
		if($mes==2){
		  if(($anioActual%4==0 && $anioActual%100!=0) || $anioActual%400==0){
		    $b = 29;
		  }else{
		     $b = 28;
		     }
		  }
		else if($mes<=7){
		  if($mes==0){
		     $b = 31;
		  }
		  else if($mes%2==0){
		    $b = 30;
		  }
		  else{
		  $b = 31;
		     }
		     }
		  else if($mes>7){
		  if($mes%2==0){
		  $b = 31;
		  }
		  else{
		    $b = 30;
		    }
		}
		if(($anioInicio>$anioActual) || ($anioInicio==$anioActual && $mesInicio>$mesActual) ||
		   ($anioInicio==$anioActual && $mesInicio == $mesActual && $diaInicio>$diaActual)){
		   echo "La fecha de inicio ha de ser anterior a la fecha Actual";
		}else{
		if($mesInicio <= $mesActual){
		$anios = $anioActual - $anioInicio;
		if($diaInicio <= $diaActual){
		$meses = $mesActual - $mesInicio;
		$dies = $diaActual - $diaInicio;
		}else{
		if($mesActual == $mesInicio){
		$anios = $anios - 1;
		}
		$meses = ($mesActual - $mesInicio - 1 + 12) % 12;
		$dies = $b-($diaInicio-$diaActual);
		}
		}else{
		$anios = $anioActual - $anioInicio - 1;
		if($diaInicio > $diaActual){
		$meses = $mesActual - $mesInicio -1 +12;
		$dies = $b - ($diaInicio-$diaActual);
		}else{
		$meses = $mesActual - $mesInicio + 12;
		$dies = $diaActual - $diaInicio;
		}
		}
                /*Resultados*/
                $ValorAno=$anios*360;
		$TotalD=($meses*30)+$dies+1+$ValorAno;
		}
                 $Ibc=round(($Devengado/$TotalD)*30);
	        	/*VALIDADOR*/
	         if($EstadoVal=='Normal'):
	            $Porce = ($TotalD * 15)/360;
		     $Vacacion=round(($Salario/30)*$Porce);
	             $Ibc=$Salario;
	          else:
	             $Porce = ($TotalD * 15)/360;
	             $Vacacion=round(($Ibc/30)*$Porce);
	             $Ibc=$Ibc;
	          endif;
	         /*ARCHIVO DE GUARDADO*/
	      	$consulta = "select count(*) from vacacion";
		$result = mysql_query ($consulta);
		$sw = mysql_fetch_row($result);
		if ($sw[0]>0):
		   $consulta = "select max(cast(codvaca as unsigned)) + 1  from vacacion";
		   $result = mysql_query ($consulta);
		   $codec = mysql_fetch_row($result);
		   $CodVaca = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
		else:
		    $CodVaca="00001";
		endif;
	     	$Estado='ACTIVA';
	        $Nota='PAGO DE VACACIONES';
		 $consulta="insert into vacacion(codvaca,cedemple,nombre,fechap,fechai,fechac,dias,ibc,subtotal,valor,nota,codzona,control)
		  value('$CodVaca','$Cedula','$Nombre','$fechap','$fechai','$fechac','$TotalD','$Ibc','$Vacacion','$Vacacion','$Nota','$CodZona','$Estado')";
		$resultado=mysql_query($consulta) or die("eRROR al Grabar las vacaciones");
                if($G_Deduccion=='NO'){
	             echo ("<script language=\"javascript\">");
	             echo ("open (\"imprimir.php?codvaca=$CodVaca\" ,\"\");");
		     echo ("</script>");
		     ?>
		     <script language="javascript">
		         open("listado.php","_self");
		     </script>
		     <?
                }else{
                    header("location: CrearDeduccionVacacion.php?NroVacacion=$CodVaca&Cedula=$Cedula");
                }
        else:
         ?>
	    <script language="javascript">
	    alert ("Ya se le generó las Vacaciones al señor(a): <?echo $Nombre;?>.!")
	    history.back()
	    </script>
	    <?
        endif;
endif;
?>
