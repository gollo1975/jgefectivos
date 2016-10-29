<html>

<head>
  <title>Facturar de Servicio</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
 <script language="javascript">
    function calculo()
       {
        var uno = 0;
       var dos = 0;
       var tres = 0;
       var cuatro1 = 0;
       var cuatro = 0;
       var quinto = 0;
       var sexto = 0;
	   var Admon = 0;
	   var Subtotalsinadmon = 0;
       uno = parseFloat(document.getElementById("total1").value) + parseFloat(document.getElementById("total2").value);
       dos = parseFloat(document.getElementById("total3").value) + parseFloat(document.getElementById("total4").value);
       tres = parseFloat(document.getElementById("total5").value) + parseFloat(document.getElementById("total6").value);
       cuatro = parseFloat(document.getElementById("total7").value) + parseFloat(document.getElementById("total8").value);
       quinto = parseFloat(document.getElementById("total9").value) + parseFloat(document.getElementById("total10").value) + parseFloat(document.getElementById("total14").value);
       sexto = parseFloat(document.getElementById("total11").value) + parseFloat(document.getElementById("total12").value) + parseFloat(document.getElementById("total13").value);
	   Admon = parseFloat(document.getElementById("total13").value);
       cuatro1 = parseFloat(uno+dos+tres+cuatro+quinto+sexto);
	   Subtotalsinadmon = parseFloat((uno+dos+tres+cuatro+quinto+sexto)- Admon); 
       document.getElementById("total").value= cuatro1.toFixed(0);
	   document.getElementById("TotalSinAdmon").value= Subtotalsinadmon.toFixed(0);
	   
       }
     function calculo2()
       {
       var VariableUna = 0;
       var VariableDos = 0;
       var VariableTres = 0;
        var VariableCuatro = 0;
       VariableUna = parseFloat(document.getElementById("total").value) + parseFloat(document.getElementById("incapacidad").value);
       VariableDos = parseFloat(document.getElementById("anticipo").value) + parseFloat(document.getElementById("otro").value);
       VariableTres = parseFloat(document.getElementById("ajuste").value) + parseFloat(document.getElementById("menor").value);
       VariableCuatro = parseFloat(VariableUna + VariableDos + VariableTres);
       document.getElementById("subtotal").value= VariableCuatro.toFixed(0);
       }
    function BaseIva()
       {
        var uno = 0;
       var  dos = 0;
        var tres = 0;
       var tiva = 0;
       uno = parseFloat(document.getElementById("subtotal").value);
       tiva = parseFloat(document.getElementById("tbaseiva").value);
       tres=parseFloat (uno * tiva)/100;
       document.getElementById("ValorBase").value= tres.toFixed(0);
       }
    function ivapagar()
       {
       var TotalIva = 0;
       var  porce = 0;
       var ValorTotal = 0;
       TotalIva = parseFloat(document.getElementById("ValorBase").value);
       porce = parseFloat(document.getElementById("ValorIva").value);
       ValorTotal = (TotalIva * porce)/100;
       document.getElementById("IvaPagar").value= ValorTotal.toFixed(0);
       }
    function totalvalor()
      {
       var SubNivel = 0;
       var SubNivelDos = 0;
       var SubNivelDos = 0;
       SubNivel = parseFloat(document.getElementById("IvaPagar").value);
       SubNivelDos = parseFloat(document.getElementById("subtotal").value);
       SubNivelTres = SubNivelDos + SubNivel;
      document.getElementById("GranTotal").value = SubNivelTres.toFixed(0);
      }
      function validar()
        {
        var totalitem = document.getElementById("tActualizaciones").value
         var suma1 = 0;
          var suma2 = 0;
          var suma3 = 0;
         var  suma4 = 0;
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
          var nEle = document.f1.elements.length;
          for (i=0; i<nEle; i++) {
                 if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	         }
           }
        for (i=1;i<=totalitem;i++)
          {
           suma1 = parseFloat(suma1) + parseFloat(document.getElementById("salario[" + i+ "]").value);
           suma2 = parseFloat(suma2) + parseFloat(document.getElementById("tiempo[" + i+ "]").value);
           suma3 = parseFloat(suma3) + parseFloat(document.getElementById("tauxilio[" + i+ "]").value);
           suma4 = parseFloat(suma4) + parseFloat(document.getElementById("ayuda[" + i+ "]").value);
           suma5 = parseFloat(suma5) + parseFloat(document.getElementById("arp[" + i+ "]").value);
           suma6 = parseFloat(suma6) + parseFloat(document.getElementById("eps[" + i+ "]").value);
           suma7 = parseFloat(suma7) + parseFloat(document.getElementById("pension[" + i+ "]").value);
           suma8 = parseFloat(suma8) + parseFloat(document.getElementById("cp[" + i+ "]").value);
           suma9 = parseFloat(suma9) + parseFloat(document.getElementById("sena[" + i+ "]").value);
           suma10 = parseFloat(suma10) + parseFloat(document.getElementById("icbf[" + i+ "]").value);
           suma11 = parseFloat(suma11) + parseFloat(document.getElementById("ps[" + i+ "]").value);
           suma12 = parseFloat(suma12) + parseFloat(document.getElementById("vacacion[" + i+ "]").value);
           suma13 = parseFloat(suma13) + parseFloat(document.getElementById("admon[" + i+ "]").value);
           suma14 += parseFloat(document.getElementById("AjusteParafiscal[" + i+ "]").value);
           document.getElementById("total1").value =  suma1.toFixed(0);
           document.getElementById("total2").value =  suma2.toFixed(0);
           document.getElementById("total3").value =  suma3.toFixed(0);
           document.getElementById("total4").value =  suma4.toFixed(0);
           document.getElementById("total5").value =  suma5.toFixed(0);
           document.getElementById("total6").value =  suma6.toFixed(0);
           document.getElementById("total7").value =  suma7.toFixed(0);
           document.getElementById("total8").value =  suma8.toFixed(0);
           document.getElementById("total9").value =  suma9.toFixed(0);
           document.getElementById("total10").value =  suma10.toFixed(0);
           document.getElementById("total11").value =  suma11.toFixed(0);
           document.getElementById("total12").value =  suma12.toFixed(0);
           document.getElementById("total13").value =  suma13.toFixed(0);
		   document.getElementById("total14").value =  suma14.toFixed(0);
          }
        }
         function CalculoFilas()
         {
          var totalitem = document.getElementById("tActualizaciones").value
          var xcon1 = 0
          var xcon2 = 0
          var xcon3 = 0
          var xcon4 = 0
           var xcon6 = 0
          var xcon5 = 0
          var xvlrto = 0
          var xlp = 0
          var totaliva = 0
         for (i=1;i<=totalitem;i++)
          {
                      xcon1 = parseFloat(document.getElementById("salario[" + i+ "]").value)+ parseFloat(document.getElementById("tiempo[" + i+ "]").value);
                      xcon2 = parseFloat(document.getElementById("ayuda[" + i+ "]").value)+ parseFloat(document.getElementById("arp[" + i+ "]").value);
                      xcon3 = parseFloat(document.getElementById("eps[" + i+ "]").value) + parseFloat(document.getElementById("pension[" + i+ "]").value);
                      xcon4 = parseFloat(document.getElementById("cp[" + i+ "]").value) + parseFloat(document.getElementById("ps[" + i+ "]").value) + parseFloat(document.getElementById("vacacion[" + i+ "]").value);
                      xcon5 = parseFloat(document.getElementById("sena[" + i+ "]").value) + parseFloat(document.getElementById("icbf[" + i+ "]").value) + parseFloat(document.getElementById("AjusteParafiscal[" + i+ "]").value);
                      xcon6 = parseFloat(document.getElementById("admon[" + i+ "]").value)+ parseFloat(document.getElementById("tauxilio[" + i+ "]").value);
                     /* xlp = parseFloat(document.getElementById("iva").value);
                      xvlrto = (xcon1 + xcon2 + xcon3 + xcon4 + xcon5 + xcon6);
                      totaliva = (xvlrto * xlp)/100;
                      document.getElementById("admon[" + i+ "]").value =  totaliva.toFixed(0);*/
            }
        }
        function CalculoFilasAdmon()
         {
         var totalitem = document.getElementById("tActualizaciones").value;
         var xcon1 = 0;
         var xcon2 = 0 ;
         var xcon3 = 0;
         var  xcon4 = 0;
          var xcon6 = 0;
         var xcon5 = 0;
         var  xvlrto = 0;
         var  xlp = 0;
         var  totalAdmon = 0;
         for (i=1;i<=totalitem;i++)
          {
                      xcon1 = parseFloat(document.getElementById("salario[" + i+ "]").value)+ parseFloat(document.getElementById("tiempo[" + i+ "]").value);
                      xcon2 = parseFloat(document.getElementById("ayuda[" + i+ "]").value)+ parseFloat(document.getElementById("arp[" + i+ "]").value);
                      xcon3 = parseFloat(document.getElementById("eps[" + i+ "]").value) + parseFloat(document.getElementById("pension[" + i+ "]").value);
                      xcon4 = parseFloat(document.getElementById("cp[" + i+ "]").value) + parseFloat(document.getElementById("ps[" + i+ "]").value) + parseFloat(document.getElementById("vacacion[" + i+ "]").value);
                      xcon5 = parseFloat(document.getElementById("sena[" + i+ "]").value) + parseFloat(document.getElementById("icbf[" + i+ "]").value) + parseFloat(document.getElementById("AjusteParafiscal[" + i+ "]").value);
                      xcon6 = parseFloat(document.getElementById("tauxilio[" + i+ "]").value);
                      xlp = parseFloat(document.getElementById("admonV[" + i+ "]").value);
                      xvlrto = (xcon1 + xcon2 + xcon3 + xcon4 + xcon5 + xcon6);
                      totalAdmon = (xvlrto * xlp )/100;
                      document.getElementById("admon[" + i+ "]").value=  totalAdmon.toFixed(0);
            }
        }
  </script>
 </head>

