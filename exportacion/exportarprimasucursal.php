<html>

<head>
  <title>Primas por Sucursal</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
     $conP="select periodoprima.* from periodoprima where
          periodoprima.estado='FALTA'";
          $resP=mysql_query($conP)or die ("Error en la busqueda de periodo");
      $fila=mysql_fetch_array($resP);
     ?>
  <center><h4><u>Primas por Sucursal</u></h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td><input type="text" name="desde" value="<? echo $fila["desde"];?>" size="12" maxlegth="10" readonly="yes" class="cajas"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo $fila["hasta"];?>" size="12" maxlegth="10" readonly= "yes" class="cajas"></td>
  </tr>
  <tr>
         <td><b>Sucursal:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la Sucursal
                                <?
                                 $consulta_z="select sucursal.codsucursal,sucursal.sucursal from sucursal order by sucursal";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error de busqueda de sucursales");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
    <tr>
         <td><b>Banco:</b></td>
                              <td colspan="12"><select name="banco" class="cajas">
                              <option value="0">Seleccione el banco
                                <?
                                 $consulta_z="select bancos,codbanco from banco  order by bancos";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codbanco"];?>"><?echo $filas_z["bancos"];?>
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
    alert ("Despliegue la vista para eligir la Sucursal ?")
    history.back()
  </script>
    <?
    elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir el banco ?")
    history.back()
  </script>
  <?
     else:
       include("../conexion.php");
         $consu="select prima.*,zona.zona,empleado.cuenta,banco.bancos from sucursal,empleado,banco,zona,prima where
          sucursal.codsucursal=zona.codsucursal and
          zona.codzona=empleado.codzona and
          empleado.cedemple=prima.cedemple and
          empleado.codbanco=banco.codbanco and
          banco.codbanco='$banco' and
          prima.fechai = '$desde' and prima.fechacorte='$hasta' and
          sucursal.codsucursal='$campo'order by prima.nombre";
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
                         <td style='font-weight:bold;font-size:1.1em;'>Estado</td>
                 </tr>
                 <?
                 $i=1;
            while($filas_s=mysql_fetch_array($resulta)):
               $NroP=$filas_s["nroprima"];
                        ?>
                <tr  class="cajas">
                 <td><?echo $i;?></td>
                 <td style='font-weight;font-size:0.9em;'><div align="left"><?echo $filas_s["cedemple"];?></div></td>
                 <td style='font-weight;font-size:0.8em;'><?echo $filas_s["nombre"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["total"];?></td>
                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["bancos"];?></td>
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["zona"];?></td>
                  <td style='font-weight;font-size:0.9em;'><?echo $filas_s["estado"];?></td>
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
                alert("No Existen empleados con primas en este Rango de Fechas ")
                history.back()
             </script>
            <?

         endif;
 endif;
  ?>
</table>

</body>
</html>
