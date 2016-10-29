<html>

<head>
  <title>Consulta carta laboral</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
   if (!isset($dato)):
  ?>
  <center><h4><u>Carta Laboral</u></h4></center>
<form action="" method="post">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
   <tr>
     <td><b>Opciones:</b></td>
     <td><select name="opcion" class="cajas">
         <option value="0">Seleccione el tipo de busqueda
         <option value="1">Código
         <option value="2">Documento
       </select></td>
   </tr>
   <tr>
     <td><b>Dato a Buscar:</b></td>
     <td><input type="text" name="dato" value="" size="15" maxlegth="15">
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
elseif (empty($opcion)):
?>
  <script language="javascript">
    alert ("Seleccione la opción de Busqueda ?")
    history.back()
  </script>
  <?
  elseif (empty($dato)):
?>
  <script language="javascript">
    alert ("Digite el dato a buscar ?")
    history.back()
  </script>
    <?
     else:
      include("../conexion.php");
       if($opcion==2):
              $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,zona
                     where zona.codzona=empleado.codzona and
                     zona.codzona='$codigo' and
                     empleado.cedemple='$dato'";
              $resultado=mysql_query($consulta)or die("Consulta incorrecta");
              $registros=mysql_num_rows($resultado);
              if($registros!=0):
                   ?>
                    <table border="0" align="center">
                        <?
                    while($filas=mysql_fetch_array($resultado)):
                     ?>
                     <tr>
                      <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                       </tr>
                      <?
                    endwhile;
                    ?>
                    </table>
                  <?
                   $consu="select carta.* from carta,empleado where
                       empleado.cedemple=carta.cedemple and
                       empleado.cedemple='$dato' order by carta.codigo";
                       $resu=mysql_query($consu)or die("Consulta incorrecta dos");
                       $regis=mysql_num_rows($resu);
                       if($regis!=0):
                               ?>
                              <center><h5>Listado de carta Laborales</h5></center>
                              <table border="0" align="center">
                              
                              <tr  class="cajas" align="center">
                                 <th>#</th>
                                  <th>Nro_Carta</th>
                                  <th>Fecha_Proceso</th>
                                 <th>Firma</th>
                                  <th>Cargo</th>
                              </tr>
                              <?
							  $t=1;
							  $Validar = '';
                               while($filas_s=mysql_fetch_array($resu)):
							    $Validar= $filas_s["tipoempleado"];
                                ?>

                              <tr  class="cajas">
							   <th><?echo $t;?></th>
                                <?if($Validar==''){?>
                                  <td><a href="../cartalaboral/impricarta.php?codigo=<?echo $filas_s["codigo"];?>&auxFirma=<?echo $filas["firmadigital"];?>"><?echo $filas_s["codigo"];?></a></td>
                                <?}else{?>
                                   <td><a href="../cartalaboral/ImprimirCarta.php?NroCarta=<?echo $filas_s["codigo"];?>&auxFirma=<?echo $filas["firmadigital"];?>"><?echo $filas_s["codigo"];?></a></td>
                                <?}?>
                                 <td><?echo $filas_s["fecha"];?></td>
                                 <td><?echo $filas_s["firma"];?></td>
                                 <td><?echo $filas_s["cargo"];?></td>
                              </tr>
                              <?
                              $t +=1;
                               endwhile;
                            ?>
                            </table>
                            <?
                      else:
                       ?>
                        <script language="javascript">
                          alert("Este documento no tiene cartas en sistema ?")
                          history.back()
                         </script>
                       <?
                     endif;
               else:
                 ?>
                        <script language="javascript">
                          alert("No esta Autorizado para ver las cartas de este empleado ?")
                          history.back()
                         </script>
                       <?
           endif;
         else:
               include("../conexion.php");
                $consu="select carta.* from carta where
                       carta.codigo='$dato'";
                       $resu=mysql_query($consu)or die("Consulta incorrecta dos");
                       $regis=mysql_num_rows($resu);
                       if($regis!=0):
                                       ?>
                                      <center><h5>Listado de carta Laborales</h5></center>
                                      <table border="0" align="center">
                                     
                                      <tr  class="cajas" align="center">
                                         <th>#</th>
                                  <th>Nro_Carta</th>
                                  <th>Fecha_Proceso</th>
                                 <th>Firma</th>
                                  <th>Cargo</th>
                                      </tr>
                                      <?
									  $t=1;
                                       while($filas_s=mysql_fetch_array($resu)):
									   $Validar= $filas_s["tipoempleado"];
                                        ?>
                                      <tr  class="cajas">
									   <th><?echo $t;?></th>
                                         <?if($Validar==''){?>
										  <td><a href="../cartalaboral/impricarta.php?codigo=<?echo $filas_s["codigo"];?>&auxFirma=<?echo $filas["firmadigital"];?>"><?echo $filas_s["codigo"];?></a></td>
										<?}else{?>
										   <td><a href="../cartalaboral/ImprimirCarta.php?NroCarta=<?echo $filas_s["codigo"];?>&auxFirma=<?echo $filas["firmadigital"];?>"><?echo $filas_s["codigo"];?></a></td>
										<?}?>
                                         <td><?echo $filas_s["fecha"];?></td>
                                         <td><?echo $filas_s["firma"];?></td>
                                         <td><?echo $filas_s["cargo"];?></td>
                                      </tr>
                                      <?
                                      $t +=1;
                                    endwhile;
                                    ?>
                                    </table>
                                  
                                    <?
                         else:
                                 ?>
                                   <script language="javascript">
                                     alert("Este codigo de carta no existe en sistema ?")
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
