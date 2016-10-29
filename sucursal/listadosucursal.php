<html>
        <head>
                <title>Listado de Sucursales</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Modificar Datos</u></h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="codigo">Cod_Sucursal
                                                        <option value="zona">Sucursal
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
                        $consulta="select sucursal.codsucursal,sucursal.sucursal,sucursal.dirsucursal,sucursal.telsucursal from sucursal,maestro,departamento where maestro.codmaestro=sucursal.codmaestro and sucursal.codepart=departamento.codepart";
                }
                elseif ($campo=='codigo')
                {
                        $consulta="select sucursal.codsucursal,sucursal.sucursal,sucursal.dirsucursal,sucursal.telsucursal from sucursal,maestro,departamento where maestro.codmaestro=sucursal.codmaestro and sucursal.codepart=departamento.codepart and sucursal.codsucursal = '$valor'";
                }
                else
                {
                        $consulta="select sucursal.codsucursal,sucursal.sucursal,sucursal.dirsucursal,sucursal.telsucursal from sucursal,maestro,departamento where maestro.codmaestro=sucursal.codmaestro and sucursal.codepart=departamento.codepart and sucursal.sucursal like '%$valor%'";
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
                           <table border="0" align="center">
                             <tr class="cajas">
                                <td>Presione Click Sobre el Cod_Sucursal, Para modificar el registro</td>
                             </tr>
                           </table>

                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <th>Cód_Sucursal</th>
                                        <th><b>Sucursal</b></th>
                                        <th><b>Dirección</th>
                                        <th><b>Teléfono</b></th>
                                        </tr>
        <?
                      $a=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $a;?></th>
                                         <td><div align="center"><a href="modificar.php?cod=<?echo $filas["codsucursal"];?>"><?echo $filas["codsucursal"];?></div></a></td>
                                        <td><?echo $filas["sucursal"];?></td>
                                        <td><?echo $filas["dirsucursal"];?></td>
                                        <td><?echo $filas["telsucursal"];?></td>

                                </tr>
        <?     $a=$a+1;
                        }
                }


?>
                        </table>
                        <div align="center"><td><a href="listadosucursal.php"><h5><font color="blue"><u>Actualizar</u></font></h5></a></td></div>
                        

        </body>
</html>
