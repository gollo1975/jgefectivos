<html>
        <head>
                <title>Reporte  Primas semestrales</title>
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
         $variable="select municipio.municipio,sucursal.dirsucursal,maestro.telmaestro,sucursal.sucursal,maestro.telmaestro,maestro.dirmaestro,maestro.web,maestro.faxmaestro,empleado.cuenta,prima.* from maestro,municipio,zona,sucursal,empleado,prima where
                     maestro.codmaestro=sucursal.codmaestro and
                     municipio.codmuni=maestro.codmuni and
                     sucursal.codsucursal=zona.codsucursal and
                      zona.codzona=empleado.codzona and
                     empleado.cedemple=prima.cedemple and
                     prima.nroprima='$nroprima'";
        $resultado=mysql_query($variable)or die("Error al buscar nro de prima");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El Nro prima, no existe en la b.d.")
            history.back()
          </script>
         <?
        else:
            while ($filas=mysql_fetch_array($resultado)):
            $cedula=number_format($filas["cedemple"],0);
            $salario=number_format($filas["salario"],0);
            $total=number_format($filas["total"],0);
             ?>
               <table border="1" align="center" width="710">
               <tr>
               <td>
               <table border="0" align="center" width="710">
               <img src="../image/logounico.png" border="0" heigth="130" width="135">
                <tr>
                 <td colspan="10"></td><td colspan="20" align="center"><b><u>PRIMA SEMESTRAL</u></b></td><td colspan="20"><td class="cajas"><b>Nro:</b>&nbsp;<?echo $filas["nroprima"];?></td>
                </tr>
                <tr>
                 <td colspan="60">---------------------------------------------------------------------------------------------------------------------------------</td>
                 </tr>
                 <tr class="cajas">
		                  </td><td colspan="15"><b>Documento:</b>&nbsp;<?echo $cedula;?></td>
		                </tr>
		                <tr class="cajas">
		                 </td><td colspan="25"><b>Empleado:</b>&nbsp;<?echo $filas["nombre"];?></td>
		                </tr>
		                <tr class="cajas">
		                <td colspan="15"><b>F_Proceso:</b>&nbsp;<?echo $filas["fechap"];?></td><td colspan="11"><b>F_Inicio:</b>&nbsp;<?echo $filas["fechai"];?></td><td colspan="15"><b>F_Corte:</b>&nbsp;<?echo $filas["fechacorte"];?></td>
		                </tr>
		                <tr class="cajas">
		                <td colspan="15"><b>F_Inicio_Cont:</b>&nbsp;<?echo $filas["fechainicio"];?></td><td colspan="11"><b>Dias:</b>&nbsp;<?echo $filas["dias"];?></td><td colspan="10"><b>Ibc:</b>&nbsp;$<?echo $salario;?></td><td colspan="15"><b>Vlr_Pagado:</b>&nbsp;$<?echo $total;?></td>
		                </tr>
		                <tr class="cajas">
		                 <td colspan="15"><b>Cuenta:</b>&nbsp;<?echo $filas["cuenta"];?></td><td colspan="20"><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td>
		                </tr>
                                  <tr class="cajas">
		                    <td colspan="40"><b>Total dias de ausentimos y Licencias no remuneradas en el perido de liquidacion de primas:</b>&nbsp;<?echo $filas["diadeduccion"];?> dias</td>
                                </tr>
		                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                                     <tr class="cajas">
		                    <td colspan="40"><b>Nota:</b>&nbsp;<?echo $filas["nota"];?></td>
		                    </tr>
		                  <tr>
		                   <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr class="cajas">
		                    <td colspan="30"><b>Firma:</b>&nbsp;-----------------------------------------------</td>
		                    </tr>
		                  <tr>
		                   <td>&nbsp;</td>
		                  </tr>
		                  <tr class="cajas" align="center">
		                     <td colspan="60"><b><?echo $filas["municipio"];?></b>&nbsp;&nbsp;<?echo $filas["dirmaestro"];?>&nbsp;&nbsp; <b>PBX:</b>&nbsp;<?echo $filas["telmaestro"];?>&nbsp;<b>Fax:</b>&nbsp;<?echo $filas["faxmaestro"];?>&nbsp;<b>Web:</b>&nbsp;<?echo $filas["web"];?></td>
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
