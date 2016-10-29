<html>
        <head>
                <title>Impresion de la cuenta de cobro</title>
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
                        $consulta="select cuenta.nrocuenta,cuenta.nit,cliente.dv,cliente.cliente,cliente.dircliente,cliente.telcliente,cuenta.fechaini,cuenta.fechaven,cuenta.observacion,sucursal.sucursal,sucursal.dirsucursal,sucursal.telsucursal
                        from cuenta,sucursal,cliente
                        where sucursal.codsucursal=cliente.codsucursal and
                             cliente.nit=cuenta.nit and
                             cuenta.nrocuenta='$nrocuenta'";

                        $resultado=mysql_query($consulta) or die("consulta incorrecta 3");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0):
                ?>
                          <script language="javascript">
                            alert("No Existe al cuenta de Cobro")
                            history.back()
                          </script>
                <?
                        else:
                           while ($filas=mysql_fetch_array($resultado)):
                ?>          <table border="1" align="center"width="705">
                            <tr>
                            <td>
                             <table border="0" align="center" width="705">
                             <img src="../image/logotipo.png" border="0"
                               <tr align="center">
                                 <td><b>Nit: 811.034.496-8</b></td>
                                 <th colspan="10">
                                 <td class="cajas"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["dirsucursal"];?></b><td>
                                 <td colspan="8">
                                 <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuenta de Cobro</b></td>
                              </tr>
                              <tr align="center">
                                 <td>&nbsp;</td>
                                 <th colspan="10">
                                 <td><b>Medellin_Colombia:</b></td>
                                 <td colspan="9">
                                 <td><?echo $filas["nrocuenta"];?><td>
                              </tr>
                               <tr align="center">
                                 <td>&nbsp;</td>
                                 <th colspan="10">
                                 <td><b><?echo $filas["telsucursal"];?></b><td>
                                 <td colspan="8">
                                 <td><b>&nbsp;</b></td>
                              </tr>
                               <tr><td><br></td></tr>
                              <tr align="center">
                                 <td>&nbsp;</td>
                                 <th colspan="10">
                                 <td><b>Fecha Inicio</b><td>
                                 <td colspan="8">
                                 <td><b>Fecha Vencimiento</b></td>
                              </tr>
                              <tr align="center">
                                 <td>&nbsp;</td>
                                 <th colspan="10">
                                 <td><?echo $filas["fechaini"];?><td>
                                 <td colspan="8">
                                 <td><?echo $filas["fechaven"];?><td>
                              </tr>
                               <tr><td><br></td></tr>
                                <tr><td><br></td></tr>
                                <tr>
                                 <td><b>Señor(a):</b></td>
                                 <th colspan="10">
                                 <td class="cajas"><?echo $filas["cliente"];?><td>
                                 <td colspan="8">
                                 <td class="cajas"><b>Nit/Cedula:&nbsp;</b><?echo $filas["nit"];?>-<?echo $filas["dv"];?></td>
                              </tr>
                              <tr>
                                 <td><b>Dirección:</b></td>
                                 <th colspan="10">
                                 <td class="cajas"><?echo $filas["dircliente"];?><td>
                                 <td colspan="8">
                                 <td class="cajas"><b>Teléfono:&nbsp;&nbsp;&nbsp;&nbsp;</b><?echo $filas["telcliente"];?></td>
                              </tr
                               </table>
                            <?
                            $observacion=$filas["observacion"];
                            endwhile;
                         endif;
                        $consulta_s="select decuenta.codservi,servicio.descripcion,decuenta.cantidad,decuenta.vlruni,decuenta.descuento,decuenta.subtotal from decuenta,servicio
                            where decuenta.codservi=servicio.codservi and
                                  decuenta.nrocuenta='$nrocuenta'order by servicio.descripcion";

                        $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta 1");
                        $registros_s=mysql_num_rows($resultado_s);
                        if ($registros_s==0)
                        {
                ?>
                           <script language="javascript">
                              alert("No Existen Detalles para la cuenta de Cobro")
                              history.back()
                           </script>
                <?
                        }
                        else
                        {
                                ?>
                                  <table border="0" align="center" width="650" >
                                   <tr><td><br></td></tr>
                                    <tr>
                                    <th class="cajas">Cód_Servicio</th>
                                     <th class="cajas">Servicio</th>
                                    <th class="cajas">Cantidad</th>
                                    <th class="cajas">Vlr_Unit.</th>
                                    <th class="cajas">Descuento</th>
                                    <th class="cajas">&nbsp;&nbsp;&nbsp;Total</th>
                                  </tr>
                                <?
                                while ($filas_s=mysql_fetch_array($resultado_s))
                                {
                                $aux=number_format($filas_s["vlruni"],0);
                                $aux1=number_format($filas_s["subtotal"],0);
                ?>
                                        <tr>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["codservi"];?></td>
                                          <td class="cajas"><?echo $filas_s["descripcion"];?></td>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["cantidad"];?></td>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $aux;?></td>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["descuento"];?></td>
                                          <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $aux1;?></td>
                                         </tr>


                <?
                 $total=$total+$filas_s["subtotal"];
                 }
                 $total=number_format($total,0);
                                $lineas=15-$registros;
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


                <tr>
                  <td class ="cajas" colspan="10">
                   <?echo $observacion;?></td>
                 </tr>
                 <tr><td><br></td></tr>
                 <tr align="center">
                   <td><b>Total_Pagar:</b></td><th class="cajas" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $total;?></th>
                 </tr>
                <?
                        }

?>
   </table>
    </td></tr>
        </body>
</html>
