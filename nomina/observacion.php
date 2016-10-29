<html>

<head>
  <title>Observacion</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='PagoNomina.php'
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
 </head>

<?
  if (!isset($cedula)):
     include("../conexion.php");
  ?>
  <center><h4><u>Observaciones</u></h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
  <tr>
     <td><b>Desde:&nbsp;</b></td>
     <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas"></td>
     <td><b>Hasta:&nbsp;</b></td>
     <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas"></td>
  </tr>
  <tr>
         <td><b>Vendedor:</b></td>
                              <td colspan="12"><select name="cedula" class="cajas">
                              <option value="0">Seleccione el Trabajador
                                <?
                                 $consulta_z="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple) as empleado  from zona,empleado,contrato
				           where empleado.codzona=zona.codzona and
				           empleado.codemple=contrato.codemple and
                                           zona.tipoempresa='SI' and
				           contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1,empleado.apemple";
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
elseif (empty($desde)):
?>
  <script language="javascript">
    alert ("Digite la fecha de inicio para el proceso ?")
    history.back()
  </script>
    <?
    elseif (empty($cedula)):
?>
  <script language="javascript">
    alert ("despliegue la lista para elgir el trabajador ?")
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
                 if($reg!=0):
	                  ?>
	                    <table border="0" align="center">
	                     <tr>
	                       <td class="cajas"><b>Documento:</b>&nbsp;<? echo $cedula;?></td>
	                     </tr>
	                     <tr>
	                       <td class="cajas"><b>Empleado:</b>&nbsp;<? echo $filas_s["empleado"];?></td>
	                     </tr>
	                    </table>
	                 <?
	                $consulta="select procesonomina.*,zona.zona from procesonomina,zona,empleado
                         where procesonomina.codzona=zona.codzona and
                         empleado.cedemple=procesonomina.cedemple and
                         procesonomina.fechainicio between '$desde' and '$hasta' and
	                 empleado.cedemple='$cedula'";
	                 $resultado=mysql_query($consulta) or die("Error al buscar registros de nomina ");
	                 $registros=mysql_num_rows($resultado);
                         if($registros!=0):
	                     ?>
	                     <center><h4><u>Detalles de comisión</u></h4></center>
	                       <table border="0" align="center" >
	                         <tr class="cajas">
                                 <th>#</th>
                                 <th>&nbsp;</th>
                                 <th>CodProceso</th>
	                            <th>Zona</th>
	                            <th>F_Inicio</th>
	                            <th>H_Inicio</th>
                                    <th>H_Final</th>
	                            <th>F_Final</th>
                                    <th>Registro</th>
                                    <th>Usuario</th>
                                     <th>Nota</th>
	                         <? $a=1;
	                          while ($filas=mysql_fetch_array($resultado)):
                                    $valor=number_format($filas["total"],0);
	                            ?>
	                              <tr class="cajas">
                                      <th><?echo $a;?></th>
                                      <td>&nbsp;<a href="Nota.php?CodProceso=<?echo $filas["codproceso"];?>&zona=<?echo $filas["zona"];?>&cedula=<?echo $cedula;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>"><img src="../image/mod.jpg" border="0" alt="Modificar Registro"></a></td>
                                        <td><div align="center"><?echo $filas["codproceso"];?></div></td>
	                              <td><?echo $filas["zona"];?></td>
	                              <td><?echo $filas["fechainicio"];?></td>
	                              <td><?echo $filas["horainicio"];?></td>
	                              <td><?echo $filas["horafinal"];?></td>
	                              <td><?echo $filas["fechafinal"];?></td>
	                             <td><div align="center"><?echo $filas["registro"];?></div></td>
                                      <td><?echo $filas["usuario"];?></td>
                                      <td><?echo $filas["nota"];?></td>
	                            </tr>
	                            <? $a=$a+1;$con=$con+$filas["registro"];
                                     endwhile;
                                     $con=number_format($con,0);
                                      ?>
	                            </table>
                                      <div align="center"><b>Total_Registros:</b>&nbsp;<?echo $con;?></div>
	                            <?
	                   else:
	                      ?>
	                         <script language="javascript">
	                            alert("No hay registros De Facturacion para esta Zona ?")
	                            history.back()
	                         </script>
	                         <?
	                   endif;
                 else:
                     ?>
	             <script language="javascript">
	                 alert("No hay registros de comision en esta fecha ?")
	                 history.back()
	            </script>
	             <?
                 endif;

	  endif;
	       ?>


</body>
</html>
