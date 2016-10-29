<html>
        <head>
                <title>Listado de Zonas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Zona por Filtro</u></h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="codigo">Cod_Zona
                                                        <option value="zona">Zona
                                                </select></td>
                                        <td><input type="text" name="valor" value="" size="40" maxlength="40"></td>
                                </tr>
                                <tr>
                                        <td colspan="2"><input type="submit" value="Buscar" class="boton"><input type="reset" value="Limpiar"class="boton"></th>
                                </tr>
                        </table>
                </form>
        <?

                include("../conexion.php");
                if (empty($valor))
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona from sucursal,zona
                        where sucursal.codsucursal=zona.codsucursal and
                        zona.estado='ACTIVA' order by zona.zona";
                }
                elseif ($campo=='codigo')
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona from sucursal,zona where sucursal.codsucursal=zona.codsucursal and zona.codzona = '$valor' order by zona.zona";
                }
                else
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona from sucursal,zona where sucursal.codsucursal=zona.codsucursal and zona.zona like '%$valor%' order by zona.zona";
                }
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
        ?>
                            <td><h4><div align="center"><a href="listadodetallado.php"><font color="blue"><u>Actualizar</u></font></a></div></h4></td>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <th>Cód_Zona</th>
                                        <th>Zona</th>
                                        <th>Dirección</th>
                                        <th>Teléfono</th>
                                        <th>Nit_Zona</th>
                                </tr>
        <?
        $a=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $a;?></th>
                                         <td><a href="detallado.php?cod=<?echo $filas["codzona"];?>"><?echo $filas["codzona"];?></a></td>
                                        <td><?echo $filas["zona"];?></td>
                                        <td><?echo $filas["dirzona"];?></td>
                                        <td><?echo $filas["telzona"];?></td>
                                        <td><?echo $filas["nitzona"];?></td>

                                </tr>
        <?
                        $a=$a+1;
                        }
                }


?>
                        </table>
                        

        </body>
</html>
