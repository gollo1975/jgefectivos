<html>

<head>
  <title>Editar relación</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 </head>

<?
  if (!isset($cedula)):
     include("../conexion.php");
  ?>
  <center><h4><u>Editar relación</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>

  <tr>
         <td><b>Trabajador:</b></td>
                              <td colspan="12"><select name="cedula" class="cajas">
                              <option value="0">Seleccione el Trabajador
                                <?
                                 $consulta_z="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple) as empleado from empleado,zona,contrato
                                     where  empleado.codzona=zona.codzona and
                                           empleado.codemple=contrato.codemple and
                                           contrato.fechater='0000-00-00' and
                                      zona.tipoempresa='SI'  order by empleado.cedemple";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error en la busqueda de vendedor");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["cedemple"];?>"> <?echo $filas_z["empleado"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($cedula)):
?>
  <script language="javascript">
    alert ("Despliegue la lista para eligir el trabajador ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple) as empleado from empleado
                where empleado.cedemple='$cedula'";
                 $resulta=mysql_query($consu) or die("Error en la busqueda de comision  ");
                 $reg=mysql_num_rows($resulta);
                 $filas_s=mysql_fetch_array($resulta);
                 $documento=number_format($cedula,0);
                 if($reg!=0):
	                  ?>
	                    <table border="0" align="center">
	                     <tr>
	                       <td class="cajas"><b>Documento:</b>&nbsp;<? echo $documento;?></td>
	                     </tr>
	                     <tr>
	                       <td class="cajas"><b>Vendedor:</b>&nbsp;<? echo $filas_s["empleado"];?></td>
	                     </tr>
	                    </table>
	                 <?
	                $consulta="select comisionomina.* from comisionomina,empleado,zona
	                 where comisionomina.cedemple=empleado.cedemple and
                               zona.codzona=comisionomina.codzona and
                               zona.estado='ACTIVA' and
	                 empleado.cedemple='$cedula'";
	                 $resultado=mysql_query($consulta) or die("Error al buscar relación de zonas ");
	                 $registros=mysql_num_rows($resultado);
                         if($registros!=0):
	                     ?>
	                     <center><h4><u>Relacion de Zonas</u></h4></center>
	                       <table border="0" align="center" >
	                         <tr class="cajas">
                                  <th>Item</th>
                                   <th>Registro</th>
	                            <th>Cod_Zona</th>
	                            <th>Zona</th>
	                            <th>F_Proceso</th>
	                            <th>Comparte</th>
	                         <?     $a=1;
	                          while ($filas=mysql_fetch_array($resultado)):
	                            ?>
	                              <tr class="cajas">
                                      <th><? echo $a;?></th>
                                      <td><a href="CambioRelacion.php?nro=<? echo $filas["codigo"];?>&codzona=<?echo $filas["codzona"];?>&cedula=<?echo $cedula;?>"><div align="center"><? echo $filas["codigo"];?></div></a></td>
	                              <td><? echo $filas["codzona"];?></td>
	                              <td><? echo $filas["zona"];?></td>
                                       <td><? echo $filas["fechap"];?></td>
	                              <td><? echo $filas["comparte"];?></td>


	                            </tr>
	                            <?  $a=$a+1;
	                            endwhile;
	                            ?>
	                            </table>
                                    <div align="center"><a href="ModificarRelacion.php"><h4><font color="red">Volver</font></h4></a></div>
                                <?
	                   else:
	                      ?>
	                         <script language="javascript">
	                            alert("No hay relacion de zonas para este venededor ?")
	                            history.back()
	                         </script>
	                         <?
	                   endif;
                 else:
                     ?>
	             <script language="javascript">
	                 alert("El vendedor no existe en sistema ?")
	                 history.back()
	            </script>
	             <?
                 endif;

	  endif;
	       ?>


</body>
</html>
