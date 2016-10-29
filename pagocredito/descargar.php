<html>

<head>
  <title>Abono a credito</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($cedemple)):
     include("../conexion.php");
  ?>
  <center><h4><u>Matricular Abono</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
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
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
     if($registros!=0):
        $con="select empleado.cedemple from empleado,credito where empleado.cedemple=credito.cedemple and credito.nuevo > 0 and
              empleado.cedemple='$cedemple'";
        $res=mysql_query($con)or die("Consulta incorrecta uno");
        $reg=mysql_num_rows($resultado);
        $reg=mysql_affected_rows();
        if ($reg!=0):
           ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
             ?>
             <tr class="cajas">
              <td><b>Asociado:&nbsp;</b><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
            include("../conexion.php");
             $consu="select credito.*,tipo.descripcion from empleado,credito,tipo where
                empleado.cedemple=credito.cedemple and
                tipo.tipocre=credito.tipocre and
                credito.nuevo>0 and
                empleado.cedemple='$cedemple'";
             $resu=mysql_query($consu)or die("Consulta incorrecta dos");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h4><u>Listado</u></h4></center>
              <table border="0" align="center">
               <tr  class="fondo">
                <td colspan="9"><br></td>
              </tr>
              <tr  class="cajas">
              <th>Item</th>
                  <th>Nro_Crédito</th>
                  <th>Descripción</th>
                  <th>Fecha_Proceso</th>
                  <th>Vlr_Entregado</th>
                  <th>Total_Credito</th>
                   <th>Cuota</th>
                   <th>Nuevo_Saldo</th>
              </tr>
              <?$a=1;
               while($filas_s=mysql_fetch_array($resu)):
                $aux=number_format($filas_s["vlrentregado"],0);
                $aux1=number_format($filas_s["tcredito"],0);
                $aux2=number_format($filas_s["cuota"],0);
                $aux3=number_format($filas_s["nuevo"],0);
                ?>

              <tr class="cajas" align="center">
                <th><?echo $a;?></th>
                 <td>&nbsp;<a href="agregar.php?cod=<?echo $filas_s["nrocredito"];?>"><?echo $filas_s["nrocredito"];?></a></td>
                 <td><?echo $filas_s["descripcion"];?>&nbsp;</td>
                 <td><?echo $filas_s["fesalida"];?></td>
                 <td><?echo $aux;?></td>
                 <td><?echo $aux1;?></td>
                 <td><?echo $aux2;?></td>
                 <td><?echo $aux3;?></td>
               </tr>
              <?$a=$a+1;
              $suma=$suma+$filas_s["nuevo"];
            endwhile;
            $suma=number_format($suma,0); 
            ?>
            </table>
            <center><td class="cajas"><b>Total_Deuda:&nbsp;&nbsp;</b><?echo $suma?></td></center>
           <td class="cajas"><b><div align="center"><a href="descargar.php"</a><u><font color="blue"><h4>Nueva_Consulta</h4></font></u></div></td>
            <?
         else:
         ?>
           <script language="javascript">
             alert("Este empleado no tiene Creditos Para Saldar en el sistema ?")
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
</body>
</html>
