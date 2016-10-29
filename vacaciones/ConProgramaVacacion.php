<html>

<head>
<title>Programaciones de Vacaciones</title>
<link rel="stylesheet" href="../estilo.css" type="text/css">
</head>
<body>
<?
if (!isset($campo)):
 include("../conexion.php");
?>
<center><h4><u>Programacion de Pago</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center" width="200">
       <tr><td><br></td></tr>
       <tr>
          <td><b>Desde:&nbsp;</b></td>
          <td ><input type="text" name="Desde" value="<?echo date("Y-m-d");?>"size="12" class="cajas" maxlength="10" id="Desde"></td>
          <td><b>Desde:&nbsp;</b></td>
          <td colspan="1"><input type="text" name="Hasta" value="<?echo date("Y-m-d");?>" class="cajas" size="12" maxlength="10" id="Hasta"></td>
       </tr>
       <tr>
        <td><b>Empresa:</b>&nbsp;</td>
          <td colspan="5"><select name="campo" class="cajas" id="campo">
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
          $consulta="select programarvacacion.* from maestro,programarvacacion
              where maestro.codmaestro=programarvacacion.codmaestro and
                    programarvacacion.fechap between '$Desde' and '$Hasta' and
                   maestro.codmaestro='$campo' order by programarvacacion.fechap DESC" ;
       $resultado=mysql_query($consulta)or die ("Error al busca informacion");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("No hay programaciones de vacaciones lista.!")
           history.back()
          </script>
        <?
       else:
          ?>
              <table border="0" align="center">
               <tr>
                   <td colspan="9"><b>Listado de Programaciones</b></td>
                </tr>
               </table>
                <table border="0" align="center">
                    <tr class="cajas" align="center">
                  <th>Item</th>
                  <th>Nro_Progra.</th>
                   <th>F_Programada</th>
                  <th>Vlr_Pagar</th>
                 </tr>
                  <?
                  $suma=1;
                  while($filas=mysql_fetch_array($resultado)):
                     $Valor=number_format($filas["vlrpagado"],0);
                    ?>
                    <tr  class="cajas">
                        <th><?echo $suma;?></th>
                         <td><a href="ImprimirProgramarVacacion.php?IdPrograma=<?echo $filas["idprogramavaca"];?>"><div align="center"><?echo $filas["idprogramavaca"];?></div></a></td>
                          <td><?echo $filas["fechap"];?></td>
                          <td><div align="right"><?echo $Valor;?></div></td>

                   </tr>
                     <?
                     $Cont=$Cont + $filas["vlrpagado"];
                     $suma=$suma + 1;
                 endwhile;
                   $Cont=number_format($Cont,0);
                ?>
                </table>
                <tr><td colspan="10"><div align="center"><b>Total_Pagado:&nbsp;<?echo $Cont;?></b></div></td></tr>

                <?
       endif;
  endif;

     ?>


</body>
</html>
