<td><input type="hidden" name="cedula" value="<? echo $filas["cedemple"];?>"></td>
<td><input type="hidden" name="Nombre" value="<? echo $Nombre;?>" size="44"></td>
<td><input type="hidden" name="fechai" value="<? echo $fechai;?>"></td>
<td><input type="hidden" name="fechac" value="<? echo $fechac;?>"></td>
<td><input type="hidden" name="fechab" value="<? echo $fechab;?>"></td>
<td><input type="hidden" name="inicion" value="<? echo $inicion;?>"></td>
<td><input type="hidden" name="Salario" value="<? echo $Salario;?>"></td>
<td><input type="hidden" name="CodZona" value="<? echo $CodZona;?>"></td>
<script language="javascript">
            function imprimir(numero)// para declara funcion
             {
              pagina='imprimirpresta.php?nropresta=' + numero
                tiempo=40
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
               }
</script>
<?

if(empty($TipoPago)):
     ?>
    <script language="javascript">
    alert ("Seleccione el tipo de pago a realizar al Empleado.!")
    history.back()
    </script>
    <?
elseif(empty($Validar)):
     ?>
    <script language="javascript">
    alert ("Seleccione el tipo de prestacion social que va a generar.!")
    history.back()
    </script>
    <?
elseif(empty($Activar)):
     ?>
    <script language="javascript">
    alert ("Seleccione el estado de la deducciones!")
    history.back()
    </script>
    <?
