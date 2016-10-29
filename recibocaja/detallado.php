	<html>
        <head>
                <title>Comprobantes de egreso</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                if (!isset($campo)):
        ?>
                                 <center><h4><u><u>Recibos de caja</u></u></h4></center>
                                 <form action="" method="post">
                                <table border="0" align="center">
                                        <tr><td><br></td></tr>
                                        <tr class="cajas">
                                                <td><b>Seleccione</b></td>
                                                <td><b>Valor de Consulta</b></td>
                                        </tr>
                                        <tr class="cajas">
                                                <td>    <select name="campo">
                                                                <option value="0">Seleccione una Opción
                                                                <option value="nrocaja">Nro_Caja
                                                                <option value="nrofactura">Nro_Factura
                                                                <option value="nit">Nit/Cedula
                                                                <option value="zona">Cliente
                                                                <option value="valor">Valor
                                                     </select></td>
                                                <td><input type="text" name="valor" value="" size="40" maxleng="40"></td>
                                        </tr>
                                        <tr>
                                          <td><b>Tipo_Busqueda:</b></td>
                                          <td><input type="radio" value="H" name="estado">Historico<input type="radio" value="R" name="estado">Real</td>
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
        elseif (empty($estado)):
        ?>
                        <script language="javascript">
                                alert("Seleccione el tipo de Busqueda ?")
                                history.back()
                        </script>
        <?
        else:
          include("../conexion.php");
            if($estado=='H'):
                 if ($campo=='nrocaja' or $campo=='nrofactura' or $campo=='nit'  or $campo=='valor'):
                                $consulta="select recibo.* from recibo where
                             recibo.$campo='$valor'";
                 else:
                                $consulta="select recibo.* from recibo
                               where recibo.zona like '%$valor%'";
                 endif;
             else:
                if ($campo=='nrocaja'):
                      $consulta="select maestrorecibo.*,recibo.* from maestrorecibo,recibo,tiporecibo where
                           maestrorecibo.nrocaja=recibo.nrocaja and
                           maestrorecibo.idrecibo=tiporecibo.idrecibo and
                           maestrorecibo.$campo='$valor' ";
                elseif($campo=='nit' or $campo=='nrofactura' or $campo=='valor'):
                     $consulta="select maestrorecibo.*,recibo.* from maestrorecibo,recibo,tiporecibo where
                           maestrorecibo.nrocaja=recibo.nrocaja and
                           maestrorecibo.idrecibo=tiporecibo.idrecibo and
                           recibo.$campo='$valor' ";
                else:
                           $consulta="select recibo.* from recibo
                            where recibo.zona like '%$valor%' and recibo.suma =''";
                endif;
             endif;
                 $resultado=mysql_query($consulta) or die("Error al buscar recibos de cajas $consulta");
                 $registros=mysql_num_rows($resultado);
                 echo $registro;
                 if ($registros==0):
                      ?>
                       <script language="javascript">
                             alert("No Existen Registros con esta opcion de busqueda")
                             history.back()
                       </script>
                      <?
                 else:
                    if($estado=='H'):
                           ?>
                           <center><h4><u>Datos de la Busqueda</u><h4></center>
                           <table border="0" align="center">
                                        <tr><td><tr></td></tr>
                                        <tr class="cajas">
                                                <th>Nro_Caja</th>
                                                <th>Nro_Factura</th>
                                                <th>Nit</th>
                                                <th>Cliente</th>
                                                <th>Fecha_Pago</th>
                                                <th>Valor</th>
                                       </tr>
                                  <?
                                while ($filas=mysql_fetch_array($resultado)):
                                   $valor=number_format($filas["valor"],0);
                                   ?>
                                        <tr class="cajas">
                                                <td><a href="imprimirindi.php?nrocaja=<?echo $filas["nrocaja"];?>"><?echo $filas["nrocaja"];?></a></td>
                                                <td><?echo $filas["nrofactura"];?></td>
                                                <td><?echo $filas["nit"];?></td>
                                                <td><?echo $filas["zona"];?></td>
                                                <td><?echo $filas["fechare"];?></td>
                                                <td>$<?echo $valor;?></td>
                                      </tr>
                                    <?
                                endwhile;
                    else:
                        ?>
                           <center><h4><u>Datos de la Busqueda</u><h4></center>
                           <table border="0" align="center">
                                        <tr><td><tr></td></tr>
                                        <tr class="cajas">
                                                <th>Nro_Caja</th>
                                                <th>Nro_Factura</th>
                                                <th>Nit</th>
                                                <th>Cliente</th>
                                                <th>Fecha_Pago</th>
                                                <th>Valor</th>
                                       </tr>
                                  <?
                                while ($filas=mysql_fetch_array($resultado)):
                                   $valor=number_format($filas["valor"],0);
                                   ?>
                                        <tr class="cajas">
                                                <td><a href="ImprimirRecibo.php?NroRecibo=<?echo $filas["nrocaja"];?>"><?echo $filas["nrocaja"];?></a></td>
                                                <td><?echo $filas["nrofactura"];?></td>
                                                <td><?echo $filas["nit"];?></td>
                                                <td><?echo $filas["zona"];?></td>
                                                <td><?echo $filas["fechare"];?></td>
                                                <td>$<?echo $valor;?></td>
                                      </tr>
                                    <?
                                endwhile;
                    endif;
                 endif;
                endif;
              ?>
                        </table>

        </body>
</html>
