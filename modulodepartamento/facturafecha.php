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
                   <center><h4>Facturas por fechas</h4></center>
                   <form action="" method="post">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                              <td><b>Fecha Inicio:&nbsp;</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><b>Fecha Final:&nbsp;</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas">&nbsp;</td>
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
                             <center><h4>Listado de Facturas</h4></center>
                            <table border="0" align="center">
                                <?
                             while($filas=mysql_fetch_array($resultado1)):
                             ?>
                               <tr class="cajas">
                                <td><b>Sucursal:</b>&nbsp;<?echo $filas["sucursal"];?></td>
                               </tr>
                                <?
                              endwhile;
                              ?>
                              </table>
                              <?
                              $consulta="select factura.nrofactura,factura.grantotal,factura.nsaldo,factura.estado,zona.zona from zona,sucursal,factura where
                              sucursal.codsucursal=zona.codsucursal and
                              zona.codzona=factura.codzona and
                              factura.fechaini between '$desde'and'$hasta' and
                              sucursal.codsucursal='$codigo'";
                           $resultado=mysql_query($consulta) or die("Error de busqueda de facturas ?");
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
                                 <td>Para ver por pantalla las facturas, Presione Click en el Campo [Nro_Factura]</td>
                               </tr>
                             </table>
                             <table border="0" align="center">
                               <tr class="cajas">
                                <th>Item</th>
                                 <th>Nro_Factura</th>
                                 <th>Zona</th>
                                 <th>Vlr_Pagar</th>
                                 <th>Saldo</th>
                                 <th>Estado</th>
                             </tr>
                              <?
                              $i=$i+1;
                              $estado=1;
                              while($filas_s=mysql_fetch_array($resultado)):
                             ?>
                               <tr class="cajas">
                               <th><?echo $i;?></th>
                               <td><a href="../factura/imprimir.php?nrofactura=<?echo $filas_s["nrofactura"];?>&codigo=<?echo $codigo;?>&estado=1"><?echo $filas_s["nrofactura"];?></a></td>
                               <td><?echo $filas_s["zona"];?></td>
                               <td><?echo $filas_s["grantotal"];?></td>
                                 <td><?echo $filas_s["nsaldo"];?></td>
                                 <td><?echo $filas_s["estado"];?></td>
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
