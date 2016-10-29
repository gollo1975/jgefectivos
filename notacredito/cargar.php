<html>
        <head>
                <title>Listado de Facturas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h3><u>Facturas de Ventas</u></h3></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="nrofactura">Nro_Factura
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
                if (empty($valor)):
                        $consulta="select factura.nrofactura,zona.zona,factura.fechaini,factura.grantotal,factura.nsaldo,zona.iva from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 order by zona.zona";

                elseif ($campo=='nrofactura'):
                                $consulta="select factura.nrofactura,zona.zona,factura.fechaini,factura.grantotal,factura.nsaldo,zona.iva from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and factura.nrofactura = '$valor'order by zona.zona";
                else:
                           $consulta="select factura.nrofactura,zona.zona,factura.fechaini,factura.grantotal,factura.nsaldo,zona.iva from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and zona.zona like '%$valor%'order by zona.zona";
                endif;
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                   ?>
                           <center><h4><u>Listado de Facturas</u></h4></center>
                           <table border="1" align="center">
                                <tr>
                                        <td colspan="2"></td>
                                </tr>
                                <tr>

                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <td><a href="cargar.php">Actualizar</a></td>
                                                <th>&nbsp;</th>
                                </tr>
                                <tr>
                                        <th>&nbsp;</th>
                                        <td><b>Nro_Factura</b></td>
                                        <td><b>Zona</b></td>
                                        <td><b>Fecha_Proceso</td>
                                        <td><b>Valor Total</b></td>
                                        <td><b>Saldo</b></td>
                                </tr>
        <?  $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                             {
                               $con=$filas["nsaldo"];
                                $con1=$filas["grantotal"];
                             $xcambio= number_format($con,2);
                              $xcambio1= number_format($con1,2);  

        ?>
                                <tr class="cajas">
                                        <th><? echo $i;?></th>
                                         <td>&nbsp;<a href="modificacion.php?cod=<?echo $filas["nrofactura"];?>"><?echo $filas["nrofactura"];?></a></td>
                                        <td>&nbsp;<?echo $filas["zona"];?></td>
                                        <td>&nbsp;<?echo $filas["fechaini"];?></td>
                                        <td>&nbsp;<?echo $xcambio1;?></td>
                                        <td>&nbsp;<?echo $xcambio;?></td>

                                </tr>
        <?
           $i=$i+1;
                        }



?>
                        </table>


        </body>
</html>
