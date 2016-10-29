<html>
        <head>
                <title>Listado de Eps</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Eps</u></h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="nit">Nit_Eps
                                                        <option value="eps">Eps
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
                        $consulta="select eps.*,municipio.municipio from eps,municipio where municipio.codmuni=eps.codmuni ";
                }
                elseif ($campo=='nit')
                {
                        $consulta="select eps.*,municipio.municipio from eps,municipio where municipio.codmuni=eps.codmuni and eps.codeps = '$valor'";
                }
                else
                {
                        $consulta="select eps.*,municipio.municipio from eps,municipio where municipio.codmuni=eps.codmuni and eps.eps like '%$valor%'";
                }
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                if ($registros==0)
                {
        ?>
                   <script language="javascript">
                                alert("No Existen Registros En el Sistema")
                                history.back()
                  </script>
        <?
                }
                else
                {
        ?>
                           <center><h4><u>Listado..</u></h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <th>Cód_Eps</td>
                                        <th>Nit</td>
                                        <th>Eps</td>
                                        <th>Teléfono</td>
                                        <th>Dirección</td>
                                        <th>Municipio</td>
                                </tr>
        <?
                         $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th>&nbsp;<?echo $i;?></th>
                                         <td>&nbsp;<a href="modificar.php?cod=<?echo $filas["codeps"];?>"><?echo $filas["codeps"];?></a></td>
                                         <td>&nbsp;<?echo $filas["nit"];?></td>
                                        <td>&nbsp;<?echo $filas["eps"];?></td>
                                        <td>&nbsp;<?echo $filas["teleps"];?></td>
                                        <td>&nbsp;<?echo $filas["direps"];?></td>
                                        <td>&nbsp;<?echo $filas["municipio"];?></td>
                                </tr>
        <?
                          $i=$i+1;
                           }
                }


?>
                        </table>
                        <td><div align="center"><a href="listado.php"><u><font color="blue"><h4>Actualizar</h4></font></u></a></div></td>
                        

        </body>
</html>
