<html>

<head>
  <title>Servicios de Empacadores</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
    function calculo()
       {
       uno = 0
       dos = 0
       tres = 0
       cuatro1 = 0
       uno = parseFloat(document.getElementById("totalp").value) + parseFloat(document.getElementById("totale").value);
       dos = parseFloat(document.getElementById("totala").value) + parseFloat(document.getElementById("totalc").value);
       tres = parseFloat(document.getElementById("totalpresta").value) + parseFloat(document.getElementById("totalad").value);
       cuatro1 = parseFloat(uno+dos+tres);
       document.getElementById("total").value= cuatro1.toFixed(0);
       }
     function calculo2()
       {
       uno = 0
       dos = 0
       tres = 0
       uno = parseFloat(document.getElementById("total").value) + parseFloat(document.getElementById("incapacidad").value);
       dos = parseFloat(document.getElementById("ajuste").value) + parseFloat(document.getElementById("mayor").value);
       tres = parseFloat(uno+dos);
       document.getElementById("subtotal").value= tres.toFixed(0);
       }
    function ivapagar()
       {
       xiva = 0
       porce = 0
       xtotal = 0
       xiva = parseFloat(document.getElementById("subtotal").value);
       porce = parseFloat(document.getElementById("iva").value);
       xtotal=parseFloat(xiva* porce)/100;
       document.getElementById("ivato").value= xtotal.toFixed(0);
       }
    function totalvalor()
      {
      var1 = 0
      var2 = 0
      var1 = parseFloat(document.getElementById("ivato").value);
      var2 = parseFloat(var1)+ parseFloat(document.getElementById("subtotal").value);
      document.getElementById("grantotal").value = var2.toFixed(0);
      }
    function calculocolumna()
    {
    totalitem = document.getElementById("tActualizaciones").value;
    diez= 0
    xce = 0
    xca = 0
    xcc = 0
    xcpre = 0
    xcad = 0
    var nEle = document.f1.elements.length;
               for (i=0; i<nEle; i++) {
                 if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	         }
               }
      for (i=0;i<=totalitem;i++)
      {
        diez = parseFloat(diez) +  parseFloat(document.getElementById("vpension["+ i + "]").value); 
        xce = parseFloat(xce) +  parseFloat(document.getElementById("vlreps["+ i + "]").value);
        xca = parseFloat(xca) +  parseFloat(document.getElementById("vlrarp["+ i+ "]").value);
        xcc = parseFloat(xcc) +  parseFloat(document.getElementById("vlrcaja["+ i+ "]").value);
        xcad = parseFloat(xcad) + parseFloat(document.getElementById("vlradmon[" + i+ "]").value);
        xcpre = parseFloat(xcpre) +  parseFloat(document.getElementById("vlrpresta["+ i+ "]").value);
        document.getElementById("totalp").value = diez.toFixed(0);
        document.getElementById("totale").value = xce.toFixed(0);
        document.getElementById("totala").value = xca.toFixed(0);
        document.getElementById("totalc").value = xcc.toFixed(0);
        document.getElementById("totalad").value = xcad.toFixed(0);
        document.getElementById("totalpresta").value = xcpre.toFixed(0);

      }
    }
 </script>
 </head>

<?
include("../conexion.php");
$consulta="select distinct empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.codemple,contrato.fechainic,zona.codzona,zona.zona,zona.iva from zona,empleado,contrato
          where   zona.codzona=empleado.codzona and
                  empleado.codemple=contrato.codemple and
                  empleado.nomina='NO' and
                  contrato.fechater='0000-00-00' and
                  contrato.fechainic <= '$hasta' and
                  zona.codzona='$codzona' order by contrato.fechainic";
