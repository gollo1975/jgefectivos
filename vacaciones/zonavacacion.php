<html>

<head>
  <title>Consulta de Vacaciones por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4>Vacaciones X Zona</h4></center>
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
          $consu="select vacacion.* from empleado,vacacion,zona where
          empleado.codzona=zona.codzona and
          empleado.cedemple=vacacion.cedemple and
          zona.codzona='$campo'";
              $resulta=mysql_query($consu)or die ("Consulta incorrecta");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>

            <center><h4>Listado de Empleados</h4></center>
            <table border="0" align="center">
              <tr class="cajas">
                <td>Para ver El Informe de las Vacaciones, Presione Click Sobre el Nro_Vacación..</td>
              </tr>
            </table>
           <table border="0" align="center">
              <tr  class="cajas">
               <th>#</th>
                  <th>Nro_Vacación</th>
                  <th>Ducumento</th>
                  <center><th>Empleado</th></center>
                  <th>Desde</th>
                  <th>Hasta</th>
                  <th>Ibc</th>
                  <th>Vlr_Pagado</th>
              </tr>
    <? $suma=1;
            while($filas_s=mysql_fetch_array($resulta)):
            $valor=number_format($filas_s["valor"],0);
   ?>
              <tr  class="cajas">
              <th><?echo $suma;?></th>
                 <td><a href="imprimir.php?codvaca=<?echo $filas_s["codvaca"];?>"><?echo $filas_s["codvaca"];?></a></td>
                 <td><a href="detalladovacacion.php?cedula=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nombre"];?></td>
                 <td><?echo $filas_s["fechai"];?></td>
                 <td><?echo $filas_s["fechac"];?></td>
                 <td><div align="center"><?echo $filas_s["ibc"];?></div></td>
                 <td><div align="right">$<?echo $valor;?></div></td>
               </tr>

           <?
           $Cont=$Cont+$filas_s["valor"];
           $suma=$suma+1;
            endwhile;
            $Cont=number_format($Cont,0);
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Vlr_Pagado:</b>&nbsp;$<?echo $Cont;?></td></center>
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
