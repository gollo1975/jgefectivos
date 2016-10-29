<html>
        <head>
                <title>Listado de Facturas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Consulta de Facturas </h4></center>
                  <form action="" method="post">
                        <table border="1" align="center">
                                <tr>
                                        <td>    <select name="campo">
                                                        <option value="0">Seleccion una opcion
                                                        <option value="nrofactura">Nro_Factura
                                                        <option value="nitzona">Nit/Cedula
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
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 order by zona.zona";
                elseif ($campo=='nrofactura'):
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and factura.nrofactura = '$valor'order by zona.zona";
                elseif ($campo=='nitzona'):
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and zona.nitzona = '$valor'order by zona.zona";
                else:
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and zona.zona like '%$valor%'order by zona.zona";
               endif;
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                  ?>
                           <center><h4>Listado de Facturas en Cartera</h4></center>
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
                                                <th>&nbsp;</th> 
                                                <td><a href="listado.php"><b>Actualizar</b></a></td>

                                </tr>
                                <tr>
                                        <th>&nbsp;</th>
                                        <td><b>Nro_Factura</b></td>
                                        <td><b>Zona</b></td>
                                        <td><b>Nit</b></td>
                                        <td><b>Fecha_Proceso</td>
                                        <td><b>Fecha_Ven.</td>
                                        <td><b>Valor Total</b></td>
                                        <td><b>Saldo</b></td>
                                </tr>
        <?
                 $i=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {
                         $con=$filas["grantotal"];
                         $con1=$filas["nsaldo"];
                         $xcambio= number_format($con,2);
                         $xcambio1= number_format($con1,2);

        ?>
                                <tr class="cajas">
                                        <th><? echo $i;?></th>
                                         <td>&nbsp;<?echo $filas["nrofactura"];?></a></td>
                                        <td>&nbsp;<?echo $filas["zona"];?></td>
                                        <td>&nbsp;<?echo $filas["nitzona"];?></td>
                                        <td>&nbsp;<?echo $filas["fechaini"];?></td>
                                        <td>&nbsp;<?echo $filas["fechaven"];?></td>
                                        <td>&nbsp;<?echo $xcambio;?></td>
                                        <td>&nbsp;<?echo $xcambio1;?></td>

                                </tr>
        <?
                       $conreg=$conreg+$filas["nsaldo"];
                         $i=$i+1;
                                        }
                        $xreal=number_format($conreg,2);
 ?>
                        </table>
                        <center><td><b>Saldo_Cartera:</b>&nbsp;<? echo $xreal;?></td></center>


        </body>
</html>
