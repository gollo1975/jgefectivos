<html>

<head>
  <title>Consulta de Empleados por Zona</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

 </head>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4>Empleados por Zona</h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
      <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.codzona,zona.zona from zona
                where zona.codzona='$campo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta  ");
                 $filas=mysql_fetch_array($resulta)
                     ?>
                    <table border="0" align="center">
                     <tr>
                       <td><? echo $filas["zona"];?></td>
                     </tr>
                   </table>
                   <?
                   $con="select empleado.cedemple,concat(empleado.nomemple,' ', empleado.nomemple1,' ', empleado.apemple, ' ',empleado.apemple1) as nombre,contrato.fechainic,contrato.salario from empleado,zona,contrato
                        where zona.codzona=empleado.codzona and
                             empleado.codemple=contrato.codemple and
                             empleado.nomina='NO' and
                             contrato.fechater='0000-00-00' and
                             zona.codzona='$campo' order by contrato.fechainic";
                    $re=mysql_query($con)or die ("Error de Busqueda");
                    $reg=mysql_num_rows($re);
                    if($reg!=0):
                      ?>
                      <center><h4>Listado de Empleados Para Relacionar</h4></center>
                      <table border="0" align="center">
                      <tr class="cajas"><td>Para Relacionar los Empleados, Presionce Click sobre el Documento[CEDULA]...</td></tr>
                      </table>
                      <table border="1" align="center">
                        <tr class="cajas">
                           <td><b>Cedula</b></td>
                           <td><b>Empleado</b></td>
                           <td><b>Fecha_Inicio</b></td>
                           <td><b>Ibc</b></td>
                        </tr>
                        <?
                        while ($filas_s=mysql_fetch_array($re)):
                        ?>
                          <tr class="cajas">
                             <td><a href="detallado.php?cedula=<? echo $filas_s["cedemple"];?>&codzona=<? echo $campo;?>"><? echo $filas_s["cedemple"];?></a></td>
                             <td><? echo $filas_s["nombre"];?></td>
                             <td><? echo $filas_s["fechainic"];?></td>
                             <td><? echo $filas_s["salario"];?></td>
                          </tr>
                          <?
                          $con=$con+1;
                        endwhile;
                        ?>
                      </table>
                      <center><td><b>Total:</b>&nbsp;<? echo $con;?></td></center>
                      <?
                    else:
                       ?>
                         <script language="javascript">
                           alert("NO hay Empleados para relacionar en subcontratos")
                           history.back()
                         </script>
                       <?
                    endif;
                   ?>

                 </form>
                 <?
 endif;
       ?>
</body>
</html>
