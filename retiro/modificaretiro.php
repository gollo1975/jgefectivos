 <head>
                <title>Crear Centro de Costo</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                      <?
                      if (!isset($auxcodigo)):
                         include("../conexion.php");
                         ?>
                               <center><h4><u>Registros Provisionales</u></h4></center>
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
                            $con1="select retiroprovision.* from retiroprovision,empleado,sucursal,maestro,zona
                            where  maestro.codmaestro=sucursal.codmaestro and
                                   sucursal.codsucursal=zona.codsucursal and
                                   zona.codzona=empleado.codzona and
                                   empleado.cedemple=retiroprovision.cedemple and
                                   retiroprovision.fechare between '$desde' and '$hasta' and
                                   maestro.codmaestro='$auxcodigo' order by zona.zona";
                             $resu1=mysql_query($con1)or die ("Consulta Incorrecta 1");
                             $reg1=mysql_num_rows($resu1);
                             if($reg1!=0):
                                ?>
                                <form action="eliminar.php" method="post">
                                  <input type="hidden" name="nit" value="<?echo $auxcodigo;?>">
                                  <input type="hidden" name="desde" value="<?echo $desde;?>">
                                  <input type="hidden" name="hasta" value="<?echo $hasta;?>">
                                  <table boder="0" align="center">
                                     <tr class="cajas">
                                       <td><b>Listado de retiro provisional</b></td>
                                     </tr>
                                   </table>
                                   <tr><td><br></td></tr>
                                   <table border="0" align="center">
                                    <tr class="cajas">
                                      <th>#</th><th><br></th><th><br></th><th><b><u>Cod_Retiro</u></b></th><th><b>&nbsp;<u>Documento</u></b></th><th><b>&nbsp;<u>Empleado</u></b></th><th><b><u>Zona</u></b></th><th><b><u>Fecha_Ret.</u></b></th><th><b><u>&nbsp;&nbsp;Dias_Segu.</u></b></th><th><b><u>&nbsp;&nbsp;Dias_Pago</u></b></th><th><b><u>&nbsp;&nbsp;Estado</u></b></th>
                                     </tr>
                                     <tr><td><br></td></tr>
                                     <?
                                     $f=1;
                                      while ($filas_s = mysql_fetch_array($resu1)):
                                     ?>
                                       <tr class="cajas">
                                         <input type="hidden" name="codigo" value="<? echo $filas_s["codretiro"];?>">
                                         <th><?echo $f;?></th>
                                         <td><input type="checkbox" name="busca[]" value="<?echo $filas_s["codretiro"];?>"></td>
                                         <td><a href="decargar.php?datos=<?echo $filas_s["codretiro"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&nit=<?echo $auxcodigo;?>"><img src="../image/mod.jpg" border="0" alt="Permite Modificar el Registro"></a></td><td>&nbsp;&nbsp;<?echo $filas_s["codretiro"];?></td>
                                         <td><?echo $filas_s["cedemple"];?></td>
                                         <td><?echo $filas_s["nombres"];?></td>
                                         <td><?echo $filas_s["zona"];?></td>
                                         <td>&nbsp;<?echo $filas_s["fechare"];?></td>
                                         <td><div align="center"><?echo $filas_s["dias"];?></div></td>
                                         <td><div align="center"><?echo $filas_s["diasperiodo"];?></div></td>
                                         <td>&nbsp;&nbsp;<?echo $filas_s["estado"];?></td>
                                      </tr>
                                       <?  $f=$f+1;
                                       endwhile;
                                       ?>
                                      <tr><td><br></td></tr>
                                       <tr>
                                        <td align="right" colspan="2"><input type="submit" value="Eliminar" class="boton"></td>
                                       </tr>
                                   </table>
                                 </form>
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
