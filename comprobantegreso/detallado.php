<html>
        <head>
                <title>Comprobantes de egreso</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($campo)):
        ?>
                                 <center><h4><u><u>Comrpobantes de Egreso</u></u></h4></center>
                                 <form action="" method="post">
                                  <table border="0" align="center">
                                        <tr><td><br></td></tr>
                                        <tr class="cajas">
                                                <td><b>Tipo de busqueda</b></td>
                                                <td><b>Valor de Consulta</b></td>
                                        </tr>
                                        <tr class="cajas">
                                                <td>    <select name="campo">
                                                                <option value="0">Seleccione una Opción
                                                                <option value="nro">Nro_Comprobante
                                                                <option value="nrofactura">Nro_Factura
                                                                <option value="nitprove">Nit/Cedula
                                                                <option value="cliente">Cliente
                                                                <option value="valor">Valor
                                                                <option value="cheque">Cheque
																<option value="zona">Zona
                                                     </select></td>
                                                <td><input type="text" name="valor" value="" size="40" maxleng="40"></td>
				      <tr>
				         <td colspan="10"><b>Fecha_Inicio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
				        <input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas">&nbsp;
          			        <b>Fecha Final:</b>
				        <input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas">&nbsp;</td>
				       </tr>
                                        <tr><td><br></td></tr>
                                        <tr>
                                                <td colspan="2"><input type="submit" Value="Buscar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                                </table>

                        </form>
                  <?
                elseif (empty($campo)):
                  ?>
                        <script language="javascript">
                                alert("Despliegue la opción de busqueda ?")
                                history.back()
                        </script>
                   <?
                elseif (empty($valor)):
                  ?>
                        <script language="javascript">
                                alert("Digite el dato a consultar ?")
                                history.back()
                        </script>
                   <?

                   else:
                        include("../conexion.php");
                        if ($campo=='nro' or $campo=='nrofactura' or $campo=='nitprove'  or $campo=='cheque' or $campo=='valor'):
                                $consulta="select comprobante.* from comprobante
                                where  comprobante.$campo='$valor' and
                                       comprobante.fecha between '$desde' and '$hasta' and
                                       comprobante.ciudad != '' order by comprobante.fecha DESC";
                                 $resultado=mysql_query($consulta)or die ("error al buscar comprobantes");
                                $registros=mysql_num_rows($resultado);
                        else:
                               $consulta="select comprobante.* from comprobante
                                where comprobante.fecha between '$desde' and '$hasta' and
                                      comprobante.ciudad != '' and 
                                      comprobante.$campo like '%$valor%' order by comprobante.fecha DESC";
                                $resultado=mysql_query($consulta) or die("Error al buscar comprobantes de egreso $consulta");
                               $registros=mysql_num_rows($resultado);
                       endif;
                       if ($registros==0):
	                           ?>
	                           <script language="javascript">
	                                alert("No Existen Registros con esta opcion de busqueda")
	                                history.back()
	                           </script>
	                            <?
	                else:
	                           ?>
	                            <center><h4><u>Datos de la Busqueda</u><h4></center>
	                                <table border="0" align="center">
                                        <tr><td><tr></td></tr>
                                        <tr class="cajas">
                                                 <th>Item</th>
                                                <th>Número</th>
                                                <th>Documento</th>
                                                <th>Nit/Cedula</th>
                                                <th>Tercero</th>
                                                <th>FPago</th>
                                                <th>Valor</th>
                                                <th>Cheque</th>
                                       </tr>
                                    <?$T=1;
                                while ($filas=mysql_fetch_array($resultado)):
                                     $valor=number_format($filas["valor"],0);
                                     ?>
                                        <tr class="cajas">
                                                 <th><?echo $T;?></th>
                                                <td><a href="imprimirindividual.php?nro=<?echo $filas["nro"];?>"><?echo $filas["nro"];?></a></td>
                                                <td><?echo $filas["nrofactura"];?></td>
                                                <td><?echo $filas["nitprove"];?></td>
                                                <td><?echo $filas["cliente"];?></td>
                                                <td><?echo $filas["fecha"];?></td>
                                                <td><div align="right">$<?echo $valor;?></div></td>
                                                <td><?echo $filas["cheque"];?></td>
                                      </tr>
                                        <? $T=$T+1;
                                           $Total=$Total+$filas["valor"];
                                endwhile;
                                $Total=number_format($Total,0);
                                ?>
                             </table>
                            <div align="center"><td class="cajas"><b>Total_Pagado:&nbsp;<?echo $Total;?></b></td></div>
                             <?
                          endif;
               endif;
        ?>

        </body>
</html>
