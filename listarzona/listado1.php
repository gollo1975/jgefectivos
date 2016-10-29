<html>
        <head>
                <title>Listado de Zonas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Consulta de Zona </h4></center>
                  <form action="" method="post">
                        <table border="0" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="codigo">Cod_Zona
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
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,sso_sucursal.nombre from sucursal,zona,sso_sucursal
                               where sucursal.codsucursal=zona.codsucursal and sso_sucursal.codigo_sucursal_pk=zona.codigo_sso_sucursal_fk and zona.estado='ACTIVA' order by zona.zona";
                }
                elseif ($campo=='codigo')
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,sso_sucursal.nombre from sso_sucursal,sucursal,zona where
						sucursal.codsucursal=zona.codsucursal and 
						sso_sucursal.codigo_sucursal_pk=zona.codigo_sso_sucursal_fk and
						zona.codzona = '$valor'";
                }
                else
                {
                        $consulta="select zona.codzona,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,sso_sucursal.nombre from sso_sucursal,sucursal,zona where
						sucursal.codsucursal=zona.codsucursal and 
						sso_sucursal.codigo_sucursal_pk=zona.codigo_sso_sucursal_fk and
						zona.zona like '%$valor%'";
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
                         
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                <td>&nbsp;</td>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
												<th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                </tr>
                                <tr>
                                        <th>&nbsp;</th>
                                        <td><b>Cód_Zona</b></td>
                                        <td><b>Zona</b></td>
                                        <td><b>Dirección</td>
                                        <td><b>Teléfono</b></td>
                                        <td><b>Nit_Zona</b></td>
										 <td><b>Sucursal_Pila</b></td>
                                </tr>
        <?             $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><? echo $i;?></th>
                                         <td>&nbsp;<a href="modificacion1.php?cod=<?echo $filas["codzona"];?>"><?echo $filas["codzona"];?></a></td>
                                        <td>&nbsp;<?echo $filas["zona"];?></td>
                                        <td>&nbsp;<?echo $filas["dirzona"];?></td>
                                        <td>&nbsp;<?echo $filas["telzona"];?></td>
                                        <td>&nbsp;<?echo $filas["nitzona"];?></td>
										<td>&nbsp;<?echo $filas["nombre"];?></td>

                                </tr>
        <?
                     $i=$i+1;
                        }
                }


?>
                        </table>


        </body>
</html>
