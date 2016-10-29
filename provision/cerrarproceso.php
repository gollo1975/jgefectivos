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
                        <center><h4><u>Cerrar Proceso</u></h4></center>
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
                          $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
                           where empleado.codemple=contrato.codemple and
                                 empleado.cedemple='$cedula'";
                           $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis!=0):
                               $conP="select provision.* from empleado,provision
                               where empleado.cedemple=provision.cedemple and
                                provision.cedemple='$cedula' and
                                provision.estado='ACTIVO'";
                               $resP=mysql_query($conP) or die("Error en la busqueda de provisiones");
                               $regP=mysql_num_rows($resP);
                               if ($regP!=0):
                                       $con="select entregaprovi.* from empleado,entregaprovi
	                               where empleado.cedemple=entregaprovi.cedemple and
	                                entregaprovi.cedemple='$cedula' and
	                                entregaprovi.carga='ACTIVO'";
	                               $res=mysql_query($con) or die("Error en la busqueda de provisiones");
	                               $reg=mysql_num_rows($res);
	                               if ($reg!=0):
                                          $Datos='PAGADO';
                                          $Resp="update provision set estado='$Datos' where provision.estado='ACTIVO' and provision.cedemple='$cedula'";
                                          $con=mysql_query($Resp)or die("Error al cerrar las provisiones");
                                          $registro=mysql_affected_rows();
                                          $RespN="update entregaprovi set carga='$Datos' where entregaprovi.carga='ACTIVO' and entregaprovi.cedemple='$cedula'";
                                          $conN=mysql_query($RespN)or die("Error al cerrar las Notas Beditos");
                                           $registros=mysql_affected_rows();
                                          echo "<script language=\"javascript\">";
	                                    echo "alert (\"Se Cerraron $registro Registro de la provision y $registros registros de las Notas Debitos\",\"pie\");";
	                                    echo ("open (\"cerrarproceso.php\",\"_self\");");
                                         echo "</script>";
                                       else:
                                          ?>
	                                  <script language="javascript">
	                                      alert("No hay Notas debito para cerrar al proceso ?")
                                              history.back()
	                                  </script>
	                                  <?
                                       endif;
	                       else:
	                           ?>
	                           <script language="javascript">
	                             alert("No hay Provisiones para cerrar en sistemas ?")
                                     history.back()
	                           </script>
	                           <?
                               endif;
                           else:
                               ?>
                              <script language="javascript">
                                alert("Este empleado se encuentra retirado en sistema?")
                                history.back()
                              </script>
                               <?
                           endif;
                   endif;
              ?>
       </body>
</html>
