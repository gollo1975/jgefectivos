<html>

<head>
  <title>Empleados por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>
<?
 include("..//conexion.php");
 $consu="select sucursal.sucursal from sucursal where sucursal.codsucursal='$NroSucursal'";
 $resu=mysql_query($consu);
 $reg=mysql_num_rows($resu);
 if ($reg!=0):
   ?>
   <table border="0" align="center">
     <tr>

     </tr>
   <?
    while($filas_s=mysql_fetch_array($resu)):
      ?>
      <tr  class="cajas">
             <td><?echo $filas_s["sucursal"];?></td>
      </tr>
      <?
    endwhile;
    ?>
    </table>
    <?
     include("../conexion.php");
     $consulta="select zona.* from zona,sucursal where
      zona.codsucursal=sucursal.codsucursal and
      sucursal.codsucursal='$NroSucursal' order by zona.zona";
     $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
          ?>

          <script language="javascript">
             alert("No hay empleados en esta Zona")
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
              <th>Codigo</th>
              <th>Ducumento</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Eps</th>
              <th>Pensión</th>
              <th><b>Costo</th>
              <th><b>Fecha Ing.</th>
              <th><b>Salario</th>
              <th><b>Nomina</th>
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
                 <td><a href="nomina.php?estado=<?echo $filas["nomina"];?>&codigo=<?echo $filas["codzona"];?>"><?echo $filas["nomina"];?></a></td>

           </tr>
            <?
             $i=$i+1;
           endwhile;
           ?>
           </table>
           <tr><td><br></td></tr>

           <?
       endif;
    endif;
 ?>
 </body>
</html>
