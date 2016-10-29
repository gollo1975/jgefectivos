<html>

<head>
  <title>Prestaciones Sociales</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Prestacion x Pagar</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
 <tr>
         <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la Empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
    <tr>
     <td><b>Tipo_Export.:</b></td>
        <td><input type="radio" value="Individual" name="Validar">Individual<input type="radio" value="General"  name="Validar">General</td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
elseif (empty($Validar)):
?>
  <script language="javascript">
    alert ("Seleccione el tipo de Exportación.!")
    history.back()
  </script>
    <?
else:
   if($Validar=='Individual'):?>
   <div align="center"><h4><u>Prestaciones X Pagar</u></h4></div>
      <form action="Buscar.php" method="post" name="f1">
        <table border="0" align="center" width="552">
         <tr class="cajas">
	  <th><b>#</b></td><th>&nbsp;</th><th><b>Nro_Prest.</b></th><th><b>Documento</b></th><th><b>Empleado</b></th><th><b>Vlr_Pagar</b></th><th><b>Zona</b></th>
	  </tr><?
          include("../conexion.php");
          $consu="select prestacion.*,zona.zona,empleado.cuenta from maestro,sucursal,empleado,zona,prestacion
          where maestro.codmaestro=sucursal.codmaestro and
          sucursal.codsucursal=zona.codsucursal and
          zona.codzona=empleado.codzona and
          empleado.cedemple=prestacion.cedemple and
          prestacion.control='ACTIVA' and
          maestro.codmaestro='$campo'order by zona.zona";
          $resulta=mysql_query($consu)or die ("Error de busqueda de prestaciones");
          echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");  ;
          $i=1;
          while ($fila= mysql_fetch_array($resulta)):
                ?>
		 <tr class="cajas">
	            <th><?echo $i;?></th>
		    <?
                    echo ("<td><input type=\"checkbox\" id=name=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $fila['nropresta'] ."\" \"></td>");?>
		    <td><input type="text" value="<?echo $fila["nropresta"];?>"  size="13" readonly class="cajas"></td>
                    <td><input type="text" value="<?echo $fila["cedemple"];?>" name="Documento[<? echo $i;?>]"id="Documento[<? echo $i;?>]" size="14" readonly class="cajas"></td>
		    <td><input type="text" value="<?echo $fila["nombres"];?>" name="empleado[<? echo $i;?>]"id="empleado[<? echo $i;?>]" size="45" readonly class="cajas"></td>
		    <td><input type="text" value="<?echo $fila["totalp"];?>" name="pagado[<? echo $i;?>]"id="pagado[<? echo $i;?>]"size="11"  class="cajas"></td>
                    <td><input type="text" value="<?echo $fila["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]"size="40" class="cajas" readonly></td>
		 <tr>
		  <?
		$i=$i+1;
	  endwhile;
        ?>
         <tr><td><br></td></tr>
	   <tr>
	    <td colspan="2">
	      <input type="submit" value="Exportar" class="boton">
	    </td>
        </table>
      </form>
    <?
   else:
         include("../conexion.php");
          $consu="select prestacion.*,zona.zona,empleado.cuenta from maestro,sucursal,empleado,zona,prestacion
          where maestro.codmaestro=sucursal.codmaestro and
          sucursal.codsucursal=zona.codsucursal and
          zona.codzona=empleado.codzona and
          empleado.cedemple=prestacion.cedemple and
          prestacion.control='ACTIVA' and
          maestro.codmaestro='$campo'order by prestacion.nombres";
          $resulta=mysql_query($consu)or die ("Error de busqueda de prestaciones");
          $registro=mysql_affected_rows();
          if ($registro!=0):
             header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Prestaciones.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
           ?>
              <table border="0" align="center">
                 <tr class="cajas">
                        <td style='font-weight:bold;font-size:1.1em;'>Item</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Nro_Presta.</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Financiero</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Vestuario</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Alianza</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Caja</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Jgefectivos</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Cesantia</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Interes</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Primas</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Vacaciones</td>
                        <td style='font-weight:bold;font-size:1.1em;'>T_Generado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>T_Deduccion</td>
                        <td style='font-weight:bold;font-size:1.1em;'>T_Pagar</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                 </tr>
                 <?
                 $a=1;
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
                <tr  class="cajas">
                 <td><?echo $a;?></td>
                  <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["nropresta"];?></div></td>
                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nombres"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["prestamo"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["vestuario"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["otros"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["comfenalco"];?></td>
                  <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["empresa"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["cesantia"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["interes"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["prima"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["vacacion"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["total"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totald"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["totalp"];?></td>
                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
               </tr>
                <?
                $a=$a+1;
            endwhile;
            ?>
            </table>
              <?
          else:
            ?>
              <script language="javascript">
                alert("No No hay prestaciones en este rango de fechas ?")
                history.back()
             </script>
            <?

          endif;
     endif;
  endif;
  ?>
</table>

</body>
</html>
