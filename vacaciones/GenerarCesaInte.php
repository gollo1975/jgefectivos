<html>

<head>
  <title></title>
</head>
<body>
<input type="hidden" name="Desde" value="<?echo $Desde;?>">
<input type="hidden" name="Hasta" value="<?echo $Hasta;?>">
<input type="hidden" name="Zona" value="<?echo $Zona;?>">
<input type="hidden" name="AuxProceso" value="<?echo $AuxProceso;?>">
   <?
if(empty($datoN)):
   ?>
   <script language="javascript">
       alert("Debe chequear todas las cajas de verificacion!")
       history.back()
   </script>
   <?
else:
    $AuxilioT=0;
    include("../conexion.php");
    $conA="select parametroauxilio.maximo,parametroauxilio.valor from parametroauxilio
          where parametroauxilio.estado='INACTIVO' order by conse DESC limit 1";
    $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
    $Linea=mysql_fetch_array($resuA);
    $Maximo=$Linea["maximo"];
    $AuxilioT=$Linea["valor"];
    for ($k=1 ; $k<=$tActualizaciones; $k ++){
         $Salario = 0;
         /*CODIGO QUE PERMITE VALIDAR LOS CODIGOS DE LICENCIAAS Y AUSENTISMO*/
        $Sql="select parametrolicenciapermiso.* from parametrolicenciapermiso where parametrolicenciapermiso.estado='ACTIVO'";
	$Rs=mysql_query($Sql)or die("Error la validar salario");
        $TotalRegistro = mysql_num_rows($Rs);
       /*FIN CODIGO*/
        /*CODIGO QUE BUSCA LOS DIAS DE PERMISOS*/
        $TotalDiasDescontar = 0; $TotalDias = 0;
         while($Fila=mysql_fetch_array($Rs)){
              $CodSalario = $Fila["codsala"];
              $Buscar="select SUM(denomina.nrohora) 'Total' from denomina,nomina
                      where  nomina.consecutivo=denomina.consecutivo and
                      nomina.cedemple='$datoN[$k]' and
                      denomina.codsala='$CodSalario' and
                      nomina.desde between '$Desde' and '$Hasta' group by nomina.cedemple";
             $Sr=mysql_query($Buscar)or die("Error al buscar codigos de salarios");
             $fil=mysql_fetch_array($Sr);
             $TotalDiasDescontar += $fil["Total"];
         }
        $TotalDias = round($TotalDiasDescontar/8);
        /*FIN DEL CODIGO DE BUSQUEDA*/
         $conP="select contrato.fechainic,contrato.salario,empleado.cedemple,concat(nomemple, ' ' ,nomemple1,  ' ' ,apemple, ' ' ,apemple1) as Empleado,empleado.periodo,empleado.codzona from contrato,empleado
	  where empleado.codemple=contrato.codemple and
                contrato.fechater='0000-00-00' and
                empleado.cedemple='$datoN[$k]'";
	 $reE=mysql_query($conP)or die("Error al buscar Empleado");
         $VectorE=mysql_fetch_array($reE);
         $Empleado=$VectorE["Empleado"];
         $CodZona=$VectorE["codzona"];
         $FechaInicioC=$VectorE["fechainic"];
         $Salario=$VectorE["salario"];
         $FormaPago=$VectorE["periodo"];
         $FechaP=date("Y-m-d");
         $Formula=0;$Interes=0;
         if($FechaInicioC <= $Desde):
             /*CODIGO QUE SIRVE PARA GENERAR CESANTIAS E INTERESES DECADAL, QUINCENAL Y MENSUAL*/
             if($FormaPago=='DECADAL' or $FormaPago=='QUINCENAL' or $FormaPago=='MENSUAL'){
		     $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
		           where empleado.cedemple=nomina.cedemple and
		          empleado.cedemple='$datoN[$k]' and
		          nomina.desde >= '$Desde' and
	                  nomina.desde <= '$Hasta' group by empleado.cedemple";
		      $resuB=mysql_query($conB)or die ("Error en la consulta");
		      $FilasN=mysql_fetch_array($resuB);
		      $SumaPresta=$FilasN["ConPresta"];
		      $fechaInicio=date("d/m/Y",  strtotime($Desde));
		      $fechaActual = date("d/m/Y",  strtotime($Hasta));
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
	     	         $TotalD=($meses*30)+$dies+1;
                         $TotalDiasDeduccion = $TotalD - $TotalDias;   /*DIAS DEDUCCIDOS EN LAS PRIMAS*/
			      	 //echo "Años: ".$anios." <br />";
				 //echo "Meses: ".$meses." <br />";
				 //echo "Días: ".$TotalD." <br />";
			 }
	                 $Division=round(($SumaPresta/$TotalD)*30);
	                 $IBC=$Division;
	                 if($Salario <= $Maximo):
	                     $Formula=round((($Division + $AuxilioT)* $TotalDiasDeduccion)/360);
	                     $Interes=round((($Formula * $TotalDiasDeduccion)*0.12)/360);
	                 else:
	                     $Formula=round(($Division * $TotalDiasDeduccion)/360);
	                     $Interes=round((($Formula * $TotalDiasDeduccion) * 0.12)/360);
	                 endif;
	                 /*ARCHIVO DE GUARDADO*/
	                 $consulta = "select count(*) from cesantiainteres";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			    $consulta = "select max(cast(nrocesantia as unsigned)) + 1  from cesantiainteres";
			    $result = mysql_query ($consulta);
			    $codec = mysql_fetch_row($result);
			    $NroCesa = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
			 else:
			     $NroCesa="000001";
			 endif;
		          $consulta="insert into cesantiainteres(nrocesantia,cedemple,nombre,fechap,inicioperiodo,fechainicio,fechafinal,salario,dias,dialicencia,auxilio,pagocesantia,pagointeres,codzona)
				 value('$NroCesa','$datoN[$k]','$Empleado','$FechaP','$Desde','$Desde','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Interes','$CodZona')";
			 $resultado=mysql_query($consulta) or die("Error al grabar prima semestral primer lote");
              }else{
                      /*CODIGO QUE SIRVE PARA GENERAR CESATNIAS E INTERESES  SEMANAL Y CATORCENAL*/
                      $conB="select SUM(nomina.presta)'ConPresta',MAX(nomina.hasta)'Ultima',MAX(nomina.basico)'SalaPagado' from nomina,empleado
		           where empleado.cedemple=nomina.cedemple and
		          empleado.cedemple='$datoN[$k]' and
		          nomina.desde >='$Desde' and
	                  nomina.hasta <= '$Hasta' group by empleado.cedemple ";
		      $resuB=mysql_query($conB)or die ("Error en la consulta");
		      $FilasN=mysql_fetch_array($resuB);
		      $SumaPresta=$FilasN["ConPresta"];
                      $UltimaFecha=$FilasN["Ultima"];
                      $DiaNominaCorte=substr($UltimaFecha,8,2);
                      $DiaCorte=substr($Hasta,8,2). ' ';
                      if($DiaNominaCorte < $DiaCorte){
                          $SalarioUltimo=$FilasN["SalaPagado"];
                          $SumaDia=($DiaCorte-$DiaNominaCorte);
                          $OtroDevengado=($SalarioUltimo/30*$SumaDia);
                      }else{
                          $OtroDevengado = 0;
                      }
		      $fechaInicio=date("d/m/Y",  strtotime($Desde));
		      $fechaActual = date("d/m/Y",  strtotime($Hasta));
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
	     	        $TotalD=($meses*30)+$dies+1;
                        $TotalDiasDeduccion = $TotalD - $TotalDias;   /*DIAS DEDUCCIDOS EN LAS PRIMAS*/
			      	 //echo "Años: ".$anios." <br />";
				 //echo "Meses: ".$meses." <br />";
				 //echo "Días: ".$TotalD." <br />";
			 }
		         $Division=round((($SumaPresta+$OtroDevengado)/$TotalD)*30);
	                 $IBC=$Division;
	                 if($Salario <= $Maximo):
	                     $Formula=round((($Division + $AuxilioT)* $TotalDiasDeduccion)/360);
	                     $Interes=round((($Formula * $TotalDiasDeduccion)*0.12)/360);
	                 else:
	                     $Formula=round(($Division * $TotalDiasDeduccion)/360);
	                     $Interes=round((($Formula * $TotalDiasDeduccion)*0.12)/360);
	                 endif;
	                 /*ARCHIVO DE GUARDADO*/
	                 $consulta = "select count(*) from cesantiainteres";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			    $consulta = "select max(cast(nrocesantia as unsigned)) + 1  from cesantiainteres";
			    $result = mysql_query ($consulta);
			    $codec = mysql_fetch_row($result);
			    $NroCesa = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
			 else:
			     $NroCesa="000001";
			 endif;
		        $consulta="insert into cesantiainteres(nrocesantia,cedemple,nombre,fechap,inicioperiodo,fechainicio,fechafinal,salario,dias,dialicencia,auxilio,pagocesantia,pagointeres,codzona)
				 value('$NroCesa','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Interes','$CodZona')";
			 $resultado=mysql_query($consulta) or die("ERROR AL GRABAR LA PRIMA SEMESTRAL MAYOR AL AÑO ANTERTIOR");
              }
         else:
               /*CODIGO QUE PERMITE GENERAR CESANTIAS E INTERESES PARA EMPLEADOS DECADALES, QUINCENALES Y MENSUALES*/
              if($FormaPago=='DECADAL' or $FormaPago=='QUINCENAL' or $FormaPago=='MENSUAL'){
	              $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
		           where empleado.cedemple=nomina.cedemple and
		          empleado.cedemple='$datoN[$k]' and
		          nomina.fechainicioc ='$FechaInicioC' and
	                  nomina.desde <= '$Hasta' group by empleado.cedemple";
		      $resuB=mysql_query($conB)or die ("Error en la consulta");
		      $FilasN=mysql_fetch_array($resuB);
		      $SumaPresta=$FilasN["ConPresta"];
		      $fechaInicio=date("d/m/Y",  strtotime($FechaInicioC));
		      $fechaActual = date("d/m/Y",  strtotime($Hasta));
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
	     	         $TotalD=($meses*30)+$dies+1;
                         $TotalDiasDeduccion = $TotalD - $TotalDias;   /*DIAS DEDUCCIDOS EN LAS PRIMAS*/
			      	 //echo "Años: ".$anios." <br />";
				 //echo "Meses: ".$meses." <br />";
				 //echo "Días: ".$TotalD." <br />";
			 }
		         $Division=round(($SumaPresta/$TotalD)*30);
	                 $IBC=$Division;
	                 if($Salario <= $Maximo):
	                   $Formula=round((($Division + $AuxilioT) * $TotalDiasDeduccion)/360);
	                   $Interes=round((($Formula * $TotalDiasDeduccion)*0.12)/360);
	                 else:
	                     $Formula=round(($Division * $TotalDiasDeduccion)/360);
	                     $Interes=round((($Formula * $TotalDiasDeduccion) * 0.12)/360);
	                 endif;
	                 /*ARCHIVO DE GUARDADO*/
	                 $consulta = "select count(*) from cesantiainteres";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			    $consulta = "select max(cast(nrocesantia as unsigned)) + 1  from cesantiainteres";
			    $result = mysql_query ($consulta);
			    $codec = mysql_fetch_row($result);
			    $NroCesa = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
			 else:
			     $NroCesa="000001";
			 endif;
		         $consulta="insert into cesantiainteres(nrocesantia,cedemple,nombre,fechap,inicioperiodo,fechainicio,fechafinal,salario,dias,dialicencia,auxilio,pagocesantia,pagointeres,codzona)
				 value('$NroCesa','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Interes','$CodZona')";
			 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
              }else{
                      /*CODIGO QUE PERMITE GENERAR CESANTIAS E INTERESES PARA EMPLEADOS SEMANALES, CATORCENAL*/
                      $conB="select SUM(nomina.presta)'ConPresta',MAX(nomina.hasta)'Ultima',MAX(nomina.basico)'SalaPagado' from nomina,empleado
		           where empleado.cedemple=nomina.cedemple and
		          empleado.cedemple='$datoN[$k]' and
		          nomina.fechainicioc ='$FechaInicioC' and
	                  nomina.hasta <= '$Hasta' group by empleado.cedemple ";
		      $resuB=mysql_query($conB)or die ("Error en la consulta");
		      $FilasN=mysql_fetch_array($resuB);
		      $SumaPresta=$FilasN["ConPresta"];
                      $UltimaFecha=$FilasN["Ultima"];
                      $DiaNominaCorte=substr($UltimaFecha,8,2);
                      $DiaCorte=substr($Hasta,8,2). ' ';
                      if($DiaNominaCorte < $DiaCorte){
                          $SalarioUltimo=$FilasN["SalaPagado"];
                          $SumaDia=($DiaCorte-$DiaNominaCorte);
                          $OtroDevengado=($SalarioUltimo/30*$SumaDia);
                      }else{
                          $OtroDevengado = 0;
                      }
		      $fechaInicio=date("d/m/Y",  strtotime($FechaInicioC));
		      $fechaActual = date("d/m/Y",  strtotime($Hasta));
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
	     	        $TotalD=($meses*30)+$dies+1;
                        $TotalDiasDeduccion = $TotalD - $TotalDias;   /*DIAS DEDUCCIDOS EN LAS PRIMAS*/
			      	 //echo "Años: ".$anios." <br />";
				 //echo "Meses: ".$meses." <br />";
				 //echo "Días: ".$TotalD." <br />";
			 }
		         $Division=round((($SumaPresta+$OtroDevengado)/$TotalD)*30);
	                 $IBC=$Division;
	                 if($Salario <= $Maximo):
	                     $Formula=round((($Division + $AuxilioT) * $TotalDiasDeduccion)/360);
	                     $Interes=round((($Formula * $TotalDiasDeduccion)*0.12)/360);
	                 else:
	                     $Formula=round(($Division * $TotalDiasDeduccion)/360);
	                     $Interes=round((($Formula * $TotalDiasDeduccion) * 0.12)/360);
	                 endif;
	                 /*ARCHIVO DE GUARDADO*/
	                 $consulta = "select count(*) from cesantiainteres";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			    $consulta = "select max(cast(nrocesantia as unsigned)) + 1  from cesantiainteres";
			    $result = mysql_query ($consulta);
			    $codec = mysql_fetch_row($result);
			    $NroCesa = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
			 else:
			     $NroCesa="000001";
			 endif;
		        $consulta="insert into cesantiainteres(nrocesantia,cedemple,nombre,fechap,inicioperiodo,fechainicio,fechafinal,salario,dias,dialicencia,auxilio,pagocesantia,pagointeres,codzona)
				 value('$NroCesa','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Interes','$CodZona')";
			 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
              }
         endif;
      }
    if($AuxProceso==1):
           ?>
           <script language="javascript">
	       alert("Se grabaron con Exito : <?echo $tActualizaciones;?> registros de la Empresa : <?echo $Zona;?>")
	       open("CesaZona.php","_self")
           </script>
           <?
      else:
           ?>
           <script language="javascript">
              alert("Se grabaron con Exito : <?echo $tActualizaciones;?> registros de la Sucursal : <?echo $Sucursal;?>")
              open("CesaSucursal.php","_self")
           </script>
          <?
      endif; 



endif;
?>
</body>
</html>
