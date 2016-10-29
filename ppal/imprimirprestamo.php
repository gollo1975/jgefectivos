<html>
        <head>
                <title>Impresion de Nota Crédito</title>
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,sucursal.sucursal,sucursal.dirsucursal,prestamoempresa.*
                         from maestro,sucursal,zona,prestamoempresa,empleado
                        where  maestro.codmaestro=sucursal.codmaestro and
                             sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=prestamoempresa.cedemple and
                              prestamoempresa.nroprestamo='$nroprestamo'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existen datos de credito para la impresion ?")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                            $cedula=number_format($filas["cedemple"],0);
                            $vlrsolicitado=number_format($filas["vlrprestamo"],0);
                            $vlrentregado=number_format($filas["vlrprestamo"],0);
                            $cuota=number_format($filas["cuota"],0);
                ?>
                              <table border="1" align="center" width="710">
                              <tr>
                              <td>
                              <table border="0" align="center" width="720">
                              <img src="../image/logounico.png" border="0" height="120" width="125">
                              <tr>
                              <td colspan="20" align="center"><b><u>AUTORIZACION DE DESCUENTO</u></b></td><td colspan="25"><td class="cajas"><b>Nro:</b>&nbsp;<?echo $filas["nroprestamo"];?></td>
                                </tr>
                                <tr><td><br></td></tr>
                                                             <tr class="cajas">
                                 <td><b>Documento:</b>&nbsp;<?echo $cedula;?>&nbsp;</td><td colspan="45"class="cajas"><b>Empleado:</b>&nbsp;<?echo $filas["nombres"];?></td>
                                 </tr>
                               <tr class="cajas">
                                 <td><b>F_Impresión:</b>&nbsp;<?echo date("Y-m-d");?></td><td><b>F_Desembolso:</b> &nbsp;<?echo $filas["fechad"];?></td>
                                 </tr>
                                  <tr class="cajas">
                                 <td><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td><td><b>Usuaria:</b> &nbsp;<?echo $filas["zona"];?></td>
                                 </tr >
                                   <tr class="cajas"><td colspan="50"><div align="center"><b>La presente solicitud de autorización se fundamenta en el Artículo 150 y 156 del C.S.T., Ley 141/61</b></div></td></tr>
                                <table border="1" aling="center" width="710">
                                <tr>
                                <td>
                                <table border="0" align="center" width="710">
                                  <tr class="cajas">
                                    <td><b>Descripción</b></td>
                                    <td><b><div align="center">Vlr_Aprobado</div></b></td>
                                    <td><b><div align="center">Plazo(dias)</div></b></td>
                                    <td><b><div align="center">Forma Pago</div></b></td>
                                    <td><b><div align="center">Cuota</div></b></td>
                                    <td><b><div align="center">Vlr_Entregado</div></b></td>
                                  </tr>
                                  <tr class="cajas">
                                    <td>Descuento Empresa</td>
                                    <td align="center"><?echo $vlrsolicitado;?></td>
                                    <td align="center"><?echo $filas["dias"];?></td>
                                     <td align="center"><?echo $filas["formapago"];?></td>
                                     <td align="center"><?echo $cuota;?></td>
                                    <td align="center"><?echo $vlrentregado;?></td>
                                  </tr>
                                  <tr><td><br></tr></td>
                                  <tr><td><br></tr></td>
                                   <tr><td><br></tr></td>
                                    <tr><td><br></tr></td>
                                   <tr>
                                   <td colspan="3"class="cajas"><b><?echo $filas["responsable"];?></b></td>  <td colspan="10"class="cajas"><b><?echo $filas["nombres"];?></b></td>
                                   </tr>
                                   <tr class="cajas">
                                   <td colspan="3"><b>Persona Autorizada</b></td>    <td colspan="10"><b>Empleado&nbsp;CC.&nbsp;<?echo $cedula;?></b></td>
                                 </tr>
                                 <tr><td><br></tr></td>
                                  <tr class="cajas"><td colspan="45"><p align="justify">Yo, <b><?echo $filas["nombres"];?></b>  identificado(a) con cédula de ciudadanía No <b><?echo $cedula;?></b>, y en mi condición de empleado(a) en misión de <b>JGEFECTIVOS S.A.S.</b> con Nit <b>900.456.778-3</b>, autorizo a retener de mi salario la cuota por un valor de <b>$<?echo $cuota;?></b> hasta cancelar el valor total del préstamo No <b><?echo $filas["nroprestamo"];?></b> autorizado por la empresa <b><?echo $filas["zona"];?></b> por un valor de <b>$<?echo $vlrentregado;?></b>. </td></tr>
                               </table>
                               </td></tr>
                               </table>
                                <?
                             }
                        }
                       ?>
                          </table>
                          </td></tr>
                        </table>
                  </body>
</html>
