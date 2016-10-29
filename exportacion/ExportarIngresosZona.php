<html>
        <head>
                <title>Listado de Empleado</title>
        </head>
        <body>
        <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        <?
 if(!isset($desde)):
 include("../conexion.php");
?>
   <center><h4><u>Ingreso Empleados</u></h4></center>
   <form action="" method="post">
     <table border="0" align="center">
       <tr><td><br></td></tr>
        <tr>
	    <td><b>Desde:</b></td>
	    <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" class='cajas' size="12" maxlength="10"></td>
        </tr>
        <tr>
	    <td><b>Hasta:</b></td>
	    <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" class='cajas' size="12" maxlength="10"></td>
	  </tr>
	 <?if ($codzona==''){?> 
       <tr>
         <td><b>Zona:</b></td>
         <td><select name="codzona" class="cajas" id="codzona">
                              <option value="0">Seleccione zona
                                <?
                                 $consulta_z="select codzona,zona from zona where zona.nomina='SI' order by zona.zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("Error al buscar zonas");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
	 <?}?> 
        <tr><td><br></td></tr>
        <tr>
          <td colspan="5"><input type="submit" value="Buscar" class="boton">
        </td></tr>
     </table>
   </form>
 <?
 elseif(empty($codzona)):
   ?>
   <script language="javascript">
     alert("Despliegue de la lista la empresa ?")
     history.back()
   </script>
   <?
   else:
                include("../conexion.php");
                $consulta="select zona.zona,empleado.*,contrato.salario,contrato.fechainic,contrato.cargo,contrato.fechater,eps.eps,pension.pension from eps,pension,zona,empleado,contrato
                        where zona.codzona=contrato.codzona and
						     contrato.codemple=empleado.codemple and
                             empleado.codeps=eps.codeps and
                             empleado.codpension=pension.codpension and
                             contrato.fechainic between '$desde' and '$hasta' and
                             zona.codzona='$codzona'  order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
                $resultado=mysql_query($consulta) or die("Error al buscar empleados");
                $registros=mysql_num_rows($resultado);
                if ($registros==0):
                  ?>
                        <script language="javascript">
                                alert("No Existen Registros de ingresos en este rango de fechas")
                                history.back()
                        </script>
               <?
                else:
                     header("Content-type: application/vnd.ms-excel");
                     header("Content-Disposition: attachment; filename=Empleados Activos.xls");
                     header("Pragma: no-cache");
                     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                     header("Expires: 0");
                        ?>
                                <table border="0" align="center">
                                     <tr class="cajas">
                                        <td style='font-weight:bold;font-size:1.1em;'>Nro</td>
					<td style='font-weight:bold;font-size:1.1em;'>Codigo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Documento</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nombre 1</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Nombre 2</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Apellido 1</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Apellido 2</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Teléfono</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Dirección</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Municipio</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Sexo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Fecha_Nac.</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Cuenta</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Eps</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Pension</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>F_Ingreso</td>
                                         <td style='font-weight:bold;font-size:1.1em;'>F_Retiro</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Salario</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Cargo</td>
                                        <td style='font-weight:bold;font-size:1.1em;'>Zona</td>
                                     </tr>
                                 <?
                                 $i=1;
                                while ($filas=mysql_fetch_array($resultado)):
                                  ?>
                                   <tr class="cajas">
                                        <td><?echo $i;?></td>
					<td><?echo $filas["codemple"];?></td>
                                        <td><?echo $filas["cedemple"];?></td>
                                        <td><?echo $filas["nomemple"];?></td>
                                        <td><?echo $filas["nomemple1"];?></td>
                                        <td><?echo $filas["apemple"];?></td>
                                        <td><?echo $filas["apemple1"];?></td>
                                        <td><?echo $filas["telemple"];?></td>
                                        <td><?echo $filas["diremple"];?></td>
                                        <td><?echo $filas["municip"];?></td>
                                        <td><?echo $filas["sexo"];?></td>
                                        <td><?echo $filas["fechanac"];?></td>
                                        <td><?echo $filas["cuenta"];?></td>
                                        <td><?echo $filas["eps"];?></td>
                                        <td><?echo $filas["pension"];?></td>
                                        <td><?echo $filas["fechainic"];?></td>
                                        <td><?echo $filas["fechater"];?></td>
                                        <td><?echo $filas["salario"];?></td>
                                        <td><?echo $filas["cargo"];?></td>
                                        <td><?echo $filas["zona"];?></td>
                                       </tr>
                               <?
                               $i=$i+1;
                              endwhile;
                              ?>
                            </table>
                              <?
                endif;
       endif;
                ?>
        </body>
</html>
