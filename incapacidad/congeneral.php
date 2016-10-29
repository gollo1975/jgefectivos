<html>
        <head>
                <title>Incapacidades en general</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
        </head>
        <body>
        <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='congeneral.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
                <?
                 if (!isset($desde)):
                         include("../conexion.php");
                ?>
                        <center><h4><u>Incapacidades por Sucursal</u><h4></center>
                         <form action="" method="post">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"><br></td>
                            </tr>
                            <tr>
                              <td><b>Desde:</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="12" maxlength="10"class="cajas"></td>
                            </tr>
                            <tr>
                              <td><b>Hasta:</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas"></td>
                            </tr>
                             <tr>
                              <td><b>Sucursal:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la sucursal
                                <?
                                 $consulta_z="select * from sucursal order by sucursal";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
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
                       alert("Seleccione la sucursal de Busqueda" )
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
                      $consulta1="select sucursal.sucursal from sucursal where
                                sucursal.codsucursal='$campo'";
                             $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("No Existe la sucursal en la b.d. ?")
                                history.back()
                              </script>
                               <?
                           else:
                           ?>

                           <center><h3>Datos de la Incapacidad</h3></center>
                            <table border="0" align="center">
                           <tr>
                             <td colspan="9"></td>

                              <?
                             while($filas=mysql_fetch_array($resultado1)):
                             ?>
                               <tr class="cajas">
                                <td><b><?echo $filas["sucursal"];?></b></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <?
                           endif;
                           include("../conexion.php");
                           $consulta="select sucursal.sucursal,zona.codzona,zona.zona,incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,incapacidad.fechapro,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,
                              eps.eps,tipoinca.concepto,incapacidad.estado from sucursal,zona,incapacidad,empleado,eps,tipoinca where
                              sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=incapacidad.cedemple and
                              empleado.codeps=eps.codeps and
                              incapacidad.tipoinca=tipoinca.tipoinca and
							  incapacidad.fechapro between '$desde'and'$hasta' and
                              sucursal.codsucursal='$campo'";
                               $resultado=mysql_query($consulta) or die("Consulta de empleado incorrecta");
                           $regist=mysql_num_rows($resultado);
                           if ($regist==0):
                              ?>
                              <script language="javascript">
                                alert("No Existen incapacidades en  la sucursal ?")
                                history.back()
                              </script>
                               <?
                           else:
                             ?>

                            <table border="0" align="center">
                               <tr class="cajas">
                               <th>Nro</th>
                              <th>Nro_Incap</th>
                              <th>Cedula</th>
                              <th>Nombre</th>
                              <th>Apellido</th>
                              <th>Cod_Zona</th>
                              <th>Zona</th>
                              <th>F_Radi.</th> 
                              <th>F_Inicio</th>
                              <th>F_Final</th>
                               <th>Dias</th>
                               <th>Descripción</th>
							    <th>Estado</th>
                             </tr>
                              <?$a=1;
                              while($filas_s=mysql_fetch_array($resultado)):
                             ?>
                               <tr class="cajas">
                               <th><?echo $a;?></th>  
                               <td><?echo $filas_s["nroinca"];?></td>
                               <td><?echo $filas_s["cedemple"];?></td>
                               <td><?echo $filas_s["nomemple"];?></td>
                               <td><?echo $filas_s["apemple"];?></td>
                               <td><?echo $filas_s["codzona"];?></td>
                               <td><?echo $filas_s["zona"];?></td>
                               <td><?echo $filas_s["fechapro"];?></td>
                               <td><?echo $filas_s["fechaini"];?></td>
                               <td><?echo $filas_s["fechater"];?></td>
                               <td><?echo $filas_s["dias"];?></td>
                               <td><?echo $filas_s["concepto"];?></td>
							    <td><?echo $filas_s["estado"];?></td>
                               </tr>
                                <?$a=$a+1;
                              endwhile;
                              ?>
                              </table>
                              <td><center><a href="imprimir3.php?campo=<?echo $campo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></td>
                              <?
                           endif;
                        endif;
                                           ?>
       </body>
</html>
