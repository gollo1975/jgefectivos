<html>
        <head>
                <title>Listado de Fondo de Pensión</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Listado de Fondo de Pensión</h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="codigo">Cod_Pension
                                                        <option value="nombre">Fondo_Pension
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
                        $consulta="select pension.* from pension ";
                }
                elseif ($campo=='codigo')
                {
                        $consulta="select pension.* from pension where pension.codpension = '$valor'";
                }
                else
                {
                        $consulta="select pension.* from pension where pension.pension like '%$valor%'";
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
                           <center><h4>Listado de Fondos</h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <td><a href="listado.php">Actualizar</a></td>

                                </tr>
                                <tr>
                                        <th>&nbsp;</th>
                                        <td><b>Cód_Pensión</b></td>
                                        <td><b>Fondo</b></td>
                                        <td><b>Teléfono</td>
                                        <td><b>Municipio</b></td>
                                </tr>
        <?
                         $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th>&nbsp;<?echo $i;?></th>
                                         <td>&nbsp;<a href="modificar.php?cod=<?echo $filas["codpension"];?>"><?echo $filas["codpension"];?></a></td>
                                        <td>&nbsp;<?echo $filas["pension"];?></td>
                                        <td>&nbsp;<?echo $filas["telpension"];?></td>
                                        <td>&nbsp;<?echo $filas["munpension"];?></td>
                                </tr>
        <?
                          $i=$i+1;
                           }
                }


?>
                        </table>
                        

        </body>
</html>
