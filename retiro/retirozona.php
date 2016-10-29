<html>

<head>
  <title>Consulta de retiro de Asociados</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
      <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='retirozona.php'
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
  <center><h4>Retiro de Asociados por Zona</h4></center>
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
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
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
       include("../conexion.php");
         $consulta="select zona.zona from zona where
                 zona.codzona='$campo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta 1");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("La zona No existe en la bd. ?")
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
              <td><?echo $filas["zona"];?></td>
              </tr>
              <?
            endwhile;
            ?>
            </table>
            <?

          include("../conexion.php");
          $consu="select retiro.* from retiro,zona,empleado where
          empleado.codzona=zona.codzona and
          empleado.cedemple=retiro.cedemple and
          retiro.fechare between '$desde' and '$hasta' and
          zona.codzona='$campo'order by retiro.fecha";
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
                  <th>Empleado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <th>Fecha_Proceso</th>
                  <th>Fecha_Retiro</th>
                  <th>Dias</th>
                </tr>
    <?
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
                 <tr  class="cajas">
                     <td><?echo $filas_s["nroretiro"];?></td>
                     <td><?echo $filas_s["cedemple"];?></td>
                     <td><?echo $filas_s["nombres"];?></td>
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
              <td><center><a href="imprimir.php?codzona=<?echo $campo;?>&desde=<? echo $desde;?>&hasta=<? echo $hasta;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></td>
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
