<html>
        <head>
                <title>Modificacion de Servicio</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($codservi))
                {
        ?>
                        <center><h4>Modificación de servicio</h4></center>
                        <form action="" method="post">
                                <table border="0" align="center">
                                        <tr>
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td><b>Cod_Servicio:</b></td>
                                                <td><input type="text" name="codservi" value="" size="10" maxleng="10"></td>
                                        </tr>
                                           <tr>
                                                <td colspan="2"><br></td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton"></th>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (empty($codservi))
                {
        ?>
                        <script language="javascript">
                                alert("Digite un Valor a Buscar")
                                history.back()
                        </script>
        <?
                }
                else
                {
                        include("../conexion.php");
                        $consulta="select * from servicio where codservi='$codservi'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros en la Busqueda")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>                              <center><h3>Datos a Modificar</h3></center>
                                        <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"><br></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Cod_Servicio:</b></td>
                                                                <td><input type="text" name="codservi" value="<?echo $filas["codservi"];?>"class="cajas" readonly></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Descripcion:</b></td>
                                                                <td><input type="text" name="descripcion" value="<?echo $filas["descripcion"];?>" class="cajas"size="40" maxlength="40"></td>
                                                        </tr>
                                                       <tr>
                                                                  <td colspan="2"><input type="submit" value="Guardar" class="boton"></td>
                                                        </tr>
        <?
                                }
                        }
                }
        ?>
                                </form>
                </table>
        </body>
</html>
