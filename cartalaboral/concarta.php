<html>

<head>
<title>Cartas laborales</title>
<link rel="stylesheet" href="../estilo.css" type="text/css">
</head>
<body>
<?
if (!isset($campo)):
 include("../conexion.php");
?>
<center><h4><u>Cartas Laborales</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center" width="200">
       <tr><td><br></td></tr>
       <tr>
          <td><b>Desde:&nbsp;</b></td>
          <td ><input type="text" name="desde" value="<?echo date("Y-m-d");?>"size="10" maxlength="10"></td>
          <td><b>Desde:&nbsp;</b></td>
          <td colspan="1"><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Sucursal:</b>&nbsp;</td>
          <td colspan="5"><select name="campo" class="cajas">
          <option value="0">Seleccione la Empresa
          <?
          $consulta_z="select maestro.nomaestro,maestro.codmaestro from maestro ";
          $resultado_z=mysql_query($consulta_z)or die ("Error al buscar empresa");
          while($filas_z=mysql_fetch_array($resultado_z)):
            ?>
            <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
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
          $consulta="select sucursal.sucursal,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,carta.* from maestro,sucursal,zona,empleado,carta
              where maestro.codmaestro=sucursal.codmaestro and
                   sucursal.codsucursal=zona.codsucursal and
                   zona.codzona=empleado.codzona and
                   empleado.cedemple=carta.cedemple and
                   carta.fecha between '$desde' and '$hasta' and
                   maestro.codmaestro='$campo' order by carta.nombres ASC" ;
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("No hay cartas laborales ?")
           history.back()
          </script>
        <?
       else:
          ?>
              <table border="0" align="center">
               <tr>
                   <td colspan="9"><b>Cartas laborales</b></td>
                </tr>
               </table>
                <table border="0" align="center">
                    <tr class="cajas" align="center">
                  <th>Item</th>
                  <th>Nro_Carta</th>
                   <th>Cédula</th>
                  <th>Empleado</th>
                  <th>Zona</th>
                  <th>F_Proceso</th>
                  <th>Tipo_Carta</th>
                 </tr>

                  <?
                  $Validar = '';
                  $suma=1;
                  while($filas=mysql_fetch_array($resultado)):
                   $Validar= $filas["tipoempleado"];
                    ?>
                    <tr  class="cajas">
                        <th><?echo $suma;?></th>
                         <?if($Validar==''){?>
                                  <td><a href="impricarta.php?codigo=<?echo $filas["codigo"];?>&auxFirma=<?echo $filas["firmadigital"];?>"><?echo $filas["codigo"];?></a></td>
                         <?}else{?>
                                   <td><a href="ImprimirCarta.php?NroCarta=<?echo $filas["codigo"];?>&auxFirma=<?echo $filas["firmadigital"];?>"><?echo $filas["codigo"];?></a></td>
                        <?}?>
                          <td><?echo $filas["cedemple"];?></td>
                          <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                        <td><?echo $filas["zonalaborada"];?></td>
                         <td><?echo $filas["fecha"];?></td>
                          <td><?echo $filas["tipocarta"];?></td>

                   </tr>
                     <?
                     $suma=$suma + 1;
                 endwhile;
                ?>
                </table>

                <?
       endif;
  endif;

     ?>


</body>
</html>
