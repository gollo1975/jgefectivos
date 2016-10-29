<html>

<head>
  <title>Modificar centro de costo</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
   <script type="text/javascript">
    function calculo()
       {
       var uno = 0;
       var dos = 0;
       var tres = 0;
       var cuatro = 0;
       var cinco = 0;
       var seis = 0;
       var totalF = 0;
       uno = parseFloat(document.getElementById("Basico").value)+ parseFloat(document.getElementById("TiempoExtra").value);
       dos = parseFloat(document.getElementById("TiempoNoExtra").value) + parseFloat(document.getElementById("AyudaTransporte").value);
       tres = parseFloat(document.getElementById("ValorArl").value) + parseFloat(document.getElementById("ValorEps").value);
       cuatro = parseFloat(document.getElementById("ValorPension").value) + parseFloat(document.getElementById("ValorCaja").value);
       cinco = parseFloat(document.getElementById("ValorSena").value) + parseFloat(document.getElementById("ValorIcbf").value) + parseFloat(document.getElementById("ValorCensatiaPrima").value);
       seis= parseFloat(document.getElementById("ValorVacacion").value) + parseFloat(document.getElementById("ValorAjuste").value) + parseFloat(document.getElementById("ValorAdmon").value);
       totalF = parseFloat(uno+dos+tres+cuatro+cinco+seis);
       document.getElementById("total").value= totalF.toFixed(0);
       /*resultado*/
       }
     function calculo2()
       {

      var uno = 0;
      var dos = 0;
      var tres = 0;
       var  cuatro = 0;
       uno = parseFloat(document.getElementById("total").value) + parseFloat(document.getElementById("incapacidad").value);
       dos = parseFloat(document.getElementById("anticipo").value) + parseFloat(document.getElementById("otro").value);
       tres = parseFloat(document.getElementById("ajuste").value) + parseFloat(document.getElementById("menor").value);
       cuatro = parseFloat(uno+dos+tres);
       document.getElementById("subtotal").value= cuatro.toFixed(0);
       }
    function BaseIva()
       {
       var uno = 0
       var dos = 0
       var tres = 0
       uno = parseFloat(document.getElementById("subtotal").value);
       tiva = parseFloat(document.getElementById("baseiva").value);
       tres=parseFloat (uno * tiva)/100;
       document.getElementById("vlrbase").value= tres.toFixed(0);
       }
    function ivapagar()
       {
       var iva = 0
       var porce = 0
       var total = 0
       iva = parseFloat(document.getElementById("vlrbase").value);
       porce = parseFloat(document.getElementById("vlriva").value);
       total=parseFloat(iva* porce)/100;
       document.getElementById("ivato").value= total.toFixed(0);
       }
    function totalvalor()
      {
      var var1 = 0
      var var2 = 0
      var1 = parseFloat(document.getElementById("ivato").value);
      var2 = parseFloat(var1)+ parseFloat(document.getElementById("subtotal").value);
      document.getElementById("grantotal").value = var2.toFixed(0);
      }
      function validar()
        {
         var totalitem = document.getElementById("tActualizaciones").value ;
         var nEle = document.f1.elements.length;
         for (i=0; i<nEle; i++) {
                 if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	       }
         }
         var suma1 = 0;
         var suma2 = 0;
         var suma3 = 0;
         var suma4 = 0;
         var suma5 = 0;
         var suma6 = 0;
         var suma7 = 0;
         var suma8 = 0;
         var suma9 = 0;
         var suma10 = 0;
         var suma11 = 0;
         var suma12 = 0;
         var suma13 = 0;
         var suma14 = 0;
        for (k=1;k<=totalitem;k++){
           suma1 +=  parseFloat(document.getElementById("salario[" + k + "]").value);
           suma2 +=  parseFloat(document.getElementById("tiempo[" + k + "]").value);
           suma3 +=  parseFloat(document.getElementById("tauxilio[" + k + "]").value);
           suma4 +=  parseFloat(document.getElementById("ayuda[" + k + "]").value);
           suma5 +=  parseFloat(document.getElementById("arp[" + k + "]").value);
           suma6 += parseFloat(document.getElementById("DatoEps[" + k + "]").value);
           suma7 += parseFloat(document.getElementById("pension[" + k + "]").value);
           suma8 += parseFloat(document.getElementById("cp[" + k + "]").value);
           suma9 += parseFloat(document.getElementById("sena[" + k + "]").value);
           suma10 += parseFloat(document.getElementById("icbf[" + k + "]").value);
           suma11 += parseFloat(document.getElementById("ps[" + k + "]").value);
           suma12 += parseFloat(document.getElementById("vacacion[" + k + "]").value);
           suma13 += parseFloat(document.getElementById("AjusteFiscal[" + k + "]").value);
           suma14 += parseFloat(document.getElementById("admon[" + k + "]").value);
           /*codigo de actualizacion*/
          f1.Basico.value = suma1;
          f1.TiempoExtra.value = suma2;
          f1.TiempoNoExtra.value = suma3;
          f1.AyudaTransporte.value = suma4;
          f1.ValorArl.value = suma5;
          f1.ValorEps.value = suma6;
          f1.ValorPension.value = suma7;
          f1.ValorCaja.value = suma8;
          f1.ValorSena.value = suma9;
          f1.ValorIcbf.value = suma10;
          f1.ValorCensatiaPrima.value = suma11;
          f1.ValorVacacion.value = suma12;
          f1.ValorAjuste.value = suma13;
          f1.ValorAdmon.value = suma14;
          }
        }
  </script>
 </head>
