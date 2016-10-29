<html>
        <head>
                <title>Listado de Observaciones</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Observaciones</u></h4></center>

        <?
                include("../conexion.php");
                $consulta="select observacion.*,sucursal.sucursal from observacion,sucursal where sucursal.codsucursal=observacion.codsucursal ";
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                $registros=mysql_affected_rows();
                                  ?>
                            <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>

                                <tr>
                                        <th><b>Número</b></th>
                                         <th><b>Observación</b></th>
                                         <th><b>Sucursal</b></th>
                                  </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <td><div align="center">&nbsp;<a href="detallado.php?codigo=<?echo $filas["numero"];?>"><?echo $filas["numero"];?></div></td>
                                        <td>&nbsp;<?echo $filas["descripcion"];?></td>
                                        <td>&nbsp;<?echo $filas["sucursal"];?></td>

                                </tr>
        <?
                        }



?>
                        </table>
                        <tr><td><br></td></tr>

                        </body>
</html>
