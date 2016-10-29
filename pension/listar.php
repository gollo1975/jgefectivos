<html>
        <head>
                <title>Listado de Pensión</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from pension order by pension";
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
                      <center><h4>Listado de Fondos</h4></center>
                      <table border="0"align="center">
                       <tr class="cajas">
                         <td>Para Ver los Empleados por Fondo de Pensión, Presione Click sobre el Cod_Pensión...</td>
                       </tr>
                      </table>
                        <table border="0" align="center">
                                <tr>
                                        <td colspan="9"></td>
                                </tr>
                                <tr class="cajas">
                                        <th>Cod_Pensión</th>
                                        <th>Fondo</th>
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>Municipio</th>
                                </tr>
        <?
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <td><a href="maestropension.php?campo=<?echo $filas["codpension"];?>"><?echo $filas["codpension"];?></td>
                                        <td><?echo $filas["pension"];?></td>
                                        <td><?echo $filas["dirpension"];?></td>
                                        <td><?echo $filas["telpension"];?></td>
                                        <td><?echo $filas["munpension"];?></td>
                                </tr>
        <?
                        }
                }
        ?>
                        </table>

        </body>
</html>
