<html>
        <head>
                <title>Impresión de Retiro de Asociados</title>
                  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

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
        $variable="select zona.zona,zona.codzona,sucursal.sucursal from zona,sucursal where
                 sucursal.codsucursal=zona.codsucursal and
                 zona.codzona='$codzona'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("No hay registro para Mostrar ?")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center" width="710">

               <tr>
                 <td colspan="1"></td><td class="cajas"><b>Nit:&nbsp;811.034.496-8</b></td>
                 <td colspan="25"></td><td class="cajas"><?echo $filas["sucursal"];?></td>
               </tr>
                 <tr>
                  <td colspan="2"><td class="cajas"><b>RETIRO DE ASOCIADOS POR ZONA</b></td>
                </tr>
                 <td>&nbsp;</td>
                <td>&nbsp;</td>
                <tr>
                  <td colspan="1"><td class="cajas"><b>Cod_Zona:</b>&nbsp;<?echo $filas["codzona"];?></td>
                  </tr>
                  <tr>
                  <td colspan="1"><td class="cajas"><b>Zona:</b>&nbsp;<?echo $filas["zona"];?> </td>
                </tr>
                <tr>
                  <td colspan="1"><td class="cajas"><b>Desde:</b>&nbsp;<?echo $desde;?></td>
                  </tr>
                  <tr>
                  <td colspan="1"><td class="cajas"><b>Hasta:</b>&nbsp;<?echo $hasta;?> </td>
                </tr>
                </table>
                 <td>&nbsp;</td>
                 <tr>
                   <table border="0" align="center">
                      <tr aling="center">
                        <td colspan="2"></td><td class="cajas"><b>Listado De Empleados </b></td>
                      </tr>
                   </table>
                 <td>&nbsp;</td>

             <?
           endwhile;
            $buscar="select retiro.* from retiro,zona,empleado where
                  empleado.codzona=zona.codzona and
                  empleado.cedemple=retiro.cedemple and
                  retiro.fecha between '$desde' and '$hasta' and
                  zona.codzona='$codzona'order by retiro.fecha";
                   $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
                       ?>
                      <table border="0" align="center" width="710">
                         <tr align="center" class="cajas">
                             <td><b>Cod_Retiro<b></td>
                             <td><b>Documento</b></td>
                             <td><b>Empleado</b></td>
                              <td><b>Fecha_Proceso</b></td>
                             <td><b>Fecha_Retiro</b></td>
                             <td><b>Dias</b></td>
                        </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                       ?>
                       <tr align="center" class="cajas">
                          <td><?echo $filas_s["nroretiro"];?></td>
                          <td><?echo $filas_s["cedemple"];?></td>
                          <td><?echo $filas_s["nombres"];?></td>
                          <td align="right"><?echo $filas_s["fecha"];?></td>
                          <td align="right"><?echo $filas_s["fechare"];?></td>
                          <td align="right"><?echo $filas_s["dias"];?></td>

                       </tr>
                       <?
                        $abono=$abono + 1;
                     endwhile;
                     ?>
                     </table>
                       <td>&nbsp;</td>
                      <tr >
                        <center><td class="cajas"><b>Nro_Registros:</b>&nbsp;<?echo $abono;?></td></center>
                      </tr>
                     <?
                    endif;
                    
            ?>

                   </body>
</html>
