<html>
        <head>
                <title>Impresión de Vacaciones</title>
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
         $variable="select sucursal.dirsucursal,sucursal.telsucursal,sucursal.faxsucursal,musucursal,empleado.cuenta,vacacion.* from zona,sucursal,empleado,vacacion where
                     sucursal.codsucursal=zona.codsucursal and
                      zona.codzona=empleado.codzona and
                     empleado.cedemple=vacacion.cedemple and
                     vacacion.codvaca='$codvaca'";
        $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Nro De la Vacacion, no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
            $cedula=number_format($filas["cedemple"],0);
            $ibc=number_format($filas["ibc"],0);
            $valor=number_format($filas["valor"],0);
             ?>
               <table border="1" align="center" width="710">
               <tr>
               <td>
               <table border="0" align="center">
               <img src="../image/logotipo.png" border="0" heigth="120" width="120">
                <tr>
                 <td colspan="1" class="cajas"><td>811.034.496-8</td><td colspan="20" align="center"><b>DESCANSO ANUAL COMPENSADO</b></td><td colspan="20"><td class="cajas"><b>Nro:</b>&nbsp;<?echo $filas["codvaca"];?></td>
                </tr>
                 <td><td><br></td></tr>
                 <tr class="cajas">
                  <td width="10"></td><td colspan="13"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
                </tr>
                <tr class="cajas">
                  <td width="10"></td><td colspan="20"><b>Asociado:</b>&nbsp;<?echo $filas["nombre"];?></td>
                </tr>
                <tr class="cajas">
                  <td width="10"></td><td colspan="10"><b>Fecha_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td><td colspan="10"><b>Fecha_Inicio:</b>&nbsp;<?echo $filas["fechai"];?></td>
                </tr>
                <tr class="cajas">
                  <td width="10"></td><td colspan="8"><b>Fecha_Corte:</b>&nbsp;<?echo $filas["fechac"];?></td><td colspan="8"><b>Dias:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="3"><b>Ibc:</b>&nbsp;<?echo $ibc;?></td><td colspan="3"><b>&nbsp;&nbsp;&nbsp;&nbsp;Vlr_Pagado:</b>&nbsp;<?echo $valor;?></td>
                </tr>
                <tr class="cajas">
                  <center><td width="10"></td><td colspan="8"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td></center>
                </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                                     <tr class="cajas">
                    <td width="15"></td><td colspan="30"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
                    </tr>
                  <tr>
                   <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas">
                    <td width="15"></td><td colspan="19"><b>Firma:</b>&nbsp;-----------------------------------------------</td>
                    </tr>
                  <tr>
                   <td>&nbsp;</td>
                  </tr>
                  <tr class="cajas" align="center">
                     <td colspan="50">COLOMBIA - &nbsp;<?echo $filas["musucursal"];?>&nbsp;&nbsp;<?echo $filas["dirsucursal"];?>&nbsp;&nbsp; Tel:&nbsp;<?echo $filas["telsucursal"];?>&nbsp;Fax:&nbsp;<?echo $filas["faxsucursal"];?></td>
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
