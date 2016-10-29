<?
 session_start();
?>
<html>

<head>
  <title>Facturar por Centro</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
    function calculo()
       {
       uno = 0
       dos = 0
       tres = 0
       cuatro1 = 0
       uno = parseFloat(document.getElementById("total1").value) + parseFloat(document.getElementById("total2").value);
       dos = parseFloat(document.getElementById("total3").value) + parseFloat(document.getElementById("total4").value);
       tres = parseFloat(document.getElementById("total5").value) + parseFloat(document.getElementById("total6").value);
       cuatro1 = parseFloat(uno+dos+tres)+parseFloat(document.getElementById("total7").value);
       document.getElementById("total").value= cuatro1.toFixed(0);
       }
     function calculo2()
       {
       uno = 0
       dos = 0
       tres = 0
       cuatro = 0
       uno = parseFloat(document.getElementById("total").value) + parseFloat(document.getElementById("incapacidad").value);
       dos = parseFloat(document.getElementById("anticipo").value) + parseFloat(document.getElementById("otro").value);
       tres = parseFloat(document.getElementById("ajuste").value) + parseFloat(document.getElementById("menor").value);
       cuatro = parseFloat(uno+dos+tres);
       document.getElementById("subtotal").value= cuatro.toFixed(0);
       }
    function ivapagar()
       {
       iva = 0
       porce = 0
       total = 0
       iva = parseFloat(document.getElementById("subtotal").value);
       porce = parseFloat(document.getElementById("iva").value);
       total=parseFloat(iva* porce)/100;
       document.getElementById("ivato").value= total.toFixed(0);
       }
    function totalvalor()
      {
      var1 = 0
      var2 = 0
      var1 = parseFloat(document.getElementById("ivato").value);
      var2 = parseFloat(var1)+ parseFloat(document.getElementById("subtotal").value);
      document.getElementById("grantotal").value = var2.toFixed(0);
      }
      function validar()
        {
        totalitem = document.getElementById("tActualizaciones").value
         suma1 = 0
         suma2 = 0
         suma3 = 0
         suma4 = 0
         suma5 = 0
        for (i=1;i<=totalitem;i++)
          {
           suma1 = parseFloat(suma1) + parseFloat(document.getElementById("ss[" + i+ "]").value);
           suma2 = parseFloat(suma2) + parseFloat(document.getElementById("cp[" + i+ "]").value);
           suma3 = parseFloat(suma3) + parseFloat(document.getElementById("ps[" + i+ "]").value);
           suma4 = parseFloat(suma4) + parseFloat(document.getElementById("admon[" + i+ "]").value);
           suma5 = parseFloat(suma5) + parseFloat(document.getElementById("ivatotal[" + i+ "]").value);
           document.getElementById("total4").value =  suma1.toFixed(0);
           document.getElementById("total5").value = suma2.toFixed(0);
           document.getElementById("total6").value =  suma3.toFixed(0);
           document.getElementById("total7").value = suma4.toFixed(0);
           document.getElementById("total8").value =  suma5.toFixed(0);
          }
        }
         function CalculoFilas()
         {
         totalitem = document.getElementById("tActualizaciones").value
         xcon1 = 0
         xcon2 = 0
         xcon3 = 0
         xcon4 = 0
         xvlrto = 0
         xlp = 0
         totaliva = 0
         for (i=1;i<=totalitem;i++)
          {
                      xcon1 = parseFloat(document.getElementById("salario[" + i+ "]").value)+ parseFloat(document.getElementById("tiempo[" + i+ "]").value);
                      xcon2 = parseFloat(document.getElementById("ayuda[" + i+ "]").value)+ parseFloat(document.getElementById("ss[" + i+ "]").value);
                      xcon3 = parseFloat(document.getElementById("cp[" + i+ "]").value) + parseFloat(document.getElementById("ps[" + i+ "]").value);
                      xcon4 = parseFloat(document.getElementById("admon[" + i+ "]").value);
                      xlp = parseFloat(document.getElementById("iva").value);
                      xvlrto = (xcon1 + xcon2 + xcon3 + xcon4);
                      totaliva = (xvlrto * xlp)/100;
                      document.getElementById("ivatotal[" + i+ "]").value =  totaliva.toFixed(0);
            }
        }
  </script>
 </head>

