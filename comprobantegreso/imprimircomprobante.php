<html>
        <head>
                <title>Impresion de comprobante de Egreso</title>
                <link rel="stylesheet" href="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
               <?

                        include ("../conexion.php");
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,maestro.faxmaestro,municipio.municipio,maestrocomprobante.id,tipocomprobante.descripcion,maestrocomprobante.vlrpagado,maestrocomprobante.fechapago,maestrocomprobante.nro,maestrocomprobante.letras,maestrocomprobante.usuario,maestrocomprobante.deduccion from maestro,municipio,maestrocomprobante,tipocomprobante
                        where maestro.codmaestro=maestrocomprobante.codmaestro and
                              maestrocomprobante.codmuni=municipio.codmuni and
                              maestrocomprobante.id=tipocomprobante.id and
                             maestrocomprobante.nro='$NroComprobante'";
                        $resultado=mysql_query($consulta) or die("Error de Busqueda de Comprobante");
                        $registros=mysql_num_rows($resultado);
                        $filas=mysql_fetch_array($resultado);
                        $Valor=number_format($filas["vlrpagado"],2);
                         $ValorT=$filas["vlrpagado"];
                         $Valor=number_format($filas["vlrpagado"],2);
                        $NitC=number_format($filas["codmaestro"],0);
                        $NroC=$filas["nro"];
                        $Proceso=$filas["tipop"];
                        $TipoC=$filas["descripcion"];
						$Deduccion=$filas["deduccion"];
                        $FechaP=$filas["fechapago"];
                        $Dia=substr($FechaP,8,6);
                        $Mes=substr($FechaP,4,4);
                        $Ano=substr($FechaP,0,4);
                        $FechaPago=($Dia.$Mes.$Ano);
                        if ($registros==0):
                            ?>
                          <script language="javascript">
                            alert("Este Comprobante no existe en Sistema")
                            history.back()
                          </script>
                           <?
                        else:
                           ?>
                                <table border="1" align="center" width="710">
                                <tr><td>
                                <table border="0" align="center" width="710">
                                <tr>
                                    <td colspan="40"><b><div align="center">COMPROBANTE DE EGRESO</div></b><td>
                                 </tr>
                                 <tr>
                                    <td colspan="40"><b><div align="right">Nro:&nbsp;<?echo $filas["nro"];?></div></b><td>
                                 </tr>
                                  <tr>
                                  <td colspan="40">-------------------------------------------------------<b>Datos de la Empresa</b>-----------------------------------------------</td>
                                 </tr>
                                 <tr><td><br></td></tr>
                                 <tr>
                                  <td class="cajas" colspan="1"><b>Nit:</b>&nbsp;<?echo $NitC;?>-<?echo $filas["dvmaestro"];?></td>
                                   <td class="cajas" colspan="1"><b>Razon Social:</b>&nbsp;<?echo $filas["nomaestro"];?></td>
                                 </tr>
                                 <tr>
                                    <td class="cajas"><b>Dirección:</b>&nbsp;<?echo $filas["dirmaestro"];?></td>
                                    <td class="cajas" colspan="35"><b>Teléfono:</b>&nbsp;<?echo $filas["telmaestro"];?>&nbsp;&nbsp;<b>Ciudad y Fecha:</b>&nbsp;<?echo $filas["municipio"];?>,&nbsp;<?echo $FechaPago;?></td>
                                 </tr>
                                 <tr>
                                    <td class="cajas"><b>Vlr_Pagado:</b>&nbsp;$<?echo $Valor;?></td>
                                     <td class="cajas"><b>Tipo_Comprobante:</b>&nbsp;<?echo $TipoC;?></td>
                                     <td class="cajas"><b>Usuario:</b>&nbsp;<?echo $filas["usuario"];?></td> 
                                 </tr>
                                 <tr>
                                   <td class="cajas" colspan="40"><b>En Letras:</b>&nbsp;<?echo $filas["letras"];?>&nbsp;PESOS ML</td>
                                  </tr>
                                 </table>
                                 </tr></td>
                                </table>
                                <?
                                $ConD="select comprobante.*,banco.bancos from comprobante,maestrocomprobante,banco
                                where maestrocomprobante.nro=comprobante.nro and
                                      comprobante.codbanco=banco.codbanco and
                                      maestrocomprobante.nro='$NroC'";
                                $ResD=mysql_query($ConD)or die ("Error al buscar detalles");

                                  ?>
	                               <table border="1" align="center" width="950">
	                                <tr> <td>
	                                <table border="0" align="center" width="950">
                                         <tr>
                                 <td colspan="40">-------------------------------------------------------------------------<b>Detalle de Pago</b>--------------------------------------------------------------------------</td>
                                 <tr><td><br></td></tr>
                                 </tr>
                                         <tr class="cajas">
										 	<td><b><div align="center">Nro.</div></b></td>
                                            <td><b><div align="center">Docum.</div></b></td>
                                            <td><b><div align="center">Nit_Tercero</div></b></td>
                                             <td><b><div align="center">Dv</div></b></td>
                                            <td><b><div align="center">Tercero</div></b></td>
                                            <td><b><div align="center">Forma_P.</div></b></td>
                                             <td><b><div align="center">Cheque</div></b></td>
                                            <td><b><div align="center">Entidad</div></b></td>
                                            <td><b><div align="center">Tipo_Cta</div></b></td>
                                            <td><b><div align="center">Vlr_Pago</div></b></td>
                                            <? if($Proceso=='NO CAUSADO' or $Proceso=='COMPRAS'):?>
                                            <? else:?>
                                               <td><b><div align="center">Nit_Zona</div></b></td>
                                               <td><b><div align="center">Zona</div></b></td>
                                            <?endif;?>
                                            <td><b><div align="center">Nota</div></b></td>
                                            <td><b><div align="center"</div></b></td>
                                         </tr>
                                          <? $T=0;
										  $i = 0;
										  $ac = 0;
										  while ($filas_C=mysql_fetch_array($ResD)):
										    $TipoC = $filas_C["cuenta"];
											if ($TipoC =='CORRIENTE'){
												$AuxCuenta= 'CTE';
											}else{
									  		  $AuxCuenta=$TipoC;
											}
											
										  $i++;
										  $ac = $ac + $filas_C["valor"];
                                          $ValorP=number_format($filas_C["valor"],0);
										  
                                            ?>
                                              <tr class="cajasletras">
												  <td><?php  echo $i;?></td>
                                                 <td><?echo $filas_C["nrofactura"];?></td>
                                                 <td><?echo $filas_C["nitprove"];?></td>
                                                 <td><?echo $filas_C["dv"];?></td>
                                                 <td><?echo $filas_C["cliente"];?></td>
                                                  <td><?echo $filas_C["pago"];?></td>
                                                  <td><?echo $filas_C["cheque"];?></td>
                                                  <td><?echo $filas_C["bancos"];?></td>
												  <td><?echo $AuxCuenta;?></td>
                                                  <td><div align="center">$<?echo $ValorP;?></div></td>
												  <?php
												  
												  //$ac = $ac +  $filas_C["pago"];
												  ?>
												  
                                                  <?php if($Proceso=='NO CAUSADO' or $Proceso=='COMPRAS'):?>
                                                  <?php else:?>
                                                  <td><?php echo $filas_C["nitzona"];?></td>
                                                  <td><?php echo $filas_C["zona"];?></td>
                                                  <?endif;?>
					                         	 <td><?echo $filas_C["concepto"];?></td>
                                              </tr>
                                              <?$T=$T+1;
                                          endwhile;
										   $ac = $ac - $Deduccion;
                                          if($T < '4'):
                                             ?>
                                              <tr><td><br></td></tr>
                                              <tr><td><br></td></tr>
                                              <tr><td><br></td></tr>
                                              <tr><td><br></td></tr>
                                              <tr><td><br></td></tr>
                                         <?else:?>
                                           <tr><td><br></td></tr>
                                           <tr><td><br></td></tr>
                                         <?endif;?>
                                          <tr>
										  <?php 
										  	$v1 = number_format($ac, 2);
											$v2 = $Valor;
										  
										  $diferencia = $ac-$ValorT + $Deduccion;
                                          $diferencia = number_format($diferencia, 2);?>
                                                                                  
                                         <td colspan="20" class="cajas"><b>Firma y Sello:</b>&nbsp;--------------------------------&nbsp;&nbsp;&nbsp;&nbsp;<b>Total_Reg.:</b>&nbsp;<?echo $T;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Valor Pago: $</b><?php echo number_format($ac, 2);?>
										 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Diferencia:  $<?php echo $diferencia;?></b>&nbsp;&nbsp;&nbsp;<b>Deducciones:&nbsp;$<?php echo number_format($Deduccion,2);?></b></td>
                                         <tr>
	                                 </table>
                                         </td></tr>
	                                </table>

	                               <?
                        endif;
                       ?>
                 </body>
</html>
