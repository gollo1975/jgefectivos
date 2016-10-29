<?
 session_start();
?>
<html>
        <head>
                <title>Matricula de Vendedores</title>
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
                        if (document.getElementById("cedulaven").value.length <=0)
                        {
                            alert ("Digite le documento del vendedor?");
                            document.getElementById("cedulaven").focus();
                            return;
                        }
                        if (document.getElementById("nombreven").value.length <=0)
                        {
                            alert ("Digite el  Nombre vendedor?");
                            document.getElementById("nombreven").focus();
                            return;
                        }
                        if (document.getElementById("dirven").value.length <=0)
                        {
                            alert ("Digite la Dirección del vendedor");
                            document.getElementById("dirven").focus();
                            return;
                        }
                        if (document.getElementById("teven").value.length <=0)
                        {
                            alert ("El campo Telefono no puede estar vacío");
                            document.getElementById("teven").focus();
                            return;
                        }
                        document.getElementById("matriculas").submit();
                    }

                   </script>


        </head>
        <body>
        <?         if(session_is_registered("xsession")):
                        if (!isset($empresa)):
                                include("../conexion.php");
                ?>
                <center><h4><u>Matricular Vendedores</u></h4></center>
                <form action="" method="post" id="matriculas" >
                        <table border="0" align="center">
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                        <td><b>Documento:</b></td>
                                        <td><input type="text" name="cedulaven" value="" size="13" maxlength="13"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedulaven">
                                </tr>
                                <tr>
                                        <td><b>Nombre:</b></td>
                                        <td><input type="text" name="nombreven" value="" size="50" maxlength="50"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id = "nombreven">
                                </tr>
                                <tr>
                                        <td><b>Dirección:</b></td>
                                        <td><input type="text" name="dirven" value="" size="50" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirven">
                                </tr>
                                <tr>
                                        <td><b>Teléfono:</b></td>
                                        <td><input type="text" name="teven" value="" size="13" maxlength="7"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="teven">
                                </tr>
                                <tr>
                                        <td><b>Celular:</b></td>
                                        <td><input type="text" name="celular" value="" size="13" maxlength="13" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="celular">
                                </tr>
                                <tr>
                                        <td><b>Empresa</b></td>
                                        <td><select name="empresa" class="cajas">
                                            <?
                                                                $consulta_z="select codmaestro,nomaestro from maestro  ";
                                                                $resultado_z=mysql_query($consulta_z) or die("Error en la busqueda de sucursales");
                                                                while ($filas_z=mysql_fetch_array($resultado_z))
                                                                {
                                                        ?>
                                                                <option value="<?echo $filas_z["codmaestro"];?>"><?echo $filas_z["nomaestro"];?>
                                                        <?
                                                                }
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
                           else:
                                include("../conexion.php");
                                $estado='ACTIVO';
                                $consulta="select * from vendedor where cedulaven='$cedulaven'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                                $registros=mysql_num_rows($resultado);
                                if ($registros==0):
                                     $nombreven=strtoupper($nombreven);
                                      $dirven=strtoupper($dirven);
                                      $consulta="insert into vendedor (cedulaven,nombreven,dirven,teven,celular,codmaestro,estado)
                                                        value('$cedulaven','$nombreven','$dirven','$teven','$celular','$empresa','$estado')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                ?>
                                        <script language="javascript">
                                          alert("Registros Grabados con Exito en la bd.?")
                                                open("agregar.php","_self");

                                        </script>
                <?
                                else:
                ?>

                                        <script language="javascript">
                                                alert("Este Documento Ya existe en Sistema")
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
