<?
 session_start();
?>
<html>
        <head>
                <title>Actividades economicas</title>
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
                        if (document.getElementById("codigo").value.length <=0)
                        {
                            alert ("Digite el código de la actividad económica.");
                            document.getElementById("codigo").focus();
                            return;
                        }
                        document.getElementById("modmaestro").submit();
                    }
                     function validar()
                    {
                          if (document.getElementById("concepto").value.length <=0)
                           {
                            alert ("Digite la descripción de la actividad económica.");
                            document.getElementById("concepto").focus();
                            return;
                            }
                        if (document.getElementById("valor").value.length <=0)
                        {
                            alert ("Digite la tarifa contemplada para la facturación");
                            document.getElementById("valor").focus();
                            return;
                        }
                        document.getElementById("matingreso").submit();
                    }

                </script>
        </head>
        <body>
        <?
        if(session_is_registered("xsession")):
                if (!isset($codigo)):

        ?>
                        <center><h4><u>Actividades</u></h4></center>
                        <form action="" method="post" id="modmaestro">
                                <table border="0" align="center">
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td><b>Digite el Código:</b></td>
                                                <td><input type="text" name="codigo" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
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
                else:
                       include("../conexion.php");
                        $consulta="select * from cree where codigocre='$codigo'";
                        $resultado=mysql_query($consulta) or die("error al buscar el codigo de la actividad");
                        $registros=mysql_num_rows($resultado);
                        if ($registros!=0):
        ?>
                                <script language="javascript">
                                        alert("Este Código de actividad ya existe en el sistema.")
                                        history.back()
                                </script>
        <?
                        else:
    ?>
                                                <center><h4><u>Actividades</u></h4></center>
                                                <form action="grabarcodigo.php" method="post" id="matingreso">
                                                <table border="0" align="center">
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                <td><b>Codigo:</b></td>
                                                                <td><input type="text" name="codigo" value="<?echo $codigo;?>" class="cajas" size="11" readonly="yes" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Descripción:</b></td>
                                                                <td colspan=3><input type="text" name="concepto" value="" size="60" class="cajas" maxlength="60"class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Tarifa:</b></td>
                                                                <td colspan=3><input type="text" name="valor" value="" size="11" class="cajas" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>

                                                        <tr>
                                                                <td colspan="4"><input type="button" value="Guardar" class="boton" onclick="validar()">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
                                                        </tr>
                                                         <tr><td><br></td></tr>

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
                                </form>
                </table>
        </body>
</html>
