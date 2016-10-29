<?
 session_start();
?>
<html>
        <head>
                <title>Matricula de Empresa</title>
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
                        if (document.getElementById("codmaestro").value.length <=0)
                        {
                            alert ("El campo NIT no puede estar vacío");
                            document.getElementById("codmaestro").focus();
                            return;
                        }
                        if (document.getElementById("dvmaestro").value.length <=0)
                        {
                            alert ("El campo DV (Dígito de Verificación) no puede estar vacío");
                            document.getElementById("dvmaestro").focus();
                            return;
                        }
                        if (document.getElementById("nomaestro").value.length <=0)
                        {
                            alert ("El campo Nombre de la Empresa no puede estar vacío");
                            document.getElementById("nomaestro").focus();
                            return;
                        }
                        if (document.getElementById("dirmaestro").value.length <=0)
                        {
                            alert ("El campo Dirección no puede estar vacío");
                            document.getElementById("dirmaestro").focus();
                            return;
                        }
                        document.getElementById("matriculas").submit();
                    }

                   </script>


        </head>
        <body>
        <?
  if(session_is_registered("xsession")):
                        if (!isset($codmaestro)):
                                include("../conexion.php");
                ?>
                <center><h4><u>Matricular Empresa</u></h4></center>
                <form action="" id="matriculas" method="post">
                        <table border="0" align="center">
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                        <td><b>Nit:</b></td>
                                        <td><input type="text" name="codmaestro" value="" size="11" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codmaestro">
                                        <b>Dv:</b> <input type="text" name="dvmaestro" value="" size="2" maxlength="1" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dvmaestro"></td>
                                </tr>
                                <tr>
                                        <td><b>Empresa:</b></td>
                                        <td><input type="text" name="nomaestro" value="" size="50" maxlength="100"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id = "nomaestro">
                                </tr>
                                <tr>
                                        <td><b>Dirección</b></td>
                                        <td><input type="text" name="dirmaestro" value="" size="50" maxlength="60" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirmaestro">
                                </tr>
                                <tr>
                                        <td><b>Teléfono:</b></td>
                                        <td><input type="text" name="telmaestro" value="" size="10" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telmaestro">
                                </tr>
                                <tr>
                                        <td><b>Fax:</b></td>
                                        <td><input type="text" name="faxmaestro" value="" size="10" maxlength="7"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="faxmaestro">
                                </tr>
                               <tr>
			         <td><b>Municipio</b></td>
			         <td colspan="1"><select name="municipio" class="cajasletra">
			               <option value="0">Seleccione el Municipio
			               <?
			               $consulta_z="select codmuni,municipio from municipio  order by municipio";
			               $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
			                while ($filas_z=mysql_fetch_array($resultado_z)):
			                   ?>
			                   <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
			                   <?
			               endwhile;
			                    ?>
			             </select></td>
			     </tr>
                                <tr>
                                        <td><b>Email:</b></td>
                                        <td><input type="text" name="email" value="" size="50" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email">
                                </tr>
                                <tr>
                                        <td><b>Web:</b></td>
                                        <td><input type="text" name="web" value="" size="50" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="web">
                                </tr>
                                <tr>
			         <td><b>Actividad:</b></td>
			         <td colspan="1"><select name="actividad" class="cajasletra">
			               <option value="0">Seleccione la actividad principal
			               <?
			               $consulta_z="select codigocre,concepto from cree  order by codigocre";
			               $resultado_z=mysql_query($consulta_z) or die("Error al buscar ");
			                while ($filas_z=mysql_fetch_array($resultado_z)):
			                   ?>
			                   <option value="<?echo $filas_z["codigocre"];?>"><?echo $filas_z["codigocre"];?>-<?echo $filas_z["concepto"];?>
			                   <?
			               endwhile;
			                    ?>
			             </select></td>
			     </tr>
                                <tr><td><br></td></tr>
                                <tr>
                                              <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                        </table>
                </form>

                <?
                        elseif(empty($actividad)):
                          ?>
                           <script language="javascript">
                              alert("Seleccion la actividad economica de la empresa!")
                              history.back()
                           </script>
                          <?
                          else:
                                include("../conexion.php");
                                $consulta="select * from maestro where codmaestro='$codmaestro'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                                $registros=mysql_num_rows($resultado);
                                if ($registros==0)
                                {
                                      $nomaestro=strtoupper($nomaestro);
                                      $dirmaestro=strtoupper($dirmaestro);
                                      $email=strtoupper($email);
                                      $web=strtoupper($webl); 
                                      $consulta="insert into maestro (codmaestro,dvmaestro,nomaestro,dirmaestro,telmaestro,faxmaestro,codmuni,email,web,codigocre)
                                                        value('$codmaestro','$dvmaestro','$nomaestro','$dirmaestro','$telmaestro','$faxmaestro','$municipio','$email','$web','$actividad')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");

                ?>

                                        <script language="javascript">

                                                open("agregar.php","_self");

                                        </script>
                <?
                                }
                                else
                                {
                ?>

                                        <script language="javascript">
                                                alert("El Registro ya Existe")
                                                history.back()
                                        </script>
                 <?
                                }
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
