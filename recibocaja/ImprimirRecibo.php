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
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
               <?

                        include ("../conexion.php");
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,maestro.dirmaestro,maestro.telmaestro,maestro.faxmaestro,municipio.municipio,maestrorecibo.vlrpagado,maestrorecibo.fechapago,maestrorecibo.nrocaja,maestrorecibo.letras,tiporecibo.descripcion from maestro,municipio,maestrorecibo,tiporecibo
                        where maestro.codmaestro=maestrorecibo.codmaestro and
                              maestrorecibo.codmuni=municipio.codmuni and
                              maestrorecibo.idrecibo =  tiporecibo.idrecibo and
                             maestrorecibo.nrocaja='$NroRecibo'";
                        $resultado=mysql_query($consulta) or die("Error de Busqueda de Comprobante");
                        $registros=mysql_num_rows($resultado);
                        $filas=mysql_fetch_array($resultado);
                        $Valor=number_format($filas["vlrpagado"],2);
                        $NitC=number_format($filas["codmaestro"],0);
                        $NroC=$filas["nrocaja"];
                        $Proceso=$filas["descripcion"];
                        $FechaP=$filas["fechapago"];
                        $Dia=substr($FechaP,8,6);
                        $Mes=substr($FechaP,4,4);
                        $Ano=substr($FechaP,0,4);
                        $FechaPago=($Dia.$Mes.$Ano);
                        if ($registros==0):
                            ?>
                          <script language="javascript">
                            alert("Este recibo de caja no existe en Sistema")
                            history.back()
                          </script>
                           <?
                        else:
                           ?>
                                <table border="1" align="center" width="710">
                                <tr><td>
                                <table border="0" align="center" width="710">
                                <tr>
                                    <td colspan="40"><b><div align="center"><u>RECIBO DE CAJA</u></div></b><td>
                                 </tr>
                                 <tr>
                                    <td colspan="40"><b><div align="right">Nro:&nbsp;<?echo $filas["nrocaja"];?></div></b><td>
                                 </tr>
                                  <tr>
                                  <td colspan="40">---------------------------------------------------------<b>Datos de la Empresa</b>-----------------------------------------------</td>
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
                                    <td class="cajas"><b>Tipo_Recibo:</b>&nbsp;<?echo $Proceso;?></td>
                                 </tr>
                                 <tr>
                                   <td class="cajas" colspan="40"><b>En Letras:</b>&nbsp;<?echo $filas["letras"];?>&nbsp;PESOS ML</td>
                                  </tr>
                                 </table>
                                 </tr></td>
                                </table>
                                <?
                                $ConD="select recibo.*,banco.bancos from recibo,maestrorecibo,banco
                                where maestrorecibo.nrocaja=recibo.nrocaja and
                                      recibo.codbanco=banco.codbanco and
                                      maestrorecibo.nrocaja='$NroC'";
                                $ResD=mysql_query($ConD)or die ("Error al buscar detalles");

                                  ?>
	                               <table border="1" align="center" width="950">
	                                <tr> <td>
	                                <table border="0" align="center" width="950">
                                         <tr>
                                 <td colspan="40">--------------------------------------------------------------------------------<b>Detalle del Recibo</b>-------------------------------------------------------------------------</td>
                                 <tr><td><br></td></tr>
                                 </tr>
                                         <tr class="cajas">
                                            <td><b><div align="center">Nro_Fact.</div></b></td>
                                            <td><b><div align="center">Nit_Cliente</div></b></td>
                                             <td><b><div align="center">Dv</div></b></td>
                                            <td><b><div align="center">Cliente</div></b></td>
                                            <td><b><div align="center">Forma_P.</div></b></td>
                                            <td><b><div align="center">Entidad</div></b></td>
                                            <td><b><div align="center">Tipo_Cta</div></b></td>
                                            <td><b><div align="center">Pago</div></b></td>
                                            <td><b><div align="center">Rtefuente</div></b></td>
                                            <td><b><div align="center">ReteIva</div></b></td>
                                             <td><b><div align="center">%Ri.</div></b></td>
                                            <td><b><div align="center">ReteIca</div></b></td>
                                            <td><b><div align="center">Dcto</div></b></td>
                                            <td><b><div align="center">%Df.</div></b></td>
                                            <td><b><div align="center">Concepto</div></b></td>
                                         </tr>
                                          <? $T=0;
                                          while ($filas_C=mysql_fetch_array($ResD)):
                                          $ValorP=number_format($filas_C["abono"],0);
                                          $ValorFte=number_format($filas_C["retefuente"],0);
                                          $ValorRte=number_format($filas_C["reteiva"],0);
                                          $ValorRteI=number_format($filas_C["reteica"],0);
                                          $ValorD=number_format($filas_C["descuento"],0);
                                            ?>
                                              <tr class="cajasletras">
                                                 <td><div align="center"><?echo $filas_C["nrofactura"];?></div></td>
                                                 <td><div align="center"><?echo $filas_C["nit"];?></div></td>
                                                 <td><?echo $filas_C["dv"];?></td>
                                                 <td><?echo $filas_C["zona"];?></td>
                                                 <td><div align="center"><?echo $filas_C["pago"];?></div></td>
                                                 <td><div align="center"><?echo $filas_C["bancos"];?></div></td>
                                                 <td><div align="center"><?echo $filas_C["cuenta"];?></div></td>
                                                 <td><div align="right">$<?echo $ValorP;?></div></td>
                                                 <td><div align="right">$<?echo $ValorFte;?></div></td>
                                                 <td><div align="right">$<?echo $ValorRte;?></div></td>
                                                  <td><div align="center"><?echo $filas_C["poriva"];?>%</div></td> 
                                                 <td><div align="right">$<?echo $ValorRteI;?></div></td>
                                                 <td><div align="right">$<?echo $ValorD;?></div></td>
                                                 <td><div align="center"><?echo $filas_C["pordcto"];?>%</div></td>
                                                 <td><div align="center"><?echo $filas_C["concepto"];?></div></td>
                                              </tr>
                                              <?$T=$T+1;
                                              $debito=$debito+$filas_C["abono"];
                                          endwhile;
                                          $debito=number_format($debito,2);
                                          if($T < 4):
                                             ?>
                                             <tr><td><br></td></tr>
                                              <tr><td><br></td></tr>
                                              <td colspan="20" class="cajas"><div align="center"><b>DEBITO:</b>&nbsp;&nbsp;$<?echo $debito;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>CREDITO:</b>&nbsp;&nbsp;$<?echo $Valor;?></div></td>
                                              <tr><td><br></td></tr>
                                         <?else:?>
                                           <tr><td><br></td></tr>
                                           <td colspan="20" class="cajas"><div align="center"><b>DEBITO:</b>&nbsp;&nbsp;$<?echo $debito;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>CREDITO:</b>&nbsp;&nbsp;$<?echo $Valor;?></div></td>
                                           <tr><td><br></td></tr>
                                         <?endif;?>
                                          <tr>
                                         <td colspan="20" class="cajas"><b>Firma y Sello:</b>&nbsp;--------------------------------&nbsp;&nbsp;&nbsp;&nbsp;<b>Total_Reg.:</b>&nbsp;<?echo $T;?></td>
                                         <tr>
	                                 </table>
                                         </td></tr>
	                                </table>

	                               <?
                        endif;
                       ?>
                 </body>
</html>
