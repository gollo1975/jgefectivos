<?
 session_start();
?>
<html>
        <head>
                <title>Modificar Vendedores</title>
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
                        if (document.getElementById("cedula").value.length >=0)
                        {
                            alert ("Digite el Documento del vendedor para la consulta");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("carga").submit();
                    }

                </script>
        </head>
        <body>
        <? if(session_is_registered("xsession")):
                if (!isset($cedula))
                {
        ?>
                        <center><h4><u>Modificar Datos</u></h4></center>
                        <form action="" method="post" id="carga">
                                <table border="0" align="center">
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td><b>Documento de Identidad:</b></td>
                                                <td><input type="text" name="cedula" value="" size="12" maxlength="12" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
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
                        $consulta="select * from vendedor where cedulaven='$cedula'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("Este documento no existe en sistema")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                                <center><h4>Datos del Vendedor</h4></center>
                                                <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                <td><b>Nit:</b></td>
                                                                <td colspan="1"><input type="text" name="cedula" value="<?echo $filas["cedulaven"];?>" size="13"class="cajas" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>

                                                        </tr>
                                                        <tr>
                                                                <td><b>Nombre:</b></td>
                                                                <td colspan=3><input type="text" name="nombre" value="<?echo $filas["nombreven"];?>" size="50" class="cajas"maxlength="50"class="cajas"  onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Dirección:</b></td>
                                                                <td colspan=3><input type="text" name="direcion" value="<?echo $filas["dirven"];?>" size="50" class="cajas"maxlength="50" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="direcion"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Teléfono:</b></td>
                                                                <td colspan=3><input type="text" name="telefono" value="<?echo $filas["teven"];?>" size="13" maxlength="7"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telefono"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Celular:</b></td>
                                                                <td colspan=3><input type="text" name="celular" value="<?echo $filas["celular"];?>" size="13" maxlength="13"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
                                                        </tr>
                                                        <tr>
                                                         <td><b>Sucursal:</b></td>
                                                           <td>
                                                             <select name="codigo" class="cajas">
                                                                 <?
                                                                $aux=$filas["codsucursal"];
                                                                $consulta_z="select sucursal.codsucursal,sucursal.sucursal from sucursal";
                                                                $resultado_z=mysql_query($consulta_z) or die("Error al buscar la sucursal");
                                                                while ($filas_z=mysql_fetch_array($resultado_z)):
                                                                    if ($aux==$filas_z["codsucursal"]):
                                                                       ?>
                                                                       <option value="<?echo $filas_z["codsucursal"];?>" selected><?echo $filas_z["sucursal"];?>
                                                                          <?
                                                                     else:
                                                                        ?>
                                                                        <option value="<?echo $filas_z["codsucursal"];?>"><?echo $filas_z["sucursal"];?>
                                                                        <?
                                                                      endif;
                                                                   endwhile;
                                                                       ?>
                                                             </select></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>

                                                        <tr>
                                                                <td colspan="4"><input type="submit" value="Guardar" class="boton"></td>
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
