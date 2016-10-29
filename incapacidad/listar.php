<html>
        <head>
                <title>Códigos de Diagnóstico</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select control.codigo,control.concepto from control";
                $resultado=mysql_query($consulta) or die("error en la bsuqueda de codigos");
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
                       <center><h4>Códigos de Diagnóstico</h4></center>
                       <table border="1" align="center">
                                <tr>
                                        <td colspan="9"></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <th>Código</th>
                                        <th>Diagnóstico</th>
                                </tr>
        <?
                         $i=1;
                        while ($filas=mysql_fetch_array($resultado)):

        ?>
                                <tr class="cajas">
                                        <th><?echo $i;?></th>
                                        <td><?echo $filas["codigo"];?></td>
                                        <td><?echo $filas["concepto"];?></td>
                                </tr>
        <?
                                                 $i=$i+1;
                        endwhile;
                }
        ?>
                        </table>

        </body>
</html>
