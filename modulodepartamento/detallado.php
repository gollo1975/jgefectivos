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
  <tr class="cajas">
    <td>Para Ver los Créditos por Empleado, Presiones Click sobre el campo (DOCUMENTO)..</td>
  </tr>
</table>
       <table border="0" align="center">
       <tr  class="fondo">
         <td colspan="9"></td>
       </tr>
       <tr  class="cajas">
       <th>Item</td>
         <th>Documento</td>
          <th>Nombres</td>
          <th>Apellidos</td>
          <th>Eps</td>
          <th>Pensión</td>
          <th>Cargo</td>
          <th>Cuenta</td>
          <th>Fecha Ing.</td>
          <th>Salario</td>
          </tr>
    <?
    $suma=1;
       while($filas=mysql_fetch_array($resultado)):
       $aux=number_format($filas["salario"],0);
   ?>
        <tr  class="cajas">
             <th><?echo $suma;?></th>
             <td><a href="detalladocredito.php?cedemple=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
             <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
             <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
             <td><?echo $filas["eps"];?></td>
             <td><?echo $filas["pension"];?></td>
             <td><?echo $filas["cargo"];?></td>
             <td><?echo $filas["cuenta"];?></td>
             <td><?echo $filas["fechainic"];?></td>
             <td><?echo $aux;?></td>
         </tr>
       <?
         $suma=$suma+1;
       endwhile;
       ?>
       </table>
       <?

    endif;
 ?>
 </body>
</html>
