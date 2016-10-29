<html>
        <head>
                <title>Listado de Cajas de compesanción</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Cajas de Compensación</u></h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="nit">Nit_Caja
                                                        <option value="nombre">Caja de compensacion
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
                        $consulta="select caja.*,municipio.municipio from caja,municipio where municipio.codmuni=caja.codmuni ";
                }
                elseif ($campo=='nit')
                {
                        $consulta="select caja.*,municipio.municipio from caja,municipio where municipio.codmuni=caja.codmuni and caja.nit = '$valor'";
                }
                else
                {
                        $consulta="select caja.*,municipio.municipio from caja,municipio where municipio.codmuni=caja.codmuni and caja.nombre like '%$valor%'";
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
                           <center><h4><u>Listado de Cajas</u></h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <th>Id</td>
                                        <th>Nit</td>
                                        <th>Caja</td>
                                        <th>Teléfono</td>
                                        <th>Dirección</td>
                                        <th>Municipio</td>
										<th>Cod_Interface</td>
                                         <th>Estado</td>
                                </tr>
        <?
                         $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th>&nbsp;<?echo $i;?></th>
                                         <td>&nbsp;<a href="ModificarC.php?cod=<?echo $filas["codigo_caja_pk"];?>"><?echo $filas["codigo_caja_pk"];?></a></td>
                                         <td>&nbsp;<?echo $filas["nit"];?></td>
                                        <td>&nbsp;<?echo $filas["nombre"];?></td>
                                        <td>&nbsp;<?echo $filas["telefono"];?></td>
                                        <td>&nbsp;<?echo $filas["direccion"];?></td>
                                        <td>&nbsp;<?echo $filas["municipio"];?></td>
										 <td><div align="center"><?echo $filas["codigo_interface_pila"];?></div></td>
                                         <td>&nbsp;<?echo $filas["estado"];?></td>
                                </tr>
        <?
                          $i=$i+1;
                           }
                }


?>
                        </table>
                        <td><div align="center"><a href="EditarCaja.php"><u><font color="blue"><h4>Actualizar</h4></font></u></a></div></td>
                        

        </body>
</html>
