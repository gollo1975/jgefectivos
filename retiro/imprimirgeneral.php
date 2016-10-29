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
        $variable="select maestro.codmaestro,maestro.nomaestro from maestro where
                 maestro.codmaestro='$codigo'";
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
               <table border="0" align="center" width="720">
                <tr>
                  <td colspan="10" class="cajas"><b><div align="center">RETIRO DE ASOCIADOS EN GENERAL</div></b></td>
                </tr>
                 <td>&nbsp;</td>
                <td>&nbsp;</td>
                <tr>
                 <td class="cajas"><b>Nit:</b>&nbsp;<?echo $filas["codmaestro"];?></td>
                  </tr>
                  <tr>
                  <td class="cajas"><b>Empresa:</b>&nbsp;<?echo $filas["nomaestro"];?> </td>
                </tr>
                <tr>
                  <td class="cajas"><b>Desde:</b>&nbsp;<?echo $desde;?></td>
                  </tr>
                  <tr>
                  <td class="cajas"><b>Hasta:</b>&nbsp;<?echo $hasta;?> </td>
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
            $buscar="select retiro.*,zona.zona,eps.eps,pension.pension from maestro,retiro,zona,empleado,sucursal,eps,pension
                      where maestro.codmaestro=sucursal.codmaestro and
                      sucursal.codsucursal=zona.codsucursal and
                      empleado.codzona=zona.codzona and
                      empleado.codeps=eps.codeps and
                      empleado.codpension=pension.codpension and
                      empleado.cedemple=retiro.cedemple and
                      retiro.fechare between '$desde' and '$hasta' and
                      maestro.codmaestro='$codigo'order by zona.zona,retiro.fechare";
                   $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
                       ?>
                      <table border="0" align="center" width="720">
                         <tr align="center" class="cajas">
                             <td><b>Documento</b></td>
                             <td><b>Empleado</b></td>
                             <td><b>Eps</b></td>
                             <td><b>Pensión</b></td>
                             <td><b>Zona</b></td>
                             <td><b>Fecha_Retiro</b></td>
                             <td><b>Dias</b></td>
                        </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                       ?>
                       <tr align="center" class="cajas">
                          <td><?echo $filas_s["cedemple"];?></td>
                          <td><?echo $filas_s["nombres"];?></td>
                           <td><?echo $filas_s["eps"];?></td>
                            <td><?echo $filas_s["pension"];?></td>
                          <td><?echo $filas_s["zona"];?></td>
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
