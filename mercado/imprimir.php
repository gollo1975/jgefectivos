<html>
        <head>
                <title>Impresion de autorizacion</title>
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
                        $consulta="select salario.desala,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.*,maestro.codmaestro,maestro.nomaestro,maestro.dvmaestro,maestro.telmaestro,maestro.dirmaestro from maestro,sucursal,zona,empleado,mercado,salario
                        where maestro.codmaestro=sucursal.codmaestro and
                              sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                             empleado.cedemple=mercado.cedemple and
                             salario.codsala=mercado.codsala and
                        mercado.codmerca='$codmerca'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                          <script language="javascript">
                            alert("No Existe la autorización del Detallado")
                            history.back()
                          </script>
                <?
                        }
                        else
                        {
                           while ($filas=mysql_fetch_array($resultado))
                            {
                             $aux1=number_format($filas["cupo"],2);
                ?>
                              <table border="1" align="center" width="710">
                              <tr>
                              <td>
                              <table border="0" align="center" width="710">
                              <tr>
                                <td colspan="60"><img src="../image/LogoInicio.JPG" border="0" width="205" height="115" class="cajas"><b><u> AUTORIZACION  RETIRO DE MERCADO</u></b> <td  class="cajas"><div align="right"><b>Nro:</b>&nbsp;<?echo $filas["codmerca"];?></div></td>
                                </tr>
                                 <tr><td><br></td></tr>
                               <tr class="cajas">
                                 <td><b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?>-<?echo $filas["dvmaestro"];?></td> <td colspan="10"><b>Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?></td>
                               </tr>
                               <tr class="cajas">
                                 <td><b>Pbx:</b>&nbsp;<?echo $filas["telmaestro"];?></td> <td colspan="10"><b>Dirección:</b>&nbsp;<?echo $filas["dirmaestro"];?></td>
                              </tr>
                               <tr><td><br></td></tr>
                               <tr><td colspan="80">-----------------------------------------------------<b>Datos del Empleado</b>-----------------------------------------------------</td></tr>
                                <tr><td><br></td></tr>
                                 <tr class="cajas">
                                 <td><b>Documento:</b>&nbsp;<?echo $filas["cedemple"];?></td><td colspan="10"><b>Empleado:</b>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                </tr>
                                 <tr>
                                  <td  class="cajas"><b>F_Solicitud:</b>&nbsp;<?echo $filas["fecha"];?></td><td colspan="10"><b>Vlr_Aprobado:</b>&nbsp;$<?echo $aux1;?></td>
                                 </tr>
                                 <tr  class="cajas">
                                  <td><b>Alianza:</b>&nbsp;<?echo $filas["desala"];?></td>
                                 </tr>
                                 <tr><td><br></td></tr>
                                 <tr><td><br></td></tr>
                                 <tr><td><br></td></tr>
                                 <tr>
                                   <td colspan="2">&nbsp;<u><b>AUTORIZADO POR</b></u></td><td>&nbsp;</td><td><u><b>FIRMA Y SELLO DE LA EMPRESA</b></u></td>
                                 </tr>
                                  <tr><td><br></td></tr>

                                 <tr>
                                   <td colspan="3" class="cajas"><?echo $filas["autoriza"];?></td><th>-------------------------------</th>
                                </tr>
                                <tr><td><br></td></tr>
                                <?
                             }
                        }
                       ?>
                          </table>
                          </td></tr>
                        </table>
                  </body>
</html>
