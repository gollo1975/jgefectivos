<html>

<head>
<title>Consulta de Mercados</title>
<link rel="stylesheet" href="../estilo.css" type="text/css">
</head>
<body>
<?
    include("../conexion.php");
      $consulta="select zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.* from zona,empleado,mercado
              where zona.codzona=empleado.codzona and
                   empleado.cedemple=mercado.cedemple and
                   mercado.nsaldo>0 and
                   zona.codzona='$codigo'";
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
                <table border="1" align="center">
                <tr align="center">
                  <th class="cajas">Nro_Aut.</th>
                  <th class="cajas">Documento</th>
                  <th class="cajas">Nombre</th>
                  <th class="cajas">Apellido</th>
                  <th class="cajas">F_Proceso</th>
                  <th class="cajas">Cupo</th>
                  <th class="cajas">Estado</th>
                  <th class="cajas">Autorizado</th>
                  <th class="cajas">&nbsp;Saldo</th>
                 </tr>

                  <?
                  while($filas=mysql_fetch_array($resultado)):
                  $aux1=number_format($filas["cupo"],0);
                   $aux2=number_format($filas["nsaldo"],0);
                    ?>
                    <tr  class="cajas">
                         <td><?echo $filas["codmerca"];?></td>
                          <td><a href="detalladomercado.php?valor=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
                          <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                          <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                         <td><?echo $filas["fecha"];?></td>
                         <td>&nbsp;<?echo $aux1;?>&nbsp;</td>
                         <td><?echo $filas["estado"];?></td>
                         <td><?echo $filas["autoriza"];?></td>
                         <td>&nbsp;<?echo $aux2;?></td>

                   </tr>
                     <?
                 endwhile;
                ?>
                </table>
               <th><center><a href="impzona.php?campo=<?echo $codigo;?>" >Imprimir</a></center></th>
                <?
       endif;
     ?>
</body>
</html>
