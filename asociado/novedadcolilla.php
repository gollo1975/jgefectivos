<html>
<head>
  <title>Novedades</title>
   <LINK  REL="stylesheet" HREF="../estiloa.css"  type="text/css">
</head>
<body>
<?
       include("../conexion.php");
         $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
                 empleado.nomina='SI' and
                 empleado.cedemple='$xcodigo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("Lo siento, no esta autorizado para ver las colillas de este Empleado ?")
            history.back()
          </script>
   <?
         else:
             ?>
              <table border="0" align="center">
                <?
                while($filas=mysql_fetch_array($resultado)):
                  ?>
                 <tr>
                  <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                  </tr>
                  <?
                endwhile;
                ?>
                </table>
                <?
              $consu="select novedadnomina.codnovedad,novedadnomina.nota,novedadnomina.desde,novedadnomina.hasta from empleado,novedadnomina where
              empleado.cedemple=novedadnomina.cedemple and
              empleado.cedemple='$xcodigo' order by novedadnomina.codnovedad";
              $resulta=mysql_query($consu)or die ("Consulta incorrecta");
              $registro=mysql_num_rows($resulta);
              $registro=mysql_affected_rows();
              if ($registro!=0):
         ?>
                <center><h4><u>Novedades</u></h4></center>
                  <table border="0" align="center">

                  <tr >
                       <th class="cajas">Item</th>
                      <th class="cajas">Cod_Nove.</th>
                      <th class="cajas">Desde</th>
                       <th class="cajas">Hasta</th>
                      <th class="cajas">Novedad</th>
                    </tr>
                <?
                $l=1;
                while($filas_s=mysql_fetch_array($resulta)):
                     ?>
                     <tr  class="cajas">
                     <th><?echo $l;?></th>
                     <td><?echo $filas_s["codnovedad"];?></td>
                     <td><?echo $filas_s["desde"];?></td>
                     <td><?echo $filas_s["hasta"];?></td>
                     <td><font color="blue"><b><?echo $filas_s["nota"];?></b></font></td>
                       </tr>
                   <?
                   $l=$l+1;
                     endwhile;
                    ?>
                    </table>
                <?
              else:
               ?>
                <script language="javascript">
                  alert("Este Empleado no Tiene novedades Generadas ..")
                  history.back()
                </script>
               <?
              endif;
         endif;
 ?>
</table>

</body>
</html>
