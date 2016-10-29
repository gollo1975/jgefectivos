<?
        if (empty($abonado)):
     ?>
                <script language="javascript">
                        alert("Digite el valor de abono a la factura")
                        history.back()
                </script>
                <?
        elseif($abonado > $saldo):
        ?>
                <script language="javascript">
                        alert("El valor del abono es mayor que el Valor real ?")
                        history.back()
                </script>
<?
       else:
               include("../conexion.php");
              $consulta = "select count(*) from cheque";
               $result = mysql_query ($consulta);
               $sw = mysql_fetch_row($result);
               $aux=$saldo-$abonado;
               if ($sw[0]>0):
                  $consulta = "select max(cast(nropago as unsigned)) + 1  from cheque";
                  $result = mysql_query ($consulta);
                  $codec = mysql_fetch_row($result);
                  $code = str_pad($codec[0], 6,"0", STR_PAD_LEFT);
               else:
                  $code="000001";
               endif;
                   $consulta1="insert into cheque (nropago,nrofactura,fechapro,abonado)
                    values('$code','$nrofactura','$fechapro','$abonado')";
                    $regis=mysql_query($consulta1)or die("Error al ingresar los cheques");
                    $consulta="update pagar set  saldo='$aux' where pagar.nrofactura='$nrofactura'";
                    $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                    $registros=mysql_affected_rows();
                    if ($registros==0):
               ?>
                      <script language="javascript">
                         alert("La tabla  Pagar, No se actualizo  en el B.D ?")
                         history.go(-2)
                      </script>
                         <?
                    else:
                       echo "<script language=\"javascript\">";
                            echo "open (\"../pie.php?msg=Se actualizó $registros registros de la Factura: $nrofactura\",\"pie\");";
                            echo "open (\"../menu.php?op=cheque\",\"contenido\");";
                        echo "</script>";
                                 </script>
                                <?
                    endif;

 endif;