<?
include ("../conexion.php");
$Sql="select dezonacosto.* from dezonacosto,zonacosto
      where dezonacosto.codigo=zonacosto.codigo and
      zonacosto.codzona='$CodZona' and
	  zonacosto.cerrado='NO' and
      zonacosto.codigo='$NroCodigo' order by dezonacosto.empleado";
$Rs=mysql_query($Sql) or die("Error al busca empleados por el centro de costo ");
$Contador=mysql_num_rows($Rs);
if($Contador!=0){?>
<center><h4><u>EDICION CENTRO DE COSTO</u></h4></center>
     <form action="GrabarEditadoCentroCosto.php" method="post" id="f1" name="f1">
     <td><input type="hidden" name="ContadorEmpleado" value="<?echo $Contador;?>" size="11" id="ContadorEmpleado"></td>
     <td><input type="hidden" name="NroCodigo" value="<?echo $NroCodigo;?>" size="11" id="NroCodigo"></td>
     <input type="hidden" name="CodZona" value="<?echo $CodZona;?>" id="CodZona">
     <input type="hidden" name="Desde" value="<?echo $Desde;?>" id="Desde">
     <input type="hidden" name="Hasta" value="<?echo $Hasta;?>" id="Hasta">
        <table border="0" align="center" >
           <tr>
              <td><b>Zona:</b>&nbsp;<?echo $Zona;?></td>
           <tr>
           <tr>
              <td><b>Centro_Costo:</b>&nbsp;<?echo $CentroCosto;?></td>
           <tr>
        </table>
	<table border="0" align="center" >
		</tr>
		<td><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cedula</b></td><td class="cajas"><b>Empleado</b></td><td><b>Básico</b></td> <td class="cajas"><b>T_Extra</b></td><td class="cajas"><b>T_Auxilio</b></td><td><b>Ayuda</b></td><td class="cajas"><b>Arp</b></td><td class="cajas"><b>Eps</b></td><td class="cajas"><b>Pensión</b></td><td class="cajas"><b>Caja</b></td><td class="cajas"><b>Sena</b></td><td class="cajas"><b>Icbf</b></td><td class="cajas"><b>Ces/Prima</b></td><td class="cajas"><b>Vacación</b></td><td class="cajas"><b>A_Paraf.</b></td><td class="cajas"><b>Admon</b></td> <td class="cajas"><b>N_Ingreso.</b></td><td class="cajas"><b>N_Retiro</b></td><td class="cajas"><b>H_EG.</b></td><td class="cajas"><b>H_AT</b></td><td class="cajas"><b>Arp</b></td>
		</tr>
		<?
		$i=1;
		$fechap=date("Y-m-d");
		echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($Rs) . "\">");
		while ($filas=mysql_fetch_array($Rs)){
		       	?>
			<tr class="cajasletra">
			<?
			echo ("<td class=\"cajasletra\"><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['conse'] ."\"\">" .$filas['cedemple']."</td>");?>
			<input type="hidden" name="cedula" value="<? echo $filas["cedemple"];?>"  size="12" readonly>
			<td><input type="text"  value="<? echo $filas["empleado"];?>"name="empleado[<? echo $i;?>]" id="empleado[<? echo $i;?>]" size="32" readonly class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["basico"];?>"name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]" size="8" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["tiempo"];?>" name="tiempo[<? echo $i;?>]" id="tiempo[<? echo $i;?>]" size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["tauxilio"];?>" name="tauxilio[<? echo $i;?>]" id="tauxilio[<? echo $i;?>]" size="8" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["ayuda"];?>" name="ayuda[<? echo $i;?>]" id="ayuda[<? echo $i;?>]" size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["ss"];?>"name="arp[<? echo $i;?>]" id="arp[<? echo $i;?>]" size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["vlreps"];?>"name="DatoEps[<? echo $i;?>]" id="DatoEps[<? echo $i;?>]" size="6" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["vlrpension"];?>"name="pension[<? echo $i;?>]" id="pension[<? echo $i;?>]" size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["cp"];?>"name="cp[<? echo $i;?>]"id="cp[<? echo $i;?>]"  size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["vlrsena"];?>"name="sena[<? echo $i;?>]"id="sena[<? echo $i;?>]"  size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["vlricbf"];?>"name="icbf[<? echo $i;?>]"id="icbf[<? echo $i;?>]"  size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["ps"];?>"name="ps[<? echo $i;?>]" id="ps[<? echo $i;?>]"class="cajas" size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["vacacion"];?>"name="vacacion[<? echo $i;?>]" id="vacacion[<? echo $i;?>]" size=7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["ajusteparafiscal"];?>"name="AjusteFiscal[<? echo $i;?>]" id="AjusteFiscal[<? echo $i;?>]" size="6" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["admon"];?>"name="admon[<? echo $i;?>]" id="admon[<? echo $i;?>]"  size="7" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["novedadingreso"];?>" name="NovedadIngreso[<? echo $i;?>]" id="NovedadIngreso[<? echo $i;?>]"size="10" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["novedadretiro"];?>" name="NovedadRetiro[<? echo $i;?>]" id="NovedadRetiro[<? echo $i;?>]"  size="10" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["diasincapacidadgeneral"];?>" name="H_EG[<? echo $i;?>]" id="H_EG[<? echo $i;?>]"  size="4" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["diasincapacidadlaboral"];?>" name="H_AT[<? echo $i;?>]" id="H_AT[<? echo $i;?>]"  size="4" class="cajasletra"></td>
			<td><input type="text"  value="<? echo $filas["nivelr"];?>" name="vlrarp[<? echo $i;?>]" id="vlrarp[<? echo $i;?>]"  size="5" class="cajasletra"></td>

			</tr>
			<?
			$i=$i+1;
			$Basico +=$filas["basico"];
			$TiempoExtra +=$filas["tiempo"];
			$TiempoNoExtra +=$filas["tauxilio"];
			$AyudaTransporte +=$filas["ayuda"];
			$ValorArl +=$filas["ss"];
			$ValorEps +=$filas["vlreps"];
			$ValorPension +=$filas["vlrpension"];
			$ValorCaja +=$filas["cp"];
			$ValorSena +=$filas["vlrsena"];
			$ValorIcbf +=$filas["vlricbf"];
			$ValorCensatiaPrima +=$filas["ps"];
			$ValorVacacion +=$filas["vacacion"];
			$ValorAjuste +=$filas["ajusteparafiscal"];
                        $ValorAdmon +=$filas["admon"];
                }
		?>
	</table>
	<table border="0" align="center">
	<tr class="cajas">
	<td><b>Básico</b></td><td><b>T_Extra</b></td><td><b>T_Auxilio</b></td><td><b>Ayuda</b></td><td><b>Arp</b></td><td><b>Eps</b></td><td><b>Pen.</b></td><td><b>Caja</b></td><td><b>Sena</b></td><td><b>Icbf</b></td><td><b>Cesa/Prima</b></td><td><b>Vacación</b></td><td><b>A_Parafiscal</b></td><td><b>Admon</b></td>
	</tr>
	<tr>
	<td><input type="text" name="Basico" value="<? echo $Basico;?>"  class="cajasletra" size="12" id="Basico"></td>
	<td><input type="text" name="TiempoExtra" value="<? echo $TiempoExtra;?>" class="cajasletra" size="12" id="TiempoExtra"></td>
	<td><input type="text" name="TiempoNoExtra" value="<? echo $TiempoNoExtra;?>" class="cajasletra" size="12" id="TiempoNoExtra"></td>
	<td><input type="text" name="AyudaTransporte" value="<? echo $AyudaTransporte;?>" class="cajasletra" size="12"  id="AyudaTransporte"></td>
	<td><input type="text" name="ValorArl" value="<? echo $ValorArl;?>" class="cajasletra" size="11" id="ValorArl"></td>
	<td><input type="text" name="ValorEps" value="<? echo $ValorEps;?>" class="cajasletra" size="11" id="ValorEps"></td>
	<td><input type="text" name="ValorPension" value="<? echo $ValorPension;?>" class="cajas" size="11" id="ValorPension"></td>
	<td><input type="text" name="ValorCaja" value="<? echo $ValorCaja;?>" class="cajasletra" size="11" id="ValorCaja"></td>
	<td><input type="text" name="ValorSena" value="<? echo $ValorSena;?>" class="cajasletra" size="11" id="ValorSena"></td>
	<td><input type="text" name="ValorIcbf" value="<? echo $ValorIcbf;?>" class="cajasletra" size="11" id="ValorIcbf"></td>
	<td><input type="text" name="ValorCensatiaPrima" value="<? echo $ValorCensatiaPrima;?>" class="cajasletra" size="11" id="ValorCensatiaPrima"></td>
	<td><input type="text" name="ValorVacacion" value="<? echo $ValorVacacion;?>" class="cajasletra" size="11" id="ValorVacacion"></td>
	<td><input type="text" name="ValorAjuste" value="<? echo $ValorAjuste;?>" class="cajasletra" size="11" id="ValorAjuste"></td>
	<td><input type="text" name="ValorAdmon" value="<? echo $ValorAdmon;?>" class="cajasletra" size="9"id="ValorAdmon"></td>
	</tr>
	</table>
	<table border="0" align="center">
	<tr><td class="cajas"><b>Registros:&nbsp;<? echo $i-1;?>&nbsp;</b><input type="button" value="Calcular Columna" name="calcular" onClick="validar()" id="calcular"></td>
	</td></tr></table>
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
	<td><input type="text" name="total" value="0" class="cajas" size="11" onclick="calculo()" id="total"></td>
	<td><input type="text" name="incapacidad" value="0" class="cajas" size="11" id="incapacidad"></td>
	<td><input type="text" name="anticipo" value="0" class="cajas" size="11" id="anticipo"></td>
	<td><input type="text" name="otro" value="0" class="cajas" size="11" id="otro"></td>
	<td><input type="text" name="ajuste" value="0" class="cajas" size="11" id="ajuste"></td>
	<td><input type="text" name="menor" value="0" class="cajas" size="11" id="menor"></td>
	<td><input type="hidden" name="baseiva" value="<?echo $baseiva;?>" class="cajas" size="11" id="baseiva"></td>
	<td><input type="hidden" name="vlriva" value="<?echo $vlriva;?>" class="cajas" size="11" id="vlriva"></td>
	</tr>
	<tr class="cajas">
	<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b>SUBTOTAL</b></td><td><b>BASE DE IVA</b></td> <td><b>IVA</b></td><td><b>GRAN TOTAL</b></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><input type="text" name="subtotal" value=" " class="cajas" size="11" onclick="calculo2()" onFocus="calculo2()" id="subtotal"></td>
	<td><input type="text" name="vlrbase" value="" class="cajas" size="11"  onclick="BaseIva()" onFocus="BaseIva()" id="vlrbase"></td>
	<td><input type="text" name="ivato" value="" class="cajas" size="11"  onclick="ivapagar()" onFocus="ivapagar()" id="ivato"></td>
	<td><input type="text" name="grantotal" value="" class="cajas" size="11" onclick="totalvalor()" onFocus="totalvalor()" id="grantotal"></td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td colspan="5">
	<input type="submit" value="Enviar Dato" class="boton">
	</td>
	</tr>
	</tr>
	</table>
	</table>
	</td></tr>
	</table>
	<input type="hidden" value="<?echo $codzona;?>" name="codzona" class="cajas"size="11" maxlength="11" id="codzona">
	<input type="hidden" value="<?echo $zona;?>" name="zona" class="cajas"size="50" maxlength="50" id="zona">
	<input type="hidden" value="<?echo $desde;?>" name="desde" class="cajas"size="11" maxlength="11" id="desde">
	<input type="hidden" value="<?echo $hasta;?>" name="hasta" class="cajas"size="11" maxlength="11" id="hasta">
	<input type="hidden" value="<?echo $fechap;?>" name="fechap" class="cajas"size="11" maxlength="11" id="fechap">
	<input type="hidden" value="<?echo $codcosto;?>" name="codcosto" class="cajas"size="11" maxlength="11" id="codcosto">
	<input type="hidden" value="<?echo $centrocosto;?>" name="centrocosto" class="cajas"size="11" maxlength="11" id="centrocosto">
     </form>
<?
}else{
	?>
	<script language="javascript">
           alert("Este centro de costo no tiene empleados para modificar.!")
	   history.back()
	</script>
	<?
}
?>
</body>
</html>