<?
if(session_is_registered("validar")):
  if (!isset($dato1)):
     include("../conexion.php");
  ?>
  <center><h4>Facturación por Centro de Costo</h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Centro de Costo:</b></td>
                              <td colspan="12"><select name="dato1" class="cajas">
                              <option value="0">Seleccione el centro de costo
                                <?
                                 $consulta="select costo.codcosto,costo.centro from costo order by centro";
                                 $resultado=mysql_query($consulta)or die ("consulta incorrecta");
                                while($filas=mysql_fetch_array($resultado)):
                                   ?>
                                   <option value="<?echo $filas["codcosto"];?>"> <?echo $filas["centro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
</table>
</form>
<?
elseif (empty($dato1)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir el centro de costo ?")
    history.back()
  </script>
  <?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.codzona,zona.zona,zona.codzona,zona.iva,cobrozona.desde,cobrozona.hasta from zona,cobrozona
                where zona.codzona=cobrozona.codzona and
                  cobrozona.desde='$desde' and cobrozona.hasta='$hasta' and
                  zona.codzona='$campo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta 1 ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                   $iva=$filas_s ["iva"];
                   $codzona=$filas_s ["codzona"];
                   $zona=$filas_s ["zona"];
                    ?>
                    <center><h4>Facturacion Por centro de Costo</h4></center>
                   <form name="" action="guardarcentro.php" method="post">
                   <td><input type="hidden" name="iva" value="<? echo $filas_s["iva"];?>"></td>
                   <table border="0" align="center">
                     <tr>
                       <td class="cajas"><b>Zona:</b>&nbsp;&nbsp;<? echo $filas_s["zona"];?></td>
                     </tr>
                       <tr class="cajas">
                       <td colspan="2"><b>Desde:</b>&nbsp;&nbsp;<? echo $filas_s["desde"];?><b>&nbsp;&nbsp;&nbsp;&nbsp;Hasta:</b>&nbsp;&nbsp;<? echo $filas_s["hasta"];?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
              $consulta="select decobrozona.*,empleado.codcosto,costo.centro from cobrozona,decobrozona,zona,costo,empleado
                     where zona.codzona=empleado.codzona and
                           empleado.codcosto=costo.codcosto and
                           zona.codzona=cobrozona.codzona and
                           cobrozona.codigo=decobrozona.codigo and
                           empleado.cedemple=decobrozona.cedemple and
                           cobrozona.desde='$desde' and cobrozona.hasta='$hasta' and
                           zona.codzona='$campo' and
                           costo.codcosto='$dato1'";

                 $resultado=mysql_query($consulta) or die("consulta incorrecta 3 ");
                 $registros=mysql_num_rows($resultado);
                  if($registros!=0):
                     ?>
                       <table border="0" align="center" >
                         <tr class="cajas">
                          <tr class="cajas">
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>Seg.:<? echo $xcontrol1;?>%</td>
                          <td>&nbsp;&nbsp;Caja:<? echo $xcontrol2;?>%</td>
                          <td>Pres.:<? echo $xcontrol3;?>%</td>
                          </tr>
                             <td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cedula</b></td> <td class="cajas"><b>Empleado</b></td><td><b>Básico</b></td> <td class="cajas"><b>Tpo_Extra</b></td><td><b>Ayuda</b></td><td class="cajas"><b>Seguridad</b></td><td class="cajas"><b>Caja</b></td><td class="cajas"><b>Presta.</b></td><td class="cajas"><b>Admon</b></td> <td class="cajas"><b>Iva</b></td>
                          </tr>
                         <?
                         echo $caja;
                         $i=1;
                         $fechap=date("Y-m-d");
                         echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
                        while ($filas=mysql_fetch_array($resultado)):
                            $codcosto=$filas["codcosto"];
                            $centrocosto=$filas["centro"];
                                 ?>
                                 <tr>
                                  <?
                                  echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['cedemple'] ."\"\">" .$filas['cedemple']."</td>");?>
                                  <input type="hidden" name="cedula" value="<? echo $filas["cedemple"];?>" class="cajas" size="12" readonly>
                                   <td><input type="text"  value="<? echo $filas["empleado"];?>"name="empleado[<? echo $i;?>]" id="empleado[<? echo $i;?>]" class="cajas" size="32" readonly></td>
                                   <td><input type="text"  value="<? echo $filas["basico"];?>"name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]" class="cajas" size="8"></td>
                                   <td><input type="text"  value="<? echo $filas["tiempo"];?>" name="tiempo[<? echo $i;?>]" id="tiempo[<? echo $i;?>]"class="cajas" size="8"></td>
                                   <td><input type="text"  value="<? echo $filas["ayuda"];?>" name="ayuda[<? echo $i;?>]" id="ayuda[<? echo $i;?>]" class="cajas" size="6"></td>
                                   <td><input type="text"  value="<? echo $filas["ss"];?>"name="ss[<? echo $i;?>]" id="ss[<? echo $i;?>]"class="cajas" size="7"></td>
                                   <td><input type="text"  value="<? echo $filas["cp"];?>"name="cp[<? echo $i;?>]"id="cp[<? echo $i;?>]" class="cajas" size="8"></td>
                                   <td><input type="text"  value="<? echo $filas["ps"];?>"name="ps[<? echo $i;?>]" id="ps[<? echo $i;?>]"class="cajas" size="8"></td>
                                   <td><input type="text"  value="<? echo $filas["admon"];?>"name="admon[<? echo $i;?>]" id="admon[<? echo $i;?>]" class="cajas" size="7"></td>
                                   <td><input type="text"  value="<? echo $filas["iva"];?>" name="ivatotal[<? echo $i;?>]" id="ivatotal[<? echo $i;?>]" class="cajas" size="6"></td>
                                 </tr>
                                  <?
                               $suma1=$suma1+$filas["basico"];
                               $suma2=$suma2+$filas["tiempo"];
                               $suma3=$suma3+$filas["ayuda"];
                               $suma4=$suma4+$filas["ss"];
                               $suma5=$suma5+$filas["cp"];
                               $suma6=$suma6+$filas["ps"];
                               $suma7=$suma7+$filas["admon"];
                               $suma8=$suma8+$filas["iva"];
                              $i=$i+1;
                              $con=$con+1;
                              endwhile;
                         ?>
                           </table>
                            <table border="0" align="center">
                             <tr class="cajas">
                             <td><b>Básico</b></td><td><b>Tiempo</b></td><td><b>Ayuda</b></td><td><b>Seguridad</b></td><td><b>Caja Comp.</b></td><td><b>Prestación</b></td><td><b>Admon</b></td><td><b>Iva</b></td>
                             </tr>
                              <tr>
                              <td><input type="text" name="total1" value="<? echo $suma1;?>" class="cajas" size="12"></td>
                              <td><input type="text" name="total2" value="<? echo $suma2;?>" class="cajas" size="12"></td>
                              <td><input type="text" name="total3" value="<? echo $suma3;?>" class="cajas" size="12"></td>
                              <td><input type="text" name="total4" value="<? echo $suma4;?>" class="cajas" size="11"></td>
                              <td><input type="text" name="total5" value="<? echo $suma5;?>" class="cajas" size="11"></td>
                              <td><input type="text" name="total6" value="<? echo $suma6;?>" class="cajas" size="11"></td>
                              <td><input type="text" name="total7" value="<? echo $suma7;?>" class="cajas" size="11"></td>
                              <td><input type="text" name="total8" value="<? echo $suma8;?>" class="cajas" size="9"></td>
                             </tr>
                             </table>
                             <table border="0" align="center">
                             <tr><td class="cajas"><b>Registros:<? echo $con;?></b><input type="button" value="Calcular Columna" name="calcular" onClick="validar()"></td>
                             <td><input type="button" value="Calcular Filas" name="calculofilas" onClick="CalculoFilas()"></td></tr></table>

                           <tr><td><br></td></tr>
                           <center><h4>Detallado de Pago</h4></center>
                           <table border="0" align="center">
                            <tr class="cajas">
                             <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b>Total</b></td> <td><b>Menos Incap.</b></td><td><b>Anticipos</b></td><td><b>Otros Dcto</b></td><td><b>Ajuste.</b></td><td><b>Menor Vlr Fact.</b></td>
                             </tr>
                             <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><input type="text" name="total" value="0" class="cajas" size="11" onclick="calculo()"></td>
                              <td><input type="text" name="incapacidad" value="0" class="cajas" size="11"></td>
                              <td><input type="text" name="anticipo" value="0" class="cajas" size="11"></td>
                              <td><input type="text" name="otro" value="0" class="cajas" size="11"></td>
                              <td><input type="text" name="ajuste" value="0" class="cajas" size="11"></td>
                              <td><input type="text" name="menor" value="0" class="cajas" size="11"></td>
                             </tr>
                             <tr class="cajas">
                             <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b>SUBTOTAL</b></td> <td><b>IVA</b></td><td><b>GRAN TOTAL</b></td>
                             </tr>
                             <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><input type="text" name="subtotal" value=" " class="cajas" size="11" onclick="calculo2()" onFocus="calculo2()"></td>
                              <td><input type="text" name="ivato" value="" class="cajas" size="11"  onclick="ivapagar()" onFocus="ivapagar()"></td>
                              <td><input type="text" name="grantotal" value="" class="cajas" size="11" onclick="totalvalor()" onFocus="totalvalor()"></td>
                              </tr>
                              <tr><td><br></td></tr>
                             <tr>
                               <td colspan="5">
                                <input type="submit" value="Enviar Dato" class="boton">
                                </td>
                              </tr>
                             </tr>
                           </table>
                         <?
                   else:
                      ?>
                         <script language="javascript">
                            alert("No hay registros con este rango de Fechas ?")
                            history.back()
                         </script>
                         <?
                   endif;
                           ?>
                          </table>
                          </td></tr>
                        </table>
                         <input type="hidden" value="<?echo $codzona;?>" name="codzona" class="cajas"size="11" maxlength="11">
                         <input type="hidden" value="<?echo $zona;?>" name="zona" class="cajas"size="50" maxlength="50">
                         <input type="hidden" value="<?echo $desde;?>" name="desde" class="cajas"size="11" maxlength="11">
                         <input type="hidden" value="<?echo $hasta;?>" name="hasta" class="cajas"size="11" maxlength="11">
                         <input type="hidden" value="<?echo $fechap;?>" name="fechap" class="cajas"size="11" maxlength="11">
                         <input type="hidden" value="<?echo $codcosto;?>" name="codcosto" class="cajas"size="11" maxlength="11">
                         <input type="hidden" value="<?echo $centrocosto;?>" name="centrocosto" class="cajas"size="11" maxlength="11">
                    </form>
       <?
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              