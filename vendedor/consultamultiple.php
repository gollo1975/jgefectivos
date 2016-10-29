<html>
        <head>
                <title>Consulta de Vendedores</title>
                <link rel="stylesheet" href="../estilo.css" type="text/css">
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                       <center><h4>Consulta de Vendedores</h4></center>
                       <form action="" method="post">
                                <table border="0" align="center">
                                        <tr>
                                                <td colspan="8"></td>
                                        </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td><b>Campo de Consulta</b></td>
                                                <td><b>Valor de Consulta</b></td>
                                        </tr>
                                        <tr>
                                                <td>    <select name="campo" class="cajas">
                                                                <option value="0">Seleccione una Opción
                                                                <option value="nitprove">Nit
                                                                <option value="provedor">Nombre
                                                                <option value="dirprove">Direccion
                                                                <option value="telprove">Telefono
                                                                <option value="muniprove">Municipio
                                                  </select></td>
                                                <td><input type="text" name="valor" value="" size="40" maxleng="40"></td>
                                                <tr><td><br></td></tr>
                                        </tr>
                                        <tr class="fondo">
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
                                alert("Seleccione un Item")
                                history.back()
                        </script>
                   <?
                }
                else
                {
                        include("../dbconexion.php");
                        if ($campo=='nitprove' or $campo=='telprove')
                        {
                                $consulta="select provedor.nitprove,provedor.dvprove,provedor.provedor,provedor.dirprove,provedor.telprove,provedor.fax,provedor.cta,provedor.muniprove from provedor,matricula where
                                        provedor.nit=matricula.nit and provedor.$campo='$valor'";
                        }
                        else
                        {
                                $consulta="select provedor.nitprove,provedor.dvprove,provedor.provedor,provedor.dirprove,provedor.telprove,provedor.fax,provedor.cta,provedor.muniprove from provedor,matricula where
                                        provedor.nit=matricula.nit and provedor.$campo like '%$valor%'";
                        }
                        $resultado=mysql_query($consulta) or die("consulta incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==0)
                        {
        ?>

                        <script language="javascript">
                                alert("No Existen Registros en la Busqueda")
                                history.back()
                        </script>
        <?
                        }
                        else
                        {
        ?>

                                         <center><h4>Datos Del Proveedor<h4></center>
                                          <table border="0" align="center">
                                            <tr><td class="cajas">Para ver las Facturas pagadas, Presione Click en el Campo [Nit/Cedula]</td></tr>
                                          </table>
                                          <table border="0" align="center">
                                        <tr>
                                                <td colspan="12"></td>
                                        </tr>
                                        <tr class="cajas">
                                           <th>Nit/Cédula</th>
                                           <th>Dv</th>
                                           <th>Proveedor</th>
                                           <th>Direccion</th>
                                           <th>Telefono</th>
                                           <th>Fax</th>
                                           <th>Municipio</th>
                                           <th>Cuenta</th>
                                        </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr class="cajas">
                                                  <td><a href="detallado.php?nit=<?echo $filas["nitprove"];?>"><?echo $filas["nitprove"];?></a></td>
                                                  <td><?echo $filas["dvprove"];?></td>
                                                  <td><?echo $filas["provedor"];?>&nbsp;</td>
                                                  <td><?echo $filas["dirprove"];?>&nbsp;</td>
                                                  <td><?echo $filas["telprove"];?></td>
                                                  <td><?echo $filas["faxprove"];?></td>
                                                  <td>&nbsp;<?echo $filas["muniprove"];?></td>
                                                  <td><?echo $filas["cta"];?></td>

                                        </tr>
        <?
                                }
                        }
                }
        ?>
         </table>
        </body>
</html>
