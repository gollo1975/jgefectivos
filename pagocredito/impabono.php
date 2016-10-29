<html>
        <head>
                <title>Impresión de abonos</title>
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
         $variable="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,credito.cedemple,credito.nrocredito,credito.nuevo from empleado,credito where
                     empleado.cedemple=credito.cedemple and
                      credito.nrocredito='$nro'";
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
               <img src="../image/logounico.png" border="0"width="125" heigth="145" cellspacing="0" cellpadding="0">
               
                 <tr>
                  <td colspan="2"><td class="cajas"><b><u>LISTADO DE ABONOS</u></b></td>
                </tr>
                 <td>&nbsp;</td>
                <td>&nbsp;</td>
                <tr>
                  <td colspan="1"><td class="cajas"><b>Empleado:</b>&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                  </tr>
                  <tr>
                  <td colspan="1"><td class="cajas"><b>Documento:</b>&nbsp;<?echo $filas["cedemple"];?> </td>
                </tr>
                 <tr>
                  <td colspan="1"</td><td class="cajas"><b>Nro_Comp.:</b>&nbsp;<?echo $filas["nrocredito"];?></td></center>
                </tr>
               </table>
                 <td>&nbsp;</td>
                 <tr>
                   <table border="0" align="center">
                      <tr aling="center">
                        <td colspan="2"></td><td class="cajas"><b>Detallado de Abonos </b></td>
                      </tr>
                   </table>
                 <td>&nbsp;</td>

             <?
           endwhile;
            $buscar="select abono.* from abono,credito where
                     abono.nrocredito=credito.nrocredito and
                     credito.nrocredito='$nro'";
                     $resul=mysql_query($buscar)or die("consulta incorrecta uno");
             $reg=mysql_num_rows($resul);
                       ?>
                      <table border="0" align="center" width="700">
                         <tr align="center" class="cajas">
                             <td><b>NroAbono<b></td>
                             <td><b>Vlr_Abono</b></td>
                             <td><b>Nuevo_Saldo</b></td>
                             <td><b>Fecha_Abono</b></td>
                        </tr>
                        <?
                     while ($filas_s=mysql_fetch_array($resul)):
                       $xbusca1=number_format($filas_s["abono"],2);
                       $xbusca2=number_format($filas_s["nuevo"],2);
                       ?>
                       <tr align="center" class="cajas">
                          <td><?echo $filas_s["codabono"];?></td>
                          <td><?echo $xbusca1;?></td>
                          <td><?echo $xbusca2;?></td>
                          <td><?echo $filas_s["fecha"];?></td>
                       </tr>
                       <?
                        $abono=$abono+$filas_s["abono"];
                     endwhile;
                      $xbusca=number_format($abono,2);
                     ?>
                     </table>
                       <td>&nbsp;</td>
                      <tr >
                        <center><td class="cajas"><b>Total Abono:</b>&nbsp;<?echo $xbusca;?></td></center>
                      </tr>
                     <?
                    endif;
                    
            ?>

                   </body>
</html>