$resultado=mysql_query($consulta) or die("consulta incorrecta 3$consulta ");
$registros=mysql_num_rows($resultado);
if($registros!=0):
    ?>
     <input type="hidden" name="zona" value="<? echo $zona;?>" size="3">
     <input type="hidden" name="basico" value="<? echo $basico;?>" size="3">
     <input type="hidden" name="pension" value="<? echo $pension;?>" size="3">
     <input type="hidden" name="eps" value="<? echo $eps;?>" size="3">
     <input type="hidden" name="arp" value="<? echo $arp;?>" size="3">
     <input type="hidden" name="caja" value="<? echo $caja;?>" size="3">
     <input type="hidden" name="admon" value="<? echo $admon;?>" size="3">
     <input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
     <input type="hidden" name="iva" value="<? echo $iva;?>">
     <input type="hidden" name="auxilio" value="<? echo $auxilio;?>">
     <input type="hidden" name="prestacion" value="<? echo $prestacion;?>">
     <form name="f1" action="grabar.php" method="post">
     <table border="0" align="center">
            <tr>
               <td><b>Cod_Zona</b></td>
               <td><input type="text" name="codzona" value="<? echo $codzona;?>"class="cajas" size="4" readonly></td>
            </tr>
             <tr>
               <td><b>Zona:</b></td>
               <td><input type="text" name="zona" value="<? echo $zona;?>"class="cajas" size="50" readonly></td>
            </tr>
          </table>
           <table border="0" align="center" >
             <tr class="cajas">
              <tr class="cajas">
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;&nbsp;&nbsp;<? echo $pension;?>%</td>
                          <td>&nbsp;&nbsp;&nbsp;<? echo $eps;?>%</td>
                          <td>&nbsp;&nbsp;&nbsp;<? echo $arp;?>%</td>
                          <td>&nbsp;&nbsp;&nbsp;<? echo $caja;?>%</td>
                          </tr>
              <td class="cajas"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cedula</b></td> <td class="cajas"><b>Empleado</b></td><td><b>Básico</b></td> <td class="cajas"><b>Dias</b></td><td><b>Pension</b></td><td class="cajas"><b>&nbsp;&nbsp;&nbsp;Eps</b></td><td class="cajas"><b>Arp</b></td><td class="cajas"><b>Caja</b></td><td class="cajas"><b>Admon</b></td><td class="cajas"><b>Prestación</b></td><td class="cajas"><b>Novedad</b></td> <td class="cajas"><b>Fecha_Ing</b></td>
             </tr>
             <?

               $i=0;
              $fechap=date("Y-m-d");
             echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
             while ($filas=mysql_fetch_array($resultado)):
                              ?>
                              <tr>
                               <?
                                  echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['cedemple'] ."\"\">" .$filas['cedemple']."</td>");?>
                                      <input type="hidden" name="fechainic" value="<? echo $filas["fechainic"];?>" class="cajas" size="12" readonly>
                                      <?
                                      $fechainic=$filas["fechainic"];
                                      if ($fechainic < $desde):
                                          $dia=substr($desde,8,2);
                                          $calculo=substr($hasta,8,2);
                                          $resta=($calculo-$dia)+1;
                                          $con=($basico/30*$resta);
                                          $vlrpension=($con * $pension)/100;
                                          $vlreps=($con * $eps)/100;
                                          $vlrarp=($con * $arp)/100;
                                          $vlrcaja=($con * $caja)/100;
                                          $vlrpresta=(($basico + $auxilio)* $prestacion)/100;
                                       else:
                                         $fechainic=$filas["fechainic"];
                                          $dia=substr($fechainic,8,2);
                                          $calculo=substr($hasta,8,2);
                                          $resta=($calculo-$dia)+1;
                                          $con=($basico/30*$resta);
                                          $vlrpension=($con * $pension)/100;
                                          $vlreps=($con * $eps)/100;
                                          $vlrarp=($con * $arp)/100;
                                          $vlrcaja=($con * $caja)/100;
                                          $vlrpresta=($con + $auxlio)* $prestacion/100;
                                       endif;
                                          ?>
                                          <input type="hidden" name="cedula" value="<? echo $filas["cedemple"];?>" class="cajas" size="12" readonly>
                                          <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"name="empleado[<? echo $i;?>]" id="empleado[<? echo $i;?>]" class="cajas" size="33" readonly></td>
                                          <td><input type="text"  value="<? echo round($con,0);?>"name="ibc[<? echo $i;?>]" id="ibc[<? echo $i;?>]" class="cajas" size="8"></td>
                                          <td><input type="text"  value="<? echo $resta;?>" name="dia[<? echo $i;?>]" id="dia[<? echo $i;?>]"class="cajas" size="8"></td>
                                          <td><input type="text"  value="<? echo round($vlrpension,0);?>"name="vpension[<? echo $i;?>]" id="vpension[<? echo $i;?>]" class="cajas" size="6"></td>
                                          <td><input type="text"  value="<? echo round($vlreps,0);?>"name="vlreps[<? echo $i;?>]" id="vlreps[<? echo $i;?>]"class="cajas" size="7"></td>
                                          <td><input type="text"  value="<? echo round($vlrarp,0);?>"name="vlrarp[<? echo $i;?>]"id="vlrarp[<? echo $i;?>]" class="cajas" size="7"></td>
                                          <td><input type="text"  value="<? echo round($vlrcaja,0);?>"name="vlrcaja[<? echo $i;?>]" id="vlrcaja[<? echo $i;?>]"class="cajas" size="7"></td>
                                          <td><input type="text"  value="<? echo $admon;?>"name="vlradmon[<? echo $i;?>]" id="vlradmon[<? echo $i;?>]" class="cajas" size="7"></td>
                                          <td><input type="text"  value="<? echo round($vlrpresta,0);?>"name="vlrpresta[<? echo $i;?>]" id="vlrpresta[<? echo $i;?>]" class="cajas" size="7"></td>
                                          <td><input type="text"  value="" name="novedad[<? echo $i;?>]" id="novedad[<? echo $i;?>]" class="cajas" size="9"></td>
                                          <td><input type="text" name="fechainic" value="<? echo $filas["fechainic"];?>" class="cajas" size="11" readonly></td>
                                   </tr>
                         <?
                           $sumap=$sumap + $vlrpension;
                           $sumae=$sumae + $vlreps;
                           $sumaa=$sumaa + $vlrarp;
                           $sumac=$sumac + $vlrcaja;
                           $sumaad=$sumaad + $admon;
                           $sumapresta=$sumapresta + $vlrpresta;
                           $i=$i+1;
               endwhile;
                      ?>
                 </table>
                 <table border="0" align="center">
                             <tr><td class="cajas"><b>Total:</b>&nbsp;<? echo $i;?><input type="button" value="Calcular Columna" name="calcular" onClick="calculocolumna()"></td>
                 <table border="0" align="center">
                   <tr class="cajas">
                      <td><b>Tot_Pensión</b></td><td><b>Tot_Eps</b></td><td><b>Tot_Arp</b></td><td><b>Tot_Caja</b></td><td><b>Tot_Admon</b></td><td><b>Tot_Prestación</b></td>
                   </tr>
                   <tr>
                       <td><input type="text" name="totalp" value="<? echo round($sumap,0);?>" class="cajas" size="11" readonly></td>
                       <td><input type="text" name="totale" value="<? echo round($sumae,0);?>" class="cajas" size="11" readonly></td>
                       <td><input type="text" name="totala" value="<? echo round($sumaa,0);?>" class="cajas" size="11" readonly></td>
                       <td><input type="text" name="totalc" value="<? echo round($sumac,0);?>" class="cajas" size="11" readonly></td>
                       <td><input type="text" name="totalad" value="<? echo round($sumaad,0);?>" class="cajas" size="11" readonly></td>
                        <td><input type="text" name="totalpresta" value="<? echo round($sumapresta,0);?>" class="cajas" size="11" readonly></td>
                   </tr>
                                                      <table border="0" align="center">
                            <tr class="cajas">
                             <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b>Total</b></td> <td><b>Incapacidad.</b></td></td><td><b>Ajuste.</b></td><td><b>Mayor Vlr Fact.</b></td>
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
                              <td><input type="text" name="ajuste" value="0" class="cajas" size="11"></td>
                              <td><input type="text" name="mayor" value="0" class="cajas" size="11"></td>
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
                            alert("Esta empresa No tiene Emppleados en este Estado  ?")
                            history.back()
                         </script>
                         <?
                   endif;
                           ?>
                          </table>
                          </td></tr>
                        </table>
                         <input type="hidden" name="zona" value="<? echo $zona;?>" size="3">
                             <input type="hidden" name="basico" value="<? echo $basico;?>" size="3">
                             <input type="hidden" name="pension" value="<? echo $pension;?>" size="3">
                             <input type="hidden" name="eps" value="<? echo $eps;?>" size="3">
                             <input type="hidden" name="arp" value="<? echo $arp;?>" size="3">
                             <input type="hidden" name="caja" value="<? echo $caja;?>" size="3">
                             <input type="hidden" name="admon" value="<? echo $admon;?>" size="3">
                             <input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
                             <input type="hidden" name="iva" value="<? echo $iva;?>">
                             <input type="hidden" name="auxilio" value="<? echo $auxilio;?>">
                             <input type="hidden" name="prestacion" value="<? echo $prestacion;?>">
                             <input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
                             <input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
        </form>

</body>
</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          