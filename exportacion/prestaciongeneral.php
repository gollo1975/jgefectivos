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
  <center><h4><u>Prestaciones Sociales</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
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
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
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
     else:
         include("../conexion.php");
          $consu="select prestacion.*,zona.zona,empleado.cuenta from maestro,sucursal,empleado,zona,prestacion
          where maestro.codmaestro=sucursal.codmaestro and
          sucursal.codsucursal=zona.codsucursal and
          zona.codzona=empleado.codzona and
          empleado.cedemple=prestacion.cedemple and
          prestacion.fechapro between '$desde' and '$hasta' and
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
                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
						<td style='font-weight:bold;font-size:1.1em;'>Nro. Prestación</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Prestamo</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Vestuario</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Tercero</td>
                        <td style='font-weight:bold;font-size:1.1em;'>D_Comfenalco</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Cesantia</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Interes</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Primas</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Vacaciones</td>
						<td style='font-weight:bold;font-size:1.1em;'>Total</td>
						<td style='font-weight:bold;font-size:1.1em;'>Deducción</td>
						<td style='font-weight:bold;font-size:1.1em;'>Total_Pagar</td>						
                        <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                 </tr>
                 <?
                 $i=1;
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
                <tr  class="cajas">
                 <td><?echo $i;?></td>
                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
				 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nropresta"];?></td>
                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nombres"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["prestamo"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["vestuario"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["otros"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["comfenalco"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["cesantia"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["interes"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["prima"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["vacacion"];?></td>
				 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["total"];?></td>
				 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["totald"];?></td>
				 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["totalp"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
               </tr>
                <?
                $i=$i+1;
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
  ?>
</table>

</body>
</html>
