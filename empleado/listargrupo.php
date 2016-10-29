<html>
        <head>
                <title>Listado de grupo</title>
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
                    if (document.getElementById("descripcion").value.length <=0)
                        {
                            alert ("El campo descripción no puede estar vacío ?");
                            document.getElementById("descripcion").focus();
                            return;
                        }
                        document.getElementById("matservicio").submit();

                    }
                </script>
        </head>
        <body>
                <?
                if (!isset($descripcion)):
                   include("../conexion.php");
                   ?>
                   <center><h4><u>Grupo de Requisitos</u></h4></center>
                   <form action="" method="post" id="matservicio">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"><br></td>
                                </tr>
                                <tr>
                                        <td><b>Descripción:</b></td>
                                        <td><input type="text" name="descripcion" value="" size="40" mexlength="40"onfocus="ColorFoco(this.id)" class="cajas" onblur="QuitarFoco(this.id)" id="descripcion">
                                </tr>
                               <tr><td><br></td></tr>
                  <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                        </tr>
                        </table>

                </form>
                    <?
                 else:
                    include("../conexion.php");
                    $descripcion=strtoupper($descripcion);
                     $consulta="insert into itemrequisito (descripcion)
                                value('$descripcion')";
                     $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                      ?>

                                        <script language="javascript">
                                                alert("Registro Almacenado Correctamente")
                                             open("listargrupo.php","_self");
                                        </script>
                <?
                 endif;
                 ?>
        </body>
</html>
