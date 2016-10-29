<html>

<head>
  <title>Empleados por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>
<?
 include("..//conexion.php");
 $consu="select zona.zona from zona where zona.codzona='$cod'";
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
             <td><?echo $filas_s["zona"];?></td>
      </tr>
      <?
    endwhile;
    ?>
    </table>
    <table border="0" align="center">
  <tr class="cajas">
    <td>Presiones Click en el Documento de Identidad, para Porcesar Nomina</td>
  </tr>
</table>
    <?
     include("..//conexion.php");
     $consulta="select empleado.*,contrato.*,zona.codzona from empleado,zona,contrato where
      empleado.codzona=zona.codzona and
      empleado.codemple=contrato.codemple and
      empleado.nomina='SI' and
      contrato.fechater='0000-00-00'and
      zona.codzona='$cod' order by empleado.nomemple";
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
              <td><b>&nbsp;&nbsp;Ducumento</b></td>
              <td><b>&nbsp;&nbsp;Nombre</b></td>
              <td><b>&nbsp;&nbsp;Apellido</b></td>
              <td><b>&nbsp;&nbsp;Fecha Ing</b></td>
              <td><b>&nbsp;&nbsp;Salario</b></td>
            </tr>
        <?
           while($filas=mysql_fetch_array($resultado)):
       ?>

            <tr  class="cajas">
                  <td>&nbsp;&nbsp;<a href="subir.php?cedula=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
                 <td>&nbsp;&nbsp;<?echo $filas["nomemple"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas["apemple"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas["fechainic"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas["salario"];?></td>
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
    endif;
 ?>
 </body>
</html>
