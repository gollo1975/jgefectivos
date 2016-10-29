<html>

<head>
  <title>primas por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
      include("../conexion.php");
     $conP="select periodoprima.* from periodoprima where
          periodoprima.estado='FALTA'";
          $resP=mysql_query($conP)or die ("Error en la busqueda de periodo");
      $fila=mysql_fetch_array($resP);
  ?>
  <center><h4><u>Prima Semestral</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Desde:</b></td>
       <td><input type="text" name="desde" value="<? echo $fila["desde"];?>" size="12" maxlength="11" readonly="yes"></td>
  </tr>
  <tr>
    <td><b>Hasta:</b></td>
       <td><input type="text" name="hasta" value="<? echo $fila["hasta"];?>" size="12" maxlength="11" readonly="yes"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select zona.codzona,zona.zona from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
       <tr>
         <td><b>Banco:</b></td>
                              <td><select name="banco" class="cajas">
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
   <tr><td></td></tr>
    <tr><td></td></tr>
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
    elseif (empty($banco)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir el banco?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
          $consu="select prima.nombre,prima.cedemple,empleado.cuenta,prima.total,banco.bancos,prima.estado from empleado,prima,zona,banco where
          zona.codzona =prima.codzona and
          empleado.cedemple=prima.cedemple and
          empleado.codbanco=banco.codbanco and
          banco.codbanco='$banco' and
          prima.fechai ='$desde' and prima.fechacorte='$hasta' and
          zona.codzona='$campo'order by prima.nombre ";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta de Exportacion de prima");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
            header("Content-type: application/vnd.ms-excel");
             header("Content-Disposition: attachment; filename=Pagar Nomina.xls");
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
               <td style='font-weight:bold;font-size:1.1em;'>Entidad</td>
               <td style='font-weight:bold;font-size:1.1em;'>Estado</td>
             </tr>
            <?
            $i=1;
            while($filas_s=mysql_fetch_array($resulta)):
             ?>
              <tr  class="cajas">
                 <td><?echo $i;?></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nombre"];?></td>
                 <td style='mso-number-format:"#,##0.00"''font-weight;font-size:0.9em;'><?echo $filas_s["total"];?></td>
                 <td style='mso-number-format:"\@"''font-weight;font-size:0.9em;'><?echo $filas_s["cuenta"];?></td>
                 <td><?echo $filas_s["bancos"];?></td>
                  <td><?echo $filas_s["estado"];?></td>
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
