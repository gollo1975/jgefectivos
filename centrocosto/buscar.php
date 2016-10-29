<html>

<head>
  <title>Consulta de Nomina por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
      <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='buscar.php'
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
  <center><h4>Empleado por centro de costo</h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr><td><br></td></tr>
    <tr>
         <td><b>Centro de Costo</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione el centro de costo
                                <?
                                 $consulta_z="select costo.codcosto,costo.centro from costo order by costo.centro";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codcosto"];?>"> <?echo $filas_z["centro"];?>
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
        $consulta="select costo.centro from costo where
                 costo.codcosto='$campo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("No existe datos en el sistema ?")
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
              <td><?echo $filas["centro"];?></td>
              </tr>
              <?
            endwhile;
            ?>
            </table>
            <?

           $consu="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,zona.codzona from empleado,costo,zona
          where zona.codzona=empleado.codzona and
          empleado.codcosto=costo.codcosto and
         costo.codcosto='$campo'order by zona.zona";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4><u>Listado de Empleados</u></h4></center>
            <table border="0" align="center">
              <tr class="cajas">
                <td>Para Ver El total de empleado por zona, Presione Click Sobre el Cod_Zona..</td>
              </tr>
            </table>
              <table border="0" align="center">

              <tr class="cajas">
                  <th>Cedula</th>
                  <th>Empleado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <th>Cod_Zona</th>
                  <th>Zona&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                 </tr>
    <?
            while($filas_s=mysql_fetch_array($resulta)):
                        ?>
         <tr  class="cajas">
                 <td><?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td><a href="detalladozona.php?codzona=<?echo $filas_s["codzona"];?>&codcosto=<? echo $campo;?>"><?echo $filas_s["codzona"];?></a></td>
                 <td><?echo $filas_s["zona"];?></td>
               </tr>

           <?
           $suma=$suma+1;
            endwhile;
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $suma;?></td></center>
             <tr><td><br></td></tr>
             <th><center><a href="imprimir.php?codcosto=<?echo $campo;?>" target="_blank" onclick="volver()" class="fondo"><b>Imprimir</b></a></center></th>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con este Centro de costo")
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
