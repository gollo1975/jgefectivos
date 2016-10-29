<html>
        <head>
                <title>Impresión nomina por Zona</title>
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
        $variable="select zona.zona,zona.codzona from zona where
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
               <table border="0" align="center" width="700">
               <img src="../image/logounico.png" border="0" width="130" heigth="120">

                 <tr>
                  <td colspan="2"><td class="cajas"><b><u>NOMINA POR ZONA</u></b></td>
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
                        <td colspan="2"></td><td class="cajas"><b>Listado de Empleados </b></td>
                      </tr>
                   </table>
                 <td>&nbsp;</td>

             <?
           endwhile;
            $buscar="select nomina.cedemple,nomina.neto,nomina.consecutivo,empleado.nomemple,empleado.apemple,empleado.cuenta from empleado,periodo,zona,nomina where
                      zona.codzona=periodo.codzona and
                      zona.codzona=empleado.codzona and
                      empleado.cedemple=nomina.cedemple and
                      periodo.codigo=nomina.codigo and
                      periodo.desde='$desde' and periodo.hasta='$hasta' and
                      zona.codzona='$codzona'order by empleado.nomemple,empleado.apemple";
              $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
                       ?>
                      <table border="0" align="center" width="700">
                         <tr align="center" class="cajas">
                             <td><b>Cod_Nomina<b></td>
                             <td><b>Documento</b></td>
                             <td><b>Empleado</b></td>
                              <td><b>Cuenta</b></td>
                             <td><b>Vlr_Pagar</b></td>
                        </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                       $xl1=number_format($filas_s["neto"],0);
                       ?>
                       <tr align="center" class="cajas">
                          <td><?echo $filas_s["consecutivo"];?></td>
                          <td><?echo $filas_s["cedemple"];?></td>
                          <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["apemple"];?></td>
                          <td align="right"><?echo $filas_s["cuenta"];?></td>
                          <td align="right"><?echo $xl1;?></td>

                       </tr>
                       <?
                        $xl2=$xl2+$filas_s["neto"];
                        $abono=number_format($xl2,0);
                     endwhile;
                     ?>
                     </table>
                       <td>&nbsp;</td>
                      <tr>
                        <center><td class="cajas"><b>Total_Pagar:</b>&nbsp;<?echo $abono;?></td></center>
                      </tr>
                     <?
                    endif;
                    
            ?>

                   </body>
</html>
