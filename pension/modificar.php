<html>
        <head>
                <title>Modificacion de Pension</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
        </head>
        <body>
       <?
                        include("../conexion.php");
                        $consulta="select * from pension where codpension='$cod'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        while ($filas=mysql_fetch_array($resultado)):
        ?>
                                        <center><h4>Datos a Modificar</h4></center>
                                        <form action="guardar.php" method="post">
                                                <table border="0" align="center">
                                                        <tr>
                                                                <td colspan="2"><br></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Codigo</b></td>
                                                                <td><input type="text" name="codpension" value="<?echo $cod;?>" class="cajas" size="3" readonly></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Pension</b></td>
                                                                <td><input type="text" name="pension" value="<?echo $filas["pension"];?>" class="cajas" size="40" maxlength="40"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Direccion</b></td>
                                                                <td><input type="text" name="dirpension" value="<?echo $filas["dirpension"];?>"class="cajas"  size="40" maxlength="40"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Telefono</b></td>
                                                                <td><input type="text" name="telpension" value="<?echo $filas["telpension"];?>"class="cajas" size="10" maxlength="7"></td>
                                                        </tr>
                                                        <tr>
                                                                <td><b>Municipio</b></td>
                                                                <td><input type="text" name="munpension" value="<?echo $filas["munpension"];?>" class="cajas" size="40" maxlength="30"></td>
                                                        </tr>
                                                        <tr><td><br></td></tr>
                                                        <tr>
                                                                  <td colspan="2"><input type="submit" value="Guardar" class="boton"></td>
                                                        </tr>
        <?
                               endwhile;
   ?>
                                </form>
                </table>
        </body>
</html>
