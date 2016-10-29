<html>

<head>
  <title>Consulta de Beneficiarios por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h3>Consulta por Zona</h3></center>
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
                                 $consulta_z="select * from zona where zona.nomina='SI' and zona.estado='ACTIVA'order by zona";
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
       include("..//conexion.php");
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

          include("..//conexion.php");
          $consu="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,funeraria,contrato,zona where
          empleado.codzona=zona.codzona and
          empleado.codemple=contrato.codemple and
          empleado.cedemple=funeraria.cedemple and
          contrato.fechater='0000-00-00'and
          zona.codzona='$campo'";
              $resulta=mysql_query($consu)or die ("Consulta incorrecta");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
          <center><h3>Listado de Empleados</h3></center>
          <table boder="0" align="center">
            <tr class="cajas">
              <td>Para ver el listado de beneficiarios, Presione Click sobre el Documento de Identidad..</td>
            </tr>
          </table>
              <table border="0" align="center">
               <tr  class="cajas">
               <th>Item</th>
                  <th>Ducumento</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
              </tr>
    <?
        $i=1;
            while($filas_s=mysql_fetch_array($resulta)):
   ?>
              <tr  class="cajas">
              <th><?echo $i;?></th>
                 <td><a href="auxiliar.php?cedemple=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                 <td><?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
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
                alert("No Existen empleados con beneficiarios")
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
