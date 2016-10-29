<html>

<head>
  <title>Zona por sucursales</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>
<?
 include("../conexion.php");
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
     $consulta="select zona.*, sso_sucursal.nombre from zona,sucursal,sso_sucursal where
      zona.codsucursal=sucursal.codsucursal and
      sucursal.codsucursal='$NroSucursal' and 
	  zona.codigo_sso_sucursal_fk=sso_sucursal.codigo_sucursal_pk and
	  zona.estado='ACTIVA' order by zona.zona";
     $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
          ?>

          <script language="javascript">
             alert("No hay zonas por esta sucursal.!")
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
              <th>Nro</th>
              <th>Zona</th>
              <th>Dirección</th>
              <th>Teléfono</th>
              <th>Sucursal_Pila</th>
           </tr>
        <?
         $i=1;
           while($filas=mysql_fetch_array($resultado)):
       ?>

            <tr  class="cajas">
                 <th><?echo $i;?></th>
                 <td><?echo $filas["zona"];?></td>
                 <td><?echo $filas["dirzona"];?></a></td>
                 <td><?echo $filas["telzona"];?></td>
                 <td><?echo $filas["nombre"];?></td>
                 

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
