<html>

<head>
<title>Aporte Social por Zona</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($campo)):
include("../conexion.php");
?>
<center><h4>Aporte Sociales[Cruce Nomina]</h4></center>
  <form  action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr><td><br></td></tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Sucursal:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select codzona,zona from zona where zona.nomina='SI' order by zona";
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
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>
    </table>
    <br>
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
         $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        ?>
           <table border="0" align="center">
              <tr class="cajas">
                <th class="fondo" align="center">Zona&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              </tr>
              <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["zona"];?></td>
               </tr>
                <?
              endwhile;
            $variable1="select consignacion.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,consignacion.valor,consignacion.fechapro,consignacion.fechapago from zona,empleado,consignacion where
                    zona.codzona=empleado.codzona and
                    empleado.cedemple=consignacion.cedemple and
                   consignacion.fechapago between '$desde'and'$hasta' and
                    zona.codzona='$campo' order by empleado.nomemple,empleado.apemple ";
        $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
        $registro=mysql_num_rows($resultado1);
          if ($registro==0):
          ?>
          <script language="javascript">
            alert("No existen aportes sociales en este rango de fechas.")
            history.back()
          </script>
         <?
         else:
         ?>
                  <table border="0" align="center">
           <tr>
             <td colspan="30" class="fondo"></td>
           </tr>
           <tr class="cajas">
              <th>Nro&nbsp;</th>
              <th>Cedula&nbsp;&nbsp;</th>
              <th>Empleado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
              <th>Fecha_Proceso</th>
              <th>Fecha_Nomina</th>
              <th>Valor</th>
             </tr>
              <?
              $i=1;
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">
                 <th><?echo $i;?></th>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td><?echo $filas_s["fechapro"];?></td>
                  <td><?echo $filas_s["fechapago"];?></td>
                 <td><?echo $filas_s["valor"];?></td>
                 </tr>
                <?
                  $suma=$suma+$filas_s["valor"];
                  $i=$i+1;
              endwhile;
              ?>
              </table>
              <tr><td><br></td></tr>
            <tr>
              <center><td><b>Total Aporte:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
            </tr>

               <?
           endif;
         endif;
         ?>

        </table>

       </body>
  </html>
