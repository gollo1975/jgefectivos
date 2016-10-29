<html>
        <head>
                <title>Listado de Zonas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Consulta de Zona por Filtro</h4></center>
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
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,pnovedad.estado from sucursal,zona,pnovedad
                                   where  sucursal.codsucursal=zona.codsucursal and
                                         zona.codzona=pnovedad.codzona and
                                         pnovedad.estado='FALTA'";
                }
                elseif ($campo=='codigo')
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,pnovedad.estado from sucursal,zona,pnovedad
                               where sucursal.codsucursal=zona.codsucursal and
                                      pnovedad.zona=zona.codzona and
                                      pnovedad.estado='FALTA' and
                                      zona.codzona = '$valor'";
                }
                else
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,pnovedad.estado from sucursal,zona,pnovedad
                           where sucursal.codsucursal=zona.codsucursal and
                                 pnovedad.codzona=zona.codzona and
                                   pnovedad.estado='FALTA' and
                                zona.zona like '%$valor%'";
                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registro
                     ?>
                           <center><h4>Listado de Zona</h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                 <th>&nbsp;</th>
                                                <td><a href="listado.php">Actualizar</a></td>

                                </tr>
                                <tr>
                                         <td><b>Item</b></td>
                                        <td><b>Cód_Zona</b></td>
                                        <td><b>Zona</b></td>
                                        <td><b>Dirección</td>
                                        <td><b>Teléfono</b></td>
                                        <td><b>Nit_Zona</b></td>
                                        <td><b>Estado</b></td>
                                </tr>
        <?
                  $i=$i+1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                         <td>&nbsp;<?echo $i;?></td>
                                         <td>&nbsp;<a href="cerrarperiodo.php?codigo=<?echo $filas["codzona"];?>&zona=<? echo $filas["zona"];?>"><?echo $filas["codzona"];?></a></td>
                                        <td>&nbsp;<?echo $filas["zona"];?></td>
                                        <td>&nbsp;<?echo $filas["dirzona"];?></td>
                                        <td>&nbsp;<?echo $filas["telzona"];?></td>
                                        <td>&nbsp;<?echo $filas["nitzona"];?></td>
                                        <td>&nbsp;<?echo $filas["estado"];?></td>

                                </tr>
        <?
               $i=$i+1;
                        }


?>
                        </table>
                        

        </body>
</html>
