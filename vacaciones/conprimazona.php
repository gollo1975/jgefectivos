<html>

<head>
  <title>Consulta de primas por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Compensación Semestral</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Desde:</b></td>
       <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="11" maxlength="11"></td>
  </tr>
  <tr>
    <td><b>Hasta:</b></td>
       <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="11" maxlength="11"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select zona.codzona,zona.zona from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"><?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
     <tr><td></td></tr>
      <tr><td></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
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
          $consu="select prima.* from prima,zona where
          zona.codzona=prima.codzona and
          prima.fechai between '$desde' and '$hasta' and
          zona.codzona='$campo'order by prima.nombre";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4>Listado de Empleados</h4></center>
            <table border="0" align="center">
              <tr class="cajas">
                <td>Para ver El Informe de las Primas, Presione Click Sobre el Nro_Prima..</td>
              </tr>
            </table>
            <table border="0" align="center">
              <tr class="cajas">
               <td>Para ver todas las Primas de un Empleado, Presione Click Sobre el Documento..</td>
              </tr>
            </table>
           <table border="0" align="center">
              
              <tr  class="cajas">
                  <th>#</th>
                  <th>Nro_Prima</th>
                  <th>Ducumento</th>
                  <th>Empleado</th>
                  <th>F_Proceso</th>
                  <th>F_Inicio</th>
                  <th>F_Corte</th>
                  <th>F_Contrato</th>
                  <th>Ibc</th>
                  <th>Dias_Totales</th>
                   <th>Dias_Licencia</th>
                  <th>Vlr_Pagado</th>
              </tr>
    <?      $j=1;
            while($filas_s=mysql_fetch_array($resulta)):
            $salario=number_format($filas_s["salario"],0);
            $total=number_format($filas_s["total"],0);
   ?>
              <tr  class="cajas">
              <th><?echo $j;?></th>
                 <td><a href="imprimirprima.php?nroprima=<?echo $filas_s["nroprima"];?>"><?echo $filas_s["nroprima"];?></a></td>
                 <td><a href="detalladoindividual.php?valor=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nombre"];?></td>
                 <td><?echo $filas_s["fechap"];?></td>
                 <td><?echo $filas_s["fechai"];?></td>
                 <td><?echo $filas_s["fechacorte"];?></td>
                 <td><div align="center"><?echo $filas_s["fechainicio"];?></div></td>
                 <td><div align="right"><?echo $salario;?></div></td>
                 <td><div align="center"><?echo $filas_s["dias"];?></div></td>
                 <td><div align="center"><?echo $filas_s["diadeduccion"];?></div></td>
                 <td><div align="right"><?echo $total;?></div></td>
               </tr>

           <?
           $j=$j+1;
           $con=$con+$filas_s["total"];
            endwhile;
            $con=number_format($con,0);
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Vlr_Pagado:</b>&nbsp;&nbsp;<?echo $con;?></td></center>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con Primas en esta Zona")
                history.back()
             </script>
            <?

         endif;
  endif;
  ?>
</table>

</body>
</html>
