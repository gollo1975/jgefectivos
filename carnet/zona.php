<html>

<head>
  <title>Carnet por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4>Carnet por Zona</h4></center>
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
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
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
          $consu="select carnet.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from carnet,zona,empleado
          where zona.codzona=empleado.codzona and
          empleado.cedemple=carnet.cedemple and
          carnet.fecha between '$desde' and '$hasta' and
          zona.codzona='$campo' order by carnet.fecha";
          $resulta=mysql_query($consu)or die ("Error al buscar carnet");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4>Listado de Empleados</h4></center>
              <table border="0" align="center">
              <tr  class="cajas">
                  <th>Nro</th>
                  <th>Cod_Entrada</th>
                  <th>Documento</th>
                  <th>Empleado</th>
                  <th>Estado</th>
                  <th>Cant.</th>
                  <th>Fecha_Pro.</th>
                   <th>Tipo_Carnet</th>
                </tr>
                <?
                $i=1;
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
               <tr  class="cajas">
                 <th><?echo $i;?></th>
                 <td><div align="center"><?echo $filas_s["codcarnet"];?></div></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["estado"];?></td>
                 <td><div align="center"><?echo $filas_s["cantidad"];?></div></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fecha"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["tipocarnet"];?></td>  

               </tr>
               <?
              $i=$i+1;
            endwhile;
              ?>
          </table>
        <?
      else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con carnet en este rango de fechas")
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
