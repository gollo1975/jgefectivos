<html>
        <head>
                <title>Listado de Municipios</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                       <form action="" method="post">
                                <table border="0" align="center">
                                        <tr>
                                                <th colspan="8">Datos a Modificar</th>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td><b>Campo de Consulta</b></td>
                                                <td><b>Valor de Consulta</b></td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo" class="cajas">
                                                                <option value="0">Seleccion el Dato
                                                                <option value="codmuni">Cod_Municipio
                                                                <option value="municipio">Municipio
                                                </select></td>
                                                <td><input type="text" name="valor" value="" size="40" maxleng="40"></td>
                                        </tr>
                                        <tr>
                                                <th colspan="2"><input type="submit" Value="Buscar">&nbsp;<input type="reset" Value="Limpiar"></th>
                                        </tr>
                                </table>
                        </form>
                      <?
                        include("../conexion.php");
                        if (empty($valor)):
                            $consulta="select departamento.departamento,municipio.* from departamento,municipio where departamento.codepart=municipio.codepart order by departamento.departamento,municipio.municipio";
                        elseif($campo=='codmuni'):
                                $consulta="select municipio.*,departamento.departamento from municipio,departamento where
                                        municipio.codepart=departamento.codepart and municipio.$campo='$valor'";
                        else:
                             $consulta="select municipio.*,departamento.departamento from municipio,departamento where
                                     municipio.codepart=departamento.codepart and municipio.$campo like '%$valor%'";
                        endif;
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0):
        ?>

                        <script language="javascript">
                                alert("No Existen Registros en la busqueda")
                                history.back()
                        </script>
        <?
                        else:
        ?>
                             <table border="0" align="center">
                               <td class="cajas"><b>Para Mofidicar el Municipio, Presione Click en el campo Cod_Municipio..</b>
                             </table>
                               <table border="0" align="center">
                                       <tr>
                                       <th>Item</th>
                                                <th>Cod_Municipio</th>
                                                <th>Municipio</th>
                                                <th>&nbsp;Departamento</th>

                                        </tr>
        <?                                 $a=1;
                                while ($filas=mysql_fetch_array($resultado)):
        ?>
                                        <tr class="cajas">
                                              <th><?echo $a;?></th>
                                                <td><a href="modificar.php?codmuni=<? echo $filas["codmuni"];?>"><?echo $filas["codmuni"];?></a></td>
                                                  <td><?echo $filas["municipio"];?></td>
                                                  <td>&nbsp;<?echo $filas["departamento"];?></td>
                                        </tr>
        <?                                      $a=$a+1;
                                endwhile;
                        endif;
                 ?>
                        </table>
                        <tr><td><br></td></tr>
                        <tr>
                          <center><td><a href="listado.php"><b><h4><u><font color="blue">Actualizar</font></u></h4></b></a></td></center>
                        </tr>

        </body>
</html>
