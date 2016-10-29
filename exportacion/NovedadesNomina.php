<html>

<head>
  <title>Consulta de Nomina por Zona</title>
      <LINK  REL="stylesheet" HREF="../formato.css"  type="text/css">

</head>

<?
  if (!isset($desde)):
     include ("../conexion.php");
  ?>
  <center><h4><u>Novedades de Nómina</u></h4></center>
<form action="" method="post" width="150">
  <table border="1" align="center">
  <tr><td>
   <table border="0" align="center">
  <tr class="fondo">
       <th colspan="8"><br></th>
  </tr>
  <tr>
    <td><b>Desde:&nbsp;</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="12" maxlegth="10"></td>
    <td> <b>Hasta:&nbsp;</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" maxlegth="10"></td>
  </tr>
  <?
  if($codzona == ''):
     ?>
     <tr>
     <td><b>Zona:</b></td>
         <td colspan="5"><select name="codzona" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
         </select></td>
     </tr>
  <?
  endif;
  ?>
  <tr><td><br></td></tr>
   <tr>
    <td colspan="5">
      <input type="submit" value="Exportar..">
    </th>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($codzona)):
?>
  <script language="javascript">
    alert ("Seleccione la empresa para hacer la respectiva exportacion.!")
    history.back()
  </script>
    <?
else:
    include ("../conexion.php");
      $consulta="select novedadnomina.* from zona,novedadnomina where
                    zona.codzona=novedadnomina.codzona and
                    novedadnomina.desde between '$desde'and'$hasta' and
                    zona.codzona='$codzona'order by novedadnomina.nombre";
                   $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                   $registros=mysql_num_rows($resultado);
                   if($registros!=0):
                       header("Content-type: application/vnd.ms-excel");
		       header("Content-Disposition: attachment; filename=Planilla de Ingreso.xls");
		       header("Pragma: no-cache");
		       header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		       header("Expires: 0");
                       $T=1;
                       while ($filas=mysql_fetch_array($resultado)):
                           $Zona=$filas["zona"];
                           $codigo=$filas["codnovedad"];
                           $basico=number_format($filas["basico"],0);
                           $pagado=number_format($filas["pagado"],0);
                           ?>
		           <table border="0" align="center">
		             <tr  class="cajas">
		               <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
		               <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
		               <td style='font-weight:bold;font-size:1.1em;'>Desde</td>
		               <td style='font-weight:bold;font-size:1.1em;'>Hasta</td>
                               <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
		             </tr>
                           <tr  class="cajas">

	                     <td><?echo $filas["cedemple"];?></td>
	                     <td><?echo $filas["nombre"];?></td>
	                     <td style='font-weight;font-size:0.9em;'><?echo $filas["desde"];?></td>
	                     <td style='font-weight;font-size:0.9em;'><?echo $filas["hasta"];?></td>
	                     <td><?echo $filas["zona"];?></td>
	                   </tr>
                           <?
                           $consu="select denovedanomina.* from denovedanomina,novedadnomina
	                           where novedadnomina.codnovedad=denovedanomina.codnovedad and
	                                   novedadnomina.codnovedad='$codigo' order by denovedanomina.codsala ASC";
                           $resul=mysql_query($consu) or die("consulta incorrecta 1 ");
                           $reg=mysql_num_rows($resul);
                           if($reg==0):
                               ?>
                               <script language="javascript">
                                   alert("No existen Detalles de Nomina ? ")
	                       </script>
	                       <?
	                   else:
	                       ?>
                                   <tr  class="cajas">
				            <td style='font-weight:bold;font-size:1.1em;'>Cod_Salario</td>
				            <td style='font-weight:bold;font-size:1.1em;'>Concepto</td>
				            <td style='font-weight:bold;font-size:1.1em;'>Vlr_Hora</td>
				            <td style='font-weight:bold;font-size:1.1em;'>Nro_Hora</td>
				            <td style='font-weight:bold;font-size:1.1em;'><div align="center">Devengado</div></td>
                                            <td style='font-weight:bold;font-size:1.1em;'>Deducción</td>
				   </tr>
	                           <?
	                           while ($filas_s=mysql_fetch_array($resul)):
	                               if($filas_s["salario"]==0):
	                                  $Total= round($filas_s["vlrhora"] * $filas_s["nrohora"]);
	                               else:
	                                   $Total= $filas_s["salario"];
	                               endif;
                                       ?>
                                       <tr class="cajasletras">
	                                    <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["codsala"];?></td>
	                                    <td style='font-weight;font-size:0.9em;'><?echo $filas_s["concepto"];?></td>
	                                    <td style='font-weight;font-size:0.9em;'><div align="Right"><?echo $filas_s["vlrhora"];?></div></td>
	                                    <td style='font-weight;font-size:0.9em;'><div align="right"><?echo $filas_s["nrohora"];?></div></td>
	                                    <td style='font-weight;font-size:0.9em;'><div align="right"><?echo $Total;?></div></td>
	                                   <td style='font-weight;font-size:0.9em;'><div align="right"><?echo $filas_s["deduccion"];?></div></td>
                                       </tr>
                                       <?
                                   endwhile;
                                    ?>
                               <td colspan="40">*************************************************************************************************************</td>
                                <?
                           endif;
                         $T=$T+1;
                        endwhile;
                           ?>
                               </table>
                           <td style='font-weight:bold;font-size:1.1em;'>Total_Registros:&nbsp;<?echo $T-1;?></td>   
                                
                                <?
                      else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros con este rango de Fechas ?")
                            history.back()
                         </script>
                         <?
                      endif;

 endif;
       ?>


</body>
</html>
