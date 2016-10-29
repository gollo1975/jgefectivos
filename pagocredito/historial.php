<html>
<head>
  <title>Consulta de Credito por Documento</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($cedemple)):

  ?>
  <center><h4>Historial de Credito</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="text" name="cedemple" value="" size="15" maxlegth="15">
     </tr>
     <tr><td></td></tr>
      <tr><td></td></tr>
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
elseif (empty($cedemple)):
?>
  <script language="javascript">
    alert ("Digite el documento del empleado ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedemple'";
     $resulta=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resulta);
     if($registros!=0):
        $con="select credito.nrocredito,tipo.descripcion from empleado,credito,tipo
              where empleado.cedemple=credito.cedemple and
                   credito.tipocre=tipo.tipocre and
                   empleado.cedemple='$cedemple'";
        $res=mysql_query($con)or die("Consulta incorrecta uno");
        $reg=mysql_num_rows($res);
        if ($reg!=0):
           ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resulta)):
             ?>
             <tr>
              <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp<?echo $filas["apemple"];?>&nbsp<?echo $filas["apemple1"];?></td>
               </tr>
              <?
            endwhile;
            ?>
            </table>
            <?

             $consu="select credito.*,salario.desala from empleado,credito,salario where
                empleado.cedemple=credito.cedemple and
                salario.codsala=credito.codsala and
                empleado.cedemple='$cedemple' order by credito.nrocredito";
             $resu=mysql_query($consu)or die("Consulta incorrecta dos");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h3>Listado de Créditos</h3></center>
               <table align="center">
                <tr>
                  <td class="cajas">Para ver los Abonos al crédito, presione Click sobre el Nro de Crédito</td>
                </tr>
             </table>
              <table border="0" align="center">
               <tr  class="fondo">
                <td colspan="9"><br></td>
              </tr>
              <tr  class="cajas">
                  <th>Nro_Crédito</th>
                  <th>Descripción</th>
                  <th>Fecha_Proceso</th>
                  <th>Plazo_Dias</th>
                  <th>Entregado</th>
                  <th>Total_Credito</th>
                   <th>Cuota</th>
                   <th>Saldo</th>
              </tr>
              <?
               while($filas_s=mysql_fetch_array($resu)):
                ?>

              <tr class="cajas" align="center">
                <td>&nbsp;<a href="detallado.php?cod=<?echo $filas_s["nrocredito"];?>"><?echo $filas_s["nrocredito"];?></a></td>
                 <td><?echo $filas_s["desala"];?>&nbsp;</td>
                 <td>&nbsp;<?echo $filas_s["fesalida"];?></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["plazo"];?></td>
                 <td><?echo $filas_s["vlrentregado"];?></td>
                 <td><?echo $filas_s["tcredito"];?></td>
                 <td><?echo $filas_s["cuota"];?></td>
                 <td><?echo $filas_s["nuevo"];?></td>
               </tr>
              <?
              $suma=$suma+$filas_s["nuevo"];
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
            <center><td class="cajas"><b>Total_Deuda:&nbsp;&nbsp;<?echo $suma?></td></center>
            <?
         else:
         ?>
           <script language="javascript">
             alert("Este empleado no tiene Creditos en el Sistema ?")
             history.back()
             </script>
          <?
         endif;
      else:
       ?>
           <script language="javascript">
             alert("El documento no existe en la base de datos ?")
             history.back()
             </script>
          <?
     endif;
   endif;
  ?>
</table>

</body>
</html>