else:
   $fechap=date("Y-m-d");
    include("../conexion.php");
    /*CODIGO QUE PERMITE BUSCAR EL AUSENTISMO*/
    $TotalDiasDescontar = 0; 
    for ($i=1; $i<=$TotalR; $i++){
       $Sql="select SUM(denomina.nrohora) 'Total' from denomina,nomina
           where  nomina.consecutivo=denomina.consecutivo and
                  nomina.cedemple='$Cedula' and
                  denomina.codsala='$CodSalario[$i]' and
                  nomina.fechainicioc between '$FechaInicio' and '$FechaRetiro' group by nomina.cedemple";
        $Rs=mysql_query($Sql)or die("Error al buscar codigos de salarios");
        $fila=mysql_fetch_array($Rs);
        $TotalDiasDescontar += $fila["Total"];
    }
     $TotalDiasDescontar = round($TotalDiasDescontar/8);
  /*FIN CODIGO*/
  $ConR="select prestacion.cedemple from empleado,prestacion
        where  empleado.cedemple=prestacion.cedemple and
               empleado.cedemple='$Cedula' and
               prestacion.fechaini='$FechaInicio' and
               prestacion.fechacor='$FechaRetiro'";
    $ResR=mysql_query($ConR)or die("Error al buscar prestaciones");
    $RegiR=mysql_num_rows($ResR);
    if($RegiR==0):
      /*acrhivo para calcular la fecha de la prima*/
       $fechaInicio=date("d/m/Y",  strtotime($FechaPrima));
       $fechaActual = date("d/m/Y",  strtotime($FechaRetiro));
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
	 $mesesp = $mesActual - $mesInicio;
	 $diesp = $diaActual - $diaInicio;
	 }else{
	  if($mesActual == $mesInicio){
	  $anios = $anios - 1;
	  }
	  $mesesp = ($mesActual - $mesInicio - 1 + 12) % 12;
	  $diesp = $b-($diaInicio-$diaActual);
	  }
	  }else{
	  $anios = $anioActual - $anioInicio - 1;
	  if($diaInicio > $diaActual){
	  $mesesp = $mesActual - $mesInicio -1 +12;
	  $diesp = $b - ($diaInicio-$diaActual);
	  }else{
	  $mesesp = $mesActual - $mesInicio + 12;
	  $diesp = $diaActual - $diaInicio;
	  }
	  }
	  /*Resultados*/
           $TotalDP=($mesesp*30)+$diesp+1;
           $TotalDiaNetoA = $TotalDP - $TotalDiasDescontar;
          }
          if($TipoPago=='COMPLETO'):
	    	      $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
			      where empleado.cedemple=nomina.cedemple and
				    empleado.cedemple='$Cedula' and
				    nomina.fechainicioc >= '$InicioN' and
                                    nomina.hasta <= '$FinalNomina' group by empleado.cedemple";
		     $resuB=mysql_query($conB)or die ("Error en la consulta");
		     $FilasN=mysql_fetch_array($resuB);
		     $Devengado=$FilasN["ConPresta"];
                     if($Devengado==0 or $Devengado==''){
                        $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
			      where empleado.cedemple=nomina.cedemple and
				    empleado.cedemple='$Cedula' and
				    nomina.desde between '$InicioN' and '$FinalNomina' group by empleado.cedemple";
		        $resuB=mysql_query($conB)or die ("Error en la consulta");
		        $FilasN=mysql_fetch_array($resuB);
		       $Devengado=$FilasN["ConPresta"];
                    }
	             $fechaInicio=date("d/m/Y",  strtotime($FechaInicio));
		     $fechaActual = date("d/m/Y",  strtotime($FechaRetiro));
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
                         $TotalDiaNeto = $TotalD - $TotalDiasDescontar;
			}
	         $Ibc=round(($Devengado/$TotalD)*30);
	        	/*CONSULTA DE AUXILIO*/
	         include("../conexion.php");
		 $conA="select parametroauxilio.maximo,parametroauxilio.valor from parametroauxilio
		 where parametroauxilio.estado='ACTIVO'";
	 	 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
		 $Linea=mysql_fetch_array($resuA);
		 $AuxilioT=$Linea["valor"];
		 $Maximo=$Linea["maximo"];
	         $Datos = $_POST['ValidarPago'];
	         $N = count($Datos);
	         $Interes=0;$Cesantia=0;$Prima=0;$Vacacion=0;
	         if($N > 2):
		         for($i=0; $i < $N; $i++){
		           if($Validar=='Normal'):
		               if($Datos[$i]=='XCesantia'):
		  		  if($Salario <= $Maximo):
				    $Cesantia=round((($Ibc+$AuxilioT)*$TotalDiaNeto)/360);
		                  else:
		                    $Cesantia=round(($Ibc*$TotalDiaNeto)/360);
		                    $AuxilioT=0;
		                  endif;
		                else:
		                  if($Datos[$i]=='XInteres'):
		                      $Interes=round((($Cesantia * $TotalDiaNeto)*0.12)/360);
		                  else:
		                      if($Datos[$i]=='XPrima'):
                                         $IbcP=round(($Devengado/$TotalD)*30);
		                         if($Salario <= $Maximo):
		                            $Prima=round((($IbcP+$AuxilioT)*$TotalDiaNetoA)/360);
		                         else:
		                            $Prima=round(($IbcP*$TotalDiaNetoA)/360);
		                         endif;
		                      else:
		                          if($Datos[$i]=='XVacacion'):
		                             if($FechaVaca != $FechaInicio):
	                                        $Vacacion=0;
		                             else:
		                                if($Salario <= $Maximo):
					           $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Salario/30)*$Porce);
					        else:
				                     $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Salario/30)*$Porce);
						     $AuxilioT=0;
				                endif;
		                             endif;
		                          endif;
		                      endif;
		                  endif;
		               endif;
		           else:
		                if($Datos[$i]=='XCesantia'):
		  		  if($Salario <= $Maximo):
				    $Cesantia=round((($Ibc+$AuxilioT)*$TotalDiaNeto)/360);
		                  else:
		                    $Cesantia=round(($Ibc*$TotalDiaNeto)/360);
		                    $AuxilioT=0;
		                  endif;
		                else:
		                  if($Datos[$i]=='XInteres'):
		                      $Interes=round((($Cesantia * $TotalDiaNeto)*0.12)/360);
   	                          else:
		                      if($Datos[$i]=='XPrima'):
                                         $IbcP=round(($Devengado/$TotalD)*30);
		                         if($Salario <= $Maximo):
		                            $Prima=round((($IbcP+$AuxilioT)*$TotalDiaNetoA)/360);
		                         else:
		                            $Prima=round(($IbcP*$TotalDiaNetoA)/360);
		                         endif;
		                      else:
		                          if($Datos[$i]=='XVacacion'):
		                             if($FechaVaca != $FechaInicio):
	                                       $Vacacion=0;
		                             else:
		                                if($Salario <= $Maximo):
					           $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Ibc/30)*$Porce);
					        else:
				                     $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Ibc/30)*$Porce);
						     $AuxilioT=0;
				                endif;
		                             endif;
		                          endif;
		                      endif;
		                  endif;
		               endif;
		           endif;
		         }
	                  $TotalGenerado=($Cesantia + $Interes + $Prima + $Vacacion);
			 $TotalPagar=$TotalGenerado;
			 $Nota='JGEFECTIVOS S.A.S. "E.S.T.", QUEDA A PAZ Y SALVO CON EL PAGO DE SUS PRESTACIONES SOCIALES.';
			                         /*ARCHIVO DE GUARDADO*/
                        include("../conexion.php");
		        $consulta = "select count(*) from prestacion";
			$result = mysql_query ($consulta);
			$sw = mysql_fetch_row($result);
			if ($sw[0]>0):
			   $consulta = "select max(cast(nropresta as unsigned)) + 1  from prestacion";
			   $result = mysql_query ($consulta);
			   $codec = mysql_fetch_row($result);
			   $NroP = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
			else:
			    $NroP="000001";
			endif;
                       $Estado='ACTIVA';
		        $consulta="insert into prestacion(nropresta,cedemple,nombres,fechapro,fechaini,fechacor,ibc,Salario,dias,diareal,diapermiso,diasprima,auxilio,total,totalp,cesantia,interes,prima,vacacion,nota,codzona,control)
			  value('$NroP','$Cedula','$Nombre','$fechap','$FechaInicio','$FechaRetiro','$Ibc','$Salario','$TotalD','$TotalDiaNeto','$TotalDiasDescontar',$TotalDP,'$AuxilioT','$TotalGenerado','$TotalPagar','$Cesantia','$Interes','$Prima','$Vacacion','$Nota','$CodZona','$Estado')";
			$resultado=mysql_query($consulta) or die("Error al Grabar las prestaciones con el tiempo completo");
                        if($Activar=='No'){
		  	    echo ("<script language=\"javascript\">");
			    echo ("open (\"imprimirpresta.php?nropresta=$NroP\" ,\"\");");
			    echo ("</script>");
			    ?>
			     <script language="javascript">
			        open("listadocesantia.php","_self");
			     </script>
			    <?
                        }else{
                             header("location: CrearDeduccion.php?NroPrestacion=$NroP&Cedula=$Cedula");
                        }
	         else:
	            ?>
		    <script language="javascript">
		    alert ("Error al Seleccionar las cajas de Chequeo o esta opcion chequeada no  se hace por esta opción.!")
		    history.back()
		    </script>
		    <?
	         endif;
          else:
             $Aux= $Salario/30;
              $AuxiliarSala=round($Aux * $NroDias);
               $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
			      where empleado.cedemple=nomina.cedemple and
				    empleado.cedemple='$Cedula' and
				    nomina.fechainicioc >= '$InicioN' and
                                    nomina.hasta <= '$FinalNomina' group by empleado.cedemple";
		     $resuB=mysql_query($conB)or die ("Error en la consulta");
		     $FilasN=mysql_fetch_array($resuB);
		     $Todo=$FilasN["ConPresta"];
                     $Devengado=$Todo + $AuxiliarSala;
                     if($Todo==0 or $Todo==''){
                        $conB="select SUM(nomina.presta)'ConPresta' from nomina,empleado
			      where empleado.cedemple=nomina.cedemple and
				    empleado.cedemple='$Cedula' and
		      		    nomina.desde between '$InicioN' and '$FinalNomina' group by empleado.cedemple";
		        $resuB=mysql_query($conB)or die ("Error en la consulta");
		        $FilasN=mysql_fetch_array($resuB);
		        $Todo=$FilasN["ConPresta"];
                       $Devengado=$Todo + $AuxiliarSala;
                     }
	             $fechaInicio=date("d/m/Y",  strtotime($FechaInicio));
		     $fechaActual = date("d/m/Y",  strtotime($FechaRetiro));
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
                          $TotalDiaNeto = $TotalD - $TotalDiasDescontar;
			}
	         $Ibc=round(($Devengado/$TotalD)*30);
	        	/*CONSULTA DE AUXILIO*/
	         include("../conexion.php");
		 $conA="select parametroauxilio.maximo,parametroauxilio.valor from parametroauxilio
		 where parametroauxilio.estado='ACTIVO'";
	 	 $resuA=mysql_query($conA)or die ("Error en la consulta de auxilio");
		 $Linea=mysql_fetch_array($resuA);
		 $AuxilioT=$Linea["valor"];
		 $Maximo=$Linea["maximo"];
	         $Datos = $_POST['ValidarPago'];
	         $N = count($Datos);
	         $Interes=0;$Cesantia=0;$Prima=0;$Vacacion=0;
	         if($N > 2):
		         for($i=0; $i < $N; $i++){
		           if($Validar=='Normal'):
		               if($Datos[$i]=='XCesantia'):
		  		  if($Salario <= $Maximo):
				    $Cesantia=round((($Ibc+$AuxilioT)*$TotalDiaNeto)/360);
		                  else:
		                    $Cesantia=round(($Ibc*$TotalD)/360);
		                    $AuxilioT=0;
		                  endif;
		                else:
		                  if($Datos[$i]=='XInteres'):
		                      $Interes=round((($Cesantia * $TotalDiaNeto)*0.12)/360);
		                  else:
		                      if($Datos[$i]=='XPrima'):
                                         $IbcP=round(($Devengado/$TotalD)*30);
		                         if($Salario <= $Maximo):
		                            $Prima=round((($IbcP+$AuxilioT)*$TotalDiaNetoA)/360);
		                         else:
		                            $Prima=round(($IbcP*$TotalDiaNetoA)/360);
		                         endif;
		                      else:
		                          if($Datos[$i]=='XVacacion'):
		                             if($FechaVaca != $FechaInicio):
	                                        $Vacacion=0;
		                             else:
		                                if($Salario <= $Maximo):
					           $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Salario/30)*$Porce);
					        else:
				                     $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Salario/30)*$Porce);
						     $AuxilioT=0;
				                endif;
		                             endif;
		                          endif;
		                      endif;
		                  endif;
		               endif;
		           else:
		                if($Datos[$i]=='XCesantia'):
		  		  if($Salario <= $Maximo):
				    $Cesantia=round((($Ibc+$AuxilioT)*$TotalDiaNeto)/360);
		                  else:
		                    $Cesantia=round(($Ibc*$TotalDiaNeto)/360);
		                    $AuxilioT=0;
		                  endif;
		                else:
		                  if($Datos[$i]=='XInteres'):
		                      $Interes=round((($Cesantia * $TotalDiaNeto)*0.12)/360);
   	                          else:
		                      if($Datos[$i]=='XPrima'):
                                         $IbcP=round(($Devengado/$TotalD)*30);
		                         if($Salario <= $Maximo):
		                            $Prima=round((($IbcP+$AuxilioT)*$TotalDiaNetoA)/360);
		                         else:
		                            $Prima=round(($IbcP*$TotalDiaNetoA)/360);
		                         endif;
		                      else:
		                          if($Datos[$i]=='XVacacion'):
		                             if($FechaVaca != $FechaInicio):
	                                       $Vacacion=0;
		                             else:
		                                if($Salario <= $Maximo):
					           $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Ibc/30)*$Porce);
					        else:
				                     $Porce = ($TotalD * 15)/360;
						     $Vacacion=round(($Ibc/30)*$Porce);
						     $AuxilioT=0;
				                endif;
		                             endif;
		                          endif;
		                      endif;
		                  endif;
		               endif;
		           endif;
		         }
	                  $TotalGenerado=($Cesantia + $Interes + $Prima + $Vacacion);
		       	 $TotalPagar=$TotalGenerado;
			 $Nota='JGEFECTIVOS S.A.S. "E.S.T.", QUEDA A PAZ Y SALVO CON EL PAGO DE SUS PRESTACIONES SOCIALES.';
			                         /*ARCHIVO DE GUARDADO*/
		      $consulta = "select count(*) from prestacion";
			$result = mysql_query ($consulta);
			$sw = mysql_fetch_row($result);
			if ($sw[0]>0):
			   $consulta = "select max(cast(nropresta as unsigned)) + 1  from prestacion";
			   $result = mysql_query ($consulta);
			   $codec = mysql_fetch_row($result);
			   $NroP = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
			else:
			    $NroP="000001";
			endif;
			$Estado='ACTIVA';
		       $consulta="insert into prestacion(nropresta,cedemple,nombres,fechapro,fechaini,fechacor,ibc,Salario,dias,diareal,diapermiso,diasprima,auxilio,total,totalp,cesantia,interes,prima,vacacion,nota,codzona,control)
			  value('$NroP','$Cedula','$Nombre','$fechap','$FechaInicio','$FechaRetiro','$Ibc','$Salario','$TotalD','$TotalDiaNeto','$TotalDiasDescontar','$TotalDP','$AuxilioT','$TotalGenerado','$TotalPagar','$Cesantia','$Interes','$Prima','$Vacacion','$Nota','$CodZona','$Estado')";
			$resultado=mysql_query($consulta) or die("Error al Grabar las prestaciones con deducciones");
                        if($Activar=='No'){
		  	    echo ("<script language=\"javascript\">");
			    echo ("open (\"imprimirpresta.php?nropresta=$NroP\" ,\"\");");
			    echo ("</script>");
			    ?>
			     <script language="javascript">
			        open("listadocesantia.php","_self");
			     </script>
			    <?
                        }else{
                             header("location: CrearDeduccion.php?NroPrestacion=$NroP&Cedula=$Cedula");
                        }
	         else:
	            ?>
		    <script language="javascript">
		    alert ("Error al Seleccionar las cajas de Chequeo o esta opcion chequeada no  se hace por esta opción.!")
		    history.back()
		    </script>
		    <?
	         endif;
          endif;
     else:
         ?>
	    <script language="javascript">
	    alert ("Ya se le generó las prestaciones al señor(a): <?echo $Nombre;?>.!")
	    history.back()
	    </script>
	    <?
     endif;

endif;
?>

