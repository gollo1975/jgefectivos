<html>

<head>
<title>Consulta de Mercados</title>
<link rel="stylesheet" href="../estilo.css" type="text/css">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='zonamercado.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
</head>
<body>
<?
if (!isset($campo)):
 include("../conexion.php");
?>
<center><h4><u>Mercados por zona</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center" width="200">
       <tr>
   <td colspan="15"></td>
      </tr>
      <tr><td><br></td></tr>
       <tr>
           <td><b>Desde:</b></td>
           <td><input type="text" name="desde" value="<?echo  date("Y-m-d");?>" size="13" maxlength="10" class="cajas"></td>
           </tr>
           <tr>
           <td><b>Hasta:</b></td>
           <td><input type="text" name="hasta" value="<?echo  date("Y-m-d");?>" size="13" maxlength="10" class="cajas"></td>
        </tr>
        <tr>
          <td><b>Zona:</b></td>
          <td><select name="campo" class="cajas">
          <option value="0">Seleccione la zona
          <?
          $consulta_z="select * from zona where zona.nomina='SI'and zona.estado='ACTIVA' order by zona";
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
         <td colspan="15"><input type="submit" value="Buscar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></th>
        </tr>
    </table>
    </form>
  <?
  elseif(empty($desde)):
   ?>
     <script language="javascript">
       alert("Digite la fecha de inicio")
       history.back()
     </script>
      <?
    elseif(empty($hasta)):
   ?>
     <script language="javascript">
       alert("Digite la fecha final")
       history.back()
     </script>
      <?
      elseif(empty($campo)):
   ?>
       <script language="javascript">
         alert("Seleccione una zona para la consulta ?")
         history.back()
       </script>
       <?
     else:
      include("../conexion.php");
      $consulta="select zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.*,salario.desala from zona,empleado,mercado,salario
              where zona.codzona=empleado.codzona and
                   empleado.cedemple=mercado.cedemple and
                   mercado.nsaldo>0 and
                   mercado.fecha between '$desde' and '$hasta' and
                   mercado.codsala=salario.codsala and
                   zona.codzona='$campo'";
                   //echo $consulta;
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
                   <td colspan="9"><b>Cartera de Mercados por Zona</b></td>
                </tr>
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

                  <?$f=1;
                  while($filas=mysql_fetch_array($resultado)):
                      $Valor=number_format($filas["cupo"],0);
                      $ValorDos=number_format($filas["nsaldo"],0);
                    ?>
                    <tr  class="cajas">
                        <th><?echo $f;?></th>
                         <td><?echo $filas["codmerca"];?></td>
                          <td><a href="detallado.php?valor=<?echo $filas["cedemple"];?>"><?echo $filas["cedemple"];?></a></td>
                          <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                          <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                         <td><?echo $filas["fecha"];?></td>
                         <td><?echo $Valor;?></td>
                         <td><?echo $filas["estado"];?></td>
                         <td><?echo $filas["autoriza"];?></td>
                         <td><?echo $ValorDos;?></td>
                         <td><?echo $filas["desala"];?></td>
                   </tr>
                     <? $f=$f+1;
                 endwhile;
                ?>
                </table>
               <th><center><a href="impzona.php?campo=<?echo $campo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" >Imprimir</a></center></th>
                <?
       endif;
  endif;

     ?>


</body>
</html>
