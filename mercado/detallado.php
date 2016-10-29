<html>

<head>
<title>Consulta de Mercados</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<?
      include("../conexion.php");
      $consulta="select empleado.nomemple,empleado.apemple,mercado.*,salario.desala from empleado,mercado,salario
              where empleado.cedemple=mercado.cedemple and
                   salario.codsala=mercado.codsala and
                   empleado.cedemple='$valor'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("NO existen registro en la consulta ?")
           history.back()
          </script>
        <?
       else:
          ?>

                <table border="0" align="center">
               <tr>
                   <th colspan="9" class="fondo" >Mercados Autorizados a Empleados</th>
                </tr>
                </table>
                <table borde="0" align="center">
                  <tr class="cajas">
                     <td>Para Imprimir o Ver la autorización de mercado, Presione Click sobre el NRO_AUTORIZACION..</td>
                  </tr>
                </table>
                <tr><td><br></td></tr>
                <table border="0" align="center">
                <tr class="fondo" align="center">
                <th class="cajas">Nro</th>
                  <th class="cajas">Nro_Autor.</th>
                  <th class="cajas">Fecha_Proceso</th>
                  <th class="cajas">Cupo</th>
                  <th class="cajas">Estado</th>
                  <th class="cajas">Autorizado</th>
                  <th class="cajas">Saldo</th>
                  <th class="cajas">Cartera</th>
                   <th class="cajas">Alianza</th>
                 </tr>

                  <? $f=1;
                  while($filas=mysql_fetch_array($resultado)):
                    ?>
                    <tr  class="cajas">
                       <th><?echo $f;?></th>
                        <td> <a href="imprimir.php?codmerca=<?echo $filas["codmerca"];?>"><?echo $filas["codmerca"];?></a></td>
                         <td><?echo $filas["fecha"];?></td>
                         <td><?echo $filas["cupo"];?></td>
                         <td><?echo $filas["estado"];?></td>
                         <td><?echo $filas["autoriza"];?></td>
                         <td><?echo $filas["nsaldo"];?></td>
                         <td><?echo $filas["historia"];?></td>
                         <td><?echo $filas["desala"];?></td>

                   </tr>
                     <?$f=$f+1;
                 endwhile;
                ?>
                </table>
               <th><center><a href="impindividual.php?valor=<?echo $valor;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></th>
                <?
       endif;
     ?>


</body>
</html>
