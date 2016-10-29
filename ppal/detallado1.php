<html>

<head>
<title>Consulta Novedades por Empleado</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
    include("../conexion.php");
     $variable="select empleado.nomemple,empleado.apemple from empleado where
                 empleado.cedemple='$cedula'";
         $resultado=mysql_query($variable)or die("consulta incorrecta ");
        $regist=mysql_num_rows($resultado);
           ?>
          <table border="0" align="center">
              <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <table border="0" align="center">
                <tr class="cajas">
                 <td colspan="10"><b>Empleado:</b>&nbsp;<?echo $filas["nomemple"];?> <?echo $filas["apemple"];?></td>
                </tr>
               </table>

             <?
              endwhile;
               ?>
               </table>
              <?
              $variable1="select novedadnomina.* from novedadnomina,empleado where
                    empleado.cedemple=novedadnomina.cedemple and
                    empleado.cedemple='$cedula' order by novedadnomina.codnovedad";
            $resultado1=mysql_query($variable1)or die("consulta incorrecta $variable1");
            $registro=mysql_num_rows($resultado1);
            if ($registro==0):
              ?>
              <script language="javascript">
                alert("No hay novedades de Nomina en este rango de Fechas ?")
                history.back()
              </script>
             <?
             else:
                 ?>
                 <center><h4>Novedades</h4></center>
                  <table border="1" align="center">
                   <tr class="cajas">
                  <th>Cod_Nov.</th>
                  <th>HEO</th>
                  <th>HEDF</th>
                  <th>DC</th>
                  <th>DNC</th>
                  <th>H_N</th>
                  <th>R_N</th>
                  <th>Retorno</th>
                  <th>HNF</th>
                  <th>Otros Dcto</th>
                  <th>Nota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  </tr>
                  <?
                 while($filas_s=mysql_fetch_array($resultado1)):
                  $aux=number_format($filas_s["otros"],0);
                 ?>
                   <tr class="cajas">
                    <td>&nbsp;<?echo $filas_s["codnovedad"];?></td>
                    <td>&nbsp;<?echo $filas_s["hed"];?></td>
                     <td>&nbsp;<?echo $filas_s["hedf"];?></td>
                     <td>&nbsp;<?echo $filas_s["dc"];?></td>
                     <td>&nbsp;<?echo $filas_s["dnc"];?></td>
                     <td>&nbsp;<?echo $filas_s["hn"];?></td>
                     <td>&nbsp;<?echo $filas_s["rn"];?></td>
                     <td>&nbsp;<?echo $filas_s["retorno"];?></td>
                      <td>&nbsp;<?echo $filas_s["hnf"];?></td>
                     <td>&nbsp;<?echo $aux;?></td>
                     <td>&nbsp;<?echo $filas_s["nota"];?></td>
                     </tr>
                    <?
                       $con=$con+1;
                        $con1=$con1+$filas_s["hed"];
                        $con2=$con2+$filas_s["hedf"];
                        $con3=$con3+$filas_s["dc"];
                        $con4=$con4+$filas_s["dnc"];
                        $con5=$con5+$filas_s["hn"];
                        $con6=$con6+$filas_s["rn"];
                        $con7=$con7+$filas_s["retorno"];
                        $con8=$con8+$filas_s["otros"];
                         $con9=$con9+$filas_s["hnf"];
                  endwhile;
                  $con8=number_format($con8,0);
                  ?>
                  </table>
                  <table border="0" align="center">
                    <tr>
                    <center><td class="cajas"><b>Registros:</b>&nbsp;<?echo $con;?>&nbsp;<b>HEO:</b>&nbsp;<?echo $con1;?>&nbsp;<b>HEDF:</b>&nbsp;<?echo $con2;?>&nbsp;<b>DC:</b>&nbsp;<?echo $con3;?>&nbsp;<b>DNC:</b>&nbsp;<?echo $con4;?>&nbsp;<b>HN:</b>&nbsp;<?echo $con5;?>&nbsp;<b>RN:</b>&nbsp;<?echo $con6;?>&nbsp;<b>Retorno:</b>&nbsp;<?echo $con7;?>&nbsp;<b>HNF:</b>&nbsp;<?echo $con9;?>&nbsp;<b>Otros Dcto:</b>&nbsp;<?echo $con8;?></td></center>
                    </tr>
                    </table>
                  <?
           endif;
         ?>

       </body>
  </html>
