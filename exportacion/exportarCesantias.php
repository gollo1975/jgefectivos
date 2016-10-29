<html>

<head>
  <title>Cesantias e Intereses</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($Empresa)):
     include("../conexion.php");
  ?>
  <center><h4><u>Cesantias e Intereses</u></h4></center>
<form action="" method="post" width="200" id="f1" name="f1">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlegth="10" id="desde"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="12" maxlegth="10" id="hasta"></td>
  </tr>
  <tr>
         <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="Empresa" class="cajas">
                              <option value="0">Seleccione la Empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error de busqueda de empresas");
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
    <td colspan="10">
      <input type="submit" value="Exportar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
 elseif (empty($Empresa)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la empresa.!")
    history.back()
  </script>
  <?
     else:
       include("../conexion.php");
         $consu="select cesantiainteres.*,zona.zona,empleado.cuenta from maestro,sucursal,empleado,zona,cesantiainteres where
          maestro.codmaestro=sucursal.codmaestro and
          sucursal.codsucursal=zona.codsucursal and
          zona.codzona=cesantiainteres.codzona and
          empleado.cedemple=cesantiainteres.cedemple and
          cesantiainteres.inicioperiodo = '$desde' and
          cesantiainteres.fechafinal = '$hasta' and
          maestro.codmaestro='$Empresa'order by zona.zona,cesantiainteres.nombre";
          $resulta=mysql_query($consu)or die ("Error de busqueda de cesantias");
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
                        <td style='font-weight:bold;font-size:1.1em;'>Cesantias</td>
                        <td style='font-weight:bold;font-size:1.1em;'>Interes</td>
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
                 <td style='font-weight;font-size:0.9em;'><?echo $filas_s["nombre"];?></td>
                 <td style='mso-number-format:"#,##0"''font-weight;font-size:0.9em;'><?echo $filas_s["pagocesantia"];?></td>
                 <td style= 'mso-number-format:"#,##0"''font-weight;font-size:0.9em;'><?echo $filas_s["pagointeres"];?></td>
                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
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
                alert("No Existen empleados con cesantias e intereses generados en este Rango de Fechas!    ")
                history.back()
             </script>
            <?

         endif;
 endif;
  ?>
</table>

</body>
</html>
