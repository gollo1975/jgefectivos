<html>
        <head>
                <title>Autorizacion de Examenes</title>
                <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()	{
						
                                window.print()
                        }
                </script>
        </head>
        <body onLoad="imprimir()">  <!-- sirve para cargar la funcion de imprsion-->
                <?
                        include ("../conexion.php");
                        $consulta="select maestro.codmaestro,maestro.nomaestro,maestro.dirmaestro,municipio.municipio,maestro.telmaestro,maestro.web,provedor.nomprove, provedor.dirprove, examen.*,zona.zona from maestro,provedor,examen,sucursal,municipio,zona
                                  where maestro.codmaestro=sucursal.codmaestro and
                                        maestro.codmuni=municipio.codmuni and
                                        sucursal.codsucursal=provedor.codsucursal and
                                        provedor.nitprove=examen.nitprove and
                                        examen.codzona=zona.codzona and
                                        examen.nro='$nropago'";
                        $resultado=mysql_query($consulta) or die("Error de Busqueda de solicitud");
                        $registros=mysql_num_rows($resultado);
                        $filas=mysql_fetch_array($resultado);
                        $TotalE=number_format($filas["costoe"],0);
                        $Nit=number_format($filas["codmaestro"],0);
                        $Documento=number_format($filas["cedula"],0);
                        $Costo=number_format($filas["costoe"],0);
                        $FechaP=$filas["fechae"];
                        $NroE=$filas["nro"];
                        $Dia=substr($FechaP,8,6);
                        $Mes=substr($FechaP,4,4);
                        $Ano=substr($FechaP,0,4);
                        $FechaNa=($Dia.$Mes.$Ano);
                                           ?>
                                        <table border="0" align="center" width="712" >
                                        <tr><td>
                                        <td class="cajas"><img src="../image/logocompleto.jpg" border="0" width="425" heigth="145" ></td>

                                          <td colspan="30"><b><div align="center">Autorización de Examen</div></b><b><div align="center">Nro:&nbsp;00<? echo $filas["nro"];?></div></b></td>
                                          <table border="0" align="center" width="712">
                                           <tr><td>
                                           <tr><td colspan="30">---------------------------------------------------------<u>Datos de la Empresa</u>-------------------------------------------------</td></tr>
                                          <tr>
                                              <td class="cajas"><b>Nit:&nbsp;</b><?echo $Nit;?></td>
                                              <td class="cajas"><b>Empresa:&nbsp;</b><?echo $filas["nomaestro"];?></td>
                                              <td class="cajas"><b>Dirección:&nbsp;</b><?echo $filas["dirmaestro"];?></td>
                                           </tr>
                                            <tr>
                                              <td class="cajas"><b>Pbx:&nbsp;</b><?echo $filas["telmaestro"];?></td>
                                              <td class="cajas"><b>Web:&nbsp;</b><?echo $filas["web"];?></td>
                                              <td class="cajas"><b>Municipio:&nbsp;</b><?echo $filas["municipio"];?></td>
                                           </tr>
                                             <tr><td colspan="30">---------------------------------------------------------<u>Datos del Empleado</u>-------------------------------------------------</td></tr>
                                            <tr>
                                              <td class="cajas"><b>Documento:&nbsp;</b><?echo $Documento;?></td>
                                              <td class="cajas"><b>Nombres:&nbsp;</b><?echo $filas["nombre"];?></td>
                                              <td class="cajas"><b>Nro_Control:&nbsp;</b><?echo $filas["radicado"];?></td>
                                           </tr>
                                            <tr>
                                              <td class="cajas"><b>F_Examen:&nbsp;</b><?echo $FechaNa;?></td>
                                              <td class="cajas"><b>Zona:&nbsp;</b><?echo $filas["zona"];?></td>
                                              <td class="cajas"><b>Vlr_Examen:&nbsp;</b>$<?echo $Costo;?></td>
                                            </tr>
                                            <tr>
                                              <td class="cajas"><strong>Proveedor:</strong> <?echo $filas["nomprove"];?></td>
                                              <td class="cajas"><strong>Direcci&oacute;n</strong>: <?echo $filas["dirprove"];?></td>
                                              <td class="cajas"><strong>Cargo</strong>: <?echo $filas["cargo"];?></td>
                                           </tr>
                                          <table border="0" align="center" width="712" >
                                          <tr>
                                           <td colspan="25">--------------------------------------------------------<u>Detalle del Examen</u>---------------------------------------------------</td>
                                           </tr>

                                           <?
                                           $con="select detalladoexamen.*,examenglobal.descripcion from detalladoexamen,examen,examenglobal
                                                  where  examen.nro=detalladoexamen.nro and
                                                         detalladoexamen.nro='$NroE' and
                                                          detalladoexamen.conse=examenglobal.conse  order by examenglobal.descripcion ASC";
                                           $resu=mysql_query($con) or die("Error de Busqueda detalle del examen");
                                           $regi=mysql_num_rows($resu);
                                           if($regi==0):
                                              ?>
                                              <script language="javascript">
                                                alert("No hay detallado del examen de ingreso ?")
                                               // history.back()
                                              </script>
                                              <?
                                           else:
                                             ?>
                                                 <tr class="cajas">
                                                    <td><b>Descripción</b></td>
                                                    <td><b><div align="center">Vlr_Examen</div></b></td>
                                                 </tr>
                                               <?

                                                while($fila=mysql_fetch_array($resu)):
                                                 $Valor=number_format($fila["vlrexamen"],0);
                                                  ?>
                                                  <tr class="cajas">
                                                    <td  class="cajas"><?echo $fila["descripcion"];?></td>
                                                    <td  class="cajas"><div align="center">$<?echo $Valor;?></div></td>
                                                </tr>
                                                  <?
                                                endwhile;
                                                 ?>
                                                 <table border="0" align="center" width="712">
                                                   <tr><td><br></td></tr>
                                                   <tr><td><br></td></tr>
                                                  <tr><td class="cajas"><b><u>Aceptada y Firmada:</u></b>&nbsp;________________________________________</td></tr>
                                                </table>
                                                <?
                                           endif;
                                           ?>
                                           </tr></td>
                                          </table>
                                        </td></tr>
                                       </table>
        </body>
</html>
