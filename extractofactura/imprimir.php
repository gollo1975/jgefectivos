<html>
        <head>
                <title>Impresion Detalle Factura</title>
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
                        $consulta="select extracto.autoriza,extracto.nrofactura,extracto.desde,extracto.hasta,extracto.nota1,zona,zona,sucursal.sucursal from extracto,factura,zona,sucursal
                        where sucursal.codsucursal=zona.codsucursal and
                             factura.codzona=zona.codzona and
                             factura.nrofactura=extracto.nrofactura and
                             extracto.autoriza='$autoriza'";
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
                ?>
                             <table border="0" align="center" width="700">
                               <tr>
                                 <td colspan="10" class="cajas"><?echo $filas["sucursal"];?></td><th>Nro_Factura:</th><td class="cajas"><?echo $filas["nrofactura"];?></td>
                                </tr>
                                <tr>
                               <th colspan="17">DETALLADO DE LA FACTURA</th>&nbsp;<th>&nbsp;Aut.</th>
                                </tr>
                                <tr>
                                 <th colspan="17">COMPENSACIONES</th><td class="cajas">&nbsp;<?echo $filas["autoriza"];?></td>
                                </tr>
                                <tr>
                                  <th colspan="6">
                                  <th>&nbsp;Desde:</th>
                                   <td class="cajas">&nbsp;&nbsp;&nbsp;<?echo $filas["desde"];?></td>
                                   <th>&nbsp;Hasta:</th>
                                   <td class="cajas">&nbsp;&nbsp;&nbsp;<?echo $filas["hasta"];?></td>
                                   <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zona:</th>
                                   <td class="cajas">&nbsp;<?echo $filas["zona"];?></td>
                                   </th></tr>
                                 <?
                                 $nota=$filas["nota1"];
                            }
                        }
                       ?>
                          </table>
                <?
                        $consulta_s="select dextracto.codcomp,listado.concepto,dextracto.porcentaje,dextracto.valor from dextracto,listado where dextracto.autoriza='$autoriza' and dextracto.codcomp=listado.codcomp order by listado.concepto";
                        $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta 1");
                        $registros_s=mysql_num_rows($resultado_s);
                        if ($registros_s==0)
                        {
                ?>
                           <script language="javascript">
                              alert("No Existe Detalle de Factura")
                              history.back()
                           </script>
                <?
                        }
                        else
                        {

                ?>
                                <br>
                                <table border="0" align="center" width="600" >
                                  <tr>
                                    <th class="cajas">Código</th>
                                    <th class="cajas">Descripción</th>
                                    <th class="cajas">Porcentaje</th>
                                    <th class="cajas">&nbsp;&nbsp;&nbsp;Valor</th>
                                  </tr>
                                <?
                                while ($filas_s=mysql_fetch_array($resultado_s))
                                {
                ?>
                                        <tr>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["codcomp"];?></td>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["concepto"];?></td>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["porcentaje"];?></td>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["valor"];?></td>
                                         </tr>


                <?
                 $total=$total+$filas_s["valor"];
                 }
                                $lineas=4-$registros;
                                for ($i=1;$i<=$lineas;$i++)
                                {
                ?>
                                        <tr>
                                                <td colspan="6">&nbsp;</td>
                                        </tr>
                <?
                                }
                ?>
                <tr><td>&nbsp;<td></tr>
                <tr><td>&nbsp;<td></tr>

                <tr>
                  <td class ="cajas" colspan="2">&nbsp;
                   <?echo $nota;?></td>
                   <td><b>Total:</b></td><th class="cajas" align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $total;?></th>
                   </tr>
                <?
                        }

?>
        </body>
</html>
