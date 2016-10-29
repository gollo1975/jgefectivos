<html>
<head>
  <title>Actualizar Saldo</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($cedula)):

  ?>
  <center><h4><u>Actualizar Saldo</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
   <tr>
     <td><b>Documento de Identidad:</b></td>
     <td><input type="text" name="cedula" value="" size="15" maxlegth="15" class="cajas">
     </tr>
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
elseif (empty($cedula)):
?>
  <script language="javascript">
    alert ("Digite el documento del empleado  para la busqueda?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedula'";
     $resulta=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resulta);
    $filas=mysql_fetch_array($resulta);
     if($registros!=0):
        $con="select credito.*,salario.desala from empleado,credito,salario
              where empleado.cedemple=credito.cedemple and
                   credito.codsala=salario.codsala and
                   credito.nuevo > 0 and
                   empleado.cedemple='$cedula'";
        $res=mysql_query($con)or die("Consulta incorrecta uno");
        $reg=mysql_num_rows($res);
        $reg=mysql_affected_rows();
        if ($reg!=0):
           ?>
            <table border="0" align="center">
             <tr>
              <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               </tr>
            </table>
              <center><h3>Listado de Créditos</h3></center>
               <table align="center">
                <tr>
                  <td class="cajas">Para actualizar el saldo de crédito presione Click sobre el Nro de Crédito</td>
                </tr>
             </table>
              <table border="0" align="center">
               <tr  class="fondo">
                <td colspan="9"><br></td>
              </tr>
              <tr  class="cajas">
                 <th>#</th>
                  <th>Nro_Crédito</th>
                  <th>Descripción</th>
                  <th>F_Proceso</th>
                  <th>Plazo_Dias</th>
                  <th>T_Credito</th>
                   <th>Cuota</th>
                   <th>Saldo</th>
                   <th>Nota</th>
              </tr>
              <? $f=1;
               while($filas_s=mysql_fetch_array($res)):
                 $xbusca1=number_format($filas_s["tcredito"],0);
                 $xbusca2=number_format($filas_s["cuota"],0);
                 $xbusca3=number_format($filas_s["nuevo"],0);
                ?>

              <tr class="cajas" align="center">
              <th><?echo $f;?></th>
                <td><a href="Actualizar.php?NroCredito=<?echo $filas_s["nrocredito"];?>&cedula=<?echo $cedula;?>"><?echo $filas_s["nrocredito"];?></a></td>
                 <td><?echo $filas_s["desala"];?>&nbsp;</td>
                 <td><?echo $filas_s["fesalida"];?></td>
                  <td><?echo $filas_s["plazo"];?></td>
                 <td><?echo $xbusca1;?></td>
                 <td><?echo $xbusca2;?></td>
                 <td><?echo $xbusca3;?></td>
                 <td><?echo $filas_s["nota"];?></td>
               </tr>
              <? $f=$f+1;
              $suma=$suma+$filas_s["nuevo"];
            endwhile;
            $xbusca4=number_format($suma,2);
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
            <center><td class="cajas"><b>Total_Deuda:&nbsp;&nbsp;<?echo $xbusca4?></td></center>
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
