<html>
        <head>
                <title>Variación de Salario</title>
        </head>
         <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        <body>
        <?
  if (!isset($empresa)):
     include("../conexion.php");
  ?>
  <center><h4>Variación de Salario</h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
  <tr>
   <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="empresa" class="cajas">
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
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($empresa)):
  ?>
  <script language="javascript">
    alert("Seleccione la empresa de la lista ?")
    history.back()
  </script>
  <?
  else:
                include("../conexion.php");
               $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,nomina.cedemple,nomina.neto,nomina.presta,empleado.cuenta,zona.zona,contrato.salario from maestro,sucursal,empleado,periodo,zona,nomina,contrato
                  where maestro.codmaestro=sucursal.codmaestro and
                  sucursal.codsucursal=zona.codsucursal and
	          zona.codzona=periodo.codzona and
	          zona.codzona=empleado.codzona and
                  empleado.codemple=contrato.codemple and
                  contrato.fechater='0000-00-00' and
	          empleado.cedemple=nomina.cedemple and
	          periodo.codigo=nomina.codigo and
	          periodo.desde='$desde' and periodo.hasta='$hasta' and
	          maestro.codmaestro='$empresa'order by zona.zona,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
                $resultado=mysql_query($consulta) or die("Error al buscar nomina");
                $registros=mysql_num_rows($resultado);
                if ($registros==0):
                  ?>
                        <script language="javascript">
                                alert("No Existen Registros")
                                history.back()
                        </script>
               <?
                else:
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Pagar Nomina.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                        ?>
                   <table border="0" align="center">
                        <tr class="cajas">
                        <td style='font-weight:bold;font-size:1.1em;'>Item</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Empleado</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Salario</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Vlr_Pagar</td>
                         <td style='font-weight:bold;font-size:1.1em;'>Variación</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                 </tr>
                 <?
                 $i=1;
             while($filas_s=mysql_fetch_array($resultado)):
                 $aux=$filas_s["salario"]/2;
                 $aux1=$filas_s["presta"] - $aux;
                        ?>
                <tr  class="cajas">
                 <td><?echo $i;?></td>
                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["salario"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["neto"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $aux1;?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
               </tr>
                <?
                $i=$i+1;
            endwhile;
            ?>
            </table>
                              <?
                endif;
 endif;
                ?>
        </body>
</html>
