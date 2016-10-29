<html>

<head>
<title>Consulta Novedades por Empleado</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
    include("../conexion.php");
     $variable="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
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
                 <td colspan="10"><b>Empleado:</b>&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                </tr>
               </table>

             <?
              endwhile;
               ?>
               </table>
              <?
              $variable1="select novedadindividual.* from novedadindividual,empleado where
                    empleado.cedemple=novedadindividual.cedemple and
                    empleado.cedemple='$cedula' order by novedadindividual.codnovedad";
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
                    <th>Item</th>
                  <th>Cod_Novedad.</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Nota</th>

                  </tr>
                  <?
                  $con=1;
                 while($filas_s=mysql_fetch_array($resultado1)):
                  $aux=number_format($filas_s["otros"],0);
                 ?>
                   <tr class="cajas">
                   <th><?echo $con;?></th>
                    <td><?echo $filas_s["codnovedad"];?></td>
                     <td><?echo $filas_s["desde"];?></td>
                     <td><?echo $filas_s["hasta"];?></td>
                    <td><?echo $filas_s["nota"];?></td>
                     </tr>
                    <?
                       $con=$con+1;
                 endwhile;
                  ?>
                  </table>
                  <?
           endif;
         ?>

       </body>
  </html>
