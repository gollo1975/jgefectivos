<html>
        <head>
                <title>Codigos de Salarios</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from parametro order by codigo";
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
                       <center><h4><u>Listado de Parámetros</u></h4></center>
                       <table border="1" align="center">
                                <tr>
                                        <td colspan="9"></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <th>Codigo</th>
                                        <th>Cocepto</th>
                                        <th>Nivel</th>
                                        <th>Estado</th>

                                </tr>
        <? $a=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $a;?></th>
                                        <td><a href="ModificarP.php?Codigo=<?echo $filas["codigo"];?>"><?echo $filas["codigo"];?></a></td>                                     
                                        <td><?echo $filas["concepto"];?></td>
                                        <td><?echo $filas["nivel"];?></td>
                                        <td><?echo $filas["estado"];?></td>
                                </tr>
        <? $a=$a+1;
                        }
                }
        ?>
                        </table>

        </body>
</html>
