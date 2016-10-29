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
                        <center><h4><u>Provisiones</u></h4></center>
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
                          $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato where
                              empleado.codemple=contrato.codemple and
                              contrato.fechater='0000-00-00' and
                              empleado.cedemple='$cedula'";
                           $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("Este documento aparece retirado de sistema ? ?")
                                history.back()
                              </script>
                               <?
                           else:
                               $con="select provision.* from empleado,provision
                               where empleado.cedemple=provision.cedemple and
                                provision.cedemple='$cedula' and
                                provision.estado='ACTIVO'";
                               $res=mysql_query($con) or die("Error en la busqueda de provisiones");
                               $reg=mysql_num_rows($res);
                               if ($reg!=0):
                                  ?>
                                  <center><h4><u>Detalle del Registro</u></h4></center>
                                  <table border="0" align="center">
                                    <tr>
                                    <th>Item</th>
                                      <th>Nro_Pago</th>
                                      <th>Valor</th>
                                      <th>F_Proceso</th>
                                       <th>Perido</th>
                                       <th>Nota</th>
                                    <tr>
                                     <?
                                     $a=1;
                                     while ($filas=mysql_fetch_array($res)):
                                       $valor=number_format($filas["valor"],0);
                                        ?>
                                        <tr class="cajas">
                                          <th><?echo $a;?></th>
                                          <td><a href="detallado.php?nro=<?echo $filas["nro"];?>&cedula=<?echo $cedula;?>"><div align="center"><?echo $filas["nro"];?></div></td>
                                          <td><?echo $valor;?></td>
                                          <td><?echo $filas["fechap"];?></td>
                                          <td><?echo $filas["periodo"];?></td>
                                          <td><?echo $filas["nota"];?></td>
                                         </tr>
                                        <?
                                        $con=$con+$filas["valor"];
                                        $a=$a+1;
                                     endwhile;
                                    $con=number_format($con,0);
                                     ?>
                                  </table>
                                  <tr>
                                   <h5><div align="center">Total_Provisión:&nbsp;$<?echo $con;?></div>  </h5>
                                  </tr>

                                  <?
                               else:
	                             ?>
	                             <script language="javascript">
	                               alert("No hay registros para modificar. ?")
                                       history.back()
	                             </script>
	                             <?

                               endif;
                           endif;
               endif;
                           ?>
       </body>
</html>
