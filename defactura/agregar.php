<html>
        <head>
                <title>Agregar Item</title>
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
                        if (document.getElementById("codcomp").value.length <=0)
                        {
                            alert ("Digite el código de cuenta para facturar");
                            document.getElementById("codcomp").focus();
                            return;
                        }
                        if (document.getElementById("concepto").value.length <=0)
                        {
                            alert ("Digite la descripción del código de cuenta ?");
                            document.getElementById("concepto").focus();
                            return;
                        }
                         document.getElementById("matitem").submit();

                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($codcomp))
                        {
                                include("../conexion.php");
                ?>
                <form action="" method="post" id="matitem">
                  <center><h4><u>Item Factura</u></h4></center>
                        <table border="0" align="center"
                        <tr><td><br></td></tr>
                              <tr>
                                        <td><b>Nro_Cuenta:</b> </td>
                                        <td><input type="text" name="codcomp" value="" size="10" mexlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codcomp">
                                </tr>
                                <tr>
                                        <td><b>Descripción:</td>
                                        <td><input type="text" name="concepto" value="" size="40" mexlength="40" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="concepto">
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
                                $consulta="select * from listado where codcomp='$codcomp'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                                $registros=mysql_num_rows($resultado);
                                if ($registros==0)
                                {
                                      $concepto=strtoupper($concepto);
                                        $consulta="insert into listado (codcomp,concepto)
                                                        value('$codcomp','$concepto')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");

                ?>

                                        <script language="javascript">
                                                alert("Registro Almacenado Correctamente")
                                               open("agregar.php","_self")
                                        </script>
                <?
                                }
                                else
                                {
                ?>

                                        <script language="javascript">
                                                alert("El Registro ya Existe")
                                               open("agregar.php","_self")
                                        </script>
                 <?
                                }
                        }
                 ?>
        </body>
</html>
