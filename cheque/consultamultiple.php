<html>
        <head>
                <title>Consulta de Facturas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($campo))
                {

        ?>
                       <center><h4>Consulta de Facturas a Tercero</h4></center>
                       <form action="" method="post">
                                <table border="0" align="center">
                                        <tr>
                                                <td colspan="8"></td>
                                        </tr>
                                        <tr>
                                                <td><center><b>Campo de Consulta</b></center></td>
                                                <td><center><b>Valor de Consulta</b></center></td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo">
                                                                <option value="0">Seleccione una Opción
                                                                <option value="nitprove">Nit
                                                                <option value="nomprove">Proveedor
                                                                <option value="telprove">Telefono
                                                                                                                      </select></td>
                                                <td><input type="text" name="valor" value="" size="40" maxleng="40"></td>
                                        </tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                                </table>

                        </form>
        <?
                }
                elseif (empty($valor))
                {
        ?>
                        <script language="javascript">
                                alert("Digite un Valor a Buscar")
                                history.back()
                        </script>
        <?
        }
                elseif (empty($campo))
                {
        ?>
                        <script language="javascript">
                                alert("Seleccione una Opcion de  La lista")
                                history.back()
                        </script>
        <?
                }
                else
                {
                        include("../conexion.php");
                        if ($campo=='nitprove' or $campo=='telprove')
                        {
                                $consulta="select provedor.*,sucursal.* from provedor,sucursal where
                                        provedor.codsucursal=sucursal.codsucursal and provedor.$campo='$valor'";
                        }
                        else
                        {
                                $consulta="select provedor.*,sucursal.* from provedor,sucursal where
                                        provedor.codsucursal=sucursal.codsucursal and provedor.$campo like '%$valor%'";
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

                                      <center><h4>Datos del Proveedor</h4></center>
                                      <table border="0" align="center">
                                        <tr class="cajas">
                                          <td>Para ver las facturas por Proveedor, Presione Click sobre el Nit del Proveedor ..</td>
                                        </tr>
                                      </table>
                                      <tr><td><br></td></tr>
                                      <table border="0" align="center">
                                        <tr class="fondo">
                                                <td colspan="12"></td>
                                        </tr>
                                        <tr class="cajas">
                                           <th>Nit</th>
                                           <th>Dv</th>
                                           <th>Proveedor</th>
                                           <th>Direccion</th>
                                           <th>Telefono</th>
                                           <th>Fax</th>
                                           <th>Municipio</th>
                                           <th>Fecha</th>
                                           <th>Sucursal</th>
                                        </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr class="cajas">
                                                  <td><a href="detallado.php?nitprove=<?echo $filas["nitprove"];?>"><?echo $filas["nitprove"];?></a></td>
                                                  <td><?echo $filas["dvprove"];?></td>
                                                  <td><?echo $filas["nomprove"];?></td>
                                                  <td><?echo $filas["dirprove"];?></td>
                                                  <td><?echo $filas["telprove"];?></td>
                                                  <td><?echo $filas["faxprove"];?></td>
                                                  <td><?echo $filas["munprove"];?></td>
                                                  <td><?echo $filas["fecha"];?></td>
                                                  <td><?echo $filas["sucursal"];?></td>

                                        </tr>
                                        <?
                                        $total=$total+1;

                                }
                             ?>
                             </table>
                             <tr><td>&nbsp;</td></tr>
                             <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $total?></td></center>
                             <?

                        }
                }
        ?>
         </table>
         </body>
</html>
