<html>

<head>
<title>Consulta de Mercados</title>
<link rel="stylesheet" href="../estilo.css" type="text/css">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='sucursalmercado.php'
                tiempo=80
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
<center><h4>Consulta de Mercados por Sucursal</h4></center>
  <form action="" method="post">
    <table border="0" align="center" width="200">
       <tr>
         <td colspan="15" class="fondo"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
        <td>Sucursal:</td>
          <td><select name="campo" class="cajas">
          <option value="0">Seleccione la Sucursal
          <?
          $consulta_z="select * from sucursal order by sucursal";
          $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
          while($filas_z=mysql_fetch_array($resultado_z)):
            ?>
            <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
            <?
         endwhile;
           ?>
         </select></td>
      </tr>
      <tr><td><br></td></tr>
         <tr>
         <td colspan="15"><input type="submit" value="Buscar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
        </tr>
    </table>
  </form>
  <?
    elseif(empty($campo)):
   ?>
       <script language="javascript">
         alert("Seleccione la sucursal para la consulta ?")
         history.back()
       </script>
       <?
     else:
     include("../conexion.php"); 
          $consulta="select sucursal.sucursal,zona.zona,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.*,salario.desala from sucursal,zona,empleado,mercado,salario
              where sucursal.codsucursal=zona.codsucursal and
                   zona.codzona=empleado.codzona and
                   empleado.cedemple=mercado.cedemple and
                   mercado.nsaldo>0 and
                   mercado.codsala=salario.codsala and
                   sucursal.codsucursal='$campo'order by zona" ;
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("NO hay cartera de Mercados ?")
           history.back()
          </script>
        <?
       else:
          ?>
              <table border="0" align="center">
               <tr>
                   <td colspan="9"><b>Cartera de Mercados por Sucursal</b></td>
                </tr>
               </table>
                <table border="0" align="center">
                  <tr class="fondo" align="center">
                  <th>Nro</th>
                  <th class="cajas">Nro_Aut.</th>
                  <th class="cajas">Documento</th>
                  <th class="cajas">Nombres</th>
                  <th class="cajas">Apellidos</th>
                  <th class="cajas">F_Proceso</th>
                  <th class="cajas">Cupo</th>
                  <th class="cajas">Zona</th>
                  <th class="cajas">Estado</th>
                  <th class="cajas">Autorizado</th>
                  <th class="cajas">Saldo</th>
                  <th class="cajas">Alianza</th>
                 </tr>

                  <? $f=1;
                  while($filas=mysql_fetch_array($resultado)):
                    $Valor=number_format($filas["nsaldo"],0);
                    ?>
                    <tr  class="cajas">
                          <th><?echo $f;?></th>
                         <td><?echo $filas["codmerca"];?></td>
                          <td><?echo $filas["cedemple"];?></td>
                          <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                          <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                         <td><?echo $filas["fecha"];?></td>
                         <td><?echo $filas["cupo"];?></td>
                         <td><?echo $filas["zona"];?></td>
                         <td><?echo $filas["estado"];?></td>
                         <td><?echo $filas["autoriza"];?></td>
                         <td><?echo $Valor;?></td>
                         <td><?echo $filas["desala"];?></td>

                   </tr>
                     <?$f=$f+1;
                     $suma=$suma + $filas["nsaldo"];
                 endwhile;
                 $suma=number_format($suma,0);
                ?>
                </table>
                <center><td><b>Vlr_Cartera:</b>&nbsp;<? echo $suma;?></td></center>
                <tr><br></tr>
               <th><center><a href="impsucursal.php?campo=<?echo $campo;?>" target="_blank" onclick="volver()" >Imprimir</a></center></th>
                <?
       endif;
  endif;

     ?>


</body>
</html>
