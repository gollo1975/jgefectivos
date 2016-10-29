<html>
        <head>
                <title>Agregar Item de Abono</title>
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
                          if (document.getElementById("descripcion").value.length <=0)
                        {
                            alert ("El campo Descripción no puede estar vacío");
                            document.getElementById("descripcion").focus();
                            return;
                        }

                        document.getElementById("matitab").submit();

                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($descripcion))
                        {
                                include("../conexion.php");
                ?>
                <center><h4><u>Item de Abono</u></h4><center>
                <form action="" method="post" id="matitab">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"><br></td>
                                </tr>
                                 <tr>
                                        <td><b>Descripcion:</b></td>
                                        <td><input type="text" name="descripcion" value="" size="40" mexlength="40" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion">
                                </tr>
                                <tr><td><br></td></tr>
                  <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                        </table>
                       
                </form>
                  <?
                        }
                        else
                        {
                                include("../conexion.php");
                                   $consulta = "select count(*) from manejo";
                                    $result = mysql_query ($consulta);
                                    $sw = mysql_fetch_row($result);
                                    $descripcion=strtoupper($descripcion);
                                    if ($sw[0]>0):
                                        $consulta = "select max(cast(codmanejo as unsigned)) + 1  from manejo";
                                        $result = mysql_query ($consulta);
                                        $codec = mysql_fetch_row($result);
                                        $code = str_pad($codec[0], 2,"0", STR_PAD_LEFT);
                                       $consulta="insert into manejo (codmanejo,descripcion)
                                                        value('$code','$descripcion')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                        $reg=mysql_affected_rows();
                                    else:
                                        $code="01";
                                        $consulta="insert into manejo (codmanejo,descripcion)
                                                        value('$code','$descripcion')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                        $reg=mysql_affected_rows();
                                        echo $consulta;
                                    endif;
                                    if ($reg!=0):
                ?>

                                        <script language="javascript">
                                                open ("../pie?msg=Agregado Item de Abono","pie");
                                              open("agregar.php","_self");
                                        </script>
                <?
                                  endif;

                            }
                 ?>
        </body>
</html>
