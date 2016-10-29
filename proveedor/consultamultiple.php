<html>
        <head>
                <title>Consulta de Proveedor</title>
                <link rel="stylesheet" href="../estilo.css" type="text/css">
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                       <center><h4>Consulta Proveedor</h4></center>
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
                                                <td>    <select name="campo">
                                                                <option value="0">Seleccione una Opción
                                                                <option value="nitprove">Nit
                                                                <option value="nomprove">Nombre
                                                                <option value="dirprove">Direccion
                                                                <option value="telprove">Telefono
                                                                <option value="faxprove">Fax
                                                                <option value="codmuni">Municipio
                                                                <option value="email">Email
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
                        include("../conexion.php");
                        if ($campo=='nitprove' or $campo=='telprove' or $campo=='faxprove')
                        {
                                $consulta="select provedor.nitprove,provedor.dvprove,provedor.nomprove,provedor.dirprove,provedor.telprove,provedor.faxprove,provedor.cuenta,provedor.banco as Bancos,provedor.tipoc,municipio.municipio,provedor.email 'emailp',sucursal.* from municipio,provedor,sucursal where
                                        provedor.codsucursal=sucursal.codsucursal and
                                        municipio.codmuni=provedor.codmuni and
                                         provedor.$campo='$valor'";
                        }
                        else
                        {
                                $consulta="select provedor.nitprove,provedor.dvprove,provedor.nomprove,provedor.dirprove,provedor.telprove,provedor.faxprove,provedor.cuenta,provedor.tipoc,provedor.banco as Bancos,municipio.municipio,provedor.email 'emailp',sucursal.* from municipio,provedor,sucursal where
                                        provedor.codsucursal=sucursal.codsucursal and
                                        municipio.codmuni=provedor.codmuni and
                                        provedor.$campo like '%$valor%'";
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

                                         <center><h4>Datos Del Proveedor<h4></center>
                                          <table border="0" align="center">
                                        <tr>
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
                                           <th>Cuenta</th>
                                           <th>Tipo Cta</th>
                                           <th>Banco</th>
                                           <th>Email</th>
                                           <th>Sucursal</th>
                                        </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr class="cajas">
                                                  <td><?echo $filas["nitprove"];?></td>
                                                  <td><?echo $filas["dvprove"];?></td>
                                                  <td><?echo $filas["nomprove"];?></td>
                                                  <td><?echo $filas["dirprove"];?></td>
                                                  <td><?echo $filas["telprove"];?></td>
                                                  <td><?echo $filas["faxprove"];?></td>
                                                  <td><?echo $filas["municipio"];?></td>
                                                  <td><?echo $filas["cuenta"];?></td>
                                                  <td><?echo $filas["tipoc"];?></td>
                                                  <td><?echo $filas["Bancos"];?></td>
                                                  <td><?echo $filas["emailp"];?></td>
                                                  <td><?echo $filas["sucursal"];?></td>

                                        </tr>
        <?
                                }
                        }
                }
        ?>
         </table>
        </body>
</html>
