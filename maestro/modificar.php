<?
 session_start();
?>
<html>
        <head>
                <title>Modificacion de Empresa</title>
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
                        if (document.getElementById("codmaestro").value.length <=0)
                        {
                            alert ("Debe de digitar el Nit de la empresa");
                            document.getElementById("codmaestro").focus();
                            return;
                        }
                        document.getElementById("modmaestro").submit();
                    }

                </script>
        </head>
        <body>
        <?
        if(session_is_registered("xsession")):
                if (!isset($codmaestro))
                {
        ?>
                        <center><h4><u>Modificar Datos</u></h4></center>
                        <form action="" method="post" id="modmaestro">
                                <table border="0" align="center">
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td><b>Digite el Nit/Cédula:</b></td>
                                                <td><input type="text" name="codmaestro" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codmaestro"></td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>

                                        <tr>
                                                <td colspan="2"><input type="button" Value="Buscar" onclick="chequearcampos()" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                else
                {
                        include("../conexion.php");
                        $consulta="select * from maestro where codmaestro='$codmaestro'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                                <center><h4><u>Datos a Modificar</u></h4></center>
                                                <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                <td><b>Nit:</b></td>
                                                                <td><input type="text" name="codmaestro" value="<?echo $filas["codmaestro"];?>" class="cajas" size="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codmaestro"></td>
                                                                <td><b>Dv:</b></td>
                                                                <td><input type="text" name="dvmaestro" value="<?echo $filas["dvmaestro"];?>" size="3" maxlength="1" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dvmaestro"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Empresa:</b></td>
                                                                <td colspan=3><input type="text" name="nomaestro" value="<?echo $filas["nomaestro"];?>" size="60" class="cajas"maxlength="100"class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nomaestro"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Dirección:</b></td>
                                                                <td colspan=3><input type="text" name="dirmaestro" value="<?echo $filas["dirmaestro"];?>" size="50" class="cajas" maxlength="60" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirmaestro"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Teléfono:</b></td>
                                                                <td colspan=3><input type="text" name="telmaestro" value="<?echo $filas["telmaestro"];?>" size="11" class="cajas" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telmaestro"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Fax:</b></td>
                                                                <td colspan=3><input type="text" name="faxmaestro" value="<?echo $filas["faxmaestro"];?>" size="11" class="cajas" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="faxmaestro"></td>
                                                        </tr>
                                                        <tr>
					                   <td><b>Municipio:</b></td>
					                   <td>    <select name="codmunicipio"class="cajas">
					                              <?
					                              $aux=$filas["codmuni"];
					                              $consulta_c="select codmuni,municipio from municipio order by municipio";
					                              $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
					                              while ($filas_c=mysql_fetch_array($resultado_c))
					                                    {
					                                    if($aux==$filas_c["codmuni"])
					                                    {
					                                    ?>
					                                    <option value="<?echo $filas_c["codmuni"];?>" selected><?echo $filas_c["municipio"];?>
					                                    <?
					                                    }
					                                    else
					                                    {
					                                    ?>
					                                    <option value="<?echo $filas_c["codmuni"];?>"><?echo $filas_c["municipio"];?>
					                                    <?
					                                    }
					                                    }
					                                    ?>
					                                    </select></td>
					                </tr>
                                                        <tr>
                                                                <td><b>Email:</b></td>
                                                                <td colspan=3><input type="text" name="email" value="<?echo $filas["email"];?>"  class="cajas" size="50" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Web:</b></td>
                                                                <td colspan=3><input type="text" name="web" value="<?echo $filas["web"];?>"  class="cajas" size="50" maxlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="web"></td>
                                                        </tr>
                                                        <tr>
					                   <td><b>Actividad:</b></td>
					                   <td>
                                                             <select name="actividad"class="cajas">
					                              <?
					                              $aux=$filas["codigocre"];
					                              $consulta_c="select codigocre,concepto from cree order by codigocre";
					                              $resultado_c=mysql_query($consulta_c) or die("consulta del Cree Incorrecta");
					                              while ($filas_c=mysql_fetch_array($resultado_c))
					                                    {
					                                    if($aux==$filas_c["codigocre"])
					                                    {
					                                    ?>
					                                    <option value="<?echo $filas_c["codigocre"];?>" selected><?echo $filas_c["codigocre"];?> <?echo $filas_c["concepto"];?>
					                                    <?
					                                    }
					                                    else
					                                    {
					                                    ?>
					                                    <option value="<?echo $filas_c["codigocre"];?>"><?echo $filas_c["codigocre"];?> <?echo $filas_c["concepto"];?>
					                                    <?
					                                    }
					                                    }
					                                    ?>
					                                    </select></td>
					                </tr>
                                                        <tr><td><br></td></tr>

                                                        <tr>
                                                                <td colspan="4"><input type="submit" value="Guardar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
                                                        </tr>
                                                         <tr><td><br></td></tr>

        <?
                                }
                        }
                }
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
                                </form>
                </table>
        </body>
</html>