<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4><u>Factura de Servicio</u></h4></center>
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
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' and estado='ACTIVA' order by zona ";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
    </tr>
    <tr>
            <td><b>Valor:</b></td>
               <td><select name="baseiva" class="cajasletra">
               <option value="10">10
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
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
else:
include ("../conexion.php");
      $consu="select zona.codzona,zona.zona,zona.codzona,zona.admon,zona.prestacion,zona.vacacion,zona.datos,zona.caja,zona.iva,zona.sena,zona.icbf,cobrozona.desde,cobrozona.hasta,cobrozona.codigo from zona,cobrozona
                where zona.codzona=cobrozona.codzona and
                   cobrozona.desde='$desde' and cobrozona.hasta='$hasta' and
                  zona.codzona='$campo'";
                 $resulta=mysql_query($consu) or die("Error en la busqueda de Items  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                   $xcontrol2=$filas_s ["caja"];
                   $xcontrol3=$filas_s ["prestacion"];
                   $xcontrol4=$filas_s ["admon"];
                   $admonV=$filas_s["datos"];
                   $vacacion=$filas_s ["vacacion"];
                   $iva=$filas_s ["iva"];
                    $sena=$filas_s ["sena"];
                    $icbf=$filas_s ["icbf"];
                   $codzona=$filas_s ["codzona"];
                   $zona=$filas_s ["zona"];
                   $codservi=$filas["codigo"];
                   $tbaseiva=$baseiva;
                   $CodigoIngreso = $filas_s["codigo"];
                    ?>
                    <center><h4>Modificar Factura de Servicio</h4></center>
                   <form name="f1" id="f1" action="grabarmodificadoparafiscal.php" method="post">
                   <td><input type="hidden" name="iva" value="<? echo $filas_s["iva"];?>"></td>
                   <td><input type="hidden" name="codigo" value="<? echo $filas_s["codigo"];?>"></td>
                   <table border="0" align="center">
                     <tr>
                       <td class="cajas"><b>Zona:</b>&nbsp;&nbsp;<? echo $filas_s["zona"];?></td>
                     </tr>
                       <tr class="cajas">
                       <td colspan="2"><b>Desde:</b>&nbsp;&nbsp;<? echo $filas_s["desde"];?><b>&nbsp;&nbsp;&nbsp;&nbsp;Hasta:</b>&nbsp;&nbsp;<? echo $filas_s["hasta"];?></td>
                     </tr>
                      <tr>
                       <td class="cajas"><b>Cod_Servicio:</b>&nbsp;&nbsp;<? echo $CodigoIngreso;?></td>
                     </tr>
                    </table>
                 <?
                endwhile;
              $consulta="select decobrozona.* from zona,cobrozona,decobrozona
                where  zona.codzona=cobrozona.codzona and
                 cobrozona.codigo=decobrozona.codigo and
                 cobrozona.desde='$desde' and cobrozona.hasta='$hasta' and
                 zona.codzona='$campo'";
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
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;</td>
                         <td>&nbsp;&nbsp;<? echo $xcontrol2;?>%</td>
                         <td>&nbsp;&nbsp;<? echo $sena;?>%</td>
                         <td>&nbsp;&nbsp;<? echo $icbf;?>%</td>
                         <td><? echo $xcontrol3;?>%</td>
                         <td><? echo $vacacion;?>%</td>
                          </tr>
                             <td class="cajas"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td><td><b>&nbsp;Cedula</b></td> <td class="cajas"><b>Empleado</b></td><td><b>Básico</b></td> <td class="cajas"><b>Tpo_Extra</b></td><td class="cajas"><b>T_Auxilio</b></td><td><b>Ayuda</b></td><td class="cajas"><b>Arp</b></td><td class="cajas"><b>Eps</b></td><td class="cajas"><b>Pensión</b></td><td class="cajas"><b>Caja</b></td><td class="cajas"><b>Sena</b></td><td class="cajas"><b>Icbf</b></td><td class="cajas"><b>Ces/Pri.</b></td><td class="cajas"><b>Vacación</b></td><td class="cajas"><b>A_Paraf.</b></td><td class="cajas"><b>Admon</b></td> <td class="cajas"><b>Nove_Ingreso</b></td> <td class="cajas"><b>Nove_Retiro</b></td><td class="cajas"><b>HIG</b></td><td class="cajas"><b>HIL</b></td><td class="cajas"><b>%Arl</b></td>
                          </tr>
                         <?
                          $i=1;
                         $fechap=date("Y-m-d");
                         echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resultado) . "\">");
                        while ($filas=mysql_fetch_array($resultado)):
                              $ayuda=$filas["ayuda"];
                              $tbase=$filas["tiempo"];
                              $tauxilio=$filas["tauxilio"];
                              $total1=$total1+$filas["basico"];
                              $total2=$total2+$filas["tiempo"];
                              $total3=$total3+$filas["tauxilio"];
                              $total4=$total4+$filas["ayuda"];
                              $total5=$total5+$filas["vlrarp"];
                              $total6=$total6+$filas["vlreps"];
                              $total7=$total7+$filas["vlrpension"];
                              $total8=$total8+$filas["cajac"];
                              $total9=$total9+$filas["vlrsena"];
                              $total10=$total10+$filas["vlricbf"];
                              $total11=$total11+$filas["ps"];
                              $total12=$total12+$filas["vacacion"];
                              $total13=$total13+$filas["admon"];
							  $total14=$total14+$filas["ajusteparafiscal"];
                             /* $total14=$total14+$filas["iva"];*/
                               ?>
                                <tr>
                                     <?
	                             echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['conse'] ."\"></td>");?>
	                             <input type="hidden" name="conse" value="<? echo $filas["conse"];?>" class="cajas">
                                     <td><input type="text" value="<? echo $filas["cedemple"];?>" name="cedula[<? echo $i;?>]" id="cedula[<? echo $i;?>]"  class="cajas" size="12" readonly></td>
	                                       <td><input type="text"  value="<? echo $filas["empleado"];?>" name="empleado[<? echo $i;?>]" id="empleado[<? echo $i;?>]" class="cajas" size="32" readonly></td>
	                                       <td><input type="text"  value="<? echo $filas["basico"];?>"name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]" class="cajas" size="10"></td>
	                                       <td><input type="text"  value="<? echo $filas["tiempo"];?>" name="tiempo[<? echo $i;?>]" id="tiempo[<? echo $i;?>]"class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["tauxilio"];?>" name="tauxilio[<? echo $i;?>]" id="tauxilio[<? echo $i;?>]"class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["ayuda"];?>" name="ayuda[<? echo $i;?>]" id="ayuda[<? echo $i;?>]" class="cajas" size="6"></td>
	                                      <td><input type="text"  value="<? echo $filas["vlrarp"];?>"name="arp[<? echo $i;?>]" id="arp[<? echo $i;?>]"class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["vlreps"];?>"name="eps[<? echo $i;?>]" id="eps[<? echo $i;?>]"class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["vlrpension"];?>"name="pension[<? echo $i;?>]" id="pension[<? echo $i;?>]"class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["cajac"];?>"name="cp[<? echo $i;?>]"id="cp[<? echo $i;?>]" class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["vlrsena"];?>"name="sena[<? echo $i;?>]"id="sena[<? echo $i;?>]" class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["vlricbf"];?>"name="icbf[<? echo $i;?>]"id="icbf[<? echo $i;?>]" class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["ps"];?>"name="ps[<? echo $i;?>]" id="ps[<? echo $i;?>]"class="cajas" size="7"></td>
                                            <td><input type="text"  value="<? echo $filas["vacacion"];?>"name="vacacion[<? echo $i;?>]" id="vacacion[<? echo $i;?>]"class="cajas" size="7"></td>
											 <td><input type="text"  value="<? echo $filas["ajusteparafiscal"];?>"name="AjusteParafiscal[<? echo $i;?>]" id="AjusteParafiscal[<? echo $i;?>]"class="cajas" size="7"></td>
	                                       <td><input type="text"  value="<? echo $filas["admon"];?>"name="admon[<? echo $i;?>]" id="admon[<? echo $i;?>]" class="cajas" size="7"></td>
                                               <td><input type="text"  value="<?echo $filas["novedadingreso"];?>" name="NovedadIngreso[<? echo $i;?>]" id="NovedadIngreso[<? echo $i;?>]" class="cajas" size="10"></td>
                                               <td><input type="text"  value="<?echo $filas["novedadretiro"];?>" name="NovedadRetiro[<? echo $i;?>]" id="NovedadRetiro[<? echo $i;?>]" class="cajas" size="10"></td>
                                               <td><input type="text"  value="<?echo $filas["diasincapacidadgeneral"];?>" name="DiasIG[<? echo $i;?>]" id="DiasIG[<? echo $i;?>]" class="cajas" size="4"></td>
                                               <td><input type="text"  value="<?echo $filas["diasincapacidadlaboral"];?>" name="DiasIL[<? echo $i;?>]" id="DiasIL[<? echo $i;?>]" class="cajas" size="4"></td>
                                               <td><input type="text"  value="<?echo $filas["nivelriesgo"];?>" name="NivelArl[<? echo $i;?>]" id="NivelArl[<? echo $i;?>]" class="cajas" size="6"></td>
                                               <input type="hidden"  value="<?echo $admonV;?>" name="admonV[<? echo $i;?>]" id="admonV[<? echo $i;?>]" size="6">
	                                     </tr>
	                                      <?
                              $i=$i+1;
                              endwhile;
							  $ContadorEmpleado = $i-1;
                         ?>
                           </table>
                            <table border="0" align="center">
                             <tr class="cajas">
                             <td><b>Nro</b></td><td><b>Básico</b></td><td><b>T_Extra</b></td><td><b>T_Auxilio</b></td><td><b>Ayuda</b></td><td><b>Arp</b></td><td><b>Eps</b></td><td><b>Pensión</b></td><td><b>Caja</b></td><td><b>Sena</b></td><td><b>Icbf</b></td><td><b>Cesa/Prima</b></td><td><b>Vacación</b></td><td><b>A_Paraf.</b></td><td><b>Admon</b></td>
                             </tr>
                              <tr>
                              <td class="cajas">&nbsp;<b><? echo $i-1?></b></td>
                              <td><input type="text" name="total1" value="<? echo $total1;?>" class="cajas" size="12" id="total1"></td>
                              <td><input type="text" name="total2" value="<? echo $total2;?>" class="cajas" size="12"  id="total2"></td>
                              <td><input type="text" name="total3" value="<? echo $total3;?>" class="cajas" size="12"  id="total3"></td>
                              <td><input type="text" name="total4" value="<? echo $total4;?>" class="cajas" size="11"  id="total4"></td>
                              <td><input type="text" name="total5" value="<? echo $total5;?>" class="cajas" size="11"  id="total5"></td>
                              <td><input type="text" name="total6" value="<? echo $total6;?>" class="cajas" size="11"  id="total6"></td>
                              <td><input type="text" name="total7" value="<? echo $total7;?>" class="cajas" size="11"  id="total7"></td>
                              <td><input type="text" name="total8" value="<? echo $total8;?>" class="cajas" size="9"  id="total8"></td>
                              <td><input type="text" name="total9" value="<? echo $total9;?>" class="cajas" size="9"  id="total9"></td>
                              <td><input type="text" name="total10" value="<? echo $total10;?>" class="cajas" size="9"  id="total10"></td>
                              <td><input type="text" name="total11" value="<? echo $total11;?>" class="cajas" size="9"  id="total11"></td>
                              <td><input type="text" name="total12" value="<? echo $total12;?>" class="cajas" size="9"  id="total12"></td>
							  <td><input type="text" name="total14" value="<? echo $total14;?>" class="cajas" size="9"  id="total14"></td>
                              <td><input type="text" name="total13" value="<? echo $total13;?>" class="cajas" size="9"  id="total13"></td>
                              <input type="hidden"  value="<?echo $iva;?>" name="ValorIva" id="ValorIva" size="6">
                              <input type="hidden"  value="<?echo $CodigoIngreso;?>" name="CodigoIngreso" id="CodigoIngreso" size="6">
							  <input type="hidden"  value="<?echo $ContadorEmpleado;?>" name="ContadorEmpleado" id="ContadorEmpleado" size="6">
                             </tr>
                             </table>
                             <table border="0" align="center">
                             <tr><td><input type="button" value="Calcular Columna" name="calcular" onClick="validar()"></td>
                             <?if($admonV==0):
                             ?>
                             <td><input type="button" value="Calcular Filas" name="calculofilas" onClick="CalculoFilas()"></td></tr></table>
                             <?else:
                             ?>
                              <td><input type="button" value="Calcular Filas" name="calculofilas" onClick="CalculoFilasAdmon()"></td></tr></table>
                             <?endif;?>
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
                              <td><input type="text" name="total" value="0" class="cajas" size="11" onclick="calculo()"  id="total"></td>
                              <td><input type="text" name="incapacidad" value="0" class="cajas" size="11"  id="incapacidad"></td>
                              <td><input type="text" name="anticipo" value="0" class="cajas" size="11"  id="anticipo"></td>
                              <td><input type="text" name="otro" value="0" class="cajas" size="11"  id="otro"></td>
                              <td><input type="text" name="ajuste" value="0" class="cajas" size="11"  id="ajuste"></td>
                              <td><input type="text" name="menor" value="0" class="cajas" size="11"  id="menor"></td>
                              <td><input type="hidden" name="tbaseiva" value="<?echo $tbaseiva;?>" class="cajas" size="11"  id="tbaseiva"></td>
                              <td><input type="hidden" name="vlriva" value="<?echo $vlriva;?>" class="cajas" size="11"  id="vlriva"></td>
                             </tr>
                             <tr class="cajas">
                             <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b>SUBTOTAL</b></td> <td><b>BASE_IVA</b></td><td><b>IVA</b></td><td><b>GRAN TOTAL</b></td>
                             </tr>
                             <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><input type="text" name="subtotal" value=" " class="cajas" size="11" onclick="calculo2()" onFocus="calculo2()"  id="subtotal"></td>
                              <td><input type="text" name="ValorBase" value="" class="cajas" size="11"  onclick="BaseIva()" onFocus="BaseIva()"  id="ValorBase"></td>
                              <td><input type="text" name="IvaPagar" value="" class="cajas" size="11"  onclick="ivapagar()" onFocus="ivapagar()"  id="IvaPagar"></td>
                              <td><input type="text" name="GranTotal" value="" class="cajas" size="11" onclick="totalvalor()" onFocus="totalvalor()"  id="GranTotal"></td>
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
                         <input type="hidden" value="<?echo $i;?>" name="i" class="cajas"size="11" maxlength="11">
						  <input type="hidden" value="" name="TotalSinAdmon" class="cajas"size="11" maxlength="11" id="TotalSinAdmon">
                    </form>
       <?
 endif;
       ?>


</body>
</html>
