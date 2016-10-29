<html>
        <head>
                <title>Listado de Zonas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4><u>Listado de facturas</u></h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="nrofactura">Nro_factura
                                                        <option value="nit">Nit
                                                        <option value="provedor">Proveedor
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
                        $consulta="select cobroexamen.codigo,cobroexamen.nit,cobroexamen.provedor,cobroexamen.nrofactura,cobroexamen.valor, cobroexamen.fechap from cobroexamen order by fechap DESC ";
                }
                elseif ($campo=='nrofactura')
                {
                        $consulta="select cobroexamen.codigo,cobroexamen.nit,cobroexamen.provedor,cobroexamen.nrofactura,cobroexamen.valor, cobroexamen.fechap from cobroexamen where nrofactura='$valor' order by fechap";
                  }
                  elseif ($campo=='nit')
                   {
                       $consulta="select cobroexamen.codigo,cobroexamen.nit,cobroexamen.provedor,cobroexamen.nrofactura,cobroexamen.valor, cobroexamen.fechap from cobroexamen where nit='$valor' order by fechap";
                    }
                    else
                     {
                        $consulta="select cobroexamen.codigo,cobroexamen.nit,cobroexamen.provedor,cobroexamen.nrofactura,cobroexamen.valor, cobroexamen.fechap from cobroexamen where provedor like '%$valor%' order by fechap DESC";
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
                           <center><h4>Listado de Facturas</h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <td><a href="listado.php">Actualizar</a></td>

                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <td><b>Código</b></td>
                                        <td><b>Nit</b></td>
                                        <td><b>Proveedor</td>
                                        <td><b>Nro_Factura</b></td>
                                        <td><b>F_Proceso</b></td>
                                         <td><b><div align="right">Vlr_Factura</div></b></td>
                                    </tr>
        <?
        $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {
                         $valor=number_format($filas["valor"],0)
        ?>
                                <tr class="cajas">
                                        <th><?echo $i;?></th>
                                         <td><a href="buscar.php?cod=<?echo $filas["codigo"];?>&provedor=<?echo $filas["provedor"];?>"><?echo $filas["codigo"];?></a></td>
                                        <td><?echo $filas["nit"];?></td>
                                        <td><?echo $filas["provedor"];?></td>
                                        <td><?echo $filas["nrofactura"];?></td>
                                          <td><?echo $filas["fechap"];?></td>
                                        <td><div align="right">$<?echo $valor;?></div></td>

                                </tr>
        <?
                       $i=$i+1;
                        }
                }


?>
                        </table>
                        

        </body>
</html>
