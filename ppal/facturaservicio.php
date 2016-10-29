<html>
        <head>
                <title>Detalle de facturas</title>
                <link rel="stylesheet" href="../estilo.css" type="text/css">
        </head>
        <body>
                      <?
                 if (!isset($desde)):
                         include("../conexion.php");
                ?>
                   <center><h4>Detallado de la Factura</h4></center>
                   <form action="" method="post">
                           <table border="0" align="center"
                            <tr>
                              <td colspan="9"></td>
                            </tr>
                            <tr><td><br></td></tr>
                            <tr>
                              <td><b>Fecha Inicio:&nbsp;</b></td>
                              <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas">&nbsp;</td>
                            </tr>
                            <tr>
                              <td><b>Fecha Final:&nbsp;</b></td>
                              <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas">&nbsp;</td>
                            </tr>
                           <tr><td><br></td></tr>
                             <tr>
                               <td colspan="6"><input type="submit" value="Buscar" class="boton"> &nbsp;<input type="reset" value="Limpiar" class="boton"></td>
                             </tr>
                        </table>

                   </form>
                  <?
                elseif(empty($desde)):
                  ?>
                    <script language="javascript">
                       alert("Digite la fecha de Inicio" )
                       history.back()
                     </script>
              <?
                 else:
                    include ("../conexion.php");
      $consu="select zona.zona,zona.prestacion,zona.caja,zona.admon,zona.iva,sucursal.banco,sucursal.banco1,sucursal.cuenta1,sucursal.cuenta2,sucursal.tipocta1,sucursal.tipocta2 from zona,sucursal
                where sucursal.codsucursal=zona.codsucursal and zona.codzona='$codigo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta 1  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                     $ivag=$filas_s["iva"];
                     $cuenta1=$filas_s["cuenta1"];
                     $cuenta2=$filas_s["cuenta2"];
                     $valor=$filas_s["tipocta1"];
                     $valor1=$filas_s["tipocta2"];
                     $presta=$filas_s["prestacion"];
                     $caja=$filas_s["caja"];
                     $admon1=$filas_s["admon"];
                     $banco=$filas_s["banco"];
                     $banco1=$filas_s["banco1"];
                       ?>
                      <td><input type="hidden" name="valor" value="<? echo $filas_s["tipocta1"];?>"></td>
                      <td><input type="hidden" name="valor1" value="<? echo $filas_s["tipocta2"];?>"></td>
                     <table border="0" align="center">
                     <tr>
                       <td colspan="2"><? echo $filas_s["zona"];?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
                $consulta="select cobrozona.* from cobrozona,zona
                 where zona.codzona=cobrozona.codzona and
                 cobrozona.desde between '$desde' and '$hasta' and
                 zona.codzona='$codigo'";
                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                     <center><h4>Listado de Servicio</h4></center>
                     <table border="0" align="center">
                       <tr class="cajas">
                         <td>Para Ver el datallado de Cobro, Presione Click sobre el NRO_SERVICIO..</td>
                       </tr>
                     </table>
                       <table border="0" align="center" >
                         <tr class="cajas">
                            <th>Nro_Servicio</th>
                            <th>&nbsp;&nbsp;Desde</th>
                            <th>&nbsp;&nbsp;Hasta</th>
                            <th>&nbsp;&nbsp;Fecha_Pro.</th>
                            <th>&nbsp;&nbsp;Total</th>
                            <th>&nbsp;&nbsp;Incapacidad</th>
                            <th>&nbsp;&nbsp;Anticipo</th>
                            <th>&nbsp;&nbsp;Otros Dcto</th>
                            <th>&nbsp;&nbsp;Ajuste</td>
                            <th>&nbsp;&nbsp;Menor Vlr</th>
                            <th>&nbsp;&nbsp;Subtotal</th>
                            <th>&nbsp;&nbsp;Iva</th>
                            <th>&nbsp;&nbsp;Gran Total</th>
                         <?
                          while ($filas=mysql_fetch_array($resultado)):
                            ?>
                              <tr class="cajas">
							  <td><a href="../facturar/imprimirdetallecaja.php?codigo=<? echo $filas["codigo"];?>&codzona=<?echo $codigo;?>&admon1=<?echo $admon1;?>&ivag=<? echo $ivag;?>&valor=<?echo $valor;?>&valor1=<?echo $valor1;?>&cuenta1=<? echo $cuenta1;?>&cuenta2=<? echo $cuenta2;?>&presta=<? echo $presta;?>&caja=<? echo $caja;?>&banco=<? echo $banco;?>&banco1=<? echo $banco1;?>"><? echo $filas["codigo"];?></a></td>
                              <td>&nbsp;&nbsp;<? echo $filas["desde"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["hasta"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["fechap"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["total"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["incapacidad"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["anticipo"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["otros"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ajuste"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["menorvlr"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["subtotal"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["ivatotal"];?></td>
                              <td>&nbsp;&nbsp;<? echo $filas["grantotal"];?></td>
                            </tr>
                            <?
                            endwhile;
                            ?>
                            </table>
                            <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros De Facturacion para esta Zona ?")
                            history.back()
                         </script>
                         <?
                   endif;
  endif;
       ?>


</body>
</html>
