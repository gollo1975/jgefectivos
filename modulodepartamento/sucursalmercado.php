<html>

<head>
<title>Consulta de Mercados</title>
<link rel="stylesheet" href="../estilo.css" type="text/css">
</head>
<body>
<?
    include("../conexion.php");
      $consulta="select zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.*,salario.desala from sucursal,zona,empleado,mercado,salario
              where sucursal.codsucursal=zona.codsucursal and
                   zona.codzona=empleado.codzona and
                   empleado.cedemple=mercado.cedemple and
                   mercado.codsala=salario.codsala and
                   mercado.nsaldo>0 and
                   sucursal.codsucursal='$codigo'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("No hay cartera de Mercado en esta Zona de Servicio ?")
           history.back()
          </script>
        <?
       else:
          ?>
          <center><h4>Listado de Empleado</h4></center>
            <table border="0" align="center">
            </table>
                 <table borde="0" align="center">
                  <tr class="cajas">
                     <td>Para Ver el listado de Mercado por Empleado, Presione Click sobre el Documento..</td>
                  </tr>
                </table>
                <tr><td><br></td></tr>
                <table border="0" align="center">
                <tr align="center">
                 <th>Nro</th>
                  <th class="cajas">Nro_Aut.</th>
                  <th class="cajas">Documento</th>
                  <th class="cajas">Nombres</th>
                  <th class="cajas">Apellidos</th>
                  <th class="cajas">F_Proceso</th>
                  <th class="cajas">Cupo</th>
                  <th class="cajas">Estado</th>
                  <th class="cajas">Autorizado</th>
                  <th class="cajas">Saldo</th>
                  <th class="cajas">Alianza</th>
                 </tr>

                  <?$t=1;
                  while($filas=mysql_fetch_array($resultado)):
                  $aux1=number_format($filas["cupo"],0);
                   $aux2=number_format($filas["nsaldo"],0);
                    ?>
                    <tr  class="cajas">
                    <th><?echo $t;?></th>
                         <td><?echo $filas["codmerca"];?></td>
                          <td><a href="detalladomercado.php?valor=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
                          <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                          <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                         <td><?echo $filas["fecha"];?></td>
                         <td>&nbsp;<?echo $aux1;?>&nbsp;</td>
                         <td><?echo $filas["estado"];?></td>
                         <td><?echo $filas["autoriza"];?></td>
                         <td>&nbsp;<?echo $aux2;?></td>
                          <td>&nbsp;<?echo $filas["desala"];?></td>

                   </tr>
                     <? $t=$t+1;
                 endwhile;
                ?>
                </table>
                <?
       endif;
     ?>
</body>
</html>
