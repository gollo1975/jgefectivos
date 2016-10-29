<?
 session_start();
?>
<html>
        <head>
                <title>Pagos de Factura</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
                 <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                    
                 </script>
        </head>
        <body>
                <?
                if(session_is_registered("xsession")):
                 if (!isset($nrofactura)):
                   ?>
                     <center><h3>Pagos de Factura</h3></center>
                         <form action="" method="post">
                           <table border="0" align="center">
                                <tr>
                                   <td colspan="9" class="fondo"><br></td>
                                </tr>
                                <tr>
                                  <td><b>Nro_Factura:</b></td>
                                   <td><input type="text" name="nrofactura" value="" size="11" maxlength="11"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nrofactura">
                                   </tr>
                                   <tr><td><br></td></tr>

                                   <tr><td colspan="1"><input type="submit" Value="Buscar" class="boton"></td></tr>
                               </tr>
                        </table>

                   </form>
                <?
                elseif(empty($nrofactura)):
                  ?>
                    <script language="javascript">
                       alert("Digite la factura a Pagar " )
                       history.back()
                     </script>
              <?
                else:
                      include("../conexion.php");
                      $consulta1="select provedor.nomprove,pagar.nrofactura,pagar.subtotal,pagar.dcto,pagar.ivapagado,pagar.valor,pagar.saldo from pagar,provedor where
                       provedor.nitprove=pagar.nitprove and
                        pagar.saldo > 0 and
                        pagar.nrofactura='$nrofactura'";
                           $resultado1=mysql_query($consulta1) or die("Consulta incorrecta");
                           $regis=mysql_num_rows($resultado1);
                           if ($regis==0):
                              ?>
                              <script language="javascript">
                                alert("Esta factura no tiene saldos pendientes en sistemas?")
                                history.back()
                              </script>
                               <?
                           else:
                           ?>
                            <center><h3>Descargar Facturas</h3></center>
                           <?
                             while ($filas=mysql_fetch_array($resultado1)):
                                ?>
                                <form action="guardar.php" method="post">
                                  <table border="0" align="center">
                                  <tr>
                                     <td><b>Proveedor:</b></td>
                                     <td colspan="15"><input type="text" name="nomprove" value="<?echo $filas["nomprove"];?>" size="50" class="cajas"readonly></td>
                                   </tr>
                                    <tr>
                                    <td><b>Nro_Factura:</b></td>
                                      <td>  <input type="text" name="nrofactura" value="<?echo $filas["nrofactura"];?>" size="10" readonly class="cajas"></td>
                                     <td><b>Subtotal:</b></td>
                                      <td colspan="5"><input type="text" name="valor" value="<?echo $filas["subtotal"];?>" size="10"readonly class="cajas"></td>
                                      </tr>
                                      <tr>
                                      <td><b>Descuento:</b></td>
                                       <td><input type="text" name="dcto" value="<?echo $filas["dcto"];?>" size="5" readonly class="cajas" ></td>
                                       <td><b>Total_Base:</b></td>
                                       <td colspan="5"><input type="text" value="<?echo $filas["valor"];?>" size="11" maxlength="11" readonly></td>
                                       </tr>
                                        <tr>
                                      <td><b>Iva_Pagado:</b></td>
                                       <td><input type="text" name="dcto" value="<?echo $filas["ivapagado"];?>" size="11" readonly class="cajas" ></td>
                                       <td><b>Saldo_Actual:</b></td>
                                       <td colspan="5"><input type="text" name="saldo" value="<?echo $filas["saldo"];?>" size="11" maxlength="11" readonly></td>
                                       </tr>
                                       <tr>
                                       <td><b>Fecha_Proceso:</b></td>
                                      <td><input type="text" name="fechapro" value="<?echo date("Y-m-d");?>" size="11" maxlength="10" readonly></td>
                                       <td><b>Valor_Pagado:</b></td>
                                      <td colspan="5"><input type="text" name="abonado" value="" size="11" maxlength="11"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="abonado"></td>

                                   </tr>
                                    <tr><td><br></td></tr>
                                   <tr>
                                     <td colspan="6"><input type="submit" value="Guardar" class="boton"></td>
                                   </tr>
                               </table>
                            </form>
                            <?
                            endwhile;
                          endif;
                    endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;                    
                                    ?>
       </body>
</html>
