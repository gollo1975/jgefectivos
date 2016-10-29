<html>

<head>
  <title>Empleados por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>

<?
 include("../conexion.php");
 $consu="select zona.zona from zona where zona.codzona= '$codigo'";
 $resu=mysql_query($consu);

   ?>
   <table border="0" align="center">
     <?
    while($filas_s=mysql_fetch_array($resu)):
      ?>
      <tr  class="cajas">
             <td><?echo $filas_s["zona"];?></td>
      </tr>
      <?
    endwhile;
    ?>
    </table>
    <table border="0" align="center">
  <tr class="cajas">
    <td>Para Ver los Empleados que tiene Nomina, Presiones Click sobre el campo (NOMINA)..</td>
  </tr>
</table>
    <?
     include("../conexion.php");
     $consulta="select empleado.*,contrato.*,pension.*,eps.*,costo.*,zona.codzona from empleado,zona,contrato,pension,eps,costo where
      empleado.codzona=zona.codzona and
      empleado.codemple=contrato.codemple and
      empleado.codpension=pension.codpension and
      empleado.codeps=eps.codeps and
      empleado.codcosto=costo.codcosto and
      contrato.fechater='0000-00-00'and
      zona.codzona= '$codzona' order by contrato.fechainic";
     $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
          ?>

          <script language="javascript">
             alert("No hay empleados en esta Zona de servicio")
             history.back()
          </script>
          <?
       else:
       ?>
              <tr><td><br></td></tr>
             <table border="0" align="center">
           <tr  class="fondo">
             <td colspan="9"></td>
           </tr>
           <tr  class="cajas">
              <th>Item</th>
              <th>Ducumento</th>
              <th>Nombres</th>
              <th>ps</th>
              <th>Pensión</th>
              <th>Costo</th>
              <th>Fecha Ing</th>
              <th>Salario</th>
              <th>Nomina</th>
           </tr>
        <?
        $suma=1;
           while($filas=mysql_fetch_array($resultado)):
           $aux=number_format($filas["salario"],0);
       ?>

            <tr  class="cajas">
               <th><?echo $suma;?></th>
                 <td><?echo $filas["cedemple"];?></td>
                 <td class="cajas"><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                <td><?echo $filas["eps"];?></td>
                 <td><?echo $filas["pension"];?></td>
                 <td class="cajas"><?echo $filas["centro"];?></td>
                 <td><?echo $filas["fechainic"];?></td>
                 <td><?echo $aux;?></td>
                 <td><a href="detallado.php?estado=<?echo $filas["nomina"];?>&codigo=<?echo $filas["codzona"];?>"><?echo $filas["nomina"];?></a></td>

           </tr>
            <?
             $suma=$suma+1;
           endwhile;
           ?>
           </table>
           <tr><td><br></td></tr>
           <tr class="cajas">
             <center><td>Nro Empleados:&nbsp;<?echo $suma?></td></center>
           </tr>
           <?
       endif;

 ?>
 </body>
</html>
