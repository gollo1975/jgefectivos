<html>

<head>
  <title>Consulta de retiro de Asociados</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
      <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='retirogeneral.php'
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
  <center><h4>Retiro de Asociados</h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Empresa:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la empresa
                                <?
                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro ";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
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
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la Empresa ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
         $consulta="select maestro.nomaestro from maestro where
                 maestro.codmaestro='$campo'";
         $resultado=mysql_query($consulta)or die ("Error en la busqueda");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("La empresa No existe en la bd. ?")
            history.back()
          </script>
   <?
        else:
        ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
             ?>
             <tr>
              <td><?echo $filas["nomaestro"];?></td>
              </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
           $consu="select retiro.*,zona.zona,eps.eps,pension.pension from maestro,retiro,zona,empleado,sucursal,pension,eps
           where maestro.codmaestro=sucursal.codmaestro and
           sucursal.codsucursal=zona.codsucursal and
          empleado.codzona=zona.codzona and
          empleado.codeps=eps.codeps and
          empleado.codpension=pension.codpension and
          empleado.cedemple=retiro.cedemple and
          retiro.fechare between '$desde' and '$hasta' and
          maestro.codmaestro='$campo'order by zona.zona,retiro.fechare";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta 2" );
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4>Listado de Empleados Retirados</h4></center>
             <table border="0" align="center">
                <tr  class="cajas">
                  <th>Cod_Retiro</th>
                  <th>Documento</th>
                  <th>Empleado</th>
                  <th>Eps</th>
                  <th>Pensión</th>
                  <th>Zona</th>
                  <th>F_Proceso</th>
                  <th>F_Retiro</th>
                  <th>Dias</th>
                </tr>
    <?
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
                 <tr  class="cajas">
                     <td><?echo $filas_s["nroretiro"];?></td>
                     <td><?echo $filas_s["cedemple"];?></td>
                     <td><?echo $filas_s["nombres"];?></td>
                     <td><?echo $filas_s["eps"];?></td>
                     <td><?echo $filas_s["pension"];?></td>
                     <td><?echo $filas_s["zona"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["fecha"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["fechare"];?></td>
                     <td>&nbsp;&nbsp;<?echo $filas_s["dias"];?></td>
                 </tr>

           <?
           $suma=$suma+1;
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $suma;?></td></center>
             <table border="0" align="center">
             <tr>
              <td><center><a href="imprimirgeneral.php?codigo=<?echo $campo;?>&desde=<? echo $desde;?>&hasta=<? echo $hasta;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></td>
             </tr>
             </table>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados retirados en este Rango de Fechas Zona")
                history.back()
             </script>
            <?

         endif;
    endif;
  endif;
  ?>
</table>

</body>
</html>
