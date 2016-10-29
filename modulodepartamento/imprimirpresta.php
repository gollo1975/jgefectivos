<html>
        <head>
                <title>Reporte de Cesantias</title>
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
         $variable="select sucursal.dirsucursal,sucursal.telsucursal,zona.zona,sucursal.faxsucursal,municipio.municipio,empleado.cuenta,prestacion.* from zona,sucursal,empleado,prestacion,municipio where
                     sucursal.codsucursal=zona.codsucursal and
                     municipio.codmuni=sucursal.codmuni and
                      zona.codzona=empleado.codzona and
                     empleado.cedemple=prestacion.cedemple and
                     prestacion.nropresta='$nropresta'";
        $resultado=mysql_query($variable)or die("Error al buscar datos");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Nro De la Prestacion, no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
             $suma=$filas["ibc"]+$filas["auxilio"];
             $novedad=$filas["prestamo"]+$filas["vestuario"]+$filas["otros"]+$filas["comfenalco"];
             $compensacion=$filas["cesantia"]+$filas["interes"]+$filas["prima"]+$filas["vacacion"];
             $total=$compensacion+$novedad;
             $compensacion=number_format($compensacion,0);
              $novedad=number_format($novedad,0);
               $total=number_format($total,0);
             $cedula=number_format($filas["cedemple"],0);
             $ibc=number_format($filas["ibc"],0);
             $auxilio=number_format($filas["auxilio"],0);
             $suma=number_format($suma,0);
             $cesantia=number_format($filas["cesantia"],0);
             $interes=number_format($filas["interes"],0);
             $prima=number_format($filas["prima"],0);
             $vacacion=number_format($filas["vacacion"],0);
             $prestamo=number_format($filas["prestamo"],0);
             $vestuario=number_format($filas["vestuario"],0);
             $otros=number_format($filas["otros"],0);
             $comfenalco=number_format($filas["comfenalco"],0);
              ?>
               <table border="1" align="center" width="710">
               <tr>
               <td>
               <table border="0" align="center" width="710">
               <img src="../image/logounico.png" border="0" width="150" height="150">
                <tr>
                 <td colspan="5" class="cajas"><td class="cajas"><td colspan="30" align="center"><b><u>PRESTACIONES SOCIALES</u></b></td><td colspan="20"><td class="cajas"><b>Nro:</b>&nbsp;<?echo $filas["nropresta"];?></td>
                </tr>
                 <td><td><br></td></tr>
                 <tr class="cajas">
                  <td colspan="13"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="20"><b>Empleado:</b>&nbsp;<?echo $filas["nombres"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="6"><b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechapro"];?></td><td colspan="12"><b>Fecha_Inicio:</b>&nbsp;<?echo $filas["fechaini"];?></td> <td colspan="40"><b>Zona:</b>&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="8"><b>Fecha_Corte:</b>&nbsp;<?echo $filas["fechacor"];?></td><td colspan="10"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td><td colspan="8"><b>Dias:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="20"><b>Fecha_Imp:</b>&nbsp;<? echo date("Y-m-d");?></td>
                </tr>
                <table border="0" align="center" width="700">
                <tr>
                   <td>&nbsp;</td>
                </tr>
                <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Base Para Liquidar vacaciones:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $ibc;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Ayuda Para el Transporte:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $auxilio;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Base Liquidar Otras Prestaciones:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?echo $suma;?></td>
                </tr>
                 <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b></b>______________________________________________________________________________________________</td>
                    </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                 <td width="15" align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Cesantias:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $cesantia;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15" align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Intereses :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $interes;?></td>
                </tr>
                <tr class="cajas">
                 <td width="15" align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Prima Semestral     :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $prima;?></td>
                </tr>
                <tr class="cajas">
                 <td width="15"align="right"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vacaciones:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $vacacion;?></td>
                </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TOTAL PRESTACIONES:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $compensacion;?></td>
                </tr>
                 <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b>_________________________Novedades de las Prestaciones_____________________________</b></td>
                    </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Prestamo:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $prestamo;?></td>
                </tr>
                 <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Vestuario :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $vestuario;?></td>
                </tr>
                <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Tercero :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $otros;?></td>
                </tr>
                <tr class="cajas">
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Descuento de Comfenalco:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $ <?echo $comfenalco;?></td>
                </tr>
                <tr>
                   <td>&nbsp;</td>
                  </tr>
                <tr>
                 <td width="15"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TOTAL NOVEDADES:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $novedad;?></td>
                </tr>
                 <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b></b>______________________________________________________________________________________________</td>
                    </tr>
                    <tr>
                   <td>&nbsp;</td>
                  </tr>
                 <tr>
                 <td width="10"></td><td colspan="20">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>TOTAL PAGAR:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$ <?echo $total;?></td>
                </tr>
                <tr>
                   <td>&nbsp;</td>
                  </tr>
                     <tr class="cajas">
                    <td width="15"></td><td colspan="50"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
                    </tr>
                  <tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                   <tr class="cajas">
                    <td width="15"></td><td colspan="19"><b>Firma:</b>&nbsp;-----------------------------------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Empresa:</b>&nbsp;------------------------------------</td>
                    </tr>
                     <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas" align="center">
                     <td colspan="50">COLOMBIA - &nbsp;<?echo $filas["municipio"];?>&nbsp;&nbsp;<?echo $filas["dirsucursal"];?>&nbsp;&nbsp; PBX:&nbsp;<?echo $filas["telsucursal"];?>&nbsp;Fax:&nbsp;<?echo $filas["faxsucursal"];?></td>
                </tr>
                 </table>
                 </td></tr>
               </table>
             <?
           endwhile;
      endif;
            ?>

                   </body>
</html>
