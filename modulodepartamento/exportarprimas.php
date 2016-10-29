<html>

<head>
  <title>primas por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($desde)):
     include("../conexion.php");
  ?>
  <center><h4>Prima Semestral</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Fecha Inicio:</b></td>
       <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="11" maxlength="11">&nbsp;</td>
  </tr>
  <tr>
    <td><b>Fecha Final:</b></td>
       <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="11" maxlength="11">&nbsp;</td>
  </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>

</form>
<?
    else:
       include("../conexion.php");
          $consu="select prima.nombre,prima.cedemple,empleado.cuenta,prima.total from empleado,prima,zona where
          empleado.codzona=zona.codzona and
          empleado.cedemple=prima.cedemple and
          prima.fechap between '$desde' and '$hasta' and
          zona.codzona='$codzona'order by prima.nombre ";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta de Exportacion de prima");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
            header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Primas semestrales.xls");
             header("Pragma: no-cache");
             header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
             header("Expires: 0");
            ?>
           <table border="0" align="center">
             <tr  class="cajas">
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
                 <td><?echo $filas_s["nombre"];?></td>
                 <td><?echo $filas_s["total"];?></td>
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
                alert("No Existen empleados con Primas en este rango de fecha.")
                history.back()
             </script>
            <?

         endif;
  endif;
  ?>
</table>

</body>
</html>
