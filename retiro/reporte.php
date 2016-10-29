 <head>
                <title>Crear Centro de Costo</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                      <?
                      if (!isset($auxcodigo)):
                         include("../conexion.php");
                         ?>
                               <center><h4><u>Retiros Provisionales</u></h4></center>
                               <form action="" method="post" id ="imacentro">
                                        <table border="0" align="center"
                                          <tr><td><br></td></tr>
                                       <tr>
                                        <td><b>F_Inicio:</b></td>
                                        <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="12"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
                                        <td><b>F_Final:</b></td>
                                        <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="10" maxlength="12"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
                                       </tr>
                                       <tr>
			         <td><b>Empresa:</b></td>
			                              <td colspan="12"><select name="auxcodigo" class="cajas">
			                              <option value="0">Seleccione la empresa
			                                <?
			                                 $consulta_z="select maestro.codmaestro,maestro.nomaestro from maestro ";
			                                 $resultado_z=mysql_query($consulta_z)or die ("Error en la busqueda de empresa");
			                                while($filas_z=mysql_fetch_array($resultado_z)):
			                                   ?>
			                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
			                                  <?
			                                  endwhile;
			                                  ?>
			                                  </select></td>
                                                          <tr><td><br></td></tr>
			         </tr>
                                        <tr><td ><input type="submit" Value="Buscar" class="boton"></td></tr>
                                     </table>
                                 </form>
                        <?
                        elseif(empty($auxcodigo)):
                          ?>
                           <script language="javascript">
                              alert("Seleccione la empresa de la lista ?")
                              history.back()
                           </script>
                          <?
                        else:
                           include("../conexion.php");
                            $con1="select retiroprovision.*,empleado.codemple from retiroprovision,empleado,sucursal,maestro,zona
                            where  maestro.codmaestro=sucursal.codmaestro and
                                   sucursal.codsucursal=zona.codsucursal and
                                   zona.codzona=empleado.codzona and
                                   empleado.cedemple=retiroprovision.cedemple and
                                   retiroprovision.fechare between '$desde' and '$hasta' and
                                   maestro.codmaestro='$auxcodigo' order by zona.zona ASC";
                             $resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
                             $reg1=mysql_num_rows($resu1);
                             if($reg1!=0):
                                ?>
                                <center><td><h4><u>Listado de retiro provisional</u></h4></b></td></center>
                                   <table boder="0" align="center">

                                        <tr="cajas">
                                       <th>Item</th>
                                      <th>Cod_Retiro</th>
                                      <th>Documento</th>
                                      <th>Empleado</th>
                                      <th>Zona</th>
									  <th>F_Ingreso</th>
                                      <th>F_Retiro</th>
                                      <th>F_Proceso</th>   
                                      <th>Dias</th>
                                     </tr>
                                     <?
                                     $f=1;
                                      while ($filas_s = mysql_fetch_array($resu1)):
									    $CodEmpleado = $filas_s["codemple"];
										$Sql="select contrato.fechainic FROM contrato
 										     where contrato.codemple='$CodEmpleado' ORDER BY contrato.codemple  DESC";                                  
										$Rs=mysql_query($Sql)or die ("Error al buscar fecha de inicio del contrato.!");
                                        $Fila=mysql_fetch_array($Rs);
										$FechaInicio = $Fila["fechainic"];
                                       ?>
                                       <tr class="cajas">
                                         <th><? echo $f;?></th>
                                         <td><?echo $filas_s["codretiro"];?></td>
                                         <td><?echo $filas_s["cedemple"];?></td>
                                         <td><?echo $filas_s["nombres"];?></td>
                                         <td><?echo $filas_s["zona"];?></td>
										 <td><?echo $FechaInicio;?></td>
                                         <td><?echo $filas_s["fechare"];?></td>
                                          <td><?echo $filas_s["fecha"];?></td>
                                         <td><?echo $filas_s["dias"];?></td>
                                      </tr>
                                       <?
                                       $f=$f+1;
                                       endwhile;
                                       ?>
                                   </table>
                                   <?
                             else:
                                   ?>
                                 <script language="javascript">
                                   alert("No hay retiros provisionales en este rango de fechas ?")
                                   open("modificaretiro.php","_self")
                                 </script>
                                 <?
                             endif;
                endif;
                     ?>

</body>
</html>
