<html>
        <head>
                <title>Auxilio para fondos </title>
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,sucursal.sucursal,maestro.telmaestro,fondos.* from maestro,sucursal,zona,fondos,empleado
                           where  maestro.codmaestro=sucursal.codmaestro and
                             sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=fondos.cedemple and
                              fondos.radicado='$nro'";
                        $resultado=mysql_query($consulta) or die("Error al buscar acrhivo $consulta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen recibo de pago a facturas")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $xlr=number_format($filas["vlrmatricula"],2);
                            $valor=number_format($filas["vlrfondo"],2);
                ?>
                              <table border="1" align="center" width="700">
                              <tr>
                              <td>
                              <table border="0" align="center" width="710">
                              <tr>
                               <th colspan="20"align="center">FORMATO DE AUXILIOS</th>&nbsp;<td><b>Nro:</b>&nbsp;<?echo $filas["radicado"];?></td>
                                </tr>
                               <tr>
                                  <td colspan="20" align="center"class="cajas"><?echo $filas["nomaestro"];?>
                                 </tr>
                                 <tr>
                                 <td colspan="20" align="center"class="cajas">Nit:&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?></td>
                                </tr>
                                 </tr>
                                  <tr><td colspan="30">----------------------------------------------------------------------------------------------------------------------------------</td>
                                 </tr>
                                </tr>
                                  <tr><td colspan="30"><b><u><div align="center">Datos del Asociado</div></u></b></td>
                                 </tr>
                                 <tr><td><br></td></tr>
                                 <tr>
                                 <td colspan="1" class="cajas"><b>Documento:</b>&nbsp;<?echo $filas["cedemple"];?></td>
                                 </tr>
                                 <tr>
                                 <td colspan="45"class="cajas"><b>Asociado:</b>&nbsp;<?echo $filas["empleado"];?></td>
                                </tr>
                                <tr>
                                 <td colspan="1" class="cajas"><b>Fondo:</b>&nbsp;<?echo $filas["fondo"];?></td>
                                </tr>
                                <tr>
                                 <td colspan="45"class="cajas"><b>Zona:</b>&nbsp;<?echo $filas["zona"];?></td>
                                 </tr>
                                <tr>
                                 <td colspan="45"class="cajas"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                 </tr>
                                <tr>
                                 <td colspan="45"class="cajas"><b>Documento:</b>&nbsp;<?echo $filas["documento"];?></td>
                                 </tr>

                                 <tr>
                                 <td align="left"class="cajas"><b>Vlr_Matricula:</b>&nbsp;$<?echo $xlr;?>&nbsp;</td>
                                 </tr>
                                 <tr>
                                 <td align="left"class="cajas"><b>Valor_Fondo:</b>&nbsp;<?echo $valor;?></td>
                                 </tr>
                                 <tr>
                                 <td colspan="45"class="cajas"><b>F_Pago:</b>&nbsp;<?echo $filas["fechap"];?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="30" class="cajas"><b>La suma(en Letras):&nbsp;</b><?echo $filas["letras"];?>&nbsp;PESOS ML.</td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="30" class="cajas"><b>Por Concepto de:&nbsp;</b><?echo $filas["observacion"];?></td>
                                 </tr>
                                   <tr><td><br></td></tr>
                                   <tr><td><br></td></tr>
                                   <tr><td><br></td></tr> 
                                <tr>
                                   <td class="cajas"><b>Firma y Sello:</b></td>
                                 </tr>
                                <?
                             }
                        }
                       ?>
                          </table>
                          </td></tr>
                        </table>
                  </body>
</html>
