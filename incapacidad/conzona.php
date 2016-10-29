<html>
        <head>
                <title>Incapacidades por Zona</title>
                <link rel="stylesheet" href="../estilo.css" type="text/css">
        </head>
        <body>
        <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='conzona.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
                <?
                 if (!isset($desde)):
                         include("../conexion.php");
                ?>
                   <center><h4><u>Incapacidades por Zona</h4></u></center>
                   <form action="" method="post">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                              <td><b>Desde:</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas"></td>
                            </tr>
                            <tr>
                              <td><b>Hasta:</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas"></td>
                            </tr>
                             <tr>
                              <td><b>Zona:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI'order by zona";
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
                               <td colspan="6"><input type="submit" value="Buscar" class="boton"> &nbsp;<input type="reset" value="Limpiar" class="boton"></td>
                             </tr>
                        </table>

                   </form>
                <?
                elseif(empty($campo)):
                  ?>
                    <script language="javascript">
                       alert("Seleccione la Zona de Busqueda" )
                       history.back()
                     </script>
                     <?
                elseif(empty($desde)):
                  ?>
                    <script language="javascript">
                       alert("Digite la fecha de Inicio" )
                       history.back()
                     </script>
              <?
                 else:
                      include("../conexion.php");
                      $consulta1="select zona.zona from zona where
                                zona.codzona='$campo'";
                             $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("No hay registro en la busqueda ?")
                                history.back()
                              </script>
                               <?
                           else:
                           ?>
                             <center><h4>Datos de la Incapacidad</h4></center>
                            <table border="0" align="center">
                                <?
                             while($filas=mysql_fetch_array($resultado1)):
                             ?>
                               <tr class="cajas">
                                <td><?echo $filas["zona"];?></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <?
                           endif;
                           include("../conexion.php");
                           $consulta="select zona.zona,incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.fechapro,incapacidad.codigo,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.nomina,
                              eps.eps,tipoinca.concepto,control.concepto as Diagnostico,incapacidad.estado from zona,incapacidad,empleado,eps,tipoinca,control where
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=incapacidad.cedemple and
                              empleado.codeps=eps.codeps and
                              incapacidad.tipoinca=tipoinca.tipoinca and
							   incapacidad.codigo=control.codigo and
                              incapacidad.fechaini between '$desde' and '$hasta' and
                              zona.codzona='$campo' order by incapacidad.fechaini DESC";
                           $resultado=mysql_query($consulta) or die("Consulta de empleado incorrecta");
                           $regist=mysql_num_rows($resultado);
                           if ($regist==0):
                              ?>
                              <script language="javascript">
                                alert("No hay registro en la busqueda ?")
                                history.back()
                              </script>
                               <?
                           else:
                             ?>
                             <table border="0" align="center">
                               <tr class="cajas">
                                 <td>Para ver las Incacidades Por Empleado, Presione Click en el Campo [CEDULA]</td>
                               </tr>
                             </table>
                             <table border="0" align="center">
                                <tr class="cajas">
                               <th>Nro</th>
                              <th>Nro_Incap</th>
                              <th>Cedula</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                               <th>F_Inicio</th>
                               <th>F_Final</th>
							   <th>F_Radica.</th> 
                               <th>Dias</th>
                               <th>Descripción</th>
							    <th>Código</th>
			                    <th>Diagnostico</th>
                               <th>Nomina</th>
							   <th>Estado</th>
                             </tr>
                              <? $l=1;
                              while($filas_s=mysql_fetch_array($resultado)):
                             ?>
                               <tr class="cajas">
                               <th><?echo $l;?></th>    
                               <td><?echo $filas_s["nroinca"];?></td>
                               <td><a href="detalladoindi.php?cedula=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                               <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                               <td><?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                                 <td><font color ="red"><?echo $filas_s["fechaini"];?></font></td>
                                 <td><font color="blue"><?echo $filas_s["fechater"];?></font></td>
								   <td><?echo $filas_s["fechapro"];?></td>
                                 <td><div align="center"><?echo $filas_s["dias"];?></div></td>
                                 <td><?echo $filas_s["concepto"];?></td>
								 <td><?echo $filas_s["codigo"];?></td>
				                <td><?echo $filas_s["Diagnostico"];?></td>
                                 <td><?echo $filas_s["nomina"];?></td>
								 <td><?echo $filas_s["estado"];?></td>
                               </tr>
                                <?$l=$l+1;
                              endwhile;
                              ?>
                              </table>
                              <th><center><a href="imprimir2.php?campo=<?echo $campo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></th>
                              <?
                           endif;
                        endif;
                                           ?>
       </body>
</html>
