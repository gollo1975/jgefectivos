<html>
        <head>
                <title>Registra provision</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                  <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function chequearcampos()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento del empleado.?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matprovi").submit();

                    }
                </script>
        </head>
        <body>
                <?
                 if (!isset($cedula)):
                ?>
                        <center><h4><u>Detalle Provisión</u></h4></center>
                         <form action="" method="post" id="matprovi">
                           <table border="0" align="center"
                                <tr><td><br></td></tr>
                                <tr>
                                  <td><b>Documento de Identidad:</b></td>
                                   <td><input type="text" name="cedula" value="" size="13" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
                                   </tr>
                                   <tr><td><br></td></tr>
                                   <tr><td colspan="1"><input type="button" Value="Buscar" class="boton" onclick="chequearcampos()"></td></tr>
                               </tr>
                        </table>
                   </form>
              <?
                else:
                      include("../conexion.php");
                          include("../conexion.php");
                          $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
                              empleado.cedemple='$cedula'";
                           $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("Este documento no existe en sistema ? ?")
                                history.back()
                              </script>
                               <?
                           else:
                               $conP="select provision.* from empleado,provision
                               where empleado.cedemple=provision.cedemple and
                                provision.cedemple='$cedula' and
                                provision.estado='ACTIVO'";
                               $resP=mysql_query($conP) or die("Error en la busqueda de provisiones");
                               $regP=mysql_num_rows($resP);
                               if ($regP!=0):
                                  ?>
                                  <center><h4><u>Detalle del Registro</u></h4></center>
                                  <table border="0" align="center">
                                    <tr>
                                      <th>Item</th>
                                      <th>Nro_Radicado</th>
                                      <th>F_Proceso</th>
                                      <th>Periodo</th>
                                      <th>Vlr_Provisión</th>
                                      <th>Nota</th>
                                    <tr>
                                     <?
                                     $a=1;
                                     while ($filasP=mysql_fetch_array($resP)):
                                       $valor=number_format($filasP["valor"],0);
                                        ?>
                                        <tr class="cajas">
                                          <th><?echo $a;?></th>
                                          <td><div align="center"><?echo $filasP["nro"];?></div></div></td>
                                           <td><?echo $filasP["fechap"];?></td>
                                            <td><?echo $filasP["periodo"];?></td>
                                          <td><?echo $valor;?></td>
                                          <td><?echo $filasP["nota"];?></td>
                                         </tr>
                                        <?
                                        $con=$con+$filasP["valor"];
                                        $a=$a+1;
                                     endwhile;
                                     $Tprovision=$con;
                                    $con=number_format($con,0);
                                     ?>
                                  </table>
                                  <tr>
                                   <h5><div align="center">Total_Provision:&nbsp;$<?echo $con;?></div>  </h5>
                                  </tr>

                                  <?
                               else:
	                             ?>
	                             <script language="javascript">
	                               alert("No hay provisiones generadas en sistema ?")
                                       history.back()
	                             </script>
	                             <?

                               endif;
                            /*segundo codigo de entrega de provision*/

                               $con="select entregaprovi.* from empleado,entregaprovi
                               where empleado.cedemple=entregaprovi.cedemple and
                                entregaprovi.cedemple='$cedula' and
                                entregaprovi.carga='ACTIVO'";
                               $res=mysql_query($con) or die("Error en la busqueda de provisiones");
                               $reg=mysql_num_rows($res);
                               if ($reg!=0):
                                  ?>
                                  <table border="0" align="center">
                                    <tr>
                                    <th>Item</th>
                                      <th>Nro_Nota</th>
                                      <th>Vlr_Nota</th>
                                      <th>F_Proceso</th>
                                       <th>Nota</th>
                                    <tr>
                                     <?
                                     $a=1;
                                     while ($filas=mysql_fetch_array($res)):
                                       $valor=number_format($filas["vlrpagado"],0);
                                        ?>
                                        <tr class="cajas">
                                          <th><?echo $a;?></th>
                                          <td><a href="detalladonota.php?nro=<?echo $filas["nro"];?>&cedula=<?echo $cedula;?>"><div align="center"><?echo $filas["nro"];?></div></td>
                                          <td><?echo $valor;?></td>
                                          <td><?echo $filas["fechae"];?></td>
                                          <td><?echo $filas["nota"];?></td>
                                         </tr>
                                        <?
                                        $con1=$con1+$filas["vlrpagado"];
                                        $a=$a+1;
                                     endwhile;
                                     $Tentrega=$con1;
                                    $con1=number_format($con1,0);
                                    $Taux=$Tprovision-$Tentrega;
                                    $Taux=number_format($Taux,0);
                                     ?>
                                  </table>
                                  <tr>
                                   <h5><div align="center">Total_Nota:&nbsp;$<?echo $con1;?></div>  </h5>
                                  </tr>
                                  <tr>
                                   <h5><div align="center">Total_Pagar:&nbsp;$<?echo $Taux;?></div>  </h5>
                                  </tr>

                                  <?
                               else:
	                             ?>
	                             <script language="javascript">
	                               alert("No hay Notas Débitos generadas en sistema ?")   
                                       history.back()
	                             </script>
	                             <?

                               endif;
                           endif;
               endif;
                           ?>
       </body>
</html>
