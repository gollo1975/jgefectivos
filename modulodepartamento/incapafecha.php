<html>
        <head>
                <title>Incapacidades por Zona</title>
                <link rel="stylesheet" href="../estilo.css" type="text/css">
        </head>
        <body>
                      <?
                 if (!isset($desde)):
                         include("../conexion.php");
                ?>
                   <center><h4>Incapacidades por Fecha</h4></center>
                   <form action="" method="post">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                              <td><b>Fecha Inicio:&nbsp;</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="10">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><b>Fecha Final:&nbsp;</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10">&nbsp;</td>
                            </tr>
                           <tr><td><br></td></tr>
                             <tr>
                               <td colspan="6"><input type="submit" value="Buscar" class="boton"> &nbsp;<input type="reset" value="Limpiar" class="boton"></td>
                             </tr>
                        </table>

                   </form>
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
                                sucursal.codsucursal='$codigo'";
                             $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                             ?>
                             <center><h4>Datos de la Incapacidad</h4></center>
                            <table border="0" align="center">
                                <?
                             while($filas=mysql_fetch_array($resultado1)):
                             ?>
                               <tr class="cajas">
                                <td><?echo $filas["sucursal"];?></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <?
                              $consulta="select zona.zona,incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,incapacidad.dias,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,
                              eps.eps,tipoinca.concepto from zona,incapacidad,empleado,eps,tipoinca,sucursal where
                              sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=empleado.codzona and
                              empleado.cedemple=incapacidad.cedemple and
                              empleado.codeps=eps.codeps and
                              incapacidad.tipoinca=tipoinca.tipoinca and
                              incapacidad.fechaini between '$desde'and'$hasta' and
                              sucursal.codsucursal='$codigo'";
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
                              <th>Nro_Incap.</th>
                              <th>Cedula</th>
                              <th>Nombres</th>
                              <th>Apellidos</th>
                               <th>F_Inicio</th>
                               <th>F_Final</th>
                               <th>Dias</th>
                               <th>Descripción</th>
                             </tr>
                              <?
                              while($filas_s=mysql_fetch_array($resultado)):
                             ?>
                               <tr class="cajas">
                               <td><?echo $filas_s["nroinca"];?></td>
                               <td><a href="detalladoindi.php?cedula=<?echo $filas_s["cedemple"];?>&codigo=<?echo $codigo;?>"><?echo $filas_s["cedemple"];?></a></td>
                               <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?></td>
                               <td><?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                                 <td><?echo $filas_s["fechaini"];?></td>
                                 <td><?echo $filas_s["fechater"];?></td>
                                 <td><?echo $filas_s["dias"];?></td>
                                 <td><?echo $filas_s["concepto"];?></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <th><center><a href="imprimirfecha.php?codigo=<?echo $codigo;?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>">Imprimir</a></center></th>
                              <?
                           endif;
                        endif;
                                           ?>
       </body>
</html>
