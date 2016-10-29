<html>
        <head>
                <title>Agregar Item al Crédito</title>
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
                            alert ("Digite el codigo para matricular los creditos");
                            document.getElementById("codigo").focus();
                            return;
                        }
                       if (document.getElementById("descripcion").value.length <=0)
                        {
                            alert ("El campo Descripción no puede estar vacío");
                            document.getElementById("descripcion").focus();
                            return;
                        }
                          document.getElementById("matitcre").submit();
                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($descripcion))
                        {
                                include("../conexion.php");
                ?>
                <center><h4><u>Agregar Item</u></h4></center>
                <form action="" method="post" id="matitcre">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"><br></td>
                                </tr>
                                <tr>
                                        <td><b>Código:</b></td>
                                        <td><input type="text" name="codigo" value="" size="10" mexlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codigo">
                                </tr>
                                 <tr>
                                        <td><b>Descripcion</b></td>
                                        <td><input type="text" name="descripcion" value="" size="40" mexlength="30" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="descripcion">
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
                               $descripcion=strtoupper($descripcion);
                                  $consulta = "select tipo.tipocre from tipo where tipo.tipocre='$codigo'";
                                  $result = mysql_query ($consulta)or die ("Error al buscar el indice");
                                  $reg = mysql_fetch_row($result);
                                  if($reg==0):
                                     $consulta="insert into tipo (tipocre,descripcion)
                                        value('$codigo','$descripcion')";
                                     $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                     $reg=mysql_affected_rows();
                                   ?>
                                    <script language="javascript">
                                         alert("El Dato fue ingresado con exito en el sistema?") 
                                          open("agregar.php","_self");
                                        </script>
                                   <?else:?>
                                      <script language="javascript">
                                          alert("El Dato ya existe en sistema")
                                          history.back()
                                        </script>
                <?
                                   endif;
                        }
                 ?>
        </body>
</html>
