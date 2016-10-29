<html>

<head>
<title>Consulta Novedades por Zona</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($campo)):
include("../conexion.php");
?>
<center><h4>Novedades_Admon</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Digite la Zona:</b></td>
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
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar" class="boton"></td>
        </tr>
        
    </table>

  </form>
  <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una zona")
     history.back()
   </script>
    <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select zona.zona from zona where
               zona.codzona='$campo'";
     $resultado=mysql_query($variable)or die("consulta incorrecta ");
     $registro=mysql_num_rows($resultado);
     while($filas=mysql_fetch_array($resultado)):
          ?>
               <table border="0" align="center">
                <tr class="cajas">
                 <td colspan="10"><b>Empresa:</b>&nbsp;<?echo $filas["zona"];?></td>
                </tr>
                <tr class="cajas">
                  <td colspan="1"><b>Desde:&nbsp;&nbsp;</b><?echo $desde;?></td>
                  <td colspan="1"><b>Hasta:&nbsp;&nbsp;</b><?echo $hasta;?></td>
                </tr>
               </table>
             <?
     endwhile;
              $variable1="select novedadindividual.*,costo.centro,empleado.nomemple from zona,novedadindividual,empleado,costo where
                    zona.codzona=novedadindividual.codzona and
                    zona.codzona=empleado.codzona and
                    empleado.cedemple=novedadindividual.cedemple and
                    empleado.codcosto=costo.codcosto and
                    novedadindividual.desde between '$desde'and'$hasta' and
                    zona.codzona='$campo'order by novedadindividual.nombre";
     $resultado1=mysql_query($variable1)or die("consulta incorrecta $variable1");
     $registro=mysql_num_rows($resultado1);
     if ($registro==0):
        ?>
        <script language="javascript">
           alert("No hay novedades de Nomina en este rango de Fechas ?")
           history.back()
        </script>
       <?
     else:
         ?>
         <center><h4>Listado de Empleados</h4></center>
         <table border="0" align="center">
           <tr><td class="cajas">Para ver las Novedades por Empleado, presione Click Sobre La ["cedula"]...</td></tr>
         </table>
          <table border="1" align="center">
           <tr >
              <th>Item</th>
              <th>Cedula</th>
              <th class="cajas">Nombre</th>
              <th class="cajas">Nota</th>
              </tr>
              <?
              $con=1;
             while($filas_s=mysql_fetch_array($resultado1)):
                ?>
                <tr class="cajas">
                  <td><?echo $con;?></td>
                  <td><a href="detallado.php?cedula=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                  <td><?echo $filas_s["nombre"];?></td>
                  <td><?echo $filas_s["nota"];?></td>
                </tr>
                <?
                $con=$con+1;
                endwhile;
                ?>
                  </table>
                <?
              endif;
         endif;
         ?>
       </body>

  </html>
