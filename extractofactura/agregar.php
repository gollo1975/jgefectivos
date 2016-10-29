    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<script language="javascript">
        function volver()// para declara funcion
        {
                pagina='agregar.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <title>Detalle de la Factura de Servicios</title>
                 <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
                <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        </head>
        <body>
                <?
                        if (!isset($nrofactura)):
                          ?>
                               
                              <center><h3>Relación de la Factura de Servicios<h3></center>
                               <form action="" method="post">
                                        <table border="0" align="center"
                                                <tr>
                                                        <td colspan="6"><br></td>
                                                </tr>
                <?
                                include("../conexion.php");
                                if (!$nro):

                                    $nrofactura=$nro;
                                     ?>
                                     <tr>
                                        <td><b>Nro Factura:</b></td>
                                        <td colspan="5"><input type="text" name="nrofactura" value="<? echo $nrofactura;?>" size="10" maxlength="10">
                                     </tr>
                                     <tr>
                                        <td><b>Desde:</b></td>
                                        <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"></td>
                                        <td><b>Hasta:</b></td>
                                       <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"></td>
                                     </tr>
                                  <tr>
                                    <td>Nota:</td>
                                    <td colspan="5"><textarea name="nota1" cols="60" rows="3" class="cajas"></textarea></td></tr>
                        <?

                                else:

                                        $nrofactura=$nro;
                                        $consulta="select * from extracto where nrofactura='$nro'";
                                        $resultado=mysql_query($consulta) or die("consulta incorrecta 1");
                                        $filas=mysql_fetch_array($resultado);
                ?>
                                        <tr>
                                        <td>Nro Factura:</td>
                                         <td colspan="5"><input type="text" name="nrofactura" value="<? echo $filas["nrofactura"];?>" size="10" mexlength="10" readonly>
                                        </tr>
                                        <tr>
                                          <td>Desde:</td>
                                        <td><input type="text" name="desde" value="<?echo $filas["desde"];?>" size="10" maxlength="10" readonly></td>
                                        <td>Hasta:</td>
                                       <td><input type="text" name="hasta" value="<?echo $filas["hasta"];?>" size="10" maxlength="10" readonly></td>
                                     </tr>
                                      <tr>
                                       <td>Nota:</td>
                                       <td colspan="5"><textarea name="nota1" cols="60" rows="3" class="cajas"><?echo $filas["nota"];?></textarea></td></tr>
                                      <?
                                endif;
                                     ?>
                         <tr>
                            <td colspan="6">&nbsp;</td>
                         </tr>
                          <tr>
                             <td>Descripción:</td>
                             <td>Porcentaje</td>
                             <td>Total</td>
                             <td>&nbsp;</td>
                           </tr>
                           <tr>
                              <td><select name="servicio" class="cajas">
                                 <option value="0">Seleccione un Servicio
                                <?
                                  $consulta_s="select * from listado order by concepto";
                                  $resultado_s=mysql_query($consulta_s) or die("consulta incorrecta 1");
                                  while ($filas_s=mysql_fetch_array($resultado_s))
                                    {
                                   ?>
                                    <option value="<?echo $filas_s["codcomp"];?>"><?echo $filas_s["concepto"];?>
                                   <?
                                    }
                                    ?>
                                  </select></td>
                                  <td><input type="text" name="porcentaje" value="" size="11" maxlength="11">
                                  <td><input type="text" name="valor" value="" size="11" maxlength="11">
                                 <td colspan="5"><input type="submit" value="Agregar" ></td>
                             </tr>
                         </table>
                        <input type="hidden" name="MM_insert" value="form1">
                        </form>
               <?
                        include("../conexion.php");
                        $consulta_d="select dextracto.*,listado.* from dextracto,listado where dextracto.autoriza='$codex' and dextracto.codcomp=listado.codcomp";
                        $resultado_d=mysql_query($consulta_d) or die("consulta incorrecta 5");
                        $registros_d=mysql_num_rows($resultado_d);
                        if ($registros_d==0):
                            ?>
                          <table border="" align="center">
                                <tr>
                                                <th>&nbsp;</th>
                                                <th>&nbsp;</th>
                                                <th>Cod_Servicio</th>
                                                <th>Descripción</th>
                                                <th>Porcentaje</th>
                                                <th>Valor</th>
                                </tr>
                          </table>
                <?

                        else:

                ?>
                          <form action="borrarfactura.php" method="post">
                                <table border="" align="center">
                                        <tr class="fondo" >
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>Cod_Servicio</td>
                                                <td>Descripción</td>
                                                <td>Porcentaje</td>
                                                <td>Valor</td>
                                                <th><a href="imprimir.php?autoriza=<?echo $codex;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></th>
                                        </tr>
                                <?
                                $subtotal=0;
                                while ($filas_d = mysql_fetch_array($resultado_d))
                                {
                                ?>
                                        <tr align="center">
                                                <input type="hidden" name="nrofactura" value="<?echo $nro;?>">
                                                <input type="hidden" name="codex" value="<?echo $codex;?>">
                                                <td>&nbsp;<input type="checkbox" name="datos[]" value="<?echo $filas_d["conse"];?>"></td>
                                                <td>&nbsp;<a href="modificarfactura.php?conse=<?echo $filas_d["conse"];?>&cod=<?echo $filas_d["codcomp"];?>"><img src="../image/mod.jpg" border="0" alt="Modificar Registro"></a></td>
                                                <td>&nbsp;<?echo $filas_d["codcomp"];?></td>
                                                <td class="cajas">&nbsp;<?echo $filas_d["concepto"];?></td>
                                                <td align="right">&nbsp;<input type="text" name="Porcentaje" value="<?echo $filas_d["porcentaje"];?>" readonly style="border:0;text-align:right"></td>
                                                <td align="right">&nbsp;<input type="text" name="valor" value="<?echo $filas_d["valor"];?>" readonly style="border:0;text-align:right"></td>


                                           </tr>
                                <?
                                $subtotal=$subtotal+$filas_d["valor"];
                                }
                             ?>
                          <tr>
                             <td colspan="9">&nbsp;</td>
                          </tr>
                          <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>Total:</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td align="right"><input type="text" name="valor" value="<?echo $subtotal;?>" readonly style="border:0;text-align:right"></td>
                              <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="9" align="center"><input type="submit" value="Eliminar"></td>
                          </tr>
                         </table>

                         </form>
                         <?
                        endif;
                    elseif(empty($desde)):
                     ?>
                        <script language="javascript">
                          alert("Digite la Fecha de inicio del servicio")
                          history.back()
                        </script>
                <?
                         elseif(empty($hasta)):

                ?>
                           <script language="javascript">
                               alert("Digite la Fecha corte del servicio")
                                history.back()
                           </script>
                 <?
                            elseif(empty($valor)):
                               ?>
                              <script language="javascript">
                                alert("Digite el valor total")
                                history.back()
                              </script>
                <?
                             else:
                                include("../conexion.php");
                                $consulta="select * from extracto where autoriza='$codex'";
                                $resultado=mysql_query($consulta) or die("consulta incorrecta 8");
                                $registros=mysql_num_rows($resultado);
                                if ($registros==0)
                                {
                                $consulta = "select count(*) from extracto";
                                $result = mysql_query ($consulta);
                                $answ = mysql_fetch_row($result);
                                 if ($answ[0] > 0)
                                  {
                                    $consulta = "select max(cast(autoriza as unsigned)) + 1 from extracto";
                                    $result2 = mysql_query($consulta);
                                    $codc = mysql_fetch_row($result2);
                                    $codex= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
                                  }
                                else
                                  $codex = "00001";
                                    $consulta="insert into extracto (autoriza,nrofactura,desde,hasta,nota1)
                                              values('$codex','$nrofactura','$desde','$hasta','$nota1')";
                                    $resultado=mysql_query($consulta) or die("Insercion 1 incorrecta");
                                    $consulta1="insert into dextracto (autoriza,codcomp,porcentaje,valor)
                                                values('$codex','$servicio','$porcentaje','$valor')";
                                    $resultado=mysql_query($consulta1) or die("Insercion 2 incorrecta");
                                    header("location: agregar.php?nro=$nrofactura&codex=$codex");
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

                                           $consulta="insert into dextracto(autoriza,codcomp,porcentaje,valor)
                                                                values('$codex','$servicio','$porcentaje','$valor')";
                                                $resultado=mysql_query($consulta) or die("Insercion 2 incorrecta");
                                                header("location: agregar.php?nro=$nrofactura&codex=$codex");

                                }
                      endif;
?>
</body>
</html>
