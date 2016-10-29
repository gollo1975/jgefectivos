<html>
        <head>
                <title>Listado de Zonas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Configuracion de Zonas</u></h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
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
                        $consulta="select parametroexamenzona.* from parametroexamenzona order by zona ASC ";
                }else{
                       $consulta="select parametroexamenzona.* from parametroexamenzona where zona like '%$valor%' order by zona ASC";
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
                           <center><h4>Listado de Zonas</h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>


                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <td><b>CodZona</b></td>
                                        <td><b>Zona</td>
                                    </tr>
        <?
        $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {
                         $valor=number_format($filas["valor"],0)
        ?>
                                <tr class="cajas">
                                        <th><?echo $i;?></th>
                                         <td><a href="EditarParametro.php?IdZona=<?echo $filas["codzona"];?>"><?echo $filas["codzona"];?></a></td>
                                         <td><?echo $filas["zona"];?></td>
                                </tr>
        <?
                       $i=$i+1;
                        }
                }


?>
                        </table>
                        

        </body>
</html>
