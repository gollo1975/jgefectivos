<html>

<head>
  <title>Consulta de Nomina por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($desde)):
  ?>
  <center><h4>Nomina por Zona</h4></center>
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
  else:
       include("../conexion.php");
         $consulta="select zona.zona from zona where
                 zona.codzona='$codzona'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
          $consu="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,nomina.cedemple, nomina.neto,empleado.cuenta from empleado,periodo,zona,nomina where
          zona.codzona=periodo.codzona and
          zona.codzona=empleado.codzona and
          empleado.cedemple=nomina.cedemple and
          periodo.codigo=nomina.codigo and
          periodo.desde='$desde' and periodo.hasta='$hasta' and
          zona.codzona='$codzona'order by empleado.nomemple,empleado.nomemple1,empleado.apemple";
          $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
          $registro=mysql_affected_rows();
          if ($registro!=0):
             header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Nomina.xls");
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
                 </tr>
                 <?
                 $i=1;
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
                <tr  class="cajas">
                 <td><?echo $i;?></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td><?echo $filas_s["neto"];?></td>
                 <td><?echo $filas_s["cuenta"];?></td>
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
                alert("No Existen empleados con nomina, en este Rango de Fechas ")
                history.back()
             </script>
            <?

         endif;
  endif;
  ?>
</table>

</body>
</html>
