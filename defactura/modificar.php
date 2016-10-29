<html>
        <head>
                <title>Modificar datos</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($codcomp))
                {
        ?>
                        <form action="" method="post">
                         <center><h4><u>Modificar Datos</u></h4></center>
                                <table border="0" align="center">
                                <tr><td><br></td></tr>
                                        <tr>
                                                <td><b>Ingrese el Item:</b></td>
                                                <td><input type="text" name="codcomp" value="" size="10" maxleng="10"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton"></td>
                                        </tr>
                                </table>
                        </form>
        <?
                }
                elseif (empty($codcomp))
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
                        $consulta="select * from listado where codcomp='$codcomp'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <form action="guardar.php" method="post">
                                        <center><h4><u>Datos a Modificar</u></h4></center>
                                                <table border="0" align="center">
                                                <tr><td><br></td></tr>  
                                                        <tr>
                                                                <td><b>Cód_Cuenta</b></td>
                                                                <td><input type="text" name="codcomp" value="<?echo $filas["codcomp"];?>" readonly size="10" class="cajas"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Descripción:<b></td>
                                                                <td><input type="text" name="concepto" value="<?echo $filas["concepto"];?>" class="cajas"size="40" maxlength="40" class="cajas"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
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
