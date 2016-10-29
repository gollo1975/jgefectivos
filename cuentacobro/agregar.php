    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='agregar.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
        function sumarTotal()
        {
              if (document.getElementById("descuento").value > 0)
              {
              total = document.getElementById("cantidad").value
               total1 = document.getElementById("vlruni").value
               total2 = document.getElementById("descuento").value
               subtotal1 = parseFloat (total) * parseFloat(total1);
               subtotal2 = parseFloat (subtotal1) * parseFloat(total2);
               xproceso = parseFloat (subtotal2)/100;
               subtotal3 = parseFloat (subtotal1) - parseFloat(xproceso);
               document.getElementById("subtotal").value =  parseFloat(subtotal3);
               }
              else
              {
               total = document.getElementById("cantidad").value
               total1 = document.getElementById("vlruni").value
               subtotal1 = parseFloat (total) * parseFloat(total1);
               document.getElementById("subtotal").value =  parseFloat(subtotal1);
              }
         }

</script>
       <head>
                <title>Creacción de la Cuenta de Cobro</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        </head>
        <body>
                <?
                        if (!isset($nit)):
                          ?>

                              <center><h3>Cuenta de Cobro<h3></center>
                               <form action="" method="post">
                                        <table border="0" align="center"
                                                <tr>
                                                        <td colspan="6"><br></td>
                                                </tr>
                <?
                                include("../conexion.php");
                                if (!$nro):
                                   $nit=$nro;
                                     ?>
                                     <tr>
                                        <td><b>Nit/Cedula:</b></td>
                                        <td><input type="text" name="nit" value="<? echo $nit;?>" size="13" maxlength="13" class="cajas">
                                        <td><b>Fecha_Inicio:</b></td>
                                        <td><input type="text" name="fechaini" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas"></td>
                                     </tr>
                                     <tr>
                                       <td><b>Fecha_Vencimiento:</b></td>
                                       <td><input type="text" name="fechaven" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" class="cajas"></td>
                                       <td><b>Fecha_Grabado:</b></td>
                                       <td><input type="text" name="fechagra" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"readonly class="cajas"></td>
                                       <td><b>Ciudad:</b></td>
                                        <td colspan="1"><input type="text" name="ciudad" value="" size="15" maxlength="15" class="cajas"> </td>
                                     </tr>
                                  <tr>
                                    <td><b>Nota:</b></td>
                                    <td colspan="10"><textarea name="observacion" cols="80" rows="6" class="cajas"></textarea></td>
                                  </tr>

                        <?

                                else:
                                       $nit=$nro;
                                        $consulta="select * from cuenta where cuenta.nit='$nro' and cuenta.nrocuenta='$codex'";
                                        $resultado=mysql_query($consulta) or die("consulta incorrecta 1");
                                        $filas=mysql_fetch_array($resultado);
                ?>                       <tr>
                                        <td><b>Nit/Cedula:</b></td>
                                         <td><input type="text" name="nit" value="<? echo $filas["nit"];?>" size="13" mexlength="13" readonly class="cajas">
                                         <td><b>Fecha_Inicio:</b></td>
                                         <td><input type="text" name="fechaini" value="<? echo $filas["fechaini"];?>" size="10" mexlength="10" readonly class="cajas" >
                                        </tr>
                                        <tr>
                                          <td><b>Fecha_Vencimiento:</b></td>
                                          <td><input type="text" name="fechaven" value="<?echo $filas["fechaven"];?>"class="cajas" size="10" maxlength="10" readonly></td>
                                          <td><b>Fecha_Grabado:</b></td>
                                          <td><input type="text" name="fechagra" value="<?echo $filas["fechagra"];?>"class="cajas" size="10" maxlength="10" readonly></td>
                                          <td><b>Ciudad:</b></td>
                                          <td><input type="text" name="ciudad" value="<?echo $filas["ciudad"];?>" class="cajas" size="15" maxlength="15" readonly></td>
                                     </tr>
                                      <tr>
                                       <td><b>Nota:</b></td>
                                       <td colspan="5"><textarea name="observacion" cols="80" rows="6" class="cajas" readonly><?echo $filas["observacion"];?></textarea></td></tr>
                                      <?
                                endif;
                                     ?>
                         <tr>
                            <td colspan="6">&nbsp;</td>
                         </tr>
                          <tr>
                             <td>Servicio</td>
                             <td>Cantidad</td>
                             <td>Vlr_Unit.</td>
                             <td>Dcto</td>
                             <td>Total.</td>
                             <td>&nbsp;</td>
                           </tr>
                           <tr>
                              <td><select name="dato" class="cajas">
                                 <option value="0">Seleccione un Servicio
                                <?
                                  $consulta_s="select * from servicio order by descripcion";
                                  $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta 1");
                                  while ($filas_s=mysql_fetch_array($resultado_s))
                                    {
                                   ?>
                                    <option value="<?echo $filas_s["codservi"];?>"><?echo $filas_s["descripcion"];?>
                                   <?
                                    }
                                    ?>
                                  </select></td>
                                  <td><input type="text" name="cantidad" value="0" size="11" maxlength="11" class="cajas">
                                  <td><input type="text" name="vlruni" value="0" size="11" maxlength="11" class="cajas">
                                  <td><input type="text" name="descuento" value="0" size="11" maxlength="11"id="descuento" onblur="sumarTotal()" class="cajas">
                                  <td><input type="text" name="subtotal" value="0" size="11" maxlength="11" class="cajas">
                                 <td colspan="5"><input type="submit" value="Agregar" ></td>
                             </tr>
                         </table>
                        <input type="hidden" name="MM_insert" value="form1">
                        </form>
               <?
                        include("../conexion.php");
                        $consulta_d="select decuenta.*,servicio.* from servicio,decuenta where decuenta.nrocuenta='$codex' and decuenta.codservi=servicio.codservi";
                        $resultado_d=mysql_query($consulta_d) or die("consulta incorrecta 5");
                        $registros_d=mysql_num_rows($resultado_d);
                        if ($registros_d==0):
                            ?>
                          <table border="" align="center" width="700">
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>Cod_Servicio</th>
                                                <th>Servicio</th>
                                                <th>Cantidad</th>
                                                <th>Vlr_Unitario</th>
                                                <th>Dcto</th>
                                                <th>SubTotal</th>
                                </tr>
                          </table>
                <?

                        else:

                ?>
                          <form action="borrarfactura.php" method="post">
                                <table border="" align="center" width="700">
                                        <tr class="fondo">
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <th>Cod_Servicio</th>
                                                <th>Servicio</th>
                                                <th>Cantidad</th>
                                                <th>Vlr_Unitario</th>
                                                <th>Dcto</th>
                                                <th>SubTotal</th>
                                                <th><a href="imprimir.php?nrocuenta=<?echo $codex;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></th>
                                        </tr>
                                <?
                                $subtotal=0;
                                while ($filas_d = mysql_fetch_array($resultado_d))
                                {
                                ?>
                                        <tr align="center" class="cajas">
                                                <input type="hidden" name="nit" value="<?echo $nro;?>">
                                                <input type="hidden" name="codex" value="<?echo $codex;?>">
                                                <td>&nbsp;<input type="checkbox" name="datos[]" value="<?echo $filas_d["codigo"];?>"></td>
                                                <td>&nbsp;<a href="modificarfactura.php?codigo=<?echo $filas_d["codigo"];?>&cod=<?echo $filas_d["codservi"];?>"><img src="../image/mod.jpg" border="0" alt="Modificar Registro"></a></td>
                                                <td>&nbsp;<?echo $filas_d["codservi"];?></td>
                                                <td class="cajas">&nbsp;<?echo $filas_d["descripcion"];?></td>
                                                <td align="right">&nbsp;<input type="text" name="cantidad" value="<?echo $filas_d["cantidad"];?>" readonly style="border:0;text-align:right"></td>
                                                <td align="right">&nbsp;<input type="text" name="vlruni" value="<?echo $filas_d["vlruni"];?>" readonly style="border:0;text-align:right"></td>
                                                <td align="right">&nbsp;<input type="text" name="descuento" value="<?echo $filas_d["descuento"];?>" readonly style="border:0;text-align:right"></td>
                                                <td align="right">&nbsp;<input type="text" name="subtotal" value="<?echo $filas_d["subtotal"];?>" readonly style="border:0;text-align:right"></td>


                                           </tr>
                                <?
                                $subtotal=$subtotal+$filas_d["subtotal"];
                                }
                               include("../conexion.php");
                                $consu="update cuenta set total='$subtotal',nsaldo='$subtotal' where nrocuenta='$codex'";
                                           $resu=mysql_query($consu) or die("Actualizacion Incorrecta");
                             ?>
                          <tr>
                             <td colspan="9">&nbsp;</td>
                          </tr>
                          <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                               <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                               <td>&nbsp;</td>
                              <td>Total:</td>
                              <td align="right"><input type="text" name="subtotal" value="<?echo $subtotal;?>" readonly style="border:0;text-align:right"></td>
                              <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="9" align="center"><input type="submit" value="Eliminar"></td>
                          </tr>
                         </table>

                         </form>
                         <?
                        endif;
                    elseif(empty($fechaini)):
                     ?>
                        <script language="javascript">
                          alert("Digite la Fecha de inicio del servicio")
                          history.back()
                        </script>
                <?
                         elseif(empty($fechaven)):

                ?>
                           <script language="javascript">
                               alert("Digite la Fecha corte del servicio")
                                history.back()
                           </script>
                           <?
                         elseif(empty($ciudad)):

                ?>
                           <script language="javascript">
                               alert("Digite la ciudad de envio")
                                history.back()
                           </script>

                 <?
                            elseif(empty($subtotal)):
                               ?>
                              <script language="javascript">
                                alert("Digite el valor total")
                                history.back()
                              </script>
                              <?
                            elseif(empty($nit)):
                               ?>
                              <script language="javascript">
                                alert("Digite el nit o cedula del cliente")
                                history.back()
                              </script>
                <?
                             else:
                             $estado="ACTIVA";
                                include("../conexion.php");
                                $consulta="select * from decuenta where nrocuenta='$codex'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta 8");
                                $registros=mysql_num_rows($resultado);
                                if ($registros==0)
                                {
                                $consulta = "select count(*) from decuenta";
                                $result = mysql_query ($consulta);
                                $answ = mysql_fetch_row($result);
                                 $ciudad=strtoupper($ciudad);
                                 if ($answ[0] > 0)
                                  {
                                    $consulta = "select max(cast(nrocuenta as unsigned)) + 1 from cuenta";
                                    $result2 = mysql_query($consulta);
                                    $codc = mysql_fetch_row($result2);
                                    $codex= str_pad($codc[0], 6, "0", STR_PAD_LEFT);
                                    $consulta="insert into cuenta (nrocuenta,nit,fechaini,fechaven,fechagra,ciudad,observacion,total,nsaldo,estado)
                                              values('$codex','$nit','$fechaini','$fechaven','$fechagra','$ciudad','$observacion','$subtotal','$subtotal','$estado')";
                                    $resultado=mysql_query($consulta) or die("Insercion 1 incorrecta $consulta");
                                    $consulta1="insert into decuenta (nrocuenta,codservi,cantidad,vlruni,descuento,subtotal)
                                                values('$codex','$dato','$cantidad','$vlruni','$descuento','$subtotal')";
                                    $resultado=mysql_query($consulta1) or die("Insercion 2 incorrecta");
                                    header("location: agregar.php?nro=$nit&codex=$codex");
                                  }
                                else

                                  $codex = "000001";
                                    $consulta="insert into cuenta (nrocuenta,nit,fechaini,fechaven,fechagra,ciudad,observacion,total,nsaldo,estado)
                                              values('$codex','$nit','$fechaini','$fechaven','$fechagra','$ciudad','$observacion','$subtotal','$subtotal','$estado')";
                                    $resultado=mysql_query($consulta) or die("Insercion 1 incorrecta");
                                    $consulta1="insert into decuenta (nrocuenta,codservi,cantidad,vlruni,descuento,subtotal)
                                                values('$codex','$dato','$cantidad','$vlruni','$descuento','$subtotal')";
                                    $resultado=mysql_query($consulta1) or die("Insercion 2 incorrecta");
                                    header("location: agregar.php?nro=$nit&codex=$codex");
                                }
                                elseif (empty($nro))
                                {
                ?>
                                        <script language="javascript">
                                                alert("Este conscutivo ya existe")
                                                pagina="agregar.php"
                                                tiempo=100
                                                ubicacion="_self"
                                                setTimeout("open(pagina,ubicacion)",tiempo)
                                                history.back()
                                        </script>
                <?
                                }
                                else
                                {

                                           $consulta="insert into decuenta(nrocuenta,codservi,cantidad,vlruni,descuento,subtotal)
                                                     values('$codex','$dato','$cantidad','$vlruni','$descuento','$subtotal')";
                                           $resultado=mysql_query($consulta) or die("Insercion 2 incorrecta");
                                           header("location: agregar.php?nro=$nit&codex=$codex");

                                }
                      endif;
?>
</body>
</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        