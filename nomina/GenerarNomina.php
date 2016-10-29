<html>

<head>
  <title></title>
</head>
<body>
<?
if(empty($datoN)):
   ?>
   <script language="javascript">
      alert("Debe de chequear todas las cajas de verificacion!")
      history.back()
   </script>
   <?
else:

$FechaP=date("Y-m-d");
    include("../conexion.php");
    for ($k=1 ; $k<=$TotalV; $k ++):
        /*codigo de busquda para validar si la nomina ya esta hecha.*/
         $conE="select empleado.periodo,empleado.basico,empleado.vlrpagado,empleado.tiempo from empleado
         where empleado.cedemple='$datoN[$k]'";
         $resuE=mysql_query($conE)or die ("Error al validar la Empleado");
         $filas_E=mysql_fetch_array($resuE);
         $Basico=$filas_E["basico"];
         $Periodo=$filas_E["periodo"];
         $VlrPeriodo=$filas_E["vlrpagado"];
         $TiempoL=$filas_E["tiempo"];
         /*cogido de validacion de Nomina*/
         $conN="select nomina.desde from empleado,nomina,zona,periodo
         where zona.codzona=periodo.codzona and
         periodo.codigo=nomina.codigo and
         nomina.cedemple='$datoN[$k]' and
         nomina.desde='$desde' and
         nomina.hasta='$hasta' and
         zona.codzona='$codzona'";
         $resuN=mysql_query($conN)or die ("Error al validar la nomina");
         $regN=mysql_num_rows($resuN);
         if($regN==0):
	         /*Graba cabezto de la nomina*/
	        $estado='ABIERTO';
	        $consulta = "select count(*) from nomina";
	        $result = mysql_query ($consulta);
	        $sw1 = mysql_fetch_row($result);
	        if ($sw1[0]>0):
	           $consult1 = "select max(cast(consecutivo as unsigned)) + 1  from nomina";
	           $result1 = mysql_query ($consult1);
	            $codec = mysql_fetch_row($result1);
	           $code = str_pad($codec[0], 10,"0", STR_PAD_LEFT);
	        else:
	          $code="0000000001";
	        endif;
	       $consulta="insert into nomina(consecutivo,codigo,cedemple,fechap,fechainicioc,desde,hasta,devengado,deduccion,neto,presta,periodo,basico,pagado,tiempo,horap,estado,usuario,codzona)
	         values('$code','$CodPeriodo','$datoN[$k]','$FechaP','$FechaIniCont[$k]','$desde','$hasta','$devengado','$dedu','$neto','$presta','$Periodo','$Basico','$VlrPeriodo','$TiempoL','$FechaHora','$estado','$Auxiliar','$codzona')";
	         $resulta=mysql_query($consulta)or die("Error al grabar Nomina");
	         /*codigo de busquda para validar si hay novedades en el sistema.*/
                 $conP="select denovedanomina.* from novedadnomina,denovedanomina,zona
                 where zona.codzona=novedadnomina.codzona and
					 zona.codzona='$codzona' and
					 novedadnomina.cedemple='$datoN[$k]' and
					 novedadnomina.desde='$desde' and
					 novedadnomina.hasta='$hasta' and
					 novedadnomina.codnovedad=denovedanomina.codnovedad";
                 $resuP=mysql_query($conP)or die ("Error al validar las novedades");
                 $regP=mysql_num_rows($resuP);
                 if($regP==0):
                     /*CODIGO SI NO HAY NOVEDADES*/
		     $Other = 'NO';
                     $ConI = "insert into denomina (consecutivo, codsala,descripcion,vlrhora,nrohora,salario,porcentaje,deduccion,prestacion,validaribc) select '$code',codsala,descripcion,vlrhora,nrohora,salario,porcentaje,deduccion,prestacion,'$Other'
					 from decentro,centro where decentro.codcentro=centro.codcentro and centro.cedemple='$datoN[$k]'and decentro.activo='SI' and decentro.permanente='SI'";
                     $ResI= mysql_query ($ConI)or die("Error al insertar datos en la tabla denomina");
		 else:
                     /*ESTE CODIGO PERMITE MOSTRAR SI HAY NOVEDADES*/
                     while($filas=mysql_fetch_array($resuP)):
				$Concepto=$filas["concepto"];$VlrHora=$filas["vlrhora"];$NroHora=$filas["nrohora"];$CodSalario=$filas["codsala"];
				$Salario=$filas["salario"];$Porcentaje=$filas["porcentaje"];$Deduccion=$filas["deduccion"];$Prestacion=$filas["prestacion"]; $IbcP = $filas["ibcprestacional"];
				/*codigo que busca el campo ibcprestacional*/
				$conC="select salario.ibcprestacional,salario.codsala from salario
				where salario.codsala='$CodSalario'";
				$resC=mysql_query($conC)or die ("Error de consulta la tabla salario");
				$filasC=mysql_fetch_array($resC);
				$CodSalaP = $filasC["ibcprestacional"];
				$CodigoIbc = $filasC["codsala"];
					/*fin codigo*/
		                if($CodSalaP == 'NO'){
					 $con="insert into denomina(consecutivo,codsala,descripcion,vlrhora,nrohora,salario,porcentaje,deduccion,prestacion,validaribc)
			                 values('$code','$CodSalario','$Concepto','$VlrHora','$NroHora','$Salario','$Porcentaje','$Deduccion','$Prestacion','NO')";
			                 $resulta=mysql_query($con)or die("Error al grabar detallado de Nomina");
			                 $regis=mysql_affected_rows();
				}else{
			    		$con="insert into denomina(consecutivo,codsala,descripcion,vlrhora,nrohora,porcentaje,deduccion,prestacion,ibcprestacional,validaribc)
			                values('$code','$CodSalario','$Concepto','$VlrHora','$NroHora','$Porcentaje','$Deduccion','$Prestacion','$IbcP','SI')";
			                $resulta=mysql_query($con)or die("Error al grabar detallado de Nomina");
			                $regis=mysql_affected_rows();
				}
                               /*consulta de detalle*/
                     endwhile;
                     /*codigo de inserccion*/
                     $ConT = "select centro.codcentro,centro.cedemple, decentro.codsala from centro,empleado,decentro,denomina where empleado.cedemple=centro.cedemple and decentro.codcentro=centro.codcentro and empleado.cedemple='$datoN[$k]' and denomina.consecutivo = '$code' and denomina.codsala = decentro.codsala";
                     $Resu=mysql_query ($ConT)or die("Error de datos");
                     $respuesta = "";
                     $registros = mysql_num_rows ($Resu);
                     for ($i = 0; $i < $registros; $i++)  {
			   if ($i > 0)
				  $respuesta .= ",";
				  $datos = mysql_fetch_array($Resu);
				  $codcentro =  $datos ["codcentro"];
				  $codsala =  $datos ["codsala"];
				  $respuesta .= "'" . $codsala . "'";
		  	  }
				$datoV = 'NO';
				$ConI = "insert into denomina (consecutivo, codsala,descripcion,vlrhora,nrohora,salario,porcentaje,deduccion,prestacion,validaribc) select '$code', codsala,descripcion,vlrhora,nrohora,salario,porcentaje,deduccion,prestacion,'$datoV'
							from decentro where codcentro = $codcentro and codsala not in ($respuesta) and decentro.activo='SI' and decentro.permanente='SI'";
					$ResI= mysql_query ($ConI)or die("Error de datos");
			  endif;
                /*codigo de actualizacion*/
                $conA="select denomina.* from denomina,nomina
                 where nomina.consecutivo=denomina.consecutivo and
                    nomina.consecutivo='$code'";
                  $resuN=mysql_query($conA)or die ("Error al validar las actualizaciones");
                 $SumaTH=0;
                 $ConHora=0;
                 $ConValor=0;
                  while($filas_A=mysql_fetch_array($resuN)):
                      $Codigo= $filas_A["codsala"];
                      $ConHora=$filas_A["vlrhora"];
                      $ConValor=$filas_A["nrohora"];
                      $Dcto= $filas_A["deduccion"];
                      $ConS=$filas_A["salario"];
		      $DatoI = $filas_A["validaribc"];
                      if($ConS==0){
			   if($DatoI=='NO'){
                               $SumaTH=round($ConHora*$ConValor);
                               $conT="update denomina set salario='$SumaTH' where consecutivo='$code' and codsala='$Codigo'";
                               $resuT=mysql_query($conT)or die ("Error al actualizar");
			   }
                      }
                      /*CODIGO PARA CARGAR CREDITOS*/
                      $con="select parametro.codigo,parametro.nivel from parametro where parametro.codigo='$Codigo'and parametro.estado='ACTIVO'";
	      	      $resup=mysql_query($con)or die("Error al buscar parametros");
                      $regis=mysql_num_rows($resup);
     	              $filas_s=mysql_fetch_array($resup);
                      $nivel=$filas_s["nivel"];
                      if($regis!=0 and $nivel==1):
                         $con_C="select credito.nuevo,credito.codsala,credito.nrocredito from credito where credito.cedemple='$datoN[$k]' and credito.nuevo > 0 and credito.codsala='$Codigo'";
		         $resu_C=mysql_query($con_C)or die("Error al buscar Creditos");
		         $reg_C=mysql_num_rows($resu_C);
		         $filas_C=mysql_fetch_array($resu_C);
		         $aux_C=$filas_C["nrocredito"];
		         $aux_P=$filas_C["nuevo"];
                         if($reg_C != 0):
		            $auxM=$Dcto * (-1);
		           $calculo=$aux_P-$auxM;
		            $consulta = "select count(*) from abono";
		            $result = mysql_query ($consulta);
		            $sw = mysql_fetch_row($result);
			    if ($sw[0] > 0):
			          $consulta1 = "select max(cast(codabono as unsigned)) + 1 from abono";
				  $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta de los abonos");
				  $codc = mysql_fetch_row($result1);
				  $codA= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
			    else:
			         $codA="000001";
			    endif;
                              $nota='POR MEDIO DEL SISTEMA DE NOMINA';
			     $fechaR=date("Y-m-d");
			      $consul="insert into abono(codabono,cedemple,nrocredito,nuevo,abono,fecha,nota)
			      values('$codA','$datoN[$k]','$aux_C','$calculo','$auxM','$fechaR','$nota')";
			      $res=mysql_query($consul)or die("Error al Grabar en la tabla Abono");
			      $actualiza="update credito set nuevo='$calculo' where credito.nrocredito='$aux_C'";
			      $resulta=mysql_query($actualiza) or die("Error al actualizar los datos del credito");
			      $regis=mysql_affected_rows();
                             //actualizar tabla detallecentro
                              if ($calculo <=0){
				       $ss = "update decentro set deduccion = '0',datos = 'NO',permanente = 'NO' where codsala = '$Codigo' and codcentro = (select codcentro from centro where cedemple='$datoN[$k]')";
				       $rr = mysql_query($ss)or die ("Error al actualizar la informacion.");
			      }
									//actualizar tabla detallecentro
                         endif;
                      else:
                          if($regis!=0 and $nivel==2):
                             $consul = "select count(*) from consignacion";
		             $result = mysql_query ($consul);
		             $sw = mysql_fetch_row($result);
	                     $auxva=$deduccion[$k] * (-1);
		             if ($sw[0] > 0):
	                        $consulta1 = "select max(cast(nrocon as unsigned)) + 1 from consignacion";
	                        $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
		                $codc = mysql_fetch_row($result1);
		                $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
	                     else:
	                        $codca='00001';
	                     endif;
	                     $consul="insert into consignacion(nrocon,cedemple,codbanco,fechapro,fechapago,valor)
		             values('$codca','$datoN[$k]','$codbanco','$fechap','$fechap','$auxva')";
		             $res=mysql_query($consul)or die("Error al grabar aportes ");
                          else:
                              if($regis!=0 and $nivel==3):
		                       $fechaR=date("Y-m-d");
			               $con_M="select mercado.nsaldo,mercado.codmerca from mercado where mercado.cedemple='$datoN[$k]' and mercado.nsaldo > 0 and mercado.codsala='$Codigo'";
				       $resu_M=mysql_query($con_M)or die("Error al buscar Mercados");
			               $reg_M=mysql_num_rows($resu_M);
			               $filas_M=mysql_fetch_array($resu_M);
				       $aux_M=$filas_M["codmerca"];
			               $aux_S=$filas_M["nsaldo"];
			               if($reg_M != 0):
			                  $auxM=$Dcto * (-1);
			                  $calculoM=$aux_S-$auxM;
			                  $consulta = "select count(*) from debitomercado";
					   $result = mysql_query ($consulta);
					   $sw = mysql_fetch_row($result);
					   if ($sw[0] > 0):
					      $consulta1 = "select max(cast(numero as unsigned)) + 1 from debitomercado";
					      $result1 = mysql_query ($consulta1) or die ("Fallo en la consulta");
					      $codc = mysql_fetch_row($result1);
					      $codca= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
					   else:
					      $codca="00001";
			                   endif;
                                             $nota='POR MEDIO DEL SISTEMA DE NOMINA';
					      $consul="insert into debitomercado(numero,cedemple,codmerca,nsaldo,fechabono,abono,nota)
					      values('$codca','$datoN[$k]','$aux_M','$calculoM','$fechaR','$auxM','$nota')";
			                      $res=mysql_query($consul)or die("Error al Grabar en la tabla debitomercado");
                                              /*actualzacion de saldos*/
					      $actualiza="update mercado set nsaldo='$calculoM' where mercado.codmerca='$aux_M'";
					      $resulta=mysql_query($actualiza) or die("Fallo la inserccion en la tabla mercado");
                                              $regis=mysql_affected_rows();
                                              //actualizar tabla detallecentro
		                              if ($calculoM <=0){
						$ss = "update decentro set deduccion = '0',datos = 'NO',permanente = 'NO' where codsala = '$Codigo' and codcentro = (select codcentro from centro where cedemple='$datoN[$k]')";
						 $rr = mysql_query($ss)or die ("Error al actualizar la informacion.");
					      }
									//actualizar tabla detallecentro
		                       endif;
                              endif;
	                  endif;
                     endif;
                  endwhile;
                 /*CODIGO PARA ACTUALIZAR TABLA NOMINA*/
                  $conA="select denomina.*,denomina.ibcprestacional,salario.ibcincapacidad,salario.vacacion from denomina,nomina,salario
                   where nomina.consecutivo=denomina.consecutivo and
                     denomina.codsala=salario.codsala and
                    nomina.consecutivo='$code'";
                  $resuN=mysql_query($conA)or die ("Error al validar las actualizaciones");
                   $SumaP = 0;
                   $TotalD = 0;
                   $TotalSalario = 0;
                   $SalarioIbcPrestacional = 0 ;
                   $ValorAporteSeguridad = 0;
                   $TotalPrestacional = 0;$TotalIbcInca = 0; $ContD = 0; $IbcVacacion = 0;
                  while($filas_A=mysql_fetch_array($resuN)):
                      $ConP=$filas_A["prestacion"];
                      $Suma = $filas_A["ibcincapacidad"];
                      $Salario=$filas_A["salario"]. ' ';
                      $Deduccion=$filas_A["deduccion"];
                      $VlrVacacion = $filas_A["vacacion"];
                      $SalarioIbcPrestacional = $SalarioIbcPrestacional + $filas_A["ibcprestacional"];
                      if($Suma == 'SI'){
                         $ContD = $filas_A["nrohora"];
                         $TotalIbcInca =  round(($Basico/30/8)*$ContD);
                      }
                      if($ConP=='SI' and $Suma =='NO'){
                        $SumaP=$SumaP+$Salario;
                      }
                      if($VlrVacacion == 'SI'){
                         $IbcVacacion = $filas_A["salario"];
                      }
                      $TotalD=$TotalD+$Deduccion;
                      $TotalSalario=$TotalSalario + $Salario;
                  endwhile;
                     $TotalPrestacional = $SumaP + $SalarioIbcPrestacional + $TotalIbcInca;
                     $OtraBasePrestacional = $TotalPrestacional;
                   if ($TipoSalario[$k] == 'INTEGRAL'){;
                      $TotalPrestacional = round((($SumaP + $SalarioIbcPrestacional + $TotalIbcInca)* 70)/100);
                   }
                   /*CODIGO QUE BUSCA EN CODIGO 49 DEL FONDO SOLIDARIDAD*/
			$Sql="select decentro.*,salario.formapago,salario.topefondosolidaridad from decentro,centro,salario
			where  salario.codsala=decentro.codsala and
			centro.codcentro=decentro.codcentro and
			salario.codsala='49' and
			centro.cedemple='$datoN[$k]'";
			$Rs=mysql_query($Sql)or die ("Error al validar la busqueda del centro");
			$Cont = mysql_num_rows($Rs);
			$Fondo=mysql_fetch_array($Rs);
			$CodCentro = $Fondo["codcentro"];
			$Concepto=$Fondo["descripcion"];
			$PorcentajeFondo=$Fondo["porcentaje"];
			$CodigoSa = $Fondo["codsala"];
			$ValidarForma = $Fondo["formapago"];
 		        $FondoSolidaridad = $Fondo["topefondosolidaridad"];
                      /*FIN CODIGO*/
                $conT="update nomina set devengado='$TotalSalario', presta='$TotalPrestacional',deduccion='$TotalD', vacacion='$IbcVacacion' where consecutivo='$code'";
                 $resuT=mysql_query($conT)or die ("Error al actualizar");
                 /*CODIFO PARA BUSCAR LA EPS, PENSION Y FONDO SOLIDARIDAD*/
                 $conCT="select decentro.variacion,decentro.codsala from decentro,centro,salario
                   where salario.codsala=decentro.codsala and
                         salario.formapago='NINGUNA' and salario.totalhoras='NO' and
                         decentro.codcentro=centro.codcentro and
                         centro.cedemple='$datoN[$k]'";
                   $resuCT=mysql_query($conCT)or die ("Error al validar la busqueda del centro");
                   $filas_CT=mysql_fetch_array($resuCT);
                   $VariableSeguridad=$filas_CT["variacion"];
                   /*CODIDO PARA ACTUALIZAR LA EPS, FONDO DE SOLIDARIDAD Y LA AFP CON LAS VARIACIONES*/
                  $conA="select denomina.*,salario.topefondosolidaridad,salario.formapago,nomina.periodo from denomina,nomina,salario
                   where nomina.consecutivo=denomina.consecutivo and
                    nomina.consecutivo='$code' and
                    salario.codsala=denomina.codsala and
                    salario.totalhoras='NO' and
                    salario.formapago='NINGUNA' ";
                   $resuN=mysql_query($conA)or die ("Error al validar las actualizaciones");
                   $AuxP=$SumaP;
                   $ConSalud=0;
                  while($filas_A=mysql_fetch_array($resuN)):
                      $Codigo= $filas_A["codsala"];
                      $PorSalud=$filas_A["porcentaje"];
                      $PeriodoPago=$filas_A["periodo"];
                      if($VariableSeguridad=='VARIABLE'):
	                         if($Codigo != '49'){
		                            $Deducciones=round(($TotalPrestacional * $PorSalud/100));
		                            $ConSalud = $ConSalud + $Deducciones;
		                            $conT="update denomina set deduccion='-$Deducciones' where consecutivo='$code' and codsala='$Codigo'";
		                            $resuT=mysql_query($conT)or die ("Error al actualizar la eps y la pension");
	                         }
				if($PeriodoPago=='QUINCENAL'){
			        	$TopeFondoSolidaridadValidado = round($FondoSolidaridad /2);
				}else{
			        	if($PeriodoPago=='CATORCENAL'){
			          		$TopeFondoSolidaridadValidado = round($FondoSolidaridad /2.15);
			       		}else{
						if($PeriodoPago=='DECADAL'){
							$TopeFondoSolidaridad = round($FondoSolidaridad /3);
			       			}else{
			       				if($PeriodoPago=='SEMANAL'){
			       					$TopeFondoSolidaridadValidado = round($FondoSolidaridad /4.3);
							}else{
			       					$TopeFondoSolidaridadValidado = $FondoSolidaridad;
			       				}
			      			}
			       		}
				}
				if($OtraBasePrestacional > $TopeFondoSolidaridadValidado){
                                    if ($CodigoSa=='49'){
					$SqlBus = "select denomina.* from denomina
					where denomina.codsala='49' and
					denomina.consecutivo='$code'";
					$RsBus=mysql_query($SqlBus)or die ("Error al validar la busqueda en la tabla denomina.!");
					$Contador = mysql_num_rows($RsBus);
					if($Contador==0){
						$BuscarCentro="insert into denomina (consecutivo,codsala,descripcion,porcentaje,prestacion,validaribc)
						value('$code','$CodigoSa','$Concepto','$PorcentajeFondo','NO','NO')";
						$RsCentro=mysql_query($BuscarCentro)or die ("Error al inserta en la tabla denomina");
						/*CODIGO PARA ACTUALIZAR*/
						$Deducciones=round(($OtraBasePrestacional * $PorcentajeFondo/100));
						$ConSalud = $ConSalud + $Deducciones;
						$conT="update denomina set deduccion='-$Deducciones' where consecutivo='$code' and codsala='$CodigoSa'";
						$resuT=mysql_query($conT)or die ("Error al actualizar la eps y la pension");
					}
                                    }
				}
                       endif;
                  endwhile;
                  /*CODIGO DE ACTUALIZACION FINAL*/
                  $TotalD=$TotalD * -1;
                  $AuxTotalDeduccion=($ConSalud+$TotalD);
                  $AuxTotalPagar=($TotalSalario-$AuxTotalDeduccion);
                  $conX="update nomina set deduccion='-$AuxTotalDeduccion',neto='$AuxTotalPagar',presta='$OtraBasePrestacional' where consecutivo='$code' ";
                  $resuX=mysql_query($conX)or die ("Error al actualizar la tabla nomina");
         else:
            ?>
             <script language="javascript">
                 alert("Este periodo de nómina ya se le hizo a este empresa!")
                 history.back()
	     </script>
	   <?
        endif;
      endfor;
      ?>
           <script language="javascript">
                 alert("Se grabaron : <?echo ($k-1);?> registros de la Empresa : <?echo $Zona;?> .!")
                 open("ListadoP.php?codzona=<?echo $codzona;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&CodPeriodo=<?echo $CodPeriodo;?>&Zona=<?echo $Zona;?>&Auxiliar=<?echo $Auxiliar;?>","_self")
	     </script>
     <?
endif;
?>
</body>

</html>



