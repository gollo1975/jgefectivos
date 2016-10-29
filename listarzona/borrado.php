
<html>
        <head>
                <title>Eliminacion</title>
        </head>
        <body>
        <?
                if(!isset($codigo))
                {
                        include("conexion.php");
                        $consulta="select ciudad.codigo,ciudad.ciudad,departamento.departamento from ciudad,departamento where ciudad.codigodepartamento=departamento.codigo  and ciudad.codigo='$cod'";
                        $resultado=mysql_query($consulta) or die ("Consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No existe el registro")
                                        history.back()
                                </script>
        <?
                        }
                        else
                        {
        ?>
                                <form action="" method="post">
                                        <table border="1" align="center">
                                                <tr>
                                                        <td>Codigo</td>
                                                        <td>Ciudad</td>
                                                        <td>Departamento</td>
                                                </tr>
        <?
                                while($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                                <tr>
                                                        <td><?echo $filas["codigo"];?></td>
                                                        <td><?echo $filas["ciudad"];?></td>
                                                        <td><?echo $filas["departamento"];?></td>
                                                </tr>
                                                <tr>
                                                        <th colspan="3">
                                                                <input type="hidden" name="codigo" value="<?echo $filas["codigo"];?>">
                                                                <input type="submit" value="Eliminar">
                                                        </th>
                                                </tr>
        <?
                                }
                        }
        ?>
                                        </table>
                                </form>
        <?
                }
                else
                {
                        include("conexion.php");
                        $consulta="delete from ciudad where codigo='$codigo'";
                        $resultado=mysql_query($consulta)or die ("Eliminacion incorrecta");
                        $registros=mysql_affected_rows();
                        if ($registros==0)
                        {
        ?>
                                <script language="javascript">
                                        alert("No se le elimino el registro")
                                        history.go(-2)
                                </script>
        <?
                        }
                        else
                        {
        ?>
                                <script language="javascript">
                                        alert("El registro se elimino correctamente")
                                        history.go(-2)
                                </script>
        <?
                        }
                }
        
?>

</body>
</html>
