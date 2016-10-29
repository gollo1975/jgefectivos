<?
if(empty($tipo)):
     ?>
       <script language="javascript">
         alert("Seleccione el tipo de incapacidad")
         history.back()
       </script>
       <?
      elseif(empty($estado)):
     ?>
       <script language="javascript">
         alert("Debe digitar el estado de la Incapacidad")
         history.back()
       </script>
         <?
         elseif(empty($CodSala)):
     ?>
       <script language="javascript">
         alert("Debe de seleccionar el Código del salario para el pago.!")
         history.back()
       </script>
         <?
	  elseif(empty($Reconocer)):
     ?>
       <script language="javascript">
         alert("Debe de seleccionar el tipo de reconocimiento de esta incapacidad a la empresa Usuaria.!")
         history.back()
       </script>
         <?	 
      elseif(empty($diagnostico)):
     ?>
       <script language="javascript">
         alert("Debe seleccionar el diagnóstico de la incapacidad")
         history.back()
       </script>

     <?
     else:
        include("../conexion.php");
       /*CODIGO QUE BUSCA EN CONCEPTO DE INCAPACIDAD*/
        $Slq="select tipoinca.concepto from tipoinca
                  WHERE tipoinca.tipoinca='$tipo'";
        $Rs=mysql_query($Slq) or die ("Error al validar tipo incapacidad");
        $FilaS=mysql_fetch_array($Rs);
        $Concepto = $FilaS["concepto"];
		$SlqC="select centro.codcentro from centro
                  WHERE centro.cedemple='$cedula'";
        $RsC=mysql_query($SlqC) or die ("Error al validar tipo incapacidad");
        $FilaC=mysql_fetch_array($RsC);
        $CodCentro = $FilaC["codcentro"];
       /*FINCODIGO*/
	   $FechaFinalIncapacidad = $fechater;
	   $Dias = strtotime($fechater)- strtotime($fechaini);
       $Diferencia_dias=intval($Dias/60/60/24) +1 ;
       /*CODIFGO QUE VALIDA EL VALOR DE INCAPACIDAD*/
        $AuxiliarDia = 0; $AuxiliarDiaMenor = 0; $TotalDiaReconocido = 0; $TotalDiaAsumidoUsuaria = 0; $TotalDiaAsumidoTemporal = 0; $ValorPagoAsumido = 0; $ValorPagoUsuaria = 0; $ValorPagoTemporal = 0;
        $SlqSalario="select parametroauxilio.maximo,parametroauxilio.minimo,parametroauxilio.porcentajepago,parametroauxilio.dialeyeps,parametroauxilio.dialeylicencia,parametroauxilio.dialeyarl from parametroauxilio
                  WHERE parametroauxilio.estado='ACTIVO'";
        $RsSalario=mysql_query($SlqSalario) or die ("Error al validar el maximo salario para la incapacidad");
        $FilaSalario=mysql_fetch_array($RsSalario);
        $Maximo = $FilaSalario["maximo"];
        $Minimo = $FilaSalario["minimo"];
        $DiaPagoEps = $FilaSalario["dialeyeps"];
        $DiaPagoLicencia = $FilaSalario["dialeylicencia"];
        $DiaPagoArl = $FilaSalario["dialeyarl"];
        $ValorPorcentaje = $FilaSalario["porcentajepago"];
        if($tipo=='1020'|| $tipo=='1030'){
               if ($Salario > $Maximo){
                    if($Diferencia_dias > $DiaPagoEps){
                        $TotalDiaReconocido = $Diferencia_dias - $DiaPagoEps;
                        $AuxiliarDia = round($Salario/30);
                        $ValorPagoTemporal = round((($AuxiliarDia * $ValorPorcentaje)/100)*$TotalDiaReconocido);
                        $ValorPagoUsuaria = round((($AuxiliarDia * $ValorPorcentaje)/100)*$DiaPagoEps);
                        $TotalDiaAsumidoTemporal = $TotalDiaReconocido;
                        $TotalDiaAsumidoUsuaria = $DiaPagoEps;
                     }else{
                          $AuxiliarDia = round($Salario/30);
                          $ValorPagoTemporal = 0;
                          $ValorPagoUsuaria = round((($AuxiliarDia * $ValorPorcentaje)/100)*$Diferencia_dias);
                          $TotalDiaAsumidoTemporal = 0;
                          $TotalDiaAsumidoUsuaria = $Diferencia_dias;
                     }
               }else{
                      $TotalDiaReconocido = $Diferencia_dias - $DiaPagoEps;
                     if($Diferencia_dias > $DiaPagoEps){
                          $AuxiliarDia = round($Minimo/30);
                          $ValorPagoTemporal = round($AuxiliarDia * $TotalDiaReconocido);
                          $ValorPagoUsuaria = round($AuxiliarDia * $DiaPagoEps);
                          $TotalDiaAsumidoTemporal = $TotalDiaReconocido;
                          $TotalDiaAsumidoUsuaria = $DiaPagoEps;
                     }else{
                          $AuxiliarDia = round($Minimo/30);
                          $ValorPagoTemporal = round($AuxiliarDia * $TotalDiaReconocido);
                          $ValorPagoUsuaria = round($AuxiliarDia * $DiaPagoEps);
                          $TotalDiaAsumidoTemporal = 0;
                          $TotalDiaAsumidoUsuaria = $Diferencia_dias;
                     }
               }
       }
       if($tipo=='1040'|| $tipo=='1050'){
           $AuxiliarDia = round($Salario/30);
           $ValorPagoTemporal = round($AuxiliarDia * $Diferencia_dias);
           $ValorPagoUsuaria = 0;
           $TotalDiaAsumidoUsuaria = 0;
           $TotalDiaAsumidoTemporal = $Diferencia_dias;
       }
       if($tipo=='1010'){
           if($Diferencia_dias <= $DiaPagoArl){
               $AuxiliarDia = round($Salario/30);
               $ValorPagoTemporal = 0;
               $ValorPagoUsuaria = round($AuxiliarDia * $Diferencia_dias);
               $TotalDiaAsumidoUsuaria = $Diferencia_dias;
               $TotalDiaAsumidoTemporal = 0;
           }else{
              $TotalDiaReconocido = $Diferencia_dias - $DiaPagoArl;
               $AuxiliarDia = round($Salario/30);
               $ValorPagoTemporal = round($AuxiliarDia * $TotalDiaReconocido);
               $ValorPagoUsuaria = round($AuxiliarDia * $DiaPagoArl);
               $TotalDiaAsumidoUsuaria = $DiaPagoArl;
               $TotalDiaAsumidoTemporal = $TotalDiaReconocido;
           }
       }
       /*FIN DE CODIGO*/
         $FechaFinal =  strtotime ( '+ 27 day' , strtotime ( $FechaIncial ) ) ;
         $FechaFinalValidada = date ( 'Y-m-d' , $FechaFinal );
         if ($Reconocer=='SI'){
             if($fechaini  >= $FechaFinalValidada){
                 if($tipo != '1030' AND $Concepto != 'ACCIDENTE DE TRANSITO'){
                      if($estado != 'EN TRANSCRIPCION'){
	                       include("../conexion.php");
		               $estado=strtoupper($estado);
		               $motivo=strtoupper($motivo);
			       $consulta="select * from incapacidad where nroinca='$nroinca' and codeps='$codeps'";
			       $resultado=mysql_query($consulta)or die("Error al validar el codigo de EPS.!");
			       $registro=mysql_num_rows($resultado);
			       if ($registro==0){
				         $consulta="insert into incapacidad(nroinca,fechaini,fechater,dias,diastemporal,diasusuaria,diasnomina,prorroga,tipoinca,codeps,cedemple,estado,codigo,codzona,fechapro,codsala,reconocerusuaria,motivo,salario,valortemporal,valorusuaria,usuario)
				         values('$nroinca','$fechaini','$FechaFinalIncapacidad','$Diferencia_dias','$TotalDiaAsumidoTemporal','$TotalDiaAsumidoUsuaria','$Diferencia_dias','$prorroga','$tipo','$codeps','$cedula','$estado','$diagnostico','$CodZona','$fechapro','$CodSala','$Reconocer','$motivo','$Salario','$ValorPagoTemporal','$ValorPagoUsuaria','$codigo')";
				         $resultado=mysql_query($consulta)or die("Error al grabar incapacidad 1030");
						 $Sql="select decentro.codsala,centro.codcentro from decentro,centro
 						 WHERE centro.codcentro=decentro.codcentro and
						       centro.cedemple='$cedula' and
							   decentro.codsala='$CodSala'";
						$Rs=mysql_query($Sql)or die("error al buscar codigos de salario en la tabla decentro.");	
						if(mysql_num_rows($Rs) == 0){
								$SqlA="select salario.* from salario,centro
									   WHERE salario.codsala='$CodSala' and
											 salario.estado='ACTIVO'";
								$Ra=mysql_query($SqlA) or die("error al buscar codigos de salario en la tabla.");
								if(mysql_num_rows($Ra)> 0){
									$VlrSalario = 0;
									$AuxS = 0;
									if($Salario <= 1034182){
									   if($CodSala==12){
										  $VlrSalario = round((689455/30)/8);
									   }
									}else{
										$AuxS = round(($Salario/30)/8);
										$VlrSalario = round(($AuxS * 66.67)/100);
									}
									if($CodSala==13){
									    $VlrSalario = round(($Salario/30)/8);
									}   
										
									$Insertar="insert into decentro(codcentro,codsala,descripcion,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion,estado,datos,activo,permanente,agrupado) select '$CodCentro', codsala,desala,
											   '$VlrSalario',0,0,'SI','VARIABLE',porcentaje,0,'SI','NO','SI','NO','SI' FROM salario WHERE salario.codsala='$CodSala'";
									$RsInsertar=mysql_query($Insertar) or die("Error al insertar los datos");
						 	    }
						}
				         echo "<script language=\"javascript\">";
				         echo "open (\"../pie.php?msg=Se Grabo registros de la Incapacidad Nro: $nroinca\",\"pie\");";
				         echo "open(\"agregar.php?codigo=$codigo\",\"_self\");";
				         echo "</script>";
			       }else{
				    ?>
				         <script language="javascript">
				         alert("Este Número de incapacidad ya existe en esta EPS, Favor verificar.!")
				         history.back()
			                </script>
			            <?
			      }
                       }else{
	                   ?>
		             <script language="javascript">
		               alert("Nota Importante: Las incapacidades EN TRANSCRIPCION NO generan reconocimiento a las Empresas Usuarias. Tener presente esta validacion.!")
	  	               history.back()
	  	             </script>
	                   <?
	               }
	         }else{
	                   ?>
		             <script language="javascript">
		               alert("Nota Importante: Las incapacidades por Accidente de transito, NO generan reconocimiento a las Empresas Usuarias. Tener presente esta validacion.!")
	  	               history.back()
	  	             </script>
	                   <?
	         }

	     }else{
                   if($tipo == '1010' || $tipo == '1050'){
                       include("../conexion.php");
	               $estado=strtoupper($estado);
	               $motivo=strtoupper($motivo);
		       $consulta="select * from incapacidad where nroinca='$nroinca' and codeps='$codeps'";
		       $resultado=mysql_query($consulta)or die("Error al validar el codigo de EPS.!");
		       $registro=mysql_num_rows($resultado);
		       if ($registro==0){
			          $consulta="insert into incapacidad(nroinca,fechaini,fechater,dias,diastemporal,diasusuaria,diasnomina,prorroga,tipoinca,codeps,cedemple,estado,codigo,codzona,fechapro,codsala,reconocerusuaria,motivo,salario,valortemporal,valorusuaria,usuario)
			         values('$nroinca','$fechaini','$FechaFinalIncapacidad','$Diferencia_dias','$TotalDiaAsumidoTemporal','$TotalDiaAsumidoUsuaria','$Diferencia_dias','$prorroga','$tipo','$codeps','$cedula','$estado','$diagnostico','$CodZona','$fechapro','$CodSala','$Reconocer','$motivo','$Salario','$ValorPagoIncapacidad','$ValorPagoAsumido','$codigo')";
			         $resultado=mysql_query($consulta)or die("Error al grabar incapacidad de 1010 o 2050");
					 $Sql="select decentro.codsala,centro.codcentro from decentro,centro
 						 WHERE centro.codcentro=decentro.codcentro and
						       centro.cedemple='$cedula' and
							   decentro.codsala='$CodSala'";
					$Rs=mysql_query($Sql)or die("error al buscar codigos de salario en la tabla decentro.");	
					if(mysql_num_rows($Rs) == 0){
						$SqlA="select salario.* from salario,centro
							   WHERE salario.codsala='$CodSala' and
									 salario.estado='ACTIVO'";
						$Ra=mysql_query($SqlA) or die("error al buscar codigos de salario en la tabla.");
						if(mysql_num_rows($Ra)> 0){
							$VlrSalario = 0;
							$AuxS = 0;
							if($Salario <= 1034182){
							   if($CodSala==12){
								  $VlrSalario = round((689455/30)/8);
							   }
							}else{
								$AuxS = round(($Salario/30)/8);
								$VlrSalario = round(($AuxS * 66.67)/100);
							}
							if($CodSala==13){
							    $VlrSalario = round(($Salario/30)/8);
							}   
								
							$Insertar="insert into decentro(codcentro,codsala,descripcion,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion,estado,datos,activo,permanente,agrupado) select '$CodCentro', codsala,desala,
									   '$VlrSalario',0,0,'SI','VARIABLE',porcentaje,0,'SI','NO','SI','NO','SI' FROM salario WHERE salario.codsala='$CodSala'";
							$RsInsertar=mysql_query($Insertar) or die("Error al insertar los datos");
						}
					}
			         echo "<script language=\"javascript\">";
			         //echo "open (\"../pie.php?msg=Se Grabo registros de la Incapacidad Nro: $nroinca\",\"pie\");";
			         //echo "open(\"agregar.php?codigo=$codigo\",\"_self\");";
			         echo "</script>";
		       }else{
			    ?>
			         <script language="javascript">
			         alert("Este Número de incapacidad ya existe en esta EPS, Favor verificar.!")
			         history.back()
		                </script>
		            <?
		       }
                   }else{
	                 ?>
		         <script language="javascript">
		             alert("Nota Importante: Las incapacidades por Enfermedad general o Accidente de transito donde el Empleado este en periodo de urgencia, NO generan reconocimiento a las Empresas Usuarias. Cambiar el reconocimiento.!")
		             history.back()
		         </script>
                         <?
                   }
             }
         }else{
                include("../conexion.php");
                $estado=strtoupper($estado);
	        $motivo=strtoupper($motivo);
                $consulta="select * from incapacidad where nroinca='$nroinca' and codeps='$codeps'";
	        $resultado=mysql_query($consulta)or die("error al validar el codigo de EPS");
	        $registro=mysql_num_rows($resultado);
	       if ($registro==0){
		     $consulta="insert into incapacidad(nroinca,fechaini,fechater,dias,diastemporal,diasusuaria,diasnomina,prorroga,tipoinca,codeps,cedemple,estado,codigo,codzona,fechapro,codsala,reconocerusuaria,motivo,salario,valortemporal,valorusuaria,usuario)
		                values('$nroinca','$fechaini','$FechaFinalIncapacidad','$Diferencia_dias','$TotalDiaAsumidoTemporal','$TotalDiaAsumidoUsuaria','$Diferencia_dias','$prorroga','$tipo','$codeps','$cedula','$estado','$diagnostico','$CodZona','$fechapro','$CodSala','$Reconocer','$motivo','$Salario','$ValorPagoIncapacidad','$ValorPagoAsumido','$codigo')";
		    $resultado=mysql_query($consulta)or die("Error al grabar incapacidad 1040");
			$Sql="select decentro.codsala,centro.codcentro from decentro,centro
 						 WHERE centro.codcentro=decentro.codcentro and
						       centro.cedemple='$cedula' and
							   decentro.codsala='$CodSala'";
			$Rs=mysql_query($Sql)or die("error al buscar codigos de salario en la tabla decentro.");	
			if(mysql_num_rows($Rs) == 0){
				$SqlA="select salario.* from salario,centro
					   WHERE salario.codsala='$CodSala' and
							 salario.estado='ACTIVO'";
				$Ra=mysql_query($SqlA) or die("error al buscar codigos de salario en la tabla.");
				if(mysql_num_rows($Ra)> 0){
					$VlrSalario = 0;
					$AuxS = 0;
					if($Salario <= 1034182){
					   if($CodSala==12){
						  $VlrSalario = round((689455/30)/8);
					   }
					}else{
						$AuxS = round(($Salario/30)/8);
						$VlrSalario = round(($AuxS * 66.67)/100);
					}
					if($CodSala==13){
					   $VlrSalario = round(($Salario/30)/8);
					}   
						
					$Insertar="insert into decentro(codcentro,codsala,descripcion,vlrhora,nrohora,salario,prestacion,variacion,porcentaje,deduccion,estado,datos,activo,permanente,agrupado) select '$CodCentro', codsala,desala,
							   '$VlrSalario',0,0,'SI','VARIABLE',porcentaje,0,'SI','NO','SI','NO','SI' FROM salario WHERE salario.codsala='$CodSala'";
					$RsInsertar=mysql_query($Insertar) or die("Error al insertar los datos");
				}
			}
		     echo "<script language=\"javascript\">";
		    echo "open (\"../pie.php?msg=Se Grabo registros de la Incapacidad Nro: $nroinca\",\"pie\");";
		    echo "open(\"agregar.php?codigo=$codigo\",\"_self\");";
		     echo "</script>";
		}else{
		         ?>
		         <script language="javascript">
		         alert("Este Número de incapacidad ya existe en esta EPS, Favor verificar.!")
		        history.back()
		       </script>
		     <?
	        }
         }
endif;
