<html>
        <head>
                <title>Impresion de nomina</title>
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
                        $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,sucursal.sucursal,maestro.dirmaestro,maestro.telmaestro,maestro.faxmaestro,zona.zona,nomina.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cuenta,observacion.descripcion,eps.eps,pension.pension from maestro,nomina,empleado,eps,pension,sucursal,zona,observacion
                             where maestro.codmaestro=sucursal.codmaestro and
                                   sucursal.codsucursal=zona.codsucursal and
                                   zona.codzona=empleado.codzona and
                                   empleado.cedemple=nomina.cedemple and
                                   eps.codeps=empleado.codeps and
                                   empleado.codpension=pension.codpension and
                                  nomina.consecutivo='$codigoN'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                        $registros=mysql_num_rows($resultado);
                        while ($filas=mysql_fetch_array($resultado))
                            {
                            $basico=number_format($filas["basico"],0);
                             $pagado=number_format($filas["pagado"],0);
                            ?>
                              <table border="1" align="center" width="719" height="486" >
                              <tr>
                              <tr class="cajasletras"><td colspan="60"><?echo $filas["descripcion"];?></td></tr>
                              <td>
                              <table border="0" align="center" width="719" >
                              <tr>
                               <th colspan="25"align="center" class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>EXTRACTO DE SALARIO</u></th><td colspan="25" class="cajas"><b>Nro_Extracto:</b>&nbsp;<?echo $filas["consecutivo"];?></td>
                                </tr>
                               <tr><td><br></td></tr>
                               <tr>
                                 <td colspan="50" class="cajas"><b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?><b>&nbsp;&nbsp;Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?></td>
                               </tr>
                                <tr class="cajasletras">
                                 <td colspan="12" ><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td><td colspan="10" ><b>Cod_Periodo:</b>&nbsp;<?echo $filas["codigo"];?></td><td colspan="10" ><b>Salario:</b>&nbsp;$<?echo $basico;?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="12" ><b>Vlr_Periodo:</b>&nbsp;$<?echo $pagado;?></td><td colspan="10" ><b>Periodo_Pago:</b>&nbsp;<?echo $filas["periodo"];?></td><td colspan="13" ><b>Tipo_Proceso:</b>&nbsp;<?echo $filas["tiempo"];?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="12" ><b>Documento:</b>&nbsp;<?echo $filas["cedemple"];?></td><td colspan="18" ><b>Empleado:</b>&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td><td colspan="10" ><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="22" ><b>ERS:</b>&nbsp;<?echo $filas["zona"];?></td><td colspan="8"><b>Desde:</b>&nbsp;<?echo $filas["desde"];?></td><td colspan="10" ><b>Hasta:</b>&nbsp;<?echo $filas["hasta"];?></td>
                                 </tr>
                                 <tr class="cajasletras">
                                 <td colspan="12" ><b>Fecha_Proceso:</b>&nbsp;Medellín&nbsp;<?echo $filas["fechap"];?></td><td colspan="10" ><b>Fecha_Imp:</b>&nbsp;<?echo date("Y-m-d");?></td><td colspan="8"><b>Eps:</b>&nbsp;<?echo $filas["eps"];?></td><td colspan="8"><b>Pensión:</b>&nbsp;<?echo $filas["pension"];?></td>
                                 </tr>
                                      <?
                               $direccion=$filas["dirmaestro"];
                               $tele=$filas["telmaestro"];
                               $fax=$filas["faxmaestro"];
                             }
                           include ("../conexion.php");
                        $consu="select denomina.* from salario,denomina,nomina
                             where salario.codsala=denomina.codsala and
                                    nomina.consecutivo=denomina.consecutivo and
                                   nomina.consecutivo='$codigoN' order by denomina.salario";
                        $resul=mysql_query($consu) or die("consulta incorrecta 1 ");
                        $registros=mysql_num_rows($resul);
                        $reg=mysql_affected_rows();
                        if($reg==0):
                          ?>
                           <script language="javascript">
                             alert("No existen Detalles de Nomina ? ")
                             history.back()
                             </script>
                          <?
                        else:
                           ?>
                           <table border="1" aling="center" width="714">
                             <tr>
                             <td>
                             <table border="0" align="center" width="714">
                                  <tr class="cajasletras">
                                    <td><b>Código</b></td>
                                    <td><b>Descripción</b></td>
                                    <td><b><div align="right">Nro_Horas</div></b></td>
                                    <td><b><div align="right">Vlr_Hora</div></b></td>
                                     <td><b><div align="right">Porcentaje</div></b></td>
                                    <td><b><div align="right">Deducción</div></b></td>
                                    <td><b><div align="right">Devengado</div></b></td>
                                    </tr>
                               <?
                                while ($filas_s=mysql_fetch_array($resul)):
                                $con=number_format($filas_s["deduccion"],0);
                                $con1=number_format($filas_s["salario"],0);
                                 $con6=number_format($filas_s["vlrhora"],0);
                                ?>
                                <tr class="cajasletras">
                                    <td><?echo $filas_s["codsala"];?></td>
                                    <td class="cajas"><?echo $filas_s["descripcion"];?></td>
                                    <td><div align="right"><?echo $filas_s["nrohora"];?></div></td>
                                    <td><div align="right"><?echo $con6;?></div></td>
                                    <td><div align="right"><?echo $filas_s["porcentaje"];?>%</div></td>
                                    <td><div align="right"><?echo $con;?></div></td>
                                   <td><div align="right">$<?echo $con1;?></div></td>
                                   <?
                                   $con2=$con2+$filas_s["deduccion"];
                                   $con3=$con3+$filas_s["salario"];
                                   $con4=$con3+$con2;
                                   $a=number_format($con2,0);
                                   $b=number_format($con3,0);
                                   $c=number_format($con4,0);
                               endwhile;
                               ?>
                                </table>
                               </td></tr>
                               <tr class="cajasletras">
                               <td width="720" align="center"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Deducciones:</b>&nbsp;$<?echo $a;?><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Devengado:</b>&nbsp;&nbsp;$<?echo $b;?><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Neto_Pagar:</b>&nbsp;&nbsp;$<?echo $c;?></td>
                               </tr>
                               </table>
                               <tr class="cajasletras">
                               <td width="720" align="center"><b>Dirección:</b>&nbsp;&nbsp;<?echo $direccion;?><b>&nbsp;Pbx:</b>&nbsp;<?echo $tele;?><b>&nbsp;Fax:</b>&nbsp;<?echo $fax;?></td>
                               </tr>
                               <?
                         endif;
                           ?>
                          </table>
                          </td></tr>
                        </table>
                  </body>
</html>
