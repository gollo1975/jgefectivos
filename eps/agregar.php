<?
 session_start();
?>
<html>
        <head>
                <title>Agregar Eps</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
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
                         if (document.getElementById("Nit").value.length <=0)
                        {
                            alert ("Digite el código de la Eps?");
                            document.getElementById("Nit").focus();
                            return;
                        }
                        if (document.getElementById("eps").value.length <=0)
                        {
                            alert ("El campo EPS no puede estar vacío");
                            document.getElementById("eps").focus();
                            return;
                        }
                        if (document.getElementById("direps").value.length <=0)
                        {
                            alert ("El campo Dirección no puede estar vacío");
                            document.getElementById("direps").focus();
                            return;
                        }
                        if (document.getElementById("teleps").value.length <=0)
                        {
                            alert ("El campo Teléfono no puede estar vacío");
                            document.getElementById("teleps").focus();
                            return;
                        }
                        if (document.getElementById("municipio").value.length <=0)
                        {
                            alert ("El campo Municipio no puede estar vacío");
                            document.getElementById("municipio").focus();
                            return;
                        }

                        document.getElementById("mateps").submit();

                    }
                </script>

        </head>
        <body>
                <?   if(session_is_registered("xsession")):
                        if (!isset($Nit)):
                                include("../conexion.php");
                ?>
                <center><h3><u>Matricular Eps</u></h3></center>
                <form action="" method="post" id="mateps">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"><br></th>
                                </tr>
                                <tr>
                                        <td><b>Nit_Eps:</b></td>
                                        <td><input type="text" name="Nit" value="" size="13" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nit">
                                </tr>
                                <tr>
                                        <td><b>Eps:</b></td>
                                        <td><input type="text" name="eps" value="" size="40" maxlength="40" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="eps">
                                </tr>
                                <tr>
                                        <td><b>Dirección:</b></td>
                                        <td><input type="text" name="direps" value="" size="40" maxlength="40" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="direps">
                                </tr>
                                <tr>
                                        <td><b>Teléfono:</b></td>
                                        <td><input type="text" name="teleps" value="" size="10" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="teleps">
                                </tr>
                                  <tr>
			       <td><b>Municipio:</b></td>
			          <td colspan="5"><select name="municipio" class="cajas" id="municipio">
			          <option value="0">Seleccione el Municipio
			          <?
			            $consulta_d="select codmuni,municipio from municipio order by municipio ";
			            $resultado_d=mysql_query($consulta_d)or die ("Error al buscar municipios");
			            while($filas_d=mysql_fetch_array($resultado_d)):
			              ?>
			              <option value="<?echo $filas_d["codmuni"];?>"> <?echo $filas_d["municipio"];?>
			              <?
			              endwhile;
			              ?></select></td>
			       </tr>
                                <tr><td><br></td></tr>
                                <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                       </table>
                </form>
                <?
   elseif(empty($municipio)):
                        ?>
                                        <script language="javascript">
                                          alert("Seleccione el municipio del listado ?")
                                          history.back()
                                        </script>
                                       <?
   else:
                                include("../conexion.php");
                                    $eps = strtoupper($eps);
                                    $direps = strtoupper($direps);
                                    $municipio = strtoupper ($municipio);
                                    $consulta = "select eps.nit from eps where nit='$Nit'";
                                    $result = mysql_query ($consulta);
                                    $sw = mysql_fetch_row($result);
                                    if ($sw==0):
                                      $consulta="insert into eps (nit,eps,direps,teleps,codmuni)
                                                         value('$Nit','$eps','$direps','$teleps','$municipio')";
                                      $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                     echo "<script language=\"javascript\">";
		                     echo "open (\"../pie.php?msg=Se Grabó $registro registro para la Eps: $eps\",\"pie\");";
                                     echo ("open (\"agregar.php\",\"_self\");");
		                     echo "</script>";
                                    else:
                                       ?>
                                        <script language="javascript">
                                          alert("Este nit ya esta creado en el sistema ?")
                                          history.back()
                                        </script>
                                       <?
                                    endif;
                       endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
                 ?>
        </body>
</html>
