<html>

<head>
  <title>Consulta de Credito por Documento</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
<?
   include("../conexion.php");
       $con="select salario.desala from salario
              where salario.codsala='$codcredito'";
        $res=mysql_query($con)or die("Consulta incorrecta uno");
            ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($res)):
             ?>
             <tr>
              <td><?echo $filas["desala"];?></td>
               </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
              $consu="select credito.*,empleado.nomemple,empleado.apemple from credito,salario,zona,empleado where
                 zona.codzona=empleado.codzona and
                 empleado.cedemple=credito.cedemple and
                 salario.codsala=credito.codsala and
                credito.nuevo > 0 and
                zona.codzona='$codzona' and
                salario.codsala='$codcredito' order by empleado.nomemple,empleado.apemple";
             $resu=mysql_query($consu)or die("Consulta incorrecta dos");
             $registros=mysql_num_rows($resu);
             ?>
              <center><h4>Listado de Créditos</h4></center>
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
              <th>Item</th>
                  <th>Nro_Crédito</th>
                  <th>Empleado</th>
                  <th>F_Proceso</th>
                  <th>Entregado</th>
                  <th>T_Credito</th>
                   <th>Cuota</th>
                   <th>Saldo</th>
              </tr>
              <?
              $i=1;
               while($filas_s=mysql_fetch_array($resu)):
                ?>

              <tr class="cajas" align="center">
               <td><?echo $i;?></td>
                <td>&nbsp;<a href="detallado1.php?cod=<?echo $filas_s["nrocredito"];?>"><?echo $filas_s["nrocredito"];?></a></td>
                <td>&nbsp;<?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["apemple"];?></td>
                  <td>&nbsp;<?echo $filas_s["fesalida"];?></td>
                 <td><?echo $filas_s["vlrentregado"];?></td>
                 <td><?echo $filas_s["tcredito"];?></td>
                 <td><?echo $filas_s["cuota"];?></td>
                 <td><?echo $filas_s["nuevo"];?></td>
               </tr>
              <?
              $suma=$suma+$filas_s["nuevo"];
              $suma1=$suma1+$filas_s["cuota"];
              $i=$i+1;
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
            <center><td class="cajas"><b>Total_Saldo:&nbsp;&nbsp;<?echo $suma?>&nbsp;&nbsp;&nbsp;<b>Total_Cuota:&nbsp;&nbsp;<?echo $suma1?></td></center>
            <?
          ?>
</table>

</body>
</html>
