<html>
        <head>
                <title>Impresion de Factura</title>
                <LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">
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
                        $consulta="select factura.fechaini 'fecha',factura.fechaven,factura.observacion,factura.subtotal,factura.iva,factura.grantotal,zona.* from factura,zona
                        where factura.nrofactura='$nrofactura' and factura.codzona=zona.codzona ";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
                ?>
                                <script language="javascript">
                                        alert("No Existe la Factura")
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
                                             <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td>&nbsp;</td>
                                          </tr>
                                          <tr>
                                             <td>&nbsp;</td>
                                          </tr>

                                               <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                        <td colspan="2"><?echo $filas["fecha"];?></td>
                                                </tr>
                                                <tr><td><br></td></tr>
                                                <tr>
                                                        <td width="25">&nbsp;</td>
                                                        <td class="cajas">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["zona"];?></td>
                                                        <td width="50">&nbsp;</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["nitzona"];?></td>
                                                </tr>
                                                <tr>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["dirzona"];?></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas["telzona"];?></td>
                                                        <td width="25">&nbsp;</td>
                                                        <td>&nbsp;<?echo $filas["fechaven"];?></td>

                                                </tr>
                                                              <?
                                        $subtotal=$filas["subtotal"];
                                        $iva=$filas["iva"];
                                        $grant=$filas["grantotal"];
                                        $observacion=$filas["observacion"];
                                }
                        }
                ?>
                                        </table>
                <?
                        $consulta_s="select defactura.*,salario.* from defactura,salario where defactura.nrofactura='$nrofactura' and defactura.codsala=salario.codsala";
                        $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta");
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
                                <br><br>
                                <table border="0" align="center" width="700">
                                <?
                                while ($filas_s=mysql_fetch_array($resultado_s))
                                {
                ?>
                                        <tr>
                                               <td align="left" width="60">&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["cantidad"];?></th>
                                               <td width="200" class="cajas">&nbsp;<?echo $filas_s["desala"];?></td>
                                               <td width="5">&nbsp;</td>
                                               <td width="5">&nbsp;</td>
                                               <td width="40">&nbsp;&nbsp;&nbsp;<?echo $filas_s["vlruni"];?></td>
                                               <td align="left" width="40">&nbsp;<?echo $filas_s["total"];?></td>

                                         </tr>


                <?
                                }
                                $lineas=6-$registros;
                                for ($i=1;$i<=$lineas;$i++)
                                {
                ?>
                                        <tr>
                                                <td colspan="6">&nbsp;</td>
                                        </tr>
                <?
                                }
                ?>
                <tr>
                  <td colspan="4">&nbsp;
                  <?
                   echo $observacion;?></td></tr>
                                        <tr>
                                                <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td align="left" valign="top">&nbsp;<?echo $subtotal;?></td>
                                        </tr>
                                        <tr>
                                         <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td align="left" valign="top">&nbsp;<?echo $iva;?></td>
                                        </tr>
                                        <tr>
                                           <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                 <td>&nbsp;</td>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td align="left" valign="top">&nbsp;<?echo $grant;?></td>
                                        </tr>
                <?
                        }

?>
        </body>
</html>
