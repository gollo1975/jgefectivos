    <html>
        <head>
                <title>Modificar talla</title>
                <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($cedemple))
                {
        ?>
                          <center><h4><u>Modificar Datos</u></h4></center>
                           <form action="" method="post">
                                <table border="0" align="center">
                                  <tr><td><br></td></tr> 
                                 <tr>
                                                <td><b>Digite el Documento:</b></td>
                                                <td><input type="text" name="cedemple" value="" size="15" maxleng="15"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                        </tr>
                                </table>
                                  
                        </form>
        <?
                }
                elseif (empty($cedemple))
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
                        $consulta="select talla.* from talla
                          where talla.cedemple='$cedemple'";
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No Existen Registros para este documento")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                             <center><h4><u>Modificar Datos</u></h4></center>
                                             <form action="grabartallamodificada.php" method="post">
                                                <table border="0" align="center">
                                                         <tr><td><br></td></tr>
                                                        <tr>
                                                                        <td><b>Cedula:</b> </td>
                                                                        <td><input type="text" name="cedula" value="<?echo $filas["cedemple"];?>" size="10" readonly></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Nombre:</b></td>
                                                                        <td><input type="text" name="nombre" value="<?echo $filas["nombre"];?>" size="50" class="cajas"readonly></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Camisa:</b></td>
                                                                        <td><input type="text" name="camisa" value="<?echo $filas["camisa"];?>" size="5" class="cajas"maxlength="5"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Pantalón:</b></td>
                                                                        <td><input type="text" name="pantalon" value="<?echo $filas["pantalon"];?>" size="5"class="cajas" maxlength="5"></td>
                                                                </tr>
                                                                <tr>
                                                                        <td><b>Zapato:</b></td>
                                                                        <td><input type="text" name="zapato" value="<?echo $filas["zapato"];?>" size="5" class="cajas"maxlength="5"></td>
                                                                </tr>

                                                                <tr><td><br></td></tr>
                                                                <tr>
                                                                        <td colspan="2"><input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></th>
                                                                </tr>
                                                                 <tr><td><br></td></tr>
                                                           </table>
                                                    </form>
        <?
                                }
                        }
                }
        ?>

        </body>
</html>
