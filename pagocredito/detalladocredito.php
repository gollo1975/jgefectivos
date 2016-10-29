<html>

<head>
  <title>Consulta de Credito por Documento</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
<?
   include("../conexion.php");
     $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedemple'";
     $resulta=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resulta);
       $con="select credito.nrocredito,tipo.descripcion from empleado,credito,tipo
              where empleado.cedemple=credito.cedemple and
                   credito.tipocre=tipo.tipocre and
                   empleado.cedemple='$cedemple'";
        $res=mysql_query($con)or die("Consulta incorrecta uno");
        $reg=mysql_num_rows($res);
        $reg=mysql_affected_rows();
          ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resulta)):
             ?>
             <tr>
              <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
              $consu="select credito.*,tipo.descripcion from empleado,credito,tipo where
                empleado.cedemple=credito.cedemple and
                tipo.tipocre=credito.tipocre and
                empleado.cedemple='$cedemple'";
             $resu=mysql_query($consu)or die("Consulta incorrecta dos");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h3>Listado de Créditos</h3></center>
               <table align="center">
                <tr>
                  <td class="cajas">Para ver los Abonos a Crédito, presione Click sobre el Nro de Crédito ? </td>
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
                  <th>Plazo en Dias</th>
                  <th>Vlr_Entregado</th>
                  <th>Total_Credito</th>
                   <th>Cuota</th>
                   <th>Nuevo_Saldo</th>
              </tr>
              <?
               while($filas_s=mysql_fetch_array($resu)):
               $xbusca=number_format($filas_s["vlrentregado"],2);
               $xbusca1=number_format($filas_s["tcredito"],2);
               $xbusca2=number_format($filas_s["cuota"],2);
               $xbusca3=number_format($filas_s["nuevo"],2);
                ?>

              <tr class="cajas" align="center">
                <td>&nbsp;<a href="detallado1.php?cod=<?echo $filas_s["nrocredito"];?>"><?echo $filas_s["nrocredito"];?></a></td>
                 <td><?echo $filas_s["descripcion"];?>&nbsp;</td>
                 <td>&nbsp;<?echo $filas_s["fesalida"];?></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;<?echo $filas_s["plazo"];?></td>
                 <td><?echo $xbusca;?></td>
                 <td><?echo $xbusca1;?></td>
                 <td><?echo $xbusca2;?>&nbsp;</td>
                 <td><?echo $xbusca3;?></td>
               </tr>
              <?
              $suma=$suma+$filas_s["nuevo"];
              $suma1=$suma1+$filas_s["cuota"];
            endwhile;
            $xbusca4=number_format($suma,2);
            $xbusca5=number_format($suma1,2);
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
            <center><td class="cajas"><b>Total_Saldo:</b>&nbsp;&nbsp;<?echo $xbusca4?>&nbsp;&nbsp;&nbsp;<b>Total_Cuota:</b>&nbsp;&nbsp;<?echo $xbusca5?></td></center>
            <?
          ?>
</table>

</body>
</html>
