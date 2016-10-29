<html>
        <head>
                <title>Agregar nuevos servicios</title>
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
                    if (document.getElementById("codservi").value.length <=0)
                        {
                            alert ("El campo código del servicio no puede estar vacío");
                            document.getElementById("codservi").focus();
                            return;
                        }
                    if (document.getElementById("descripcion").value.length <=0)
                        {
                            alert ("El campo descripción no puede estar vacío");
                            document.getElementById("descripcion").focus();
                            return;
                        }
                        document.getElementById("matservicio").submit();

                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($codservi))
                        {
                                include("../conexion.php");
                ?>
                 <center><h3>Agregar Nuevos Servicios</h3></center>
                <form action="" method="post" id="matservicio">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"><br></td>
                                </tr>
                                <tr>
                                        <td><b>Cod_Servicio:</b></td>
                                        <td><input type="text" name="codservi" value="" size="10" mexlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codservi">
                                </tr>
                                <tr>
                                        <td><b>Descripción:</b></td>
                                        <td><input type="text" name="descripcion" value="" size="40" mexlength="40"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion">
                                </tr>
                  <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                        </tr>
                        </table>

                </form>
                    <?
                        }
                        else
                        {
                                include("../conexion.php");
                                $consulta="select * from servicio where codservi='$codservi'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                                $registros=mysql_num_rows($resultado);
                                $descripcion=strtoupper($descripcion);
                                if ($registros==0)
                                {
                                        $consulta="insert into servicio (codservi,descripcion)
                                                        value('$codservi','$descripcion')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");

                ?>

                                        <script language="javascript">
                                                alert("Registro Almacenado Correctamente")
                                             open("agregar.php","_self");
                                        </script>
                <?
                                }
                                else
                                {
                ?>

                                        <script language="javascript">
                                                alert("El Registro ya Existe")
                                                open("agregar.php","_self");
                                        </script>
                 <?
                                }
                        }
                 ?>
        </body>
</html>
