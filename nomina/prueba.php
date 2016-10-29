<html>

<head>
  <title>Consulta Extracto de Nomina</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($dato)):
     include("../conexion.php");
  ?>
  <center><h4>Extracto de Nomina</h4></center>
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
                              <td colspan="12"><select name="dato" class="cajas">
                              <option value="0">Seleccione el empleado
                                <?
                                 $consulta_z="select empleado.cedemple,empleado.nomemple,empleado.apemple from empleado where empleado.nomina='SI' order by empleado.nomemple,empleado.apemple";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["cedemple"];?>"> <?echo $filas_z["nomemple"];?>&nbsp;<?echo $filas_z["apemple"];?>
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
elseif (empty($dato)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
<?
else:
    include("../conexion.php");
         $consulta="select empleado.nomemple,empleado.apemple from empleado where
                 empleado.cedemple='$dato'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("El Empleado no Existe en el Sistema ?")
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
              <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["apemple"];?></td>
              </tr>
              <?
            endwhile;
            ?>
            </table>
            <?

          include("../conexion.php");
          $consu="select nomina.* from empleado,nomina where
           empleado.cedemple=nomina.cedemple and
           nomina.fechap between '$desde' and '$hasta' and
           empleado.cedemple='$dato'order by nomina.consecutivo";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4>Listado de Colillas</h4></center>
            <table border="0" align="center">
              <tr class="cajas">
                <td>Para ver El Informe de las colilla, Presione Click Sobre el Cod_Nómina..</td>
              </tr>
            </table>
              <table border="0" align="center">

              <tr  class="cajas">
                  <th>Cod_Nomina</th>
                  <th>Cod_Periodo</th>
                 <th>Desde</th>
                  <th>Hasta</th>
                  <th>Pagado</th>
                  <th>Devengado</th>
                  <th>Deducido</th>
                  <th>Prestación</th>
                </tr>
    <?
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
         <tr  class="cajas">
                 <td><a href="imprimir.php?codigo=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
                 <td><?echo $filas_s["codigo"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["desde"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["hasta"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["neto"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["devengado"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["deduccion"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["presta"];?></td>

               </tr>

           <?
           $suma=$suma+1;
           $con=$con+$filas_s["presta"];
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $suma;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vlr_Prestación:</b>&nbsp;&nbsp;<?echo $con;?></td></center>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con nomina en este Rango de Fechas ")
                history.back()
             </script>
            <?

         endif;
    endif;
endif;
?>
</body>
</html>
