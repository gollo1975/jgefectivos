<html>
        <head>
                <title>Listado de Facturas</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
                  <center><h4>Facturas en Cartera</h4></center>
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
                $FechaA=date("Y-m-d");
                include("../conexion.php");
                if (empty($valor)):
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and factura.fechaven <= '$FechaA' order by zona.zona";
                elseif ($campo=='nrofactura'):
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and factura.nrofactura = '$valor' and factura.fechaven <= '$FechaA' order by zona.zona";
                elseif ($campo=='nitzona'):
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and zona.nitzona = '$valor' and factura.fechaven <= '$FechaA' order by zona.zona";
                else:
                        $consulta="select factura.nrofactura,zona.zona,zona.nitzona,factura.fechaini,factura.fechaven,factura.grantotal,factura.nsaldo from factura,zona where zona.codzona=factura.codzona and factura.nsaldo >0 and zona.zona like '%$valor%' and factura.fechaven <= '$FechaA' order by zona.zona";
               endif;
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                  ?>
	                           <table border="1" align="center">

                                <tr>
                                        <th>&nbsp;</th>
                                        <th><b>Nro_Factura</b></th>
                                        <th><b>Nit</b></th>
                                         <th><b>Zona</b></th>
                                        <th><b>Fecha_Proceso</th>
                                        <th><b>Fecha_Ven.</th>
                                        <th><b>Valor Total</b></th>
                                        <th><b>Saldo</b></th>
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
                                         <td><?echo $filas["nrofactura"];?></a></td>
                                        <td><?echo $filas["nitzona"];?></td>
                                        <td><?echo $filas["zona"];?></td>
                                        <td><div align="center"><?echo $filas["fechaini"];?></div></td>
                                        <td><div align="center"><?echo $filas["fechaven"];?></div></td>
                                        <td><div align="right"><?echo $xcambio;?></div></td>
                                        <td><div align="right"><?echo $xcambio1;?></div></td>

                                </tr>
        <?
                       $conreg=$conreg+$filas["nsaldo"];
                         $i=$i+1;
                                        }
                        $xreal=number_format($conreg,2);
 ?>
                        </table>
                        <center><td><b>Saldo_Cartera:</b>&nbsp;<? echo $xreal;?></td></center>
                        <tr><td></td></tr>
                        <div align="center"><h4><font color="red"><a href="ExportarCartera.php"><b>Exportar..</b></a></font></h4></div>


        </body>
</html>
