<html>

<head>
  <title></title>
</head>
<body>
<input type="hidden" name="Desde" value="<?echo $Desde;?>">
<input type="hidden" name="Hasta" value="<?echo $Hasta;?>">
<input type="hidden" name="Validar" value="<?echo $Validar;?>">
<input type="hidden" name="AuxilioT" value="<?echo $AuxilioT;?>">
<input type="hidden" name="Zona" value="<?echo $Zona;?>">
<input type="hidden" name="AuxProceso" value="<?echo $AuxProceso;?>">
<?
if(empty($Validar)):
   ?>
   <script language="javascript">
       alert("Seleccione el tipo de validador para las primas semestrales!")
       history.back()
   </script>
   <?
elseif(empty($datoN)):
   ?>
   <script language="javascript">
       alert("Debe chequear todas las cajas de verificacion!")
       history.back()
   </script>
   <?
else:
  if($Validar=='MANUAL' and $VlrManual==''):
      ?>
      <script language="javascript">
       alert("Favor digite el Nro de Dias para el corte de las primas!")
       history.back()
      </script>
      <?
  else:
     include("../conexion.php");
     for ($k=1 ; $k<=$tActualizaciones; $k ++):
          /*CODIGO QUE PERMITE DESCONTAR LOS DIAS AUSENTISMO*/
          $Sql="select parametrolicenciapermiso.* FROM parametrolicenciapermiso
                 where parametrolicenciapermiso.estado='ACTIVO'";
          $Rs=mysql_query($Sql)or die("Error al validar los datos");
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
      /*FIN CODIGO*/
          $conP="select contrato.fechainic,contrato.salario,contrato.cambio,contrato.salario_fecha_desde,empleado.cedemple,concat(nomemple, ' ' ,nomemple1,  ' ' ,apemple, ' ' ,apemple1) as Empleado,empleado.codzona as CodZona from contrato,empleado
	  where empleado.codemple=contrato.codemple and
                contrato.fechater='0000-00-00' and
                empleado.cedemple='$datoN[$k]'";
	 $reE=mysql_query($conP)or die("Error al buscar Empleado");
         $VectorE=mysql_fetch_array($reE);
         $Empleado=$VectorE["Empleado"];
         $FechaInicioC=$VectorE["fechainic"];
		 $Cambio=$VectorE["cambio"];
		 $FechaCambio=$VectorE["salario_fecha_desde"];
         $Salario=$VectorE["salario"];
		 $CodZona=$VectorE["CodZona"];
         $Division=0;
         $FechaP=date("Y-m-d");
         if($Validar=='MEDIO'):
	         $AuxSalario=$Salario/2;
                 if($FechaInicioC <= $Desde):
	                 $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
	                 where empleado.cedemple=nomina.cedemple and
	                     empleado.cedemple='$datoN[$k]' and
	                     nomina.desde between '$Desde' and '$Hasta' group by empleado.cedemple";
	                 $resuB=mysql_query($conB)or die ("Error en la consulta");
	                 $FilasN=mysql_fetch_array($resuB);
	                 $SumaPresta=$FilasN["ConPresta"] + $AuxSalario;
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
			      $mes;
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
                         $conA="select parametroauxilio.maximo from parametroauxilio
	                 where parametroauxilio.estado='ACTIVO'";
	                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
                         $Linea=mysql_fetch_array($resuA);
                         $Maximo=$Linea["maximo"];
	                 if($Salario <= $Maximo):
                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
                         else:
                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
                         endif;
                         /*ARCHIVO DE GUARDADO*/
                        $consulta = "select count(*) from prima";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
			     $result = mysql_query ($consulta);
			     $codec = mysql_fetch_row($result);
			     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
			 else:
			       $codprima="00001";
			 endif;
		        $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
			 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$Desde','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
			 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
	         else:
                        $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
	                 where empleado.cedemple=nomina.cedemple and
	                     empleado.cedemple='$datoN[$k]' and
	                     nomina.fechainicioc between '$FechaInicioC' and '$Hasta' group by empleado.cedemple";
	                 $resuB=mysql_query($conB)or die ("Error en la consulta");
	                 $FilasS=mysql_fetch_array($resuB);
	                 $SumaPresta=$FilasS["ConPresta"] + $AuxSalario;
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
			       $mes;
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
                         $conA="select parametroauxilio.maximo from parametroauxilio
	                 where parametroauxilio.estado='ACTIVO'";
	                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
                         $Linea=mysql_fetch_array($resuA);
                         $Maximo=$Linea["maximo"];
	                 if($Salario <= $Maximo):
                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
                         else:
                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
                         endif;
                         /*ARCHIVO DE GUARDADO*/
                         $consulta = "select count(*) from prima";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
			     $result = mysql_query ($consulta);
			     $codec = mysql_fetch_row($result);
			     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
			 else:
			       $codprima="00001";
			 endif;
		       	 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
			 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$Division','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
			 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
	         endif;
     else:
              if($Validar=='COMPLETO'):
	         $AuxSalario=$Salario;
                 if($FechaInicioC <= $Desde):
	                 $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
	                 where empleado.cedemple=nomina.cedemple and
	                     empleado.cedemple='$datoN[$k]' and
	                     nomina.desde between '$Desde' and '$Hasta' group by empleado.cedemple";
	                 $resuB=mysql_query($conB)or die ("Error en la consulta");
	                 $FilasN=mysql_fetch_array($resuB);
	                 $SumaPresta=$FilasN["ConPresta"] + $AuxSalario;
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
			      $mes;
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
                         $conA="select parametroauxilio.maximo from parametroauxilio
	                 where parametroauxilio.estado='ACTIVO'";
	                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
                         $Linea=mysql_fetch_array($resuA);
                         $Maximo=$Linea["maximo"];
	                 if($Salario <= $Maximo):
                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
                         else:
                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
                         endif;
                         /*ARCHIVO DE GUARDADO*/
                        $consulta = "select count(*) from prima";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
			     $result = mysql_query ($consulta);
			     $codec = mysql_fetch_row($result);
			     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
			 else:
			       $codprima="00001";
			 endif;
			 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
			 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$Desde','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
			 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
	         else:
                        $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
	                 where empleado.cedemple=nomina.cedemple and
	                     empleado.cedemple='$datoN[$k]' and
	                     nomina.fechainicioc between '$FechaInicioC' and '$Hasta' group by empleado.cedemple";
	                 $resuB=mysql_query($conB)or die ("Error en la consulta");
	                 $FilasS=mysql_fetch_array($resuB);
	                 $SumaPresta=$FilasS["ConPresta"] + $AuxSalario;
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
			      $mes;
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
                         $conA="select parametroauxilio.maximo from parametroauxilio
	                 where parametroauxilio.estado='ACTIVO'";
	                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
                         $Linea=mysql_fetch_array($resuA);
                         $Maximo=$Linea["maximo"];
	                 if($Salario <= $Maximo):
                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
                         else:
                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
                         endif;
                         /*ARCHIVO DE GUARDADO*/
                         $consulta = "select count(*) from prima";
			 $result = mysql_query ($consulta);
			 $sw = mysql_fetch_row($result);
			 if ($sw[0]>0):
			     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
			     $result = mysql_query ($consulta);
			     $codec = mysql_fetch_row($result);
			     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
			 else:
			       $codprima="00001";
			 endif;
		       	 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
			 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$Division','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
			 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
	         endif;
              else:
                   if($Validar=='MANUAL'):
	                $AuxSalario=round(($Salario/30)*$VlrManual);
                        if($FechaInicioC <= $Desde):
		                 $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
		                 where empleado.cedemple=nomina.cedemple and
		                     empleado.cedemple='$datoN[$k]' and
		                     nomina.desde between '$Desde' and '$Hasta' group by empleado.cedemple";
		                 $resuB=mysql_query($conB)or die ("Error en la consulta");
		                 $FilasN=mysql_fetch_array($resuB);
		                 $SumaPresta=$FilasN["ConPresta"]+$AuxSalario;
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
				       $mes;
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
	                         $conA="select parametroauxilio.maximo from parametroauxilio
		                 where parametroauxilio.estado='ACTIVO'";
		                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
	                         $Linea=mysql_fetch_array($resuA);
	                         $Maximo=$Linea["maximo"];
		                 if($Salario <= $Maximo):
	                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
	                         else:
	                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
	                         endif;
 	                         /*ARCHIVO DE GUARDADO*/
	                        $consulta = "select count(*) from prima";
				 $result = mysql_query ($consulta);
				 $sw = mysql_fetch_row($result);
				 if ($sw[0]>0):
				     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
				     $result = mysql_query ($consulta);
				     $codec = mysql_fetch_row($result);
				     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
				 else:
				       $codprima="00001";
				 endif;
				 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
				 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$Desde','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
				 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
	                else:
	                        $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
		                 where empleado.cedemple=nomina.cedemple and
		                     empleado.cedemple='$datoN[$k]' and
		                     nomina.fechainicioc between '$FechaInicioC' and '$Hasta' group by empleado.cedemple";
		                 $resuB=mysql_query($conB)or die ("Error en la consulta");
		                 $FilasS=mysql_fetch_array($resuB);
		                 $SumaPresta=$FilasS["ConPresta"]+$AuxSalario;
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
				      $mes;
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
	                         $conA="select parametroauxilio.maximo from parametroauxilio
		                 where parametroauxilio.estado='ACTIVO'";
		                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
	                         $Linea=mysql_fetch_array($resuA);
	                         $Maximo=$Linea["maximo"];
		                 if($Salario <= $Maximo):
	                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
	                         else:
	                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
	                         endif;
	                         /*ARCHIVO DE GUARDADO*/
	                         $consulta = "select count(*) from prima";
				 $result = mysql_query ($consulta);
				 $sw = mysql_fetch_row($result);
				 if ($sw[0]>0):
				     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
				     $result = mysql_query ($consulta);
				     $codec = mysql_fetch_row($result);
				     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
				 else:
				       $codprima="00001";
				 endif;
			       	 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
				 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$Division','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
				 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
                         endif;
                   else:
                       if($Validar=='BASICO'):
                        $AuxSalario=$Salario;
                        if($FechaInicioC <= $Desde):
		                 $SumaPresta=$AuxSalario;
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
				      $mes;
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
		                 $Division=$SumaPresta;
	                         $IBC=$Division;
	                         $conA="select parametroauxilio.maximo from parametroauxilio
		                 where parametroauxilio.estado='ACTIVO'";
		                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
	                         $Linea=mysql_fetch_array($resuA);
	                         $Maximo=$Linea["maximo"];
		                 if($Salario <= $Maximo):
	                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
	                         else:
	                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
	                         endif;
	                         /*ARCHIVO DE GUARDADO*/
	                        $consulta = "select count(*) from prima";
				 $result = mysql_query ($consulta);
				 $sw = mysql_fetch_row($result);
				 if ($sw[0]>0):
				     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
				     $result = mysql_query ($consulta);
				     $codec = mysql_fetch_row($result);
				     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
				 else:
				       $codprima="00001";
				 endif;
				 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
				 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$Desde','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
				 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
	                else:
		                 $SumaPresta=$AuxSalario;
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
				      $mes;
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
		                 $Division=$SumaPresta;
	                         $conA="select parametroauxilio.maximo from parametroauxilio
		                 where parametroauxilio.estado='ACTIVO'";
		                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
	                         $Linea=mysql_fetch_array($resuA);
	                         $Maximo=$Linea["maximo"];
		                 if($Salario <= $Maximo):
	                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
	                         else:
	                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
	                         endif;
	                         /*ARCHIVO DE GUARDADO*/
	                         $consulta = "select count(*) from prima";
				 $result = mysql_query ($consulta);
				 $sw = mysql_fetch_row($result);
				 if ($sw[0]>0):
				     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
				     $result = mysql_query ($consulta);
				     $codec = mysql_fetch_row($result);
				     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
				 else:
				       $codprima="00001";
				 endif;
			       	 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
				 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$Division','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
				 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
                         endif;
                       else:
                           if($FechaInicioC <= $Desde):
                                 $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
		                 where empleado.cedemple=nomina.cedemple and
		                     empleado.cedemple='$datoN[$k]' and
		                     nomina.desde between '$Desde' and '$Hasta' group by empleado.cedemple";
		                 $resuB=mysql_query($conB)or die ("Error en la consulta");
		                 $FilasS=mysql_fetch_array($resuB);
		                 $SumaPresta=$FilasS["ConPresta"];
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
				      $mes;
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
				 //echo "Días: ".$TotalD." <br />"; *************************************************
				 }
		                 $Division=round(($SumaPresta/$TotalD)*30);
	                         $IBC=$Division;
	                         $conA="select parametroauxilio.maximo from parametroauxilio
		                 where parametroauxilio.estado='ACTIVO'";
		                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
	                         $Linea=mysql_fetch_array($resuA);
	                         $Maximo=$Linea["maximo"];
		                 if($Salario <= $Maximo):
	                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
	                         else:
	                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
	                         endif;
	                         /*ARCHIVO DE GUARDADO*/
	                        $consulta = "select count(*) from prima";
				 $result = mysql_query ($consulta);
				 $sw = mysql_fetch_row($result);
				 if ($sw[0]>0):
				     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
				     $result = mysql_query ($consulta);
				     $codec = mysql_fetch_row($result);
				     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
				 else:
				       $codprima="00001";
				 endif;
				 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
				 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$Desde','$Hasta','$IBC','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
				 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
	                   else:
                                 $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
		                 where empleado.cedemple=nomina.cedemple and
		                     empleado.cedemple='$datoN[$k]' and
		                     nomina.fechainicioc between '$FechaInicioC' and '$Hasta' group by empleado.cedemple";
		                 $resuB=mysql_query($conB)or die ("Error en la consulta");
		                 $FilasS=mysql_fetch_array($resuB);
		                 $SumaPresta=$FilasS["ConPresta"];
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
				      $mes;
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
	                         $conA="select parametroauxilio.maximo from parametroauxilio
		                 where parametroauxilio.estado='ACTIVO'";
		                 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
	                         $Linea=mysql_fetch_array($resuA);
	                         $Maximo=$Linea["maximo"];
		                 if($Salario <= $Maximo):
	                           $Formula=round((($Division+$AuxilioT)*$TotalDiasDeduccion)/360);
	                         else:
	                           $Formula=round(($Division*$TotalDiasDeduccion)/360);
	                         endif;
	                         /*ARCHIVO DE GUARDADO*/
	                         $consulta = "select count(*) from prima";
				 $result = mysql_query ($consulta);
				 $sw = mysql_fetch_row($result);
				 if ($sw[0]>0):
				     $consulta = "select max(cast(nroprima as unsigned)) + 1  from prima";
				     $result = mysql_query ($consulta);
				     $codec = mysql_fetch_row($result);
				     $codprima = str_pad($codec[0], 5,"0", STR_PAD_LEFT);
				 else:
				       $codprima="00001";
				 endif;
			       	 $consulta="insert into prima(nroprima,cedemple,nombre,fechap,fechai,fechainicio,fechacorte,salario,dias,diadeduccion,auxilio,total,prima,codzona,cambiosalario,fechacambio)
				 value('$codprima','$datoN[$k]','$Empleado','$FechaP','$Desde','$FechaInicioC','$Hasta','$Division','$TotalD','$TotalDias','$AuxilioT','$Formula','$Formula','$CodZona','$Cambio','$FechaCambio')";
				 $resultado=mysql_query($consulta) or die("eRROR al Grabar la prima semestral");
                           endif;
                       endif;
                   endif;
              endif;
         endif;
   endfor;
   if($AuxProceso==1):
       ?>
       <script language="javascript">
	       alert("Se grabó con Exito : <?echo $tActualizaciones;?> registros de la Empleado : <?echo $Empleado;?>")
	       open("listadoprima.php","_self")
       </script>
       <?
   else:
       if($AuxProceso==2):
           ?>
           <script language="javascript">
	       alert("Se grabaron con Exito : <?echo $tActualizaciones;?> registros de la Empresa : <?echo $Zona;?>")
	       open("PrimaZona.php","_self")
           </script>
           <?
       else:
           ?>
           <script language="javascript">
              alert("Se grabaron con Exito : <?echo $tActualizaciones;?> registros de la Sucursal : <?echo $Sucursal;?>")
              open("PrimaSucursal.php","_self")
           </script>
          <?
       endif;
   endif;
  endif;
endif;
?>
</body>
</html>
