<html>
        <head>
                <title>Consulta de Empleados</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($campo))
                {
        ?>
                                 <center><h4>Consulta Empleado Por Selección</h4></center>
                                 <form action="" method="post">
                                <table border="0" align="center">
                                        <tr class="fondo">
                                                <td colspan="9"></td>
                                        </tr>
                                        <tr class="cajas">
                                                <td><b>Campo de Consulta</b></td>
                                                <td><b>Valor de Consulta</b></td>
                                        </tr>
                                        <tr class="cajas">
                                                <td>    <select name="campo">
                                                                <option value="0">Seleccione una Opción
                                                                <option value="codemple">Codigo Empleado
                                                                <option value="cedemple">Cedula
                                                                <option value="nomemple">Primer Nombre
                                                                 <option value="nomemple1">Segundo Nombre
                                                                <option value="apemple">Primer Apellido
                                                                <option value="apemple1">Segundo Apellido
                                                                <option value="telemple">Telefono
                                                                <option value="diremple">Direccion
                                                                <option value="municipio">Municipio
                                                                <option value="celular">Celular
                                                                <option value="cuenta">Cuenta

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
                elseif (!isset($valor))
                {
        ?>
                        <script language="javascript">
                                alert("Digite un Valor a Buscar")
                                history.back()
                        </script>
        <?
                }
                else
                {
                        include("../conexion.php");
                        if ($campo=='codemple' or $campo=='cedemple' or $campo=='telemple'  or $campo=='celular' or $campo=='cuenta')
                        {
                                $consulta="select empleado.*,banco.*,zona.*,eps.*,pension.*,costo.* from empleado,banco,zona,eps,pension,costo where
                                empleado.codbanco=banco.codbanco and
                                empleado.codzona=zona.codzona and
                                empleado.codeps=eps.codeps and
                                empleado.codpension=pension.codpension and
                                empleado.codcosto=costo.codcosto and  empleado.$campo='$valor'";
                         }
                        else
                        {
                                $consulta="select empleado.*,banco.*,zona.*,eps.*,pension.*,costo.* from empleado,banco,zona,eps,pension,costo where
                                empleado.codbanco=banco.codbanco and
                                empleado.codzona=zona.codzona and
                                empleado.codeps=eps.codeps and
                                empleado.codpension=pension.codpension and
                                empleado.codcosto=costo.codcosto and  empleado.$campo like '%$valor%' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
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
        ?>                      <center><h4><u>Datos del Empleado</u><h4></center>
                                <table border="0" align="center">
                                        <tr class="fondo">
                                                <td colspan="30"></td>
                                        </tr>
                                        <tr class="cajas">
                                                <th>Código</th>
                                                <th>Cedula</th>
                                                <th>Nombres</th>
                                                <th>Apellidos</th>
                                                <th>Telefono</th>
                                                <th>Direccion</th>
                                                <th>Municipio</th>
                                                <th>Sexo</th>
                                                <th>Fecha Nac.</th>
                                                <th>Estado Civ.</th>
                                                <th>Cuenta</th>
                                                <th>Banco</th>
                                                <th>Zona</th>
                                                <th>Eps</th>
                                                <th>Pension</th>
                                                <th>Nomina</th>
                                                <th>Costo</th>
                                    
                                       </tr>
        <?
                                while ($filas=mysql_fetch_array($resultado))
                                {
        ?>
                                        <tr class="cajas">
                                                <td><?echo $filas["codemple"];?></td>
                                                <td><?echo $filas["cedemple"];?></td>
                                                <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                                                <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                                                <td><?echo $filas["telemple"];?></td>
                                                <td><?echo $filas["diremple"];?></td>
                                                <td><?echo $filas["municipio"];?></td>
                                                <td><?echo $filas["sexo"];?></td>
                                                <td><?echo $filas["fechanac"];?></td>
                                                <td><?echo $filas["estcivil"];?></td>
                                                <td><?echo $filas["cuenta"];?></td>
                                                <td><?echo $filas["bancos"];?></td>
                                                <td><?echo $filas["zona"];?></td>
                                                <td><?echo $filas["eps"];?></td>
                                                <td><?echo $filas["pension"];?></td>
                                                <td><?echo $filas["nomina"];?></td>
                                                <td><?echo $filas["centro"];?></td>

                                      </tr>
        <?
                                }
                        }
                }
        ?>
                        </table>

        </body>
</html>
