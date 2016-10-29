<html>
        <head>
                <title>Impresión Pago de Incapacidad</title>
              <LINK  REL="stylesheet" HREF="../formato.css" type="text/css">
                <script language="javascript">
                        function imprimir()
                        {
                                window.print()
                        }
                </script>
        </head>
        <body onload="imprimir()">  <!-- sirve para cargar la funcion de impresion-->
               <?

        include("../conexion.php");
         $variable="select pagado.*,maestro.dirmaestro,maestro.codmuni as auxiliar,municipio.municipio,maestro.telmaestro,maestro.faxmaestro,empleado.cuenta,maestro.nomaestro from maestro,pagado,empleado,sucursal,zona,municipio where
                     maestro.codmaestro=sucursal.codmaestro and
                      sucursal.codsucursal=zona.codsucursal and
                      municipio.codmuni=sucursal.codmuni and
                      zona.codzona=empleado.codzona and
                     empleado.cedemple=pagado.cedemple and
                     pagado.nropago='$nropago'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
          while ($filas=mysql_fetch_array($resultado)):
          $valor=number_format($filas["valor"],0);
             ?>
               <table border="1" align="center" width="710">
               <tr>
               <td>
               <table border="0" align="center" width="710">
               <img src="../image/logounico.png" border="0" width="130" heigth="125">
                <tr>
                 <td class="cajas" colspan="5"><b>Nit:</b>&nbsp;811.034.496-8</td><td colspan="15" align="center"><b><u>&nbsp;&nbsp;&nbsp;&nbsp;PAGO DE INCAPACIDADES</u></b></td><td colspan="10"><td class="cajas"><b>Nro_Pago:</b>&nbsp;<?echo $filas["nropago"];?></td>
                </tr>
                 <td><td><br></td></tr>
                 <tr class="cajas">
                  <td colspan="10"><b>Documento:</b>&nbsp;<?echo $filas["cedemple"];?></td><td colspan="15"><b>Nro_Incapacidad:</b>&nbsp;<?echo $filas["nroinca"];?></td>
                </tr>
                <tr class="cajas">
                  </td><td colspan="25"><b>Empleado:</b>&nbsp;<?echo $filas["nombre"];?></td>
                </tr>
                <tr class="cajas">
                  </td><td colspan="10"><b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td><td colspan="10"><b>Fecha_Inicio:</b>&nbsp;<?echo $filas["fechai"];?></td>
                </tr>
                <tr class="cajas">
                </td><td colspan="8"><b>Fecha_Ter.:</b>&nbsp;<?echo $filas["fechat"];?></td><td colspan="8"><b>Dias_Inca.:</b>&nbsp;<?echo $filas["dias"];?><td colspan="10"><b>Dias_Pag.:</b>&nbsp;<?echo $filas["diapagar"];?></td><td colspan="3">&nbsp;&nbsp;<b>Ibc:</b>&nbsp;<?echo $filas["ibc"];?></td><td colspan="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;% Pago:</b>&nbsp;<?echo $filas["porcentaje"];?></td>
                </tr>
                <tr class="cajas">
                  <center></td><td colspan="8"><b>Vlr_Pagado:</b>&nbsp;<?echo $valor;?></td><td colspan="8"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td></center>
                </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                                     <tr class="cajas">
                    <td colspan="30"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
                    </tr>
                  <tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                    <td colspan="19"><b>Firma:</b>&nbsp;-----------------------------------------------</td>
                    </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas" align="center">
                     <td colspan="50">COLOMBIA - &nbsp;<?echo $filas["municipio"];?>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; <b>PBX:</b>&nbsp;<?echo $filas["telmaestro"];?>&nbsp;<b>Fax:</b>&nbsp;<?echo $filas["faxmaestro"];?></td>
                </tr>
                 </table>
                 </td></tr>
               </table>
             <?
           endwhile;

            ?>

                   </body>
</html>
