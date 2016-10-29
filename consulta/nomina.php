<?
 session_start();
?>
<html>

<head>
  <title>Empleados por Nomina</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>
<?
 if(session_is_registered("xsession")):
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
       <tr  class="cajas">

          <td><b>&nbsp;&nbsp;Ducumento</b></td>
          <td><b>&nbsp;&nbsp;Nombres</b></td>
          <td><b>&nbsp;&nbsp;Apellidos</b></td>
          <td><b>&nbsp;&nbsp;Eps</b></td>
          <td><b>&nbsp;&nbsp;Pensión</b></td>
          <td><b>&nbsp;&nbsp;Tel.</b></td>
          <td><b>&nbsp;&nbsp;Cargo</b></td>
          <td><b>&nbsp;&nbsp;Cuenta</b></td>
          <td><b>&nbsp;&nbsp;Fecha Ing</b></td>
          <td><b>&nbsp;&nbsp;Salario</b></td>
          </tr>
    <?
       while($filas=mysql_fetch_array($resultado)):
   ?>
        <tr  class="cajas">
             <td>&nbsp;&nbsp;<?echo $filas["cedemple"];?></a></td>
             <td>&nbsp;&nbsp;<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
             <td>&nbsp;&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
             <td>&nbsp;&nbsp;<?echo $filas["eps"];?></td>
             <td>&nbsp;&nbsp;<?echo $filas["pension"];?></td>
             <td>&nbsp;&nbsp;<?echo $filas["telemple"];?></td>
             <td>&nbsp;&nbsp;<?echo $filas["cargo"];?></td>
             <td>&nbsp;&nbsp;<?echo $filas["cuenta"];?></td>  
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
