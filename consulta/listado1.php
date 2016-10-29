<?
 session_start();
?>
<html>

<head>
  <title>Empleados por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>
<?
 if(session_is_registered("xsession")):
 include("../conexion.php");
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
      zona.codzona='$cod' order by contrato.fechainic DESC, empleado.nomina";
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

              <td><b>Código</b></td>
              <td><b>&nbsp;&nbsp;Ducumento</b></td>
              <td><b>&nbsp;&nbsp;Empleado</b></td>
              <td><b>&nbsp;&nbsp;Eps</b></td>
              <td><b>&nbsp;&nbsp;Pensión</b></td>
              <td><b>&nbsp;&nbsp;Costo</b></td>
              <td><b>&nbsp;&nbsp;Fecha Ing</b></td>
              <td><b>&nbsp;&nbsp;Salario</b></td>
              <td><b>&nbsp;&nbsp;Nomina</b></td>
           </tr>
        <?
           while($filas=mysql_fetch_array($resultado)):
       ?>

            <tr  class="cajas">
                 <td><?echo $filas["codemple"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas["cedemple"];?></a></td>
                 <td class="cajas">&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                <td>&nbsp;&nbsp;<?echo $filas["eps"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas["pension"];?></td>
                 <td class="cajas">&nbsp;&nbsp;<?echo $filas["centro"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas["fechainic"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas["salario"];?></td>
                 <td>&nbsp;&nbsp;<a href="nomina.php?estado=<?echo $filas["nomina"];?>&codigo=<?echo $filas["codzona"];?>"><?echo $filas["nomina"];?></a></td>

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
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;    
 ?>
 </body>
</html>
