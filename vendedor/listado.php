<html>
        <head>
                <title>Listado de vendedores</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                       <form action="" method="post">
                                <table border="0" align="center">
                                        <tr>
                                                <th colspan="8">Datos de la Busqueda</th>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td><b>Campo de Consulta</b></td>
                                                <td><b>Valor de Consulta</b></td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo" class="cajas">
                                                                <option value="0">Seleccion La Busqueda
                                                                <option value="cedulaven">Documento
                                                                <option value="nombreven">Vendedor
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
                            $consulta="select vendedor.* from vendedor order by nombreven";
                        elseif($campo=='cedulaven'):
                                $consulta="select vendedor.* from vendedor where
                                       vendedor.cedulaven='$valor'";
                        elseif($campo=='nombreven'):
                             $consulta="select vendedor.* from vendedor where
                                     vendedor.nombreven like '%$valor%'";
                        else:
                           ?>
                             <script language="javascript">
                               alert("Debe de Seleccionar un Item de Busqueda ?")
                               open("listado.php","_self")
                             </script>
                           <?
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
                                       <tr>
                                                <th>Documento</th>
                                                <th>Nombre</th>
                                                <th>Dirección</th>
                                                <th>Teléfono</th>
                                                <th>Celular</th>

                                        </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado)):
        ?>
                                        <tr class="cajas">
                                                <td><?echo $filas["cedulaven"];?></td>
                                                <td><?echo $filas["nombreven"];?></td>
                                                <td><?echo $filas["dirven"];?></td>
                                                <td><?echo $filas["teven"];?></td>
                                                <td><?echo $filas["celular"];?></td>

                                        </tr>
        <?
                                endwhile;
                        endif;
                 ?>
                        </table>
                        <tr><td><br></td></tr>
                        <tr>
                          <center><td><a href="listado.php"><b>Actualizar</b></a></td></center>
                        </tr>

        </body>
</html>
