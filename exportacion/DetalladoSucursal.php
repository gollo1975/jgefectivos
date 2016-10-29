<? include("../conexion.php");
         $consu="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,banco.bancos,nomina.cedemple,nomina.neto,empleado.cuenta,zona.zona from sucursal,empleado,banco,periodo,zona,nomina where
          sucursal.codsucursal=zona.codsucursal and
          zona.codzona=periodo.codzona and
          zona.codzona=empleado.codzona and
          empleado.codbanco=banco.codbanco and
          banco.codbanco='$Banco' and
          nomina.neto > 0 and
          empleado.cedemple=nomina.cedemple and
          periodo.codigo=nomina.codigo and
          periodo.pagado='' and
          periodo.desde='$desde' and periodo.hasta='$hasta' and
          sucursal.codsucursal='$DatoSucursal'order by zona.zona,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
          $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
          $registro=mysql_affected_rows();
          if ($registro!=0):
             header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Nomina por Sucursal.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
           ?>
              <table border="0" align="center">
                 <tr class="cajas">
                        <td style='font-weight:bold;font-size:1.1em;'>Item</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Vlr_Pagar</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Entidad</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                 </tr>
                 <?
                 $i=1;
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
                <tr  class="cajas">
                 <td><?echo $i;?></td>
                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["neto"];?></td>
	            <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["bancos"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
               </tr>
                <?
                $i=$i+1;
            endwhile;
             /*proceso de guardado*/
			 if($CerrarPago=='SI'){
                 include("../conexion.php");
                 $Con="update periodo set periodo.pagado='SI' where codzona=(select zona.codzona from zona inner join sucursal on sucursal.codsucursal=zona.codsucursal where zona.codzona=periodo.codzona and sucursal.codsucursal='$DatoSucursal') and
                 periodo.desde='$desde' and
	             periodo.hasta='$hasta'";
	             $resu=mysql_query($Con)or die("Error al actualizar");
	             $reg=mysql_affected_rows();
			 } 
	         /*fin proceso*/
            ?>
            </table>
              <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empresas pendientes por pago de nomina!")
                history.back()
             </script>
            <?

         endif;

  ?>
</table>

</body>
</html>
