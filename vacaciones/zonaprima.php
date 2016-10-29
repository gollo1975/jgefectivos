<html>

<head>
  <title>Consulta de Primas semestrales</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4>Consulta por Zona</h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td><select name="campo" class="cajas">
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
          $consu="select prima.* from empleado,prima,zona where
          empleado.codzona=zona.codzona and
          empleado.cedemple=prima.cedemple and
          zona.codzona='$campo'order by empleado.cedemple";
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
               <td>Para ver todas las Primas de los empleados, Presione Click Sobre el Documento..</td>
              </tr>
            </table>
           <table border="0" align="center">
              
              <tr  class="cajas">
                  <th>Nro_Prima</th>
                  <th>Ducumento</th>
                  <center><th>Empleado</th></center>
                  <th>Fecha_Pro.</th>
                  <th>Fecha_Ini.</th>
                  <th>Fecha_Ter.</th>
                   <th>dias</th>
                  <th>Ibc</th>
                  <th>Vlr_Pagado</th>
              </tr>
    <?
            while($filas_s=mysql_fetch_array($resulta)):
   ?>
              <tr  class="cajas">
                 <td>&nbsp;&nbsp;&nbsp;<a href="imprimirpresta.php?nroprima=<?echo $filas_s["nroprima"];?>"><?echo $filas_s["nroprima"];?></a></td>
                 <td><a href="detalladoprima?cedula=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nombre"];?></td>
                 <td><?echo $filas_s["fechap"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechainicio"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["fechacorte"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["dias"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["salario"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["total"];?></td>
               </tr>

           <?
           $suma=$suma+1;
           $con=$con+$filas_s["total"];
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $suma;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vlr_Pagado:</b>&nbsp;&nbsp;<?echo $con;?></td></center>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con vacaciones en esta Zona")
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
