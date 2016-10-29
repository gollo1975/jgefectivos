<html>
        <head>
                <title>Carta Laboral</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
                <script language="javascript">
                     
                         function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
               <?
                        include ("../conexion.php");
                        $consulta="select maestro.codmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,municipio.municipio,departamento.departamento,maestro.web,sucursal.sucursal,zona.zona,tipocontrato.concepto,contrato.cargo,contrato.salario,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1) as empleado,empleado.periodo,contrato.fechainic,acceso.nombre from maestro,sucursal,zona,empleado,contrato,tipocontrato,acceso,municipio,departamento
                        where  maestro.codmaestro=sucursal.codmaestro and
                               maestro.codmaestro=acceso.codmaestro and
                               maestro.codmuni=municipio.codmuni and
                               municipio.codepart=departamento.codepart and
                               sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.codemple=contrato.codemple and
                              contrato.fechater='0000-00-00' and
                              contrato.tipo=tipocontrato.tipo and
                             empleado.cedemple='$xcodigo'";
                             $resultado=mysql_query($consulta) or die("Error al buscar carta Laboral");
                        $registros=mysql_num_rows($resultado);
                        $filas=mysql_fetch_array($resultado);
                        $documento=number_format($xcodigo,0);
                        $abono=$filas["salario"];
                        $NitEmpresa=$filas["codmaestro"];
                        $FormaPago=$filas["periodo"];
                        include("../numeros.php");
                        $salario=num2letras($abono);
                        $salario=strtoupper($salario);
                        $salariopago=number_format($abono,0);
                        /*codigo para busquedas de sucursales*/
                     /*   $ConS="select sucursal.sucursal from sucursal,maestro
                          where maestro.codmaestro=sucursal.codmaestro and
                          maestro.codmaestro='$NitEmpresa'";
                          $ResS=mysql_query($ConS)or die ("Error al buscar colillas de nomina");
                          $Pago = mysql_fetch_row($ResS);*/
                          /*fin codigo*/
                        if ($registros==0):
                          ?>
                          <script language="javascript">
                            alert("No existen registros para el proceso de la carta laboral")
                            history.back()
                          </script>
                           <?
                        else:
                          $ConR="select nomina.presta,empleado.basico,empleado.vlrpagado from empleado,nomina,contrato
                          where empleado.cedemple=nomina.cedemple and
                          empleado.codemple=contrato.codemple and
                          contrato.fechater='0000-00-00' and
                          empleado.cedemple='$xcodigo'";
                          $ResR=mysql_query($ConR)or die ("Error al buscar colillas de nomina");
                          $Con=mysql_num_rows($ResR);
                          if($Con=='0'):
                              $sw=1;
                          else:
                               if($Con=='1'):
                                  $sw='2';
                                  $filas_UNO=mysql_fetch_array($ResR);
                                  $Suma1=$filas_UNO["presta"];
                                  $Suma2=$filas_UNO["vlrpagado"];
                                  $TotalPromedio=$Suma1-$Suma2;
                                  include("../numeroCarta.php");
                                  $pago=letrasValor($TotalPromedio);
                                  $pagopromedio=number_format($TotalPromedio,0);
                                  $pago=strtoupper($pago);
                               else:
                                  $sw='3';
                                  if ($FormaPago == 'SEMANAL'):
                                     $Con1="select nomina.presta,nomina.pagado from empleado,nomina
	                             where empleado.cedemple=nomina.cedemple and
	                             empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 3,1";
	                             $Res1=mysql_query($Con1)or die ("Error al buscar datos de cuarta colilla");
                                     $filas_1=mysql_fetch_array($Res1);
                                     $Aux1=$filas_1["pagado"];
                                     $Suma1=$filas_1["presta"];
                                     /*primero*/
                                     $Con2="select nomina.presta,nomina.pagado from empleado,nomina
	                             where empleado.cedemple=nomina.cedemple and
	                             empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 2,1";
	                             $Res2=mysql_query($Con2)or die ("Error al buscar datos de tercera colilla");
                                     $filas_2=mysql_fetch_array($Res2);
                                     $Aux2=$filas_2["pagado"];
                                     $Suma2=$filas_2["presta"];
                                     $Con3="select nomina.presta,nomina.pagado from empleado,nomina
	                             where empleado.cedemple=nomina.cedemple and
	                             empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 1,1";
	                             $Res3=mysql_query($Con3)or die ("Error al buscar datos de segunda colilla");
                                     $filas_3=mysql_fetch_array($Res3);
                                     $Aux3=$filas_3["pagado"];
                                     $Suma3=$filas_3["presta"];
                                     /*final codigo*/
	                             $Con4="select nomina.presta,nomina.pagado from empleado,nomina
	                             where empleado.cedemple=nomina.cedemple and
	                             empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 1";
	                             $Res4=mysql_query($Con4)or die ("Error al buscar datos de la segunda colilla");
	                             $filas_4=mysql_fetch_array($Res4);
	                             $Aux4=$filas_4["pagado"];
                                     $Suma4=$filas_4["presta"];
                                     /*totales de suma*/
                                     $TotalPromedio=(($Suma1+$Suma2+$Suma3+$Suma4)-($Aux1+$Aux2+$Aux3+$Aux4));
                                     include("../numeroCarta.php");
                                     $pago=letrasValor($TotalPromedio);
                                     $pagopromedio=number_format($TotalPromedio,0);
                                     $pago=strtoupper($pago);
                                  else:
                                     if($FormaPago=='DECADAL'):
                                        $Con2="select nomina.presta,nomina.pagado from empleado,nomina
	                                where empleado.cedemple=nomina.cedemple and
	                                empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 2,1";
	                                $Res2=mysql_query($Con2)or die ("Error al buscar datos de tercera colilla");
                                        $filas_2=mysql_fetch_array($Res2);
                                        $Aux2=$filas_2["pagado"];
                                        $Suma2=$filas_2["presta"];
                                        $Con3="select nomina.presta,nomina.pagado from empleado,nomina
	                                where empleado.cedemple=nomina.cedemple and
	                                empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 1,1";
	                                $Res3=mysql_query($Con3)or die ("Error al buscar datos de segunda colilla");
                                        $filas_3=mysql_fetch_array($Res3);
                                        $Aux3=$filas_3["pagado"];
                                        $Suma3=$filas_3["presta"];
                                        /*final codigo*/
	                                $Con4="select nomina.presta,nomina.pagado from empleado,nomina
	                                where empleado.cedemple=nomina.cedemple and
	                                empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 1";
	                                $Res4=mysql_query($Con4)or die ("Error al buscar datos de la segunda colilla");
	                                $filas_4=mysql_fetch_array($Res4);
	                                $Aux4=$filas_4["pagado"];
                                        $Suma4=$filas_4["presta"];
                                        /*totales de suma*/
                                        $TotalPromedio=(($Suma2+$Suma3+$Suma4)-($Aux2+$Aux3+$Aux4));
                                        include("../numeroCarta.php");
                                        $pago=letrasValor($TotalPromedio);
                                        $pagopromedio=number_format($TotalPromedio,0);
                                        $pago=strtoupper($pago);
                                      else:
                                          if($FormaPago=='CATORCENAL' or $FormaPago='QUINCENAL'):
	                                     $Con5="select nomina.presta,nomina.pagado from empleado,nomina
		                             where empleado.cedemple=nomina.cedemple and
		                             empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 1,1";
		                             $Res5=mysql_query($Con5)or die ("Error al buscar datos de primera colilla");
	                                     $filas_5=mysql_fetch_array($Res5);
	                                     $Aux5=$filas_5["pagado"];
	                                     $Suma5=$filas_5["presta"];
		                             $Con6="select nomina.presta,nomina.pagado from empleado,nomina
		                             where empleado.cedemple=nomina.cedemple and
		                             empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 1";
		                             $Res6=mysql_query($Con6)or die ("Error al buscar datos de la segunda colilla");
		                             $filas_6=mysql_fetch_array($Res6);
		                             $Aux6=$filas_6["pagado"];
	                                     $Suma6=$filas_6["presta"];
	                                     $TotalPromedio=(($Suma6+$Suma6)-($Aux6+$Aux6));
	                                     include("../numeroCarta.php");
	                                     $pago=letrasValor($TotalPromedio);
	                                     $pagopromedio=number_format($TotalPromedio,0);
	                                     $pago=strtoupper($pago);
                                           else:
		                             $ConT="select nomina.presta,nomina.pagado from empleado,nomina
		                             where empleado.cedemple=nomina.cedemple and
		                             empleado.cedemple='$xcodigo' order by nomina.consecutivo DESC limit 1";
		                             $ResT=mysql_query($ConT)or die ("Error al buscar datos de la segunda colilla");
		                             $filas_T=mysql_fetch_array($ResT);
		                             $AuxT2=$filas_T["presta"];
	                                     $AuxT1=$filas_T["pagado"];
	                                     $TotalPromedio=($AuxT2-$AuxT1);
	                                     include("../numeroCarta.php");
	                                     $pago=letrasValor($TotalPromedio);
	                                     $pagopromedio=number_format($TotalPromedio,0);
	                                     $pago=strtoupper($pago);
                                           endif;
                                       endif;
                                  endif;
                               endif;
                          endif;

                           ?>
	                   <table border="0" align="center" width="710">
 	                  <tr>
	                  <td colspan="30" rowspan="8" class="cajas"><table width="100%" border="0" cellpadding="0" cellspacing="0">

	                    <tr>
	                      <td width="200" rowspan="6" valign="top" style="border-top: 0px solid; border-left: 0px solid; border-bottom: 0px solid;border-right: 0px solid;"><img src="../image/logocompleto.jpg" border="0" heigth="350" width="250"></td>
	                    </tr>

	                    <tr>
	                      <th rowspan="2" bgcolor="#FFFFFF" style="border-top: 0px solid; border-right: 0px solid; border-bottom: 0px solid;"><b></b></th>
						  <td style="border-top: 0px solid; border-right: 0px solid; font-family:verdana; font-size:8pt">&nbsp;</td>
	                    </tr>

	                    <tr>
	                      <td style="border-left: 0px solid; border-bottom: 0px solid;font-family:verdana; font-size:8pt"><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td>
	                    </tr>
	                    <tr>
	                      <td align="center" style="border-right: 0px solid; border-bottom: 0px solid;font-family:verdana; font-size:9pt"> </td>

	                    </tr>
	                    <tr>
	                      <th rowspan="2" bgcolor="#FFFFFF" style="border-top: 0px solid; border-right: 0px solid; border-bottom: 0px solid;"><b></b></th>
						  <td style="border-top: 0px solid; border-right: 0px solid; font-family:verdana; font-size:8pt">&nbsp;</td>
	                    </tr>
	                    <tr>
	                      <th rowspan="2" bgcolor="#FFFFFF" style="border-top: 0px solid; border-right: 0px solid; border-bottom: 0px solid;"><b></b></th>
						  <td style="border-top: 0px solid; border-right: 0px solid; font-family:verdana; font-size:8pt">&nbsp;</td>
	                    </tr>
	                    <tr>
	                      <th rowspan="2" bgcolor="#FFFFFF" style="border-top: 0px solid; border-right: 0px solid; border-bottom: 0px solid;"><b></b></th>
						  <td style="border-top: 0px solid; border-right: 0px solid; font-family:verdana; font-size:8pt">&nbsp;</td>
	                    </tr>

	                    <tr>

	                      <th rowspan="2" bgcolor="#c4c4c4" style="border-top: 0px solid; border-right: 0px solid; border-bottom: 0px solid;"><b>DEPARTAMENTO DE NOMINA</b></th>
						  <td style="border-top: 0px solid; border-right: 0px solid; font-family:verdana; font-size:8pt">&nbsp;</td>

	                    </tr>
	                    <tr>
	                      <th rowspan="2" bgcolor="#FFFFFF" style="border-top: 0px solid; border-right: 0px solid; border-bottom: 0px solid;"><b></b></th>
						  <td style="border-top: 0px solid; border-right: 0px solid; font-family:verdana; font-size:8pt">&nbsp;</td>
	                    </tr>

	                  </table></td><td width="1" class="cajas">&nbsp;</td>
	                   <table border="0" align="center" width="700">
	                   <tr><td>
	                               <tr><td colspan="16">---------------------------------------------------------------------------------------------------------------------------------- </td></tr>
                            <tr><td>&nbsp;</td></tr>
                           <tr>
                              <td><b>Señor(a)</b></td>
                            </tr>
                            <tr>
                              <td class="cajas">A QUIEN PUEDA INTERESAR</td>
                            </tr>
                            <tr>
                              <td class="cajas"><b>La Ciudad</b></td>
                            </tr>
                             <tr><td>&nbsp;</td></tr>
                              <tr><td>&nbsp;</td></tr>

                            <tr>
                              <td class="cajas"><b><div align="center">CERTIFICA QUE</div></b></td>
                            </tr>
                             <tr><td>&nbsp;</td></tr>
                              <tr><td>&nbsp;</td></tr>
                              <?if ($sw=='1'):?>
                                 <tr class="cajas"><td><p align="justify">El (La) señor(a) <b><?echo $filas["empleado"];?></b> con cédula de ciudadanía Nro <b><?echo $documento;?></b> esta vinculado a la empresa <b><?echo $filas["nomaestro"];?></b>, desde el <b><?echo $filas["fechainic"];?></b>, mediante un <b><?echo $filas["concepto"];?></b>, en el cargo de <b><?echo $filas["cargo"];?></b>. Devenga un salario Básico mensual de <b><?echo $salario;?> PESOS ML ($<?echo $salariopago;?>)</b>. Los servicios son prestados para la empresa <b><?echo $filas["zona"];?>.</b> </b> </u></p></td></tr>
                              <?else:
                                   if($sw=='2'):
                                      if($TotalPromedio > 0):?>
                                         <tr class="cajas"><td><p align="justify">El (La) señor(a) <b><?echo $filas["empleado"];?></b> con cédula de ciudadanía Nro <b><?echo $documento;?></b> esta vinculado a la empresa <b><?echo $filas["nomaestro"];?></b>, desde el <b><?echo $filas["fechainic"];?></b>, mediante un <b><?echo $filas["concepto"];?></b>, en el cargo de <b><?echo $filas["cargo"];?></b>. Devenga un salario Básico mensual de <b><?echo $salario;?> PESOS ML ($<?echo $salariopago;?>)</b>, más un promedio mensual de <b><?echo $pago;?> PESOS ML ($<?echo $pagopromedio;?>)</b>. Los servicios son prestados para la empresa <b><?echo $filas["zona"];?>.</b> </b> </u></p></td></tr>
                                      <?else:?>
                                         <tr class="cajas"><td><p align="justify">El (La) señor(a) <b><?echo $filas["empleado"];?></b> con cédula de ciudadanía Nro <b><?echo $documento;?></b> esta vinculado a la empresa <b><?echo $filas["nomaestro"];?></b>, desde el <b><?echo $filas["fechainic"];?></b>, mediante un <b><?echo $filas["concepto"];?></b>, en el cargo de <b><?echo $filas["cargo"];?></b>. Devenga un salario Básico mensual de <b><?echo $salario;?> PESOS ML ($<?echo $salariopago;?>)</b>. Los servicios son prestados para la empresa <b><?echo $filas["zona"];?>.</b> </b> </u></p></td></tr>
                                      <?endif;
                                   else:
                                     if($TotalPromedio > 0):?>
                                         <tr class="cajas"><td><p align="justify">El (La) señor(a) <b><?echo $filas["empleado"];?></b> con cédula de ciudadanía Nro <b><?echo $documento;?></b> esta vinculado a la empresa <b><?echo $filas["nomaestro"];?></b>, desde el <b><?echo $filas["fechainic"];?></b>, mediante un <b><?echo $filas["concepto"];?></b>, en el cargo de <b><?echo $filas["cargo"];?></b>. Devenga un salario Básico mensual de <b><?echo $salario;?> PESOS ML ($<?echo $salariopago;?>)</b>, más un promedio mensual de <b><?echo $pago;?> PESOS ML ($<?echo $pagopromedio;?>)</b>. Los servicios son prestados para la empresa <b><?echo $filas["zona"];?>.</b> </b> </u></p></td></tr>
                                      <?else:?>
                                         <tr class="cajas"><td><p align="justify">El (La) señor(a) <b><?echo $filas["empleado"];?></b> con cédula de ciudadanía Nro <b><?echo $documento;?></b> esta vinculado a la empresa <b><?echo $filas["nomaestro"];?></b>, desde el <b><?echo $filas["fechainic"];?></b>, mediante un <b><?echo $filas["concepto"];?></b>, en el cargo de <b><?echo $filas["cargo"];?></b>. Devenga un salario Básico mensual de <b><?echo $salario;?> PESOS ML ($<?echo $salariopago;?>)</b>. Los servicios son prestados para la empresa <b><?echo $filas["zona"];?>.</b> </b> </u></p></td></tr>
                                      <?endif;
                                   endif;
                              endif;?>
                              <tr><td>&nbsp;</td></tr>
                               <tr><td>&nbsp;</td></tr>

                               <tr>
                                <td class="cajas">La presente solicitud fue impresa vía Web en la fecha: <b><?echo date("Y-m-d");?></b></td>
                               </tr>
                               <tr><td>&nbsp;</td></tr>
                               <tr><td>&nbsp;</td></tr>
                               <tr>
                                <td class="cajas">Cordialmente,</td>
                               </tr>
                               <tr><td>&nbsp;</td></tr>
                               <tr>
                              <td><img src="../image/firmaWalter.png" border="0" heigth="115" width="122" onclick="derecha()"></td>
                               </tr>
                               <tr>
                                <td class="cajas"><b><?echo $filas["nombre"];?></b></td>
                               </tr>
                               <tr>
                                <td class="cajas"><b>JEFE DE NOMINA Y FACTURACION</b></td>
                               </tr>
                               <tr>
                                <td class="cajas"><b>Firmada Digitalmente</b></td>
                               </tr>
                               <tr><td>&nbsp;</td></tr>
                               <tr><td>&nbsp;</td></tr>
                               <tr><td colspan="16">---------------------------------------------------------------------------------------------------------------------------------- </td></tr>
                               <tr>
                                <td class="cajas"><b>Casa matriz:&nbsp;</b><?echo $filas["nomaestro"];?></td>
                               </tr>
                               <tr>
                                <td class="cajas"><b>Dirección:</b>&nbsp;<?echo $filas["dirmaestro"];?></td>
                               </tr>
                                <tr>
                                <td class="cajas"><b>Pbx:</b>&nbsp;<?echo $filas["telmaestro"];?></td>
                               </tr>
                                <tr>
                                <td class="cajas"><b>Web:</b>&nbsp;<?echo $filas["web"];?></td>
                               </tr>
                               <tr>
                                <td class="cajas"><b>Departamento:</b>&nbsp;<?echo $filas["departamento"];?>&nbsp;&nbsp;<b>Municipio:</b>&nbsp;<?echo $filas["municipio"];?></td>
                               </tr>
                                <tr><td>&nbsp;</td></tr>
                               <tr><td colspan="16">---------------------------------------------------------------------------------------------------------------------------------- </td></tr>
                                  <?
                          endif;
	                       ?>
	                       </table></td> </tr>
	                        </table>
                  </body>
</html>
