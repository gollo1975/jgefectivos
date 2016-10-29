<html>
        <head>
                <title>Agregar Observacion</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                 <script type="text/javascript">
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
                        if (document.getElementById("Observacion").value.length <=0)
                        {
                            alert ("Digite la observacion de la sucursal.");
                            document.getElementById("Observacion").focus();
                            return;
                        }

                         document.getElementById("matsala").submit();

                    }
                </script>
        </head>
        <body>
                <?
                        if (!isset($Observacion)):
                                include("../conexion.php");
                ?>
                <center><h4><u>Crear Observación</u></h4></center>
                <form action="" method="post"id="matsala">
                        <table border="0" align="center"
                           <tr>
                            <td><b>Observación:</b></td>
                            <td><textarea name="Observacion" cols="65" rows="5" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Observacion"></textarea></td>
                          </tr>
                          <tr>
                             <td><b>Sucursal:</b></td>
                                <td><select name="Sucursal" class="cajas" >
                                <option value="0">Seleccione la Sucursal
                                    <?
                                    include("../conexion.php");
                                     $consulta="select sucursal.codsucursal,sucursal.sucursal from sucursal where sucursal.estado='ACTIVA' order by sucursal";
                                     $resultado=mysql_query($consulta) or die("Error en la busqueda de sucursales");
                                      while ($filas=mysql_fetch_array($resultado)):
                                          ?>
                                          <option value="<?echo $filas["codsucursal"];?>"><?echo $filas["sucursal"];?>
                                          <?
                                      endwhile;
                                     ?>
                                </select></td>
                          </tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar"class="boton"></td>
                                        </tr>

                        </table>
             
                </form>
                      <?
                        elseif(empty($Sucursal)):
                           ?>
                            <script language="javascript">
                               alert("Seleccione la sucursal de la lista!")
                               history.back()
                            </script>
                           <?
                        else:

                                include("../conexion.php");
                                $conB="select observacion.codsucursal from observacion
				where observacion.codsucursal='$Sucursal'";
				$resulB=mysql_query($conB) or die("Error al busca procesos");
				$filas=mysql_fetch_array($resulB);
				$regB=mysql_num_rows($resulB);
				if($regB==0):
                                        $consulta="insert into observacion (descripcion,codsucursal)
                                                        value('$Observacion','$Sucursal')";
                                        $resultado=mysql_query($consulta) or die("Insercion incorrecta");
                                         $re=mysql_affected_rows();
                                         echo "<script language=\"javascript\">";
                                        echo "open (\"../pie.php?msg=Se Grabo registros de la sucursal  Nro: $Sucursal\",\"pie\");";
                                              echo "open(\"agregar.php\",\"_self\");";
                                        echo "</script>";
                                else:
                                     ?>
	                            <script language="javascript">
	                               alert("Esta sucursal ya tiene la observacion!")
	                               history.back()
	                            </script>
	                           <?
                                endif;
                        endif;
                 ?>
        </body>
</html>
