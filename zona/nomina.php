<html>

<head>
  <title>Empleados por Nomina</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>
<?
include("../conexion.php");
  $consulta="SELECT empleado . * , contrato . * , pension . * , eps . * , costo . * 
              FROM empleado, zona, contrato, pension, eps, costo
              WHERE empleado.codzona = zona.codzona
              AND empleado.codemple = contrato.codemple
              AND empleado.codpension = pension.codpension
              AND empleado.codeps = eps.codeps
              AND empleado.codcosto = costo.codcosto
              AND contrato.fechater = '0000-00-00'
              AND zona.codzona = '$codigo'
              AND empleado.nomina = '$estado'order by contrato.fechainic";
              $resultado=mysql_query($consulta)or die ("Consulta incorrecta 1");
  $registro=mysql_num_rows($resultado);
  $registro=mysql_affected_rows();
  if ($registro==0):
      ?>
      <script language="javascript">
         alert("No hay empleados por Nomina")
         history.back()
      </script>
      <?
   else:
   ?>
          <center><h4>Listado de Trabajadores</h4></center>
       <table border="0" align="center">
       <tr  class="fondo">
         <td colspan="9"></td>
       </tr>
       <tr  class="cajas" align="center">
          <th>Item</th>
          <th>Código</th>
          <th>Ducumento</th>
          <th>Nombres</th>
          <th>Apellidos</th>
          <th>Eps</th>
          <th>Pensión</th>
          <th>Costo</th>
          <th>Fecha Ing.</th>
          <th>Salario</th>
          </tr>
    <?
       $i=1;
       while($filas=mysql_fetch_array($resultado)):
   ?>
        <tr  class="cajas">
        <th><?echo $i;?></th>
             <td><?echo $filas["codemple"];?></td>
             <td><?echo $filas["cedemple"];?></a></td>
             <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
             <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
             <td><?echo $filas["eps"];?></td>
             <td><?echo $filas["pension"];?></td>
             <td><?echo $filas["centro"];?></td>
             <td><?echo $filas["fechainic"];?></td>
             <td><?echo $filas["salario"];?></td>
         </tr>
       <?
         $i=$i+1;
       endwhile;
       ?>
       </table>
       <tr><td><br></td></tr>

       <?

    endif;
 ?>
 </body>
</html>
