<html>
        <head>
                <title>Impresion Recibo de Control</title>
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,examenomina.* from maestro,examenomina
                        where  examenomina.codpago='$nropago'";
                        $resultado=mysql_query($consulta) or die("Error al buscar los datos");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen recibo de control para este documento ?")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $xlr=number_format($filas["valor"],2);
                             $cedula=number_format($filas["cedula"],0);
                ?>
                              <table border="1" align="center" width="710">
                              <tr>
                              <td>
                              <table border="0" align="center" width="710">
                              <tr>
                               <th colspan="16"align="center">RECIBO DE CONTROL</th>&nbsp;<th>Nro:&nbsp;<?echo $filas["codpago"];?></th>
                                </tr>
                               <tr>
                                 <tr class="cajas"><b>Fecha de pago</b>:&nbsp;<?echo $filas["fechap"];?></tr>
                                 <td colspan="20" align="center"class="cajas"><?echo $filas["nomaestro"];?>
                                 </tr>
                                 <tr>
                                 <td colspan="20" align="center"class="cajas">Nit:&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?></td>
                                </tr>
                                 </tr>
                                  <tr><td colspan="20">--------------------------------------------------------------------------------------------------------------------------------</td>
                                 </tr>
                                </tr>
                                  <tr><td colspan="20"><b><u><div align="center">Datos del Pagador</div></u></b></td>
                                 </tr>
                                 <tr><td><br></td></tr>
                                <tr>
                                 <td colspan="10" class="cajas"><b>Recibido de:</b>&nbsp;<?echo $filas["nombre"];?>&nbsp;</td><td colspan="45"class="cajas"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
                                 </tr>
                                 <tr>
                                 <td align="left"class="cajas"><b>Valor:</b>&nbsp;$<?echo $xlr;?>&nbsp;</td>
                                 </tr>
                                 <tr>
                                 <td align="left"class="cajas"><b>Nro_Radicado:</b>&nbsp;<?echo $filas["radicado"];?></td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="20" class="cajas"><b>La suma(en Letras):&nbsp;</b><?echo $filas["concepto"];?>&nbsp;PESOS ML.</td>
                                 </tr>
                                  <tr><td>&nbsp;</td></tr>
                                 <tr>
                                 <td colspan="20" class="cajas"><b>Concepto:&nbsp;</b><?echo $filas["nota"];?></td>
                                 </tr>
                                 <tr><td>&nbsp;</td></tr>
                                 <tr><td>&nbsp;</td></tr>
                                  <tr><td>&nbsp;</td></tr>

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
