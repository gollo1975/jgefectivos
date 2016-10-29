<html>

<head>
  <title>Facturar por nivel de Riesgo</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script type="text/javascript">
  function divColorChange(){
    document.getElementById('myDiv').style.color = '#FF0000';
    }
      function validar(){
         var totalitem = document.getElementById("tActualizaciones").value;
         var sumaR = 0;
         var sumaR1 = 0;
         var sumaR2 = 0;
         var sumaR3 = 0;
         var sumaR4 = 0;
         var sumaR5 = 0;
         var sumaR6 = 0;
         var sumaR7 = 0;
         var sumaR8 = 0;
         var sala = 0;
         var tiempoE = 0;
         var tiempo = 0;
         var AyudaT = 0;
        for (k=1;k<=totalitem;k++){
           sala +=  parseFloat(document.getElementById("salario[" + k + "]").value);
           tiempoE +=  parseFloat(document.getElementById("tiempo[" + k + "]").value);
           tiempo +=  parseFloat(document.getElementById("tauxilio[" + k + "]").value);
           AyudaT +=  parseFloat(document.getElementById("ayuda[" + k + "]").value);
           sumaR +=  parseFloat(document.getElementById("arp[" + k + "]").value);
           sumaR1 += parseFloat(document.getElementById("eps[" + k + "]").value);
           sumaR2 += parseFloat(document.getElementById("pension[" + k + "]").value);
           sumaR3 += parseFloat(document.getElementById("cp[" + k + "]").value);
           sumaR4 += parseFloat(document.getElementById("sena[" + k + "]").value);
           sumaR5 += parseFloat(document.getElementById("icbf[" + k + "]").value);
           sumaR6 += parseFloat(document.getElementById("ps[" + k + "]").value);
           sumaR7 += parseFloat(document.getElementById("vacacion[" + k + "]").value);
           sumaR8 += parseFloat(document.getElementById("admon[" + k + "]").value);
          f1.total1.value = sala;
          f1.total2.value = tiempoE;
          f1.total3.value = tiempo;
          f1.total4.value = AyudaT;
          f1.total5.value = sumaR;
          f1.total6.value = sumaR1;
          f1.total7.value = sumaR2;
          f1.total8.value = sumaR3;
          f1.total9.value = sumaR4;
          f1.total10.value = sumaR5;
          f1.total11.value = sumaR6;
          f1.total12.value = sumaR7;
          f1.total13.value = sumaR8;
         }
      }
      function CalculoFilas(){
          var totalitem = document.getElementById("tActualizaciones").value;
          var xcon = 0;
          var xcon1 = 0;
         var xcon2 = 0;
         var xcon3 = 0;
         var xcon4 = 0;
         var xcon5 = 0;
         var xcon6 = 0;
         var xcon7 = 0;
         var aux = 0;
         var xvlrto = 0;
         var totaladmon = 0;
         var nEle = document.f1.elements.length;
         for (i=0; i<nEle; i++) {
                 if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	         }
               }
         for (k=1;k<=totalitem;k++){
               xcon = parseFloat(document.getElementById("salario[" + k+ "]").value)+ parseFloat(document.getElementById("tiempo[" + k+ "]").value);
               xcon1 = parseFloat(document.getElementById("ayuda[" + k+ "]").value)+ parseFloat(document.getElementById("arp[" + k+ "]").value);
               xcon2 = parseFloat(document.getElementById("eps[" + k+ "]").value)+ parseFloat(document.getElementById("pension[" + k+ "]").value);
               xcon3 = parseFloat(document.getElementById("cp[" + k+ "]").value) + parseFloat(document.getElementById("ps[" + k+ "]").value)+ parseFloat(document.getElementById("vacacion[" + k+ "]").value);
               xcon4 = parseFloat(document.getElementById("sena[" + k+ "]").value) + parseFloat(document.getElementById("icbf[" + k+ "]").value);
               xcon5 = parseFloat(document.getElementById("tauxilio[" + k+ "]").value);
               aux = parseFloat(document.getElementById("valor").value);
               if(aux==0){
                 }else{
                  xvlrto = (xcon + xcon1 + xcon2 + xcon3 + xcon4 +xcon5);
                  totaladmon = parseFloat(xvlrto * aux)/100;
                  document.getElementById("admon[" + k+ "]").value =  totaladmon.toFixed(0);
                }
            }
        }
     function calculo()
       {
       var uno = 0;
       var dos = 0;
       var tres = 0;
       var cuatro = 0;
       var cinco = 0;
       var seis = 0;
       var totalF = 0;
       uno = parseFloat(document.getElementById("total1").value)+ parseFloat(document.getElementById("total2").value);
       dos = parseFloat(document.getElementById("total3").value) + parseFloat(document.getElementById("total4").value);
       tres = parseFloat(document.getElementById("total5").value) + parseFloat(document.getElementById("total6").value);
       cuatro = parseFloat(document.getElementById("total7").value) + parseFloat(document.getElementById("total8").value);
       cinco = parseFloat(document.getElementById("total9").value) + parseFloat(document.getElementById("total10").value);
       seis= parseFloat(document.getElementById("total11").value) + parseFloat(document.getElementById("total12").value) + parseFloat(document.getElementById("total13").value);
       totalF = parseFloat(uno+dos+tres+cuatro+cinco+seis);
       document.getElementById("total").value= totalF.toFixed(0);
       }
     function calculo2()
       {
       var Sum = 0;
       var Sum1 = 0;
       var Sum2 = 0;
       var Sum3 = 0;
       Sum = parseFloat(document.getElementById("total").value) + parseFloat(document.getElementById("incapacidad").value);
       Sum1 = parseFloat(document.getElementById("anticipo").value) + parseFloat(document.getElementById("otro").value);
       Sum2 = parseFloat(document.getElementById("ajuste").value) + parseFloat(document.getElementById("menor").value);
       Sum3 = parseFloat(Sum+Sum1+Sum2);
       document.getElementById("subtotal").value= Sum3.toFixed(0);
       }
       function BaseIva()
       {
       var uno = 0;
       var dos = 0;
       var tres = 0
       uno = parseFloat(document.getElementById("subtotal").value);
       tiva = parseFloat(document.getElementById("tbaseiva").value);
       tres = parseFloat (uno * tiva)/100;
       document.getElementById("vlrbase").value= tres.toFixed(0);
       }
       function ivapagar()
       {
       var iva = 0;
       var porce = 0;
       var total = 0;
       iva = parseFloat(document.getElementById("vlrbase").value);
       porce = parseFloat(document.getElementById("vlriva").value);
       total = parseFloat(iva* porce)/100;
       document.getElementById("ivato").value= total.toFixed(0);
       }
       function totalvalor()
      {
      var var1 = 0;
      var var2 = 0;
      var1 = parseFloat(document.getElementById("ivato").value);
      var2 = parseFloat(var1)+ parseFloat(document.getElementById("subtotal").value);
      document.getElementById("grantotal").value = var2.toFixed(0);
      }
  </script>
 </head>

<?
  if (!isset($CodZona)):
     include("../conexion.php");
  ?>
  <center><h4><u>Facturación del Servicio</u></h4></center>
<form name="finicio" id="finicio" action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
   <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="CodZona" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' and zona.estado='ACTIVA' order by zona";
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
       <tr>
     <td><b>Pago_Nómina</b></td>
          <td><select name="TotalFecha" class="cajas">
          <option value="0">Seleccione forma de pago
          <option value="7">SEMANAL
          <option value="10">DECADAL
          <option value="14">CATORCENAL
          <option value="15">QUINCENAL
          <option value="30">MENSUAL
          </select></td>
      </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($CodZona)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
elseif (empty($TotalFecha)):
?>
  <script language="javascript">
    alert ("Seleccione el tipo de pago de nómina")
    history.back()
  </script>
    <?
else:
  include ("../conexion.php");
   $ConR="select cobrozona.desde,cobrozona.hasta from cobrozona
                where cobrozona.codzona='$CodZona' and
                   cobrozona.desde='$Desde' and cobrozona.hasta='$Hasta'";
   $resV=mysql_query($ConR) or die("Error al buscar duplicidad  ");
   $RegV=mysql_num_rows($resV);
   if($RegV==0):
     $consu="select zona.codzona,zona.zona,zona.codzona,zona.admon,zona.prestacion,zona.caja,zona.vacacion,zona.iva,zona.datos,zona.factura,zona.sena,zona.icbf,periodo.desde,periodo.hasta from zona,periodo
                where zona.codzona=periodo.codzona and
                   periodo.desde='$Desde' and periodo.hasta='$Hasta' and
                  zona.codzona='$CodZona'";
     $resulta=mysql_query($consu) or die("Error en la busqueda de zonas  ");
     $reg=mysql_num_rows($resulta);
     $filas_s=mysql_fetch_array($resulta);
     if($reg!=0):
             $vlrcaja=$filas_s["caja"];
             $vlrprestacion=$filas_s["prestacion"];
             $vlrvacacion=$filas_s["vacacion"];
             $vlradmon=$filas_s["admon"];
             $vlrsena=$filas_s["sena"];
             $vlricbf=$filas_s["icbf"];
             $vlriva=$filas_s ["iva"];
             $codzona=$filas_s ["codzona"];
             $zona=$filas_s ["zona"];
             $factura=$filas_s["factura"];
             $valor=$filas_s["datos"];
             $AdmonFija=$filas_s["admon"];
             $tbaseiva=$baseiva;
             ?>
              <center><h4><u>Facturacion del Servicio</u></h4></center>
              <form name="f1" id="f1" action="guardarzonacaja.php" method="post">
                  <td><input type="hidden" name="iva" value="<? echo $filas_s["iva"];?>"></td>
                  <td><input type="hidden" name="valor" value="<? echo $valor;?>"></td>
                  <input type="hidden" value="<?echo $CodZona;?>" name="CodZona" class="cajas"size="11" maxlength="11">
                  <input type="hidden" value="<?echo $zona;?>" name="zona" class="cajas"size="50" maxlength="50">
                  <input type="hidden" value="<?echo $Desde;?>" name="Desde" class="cajas"size="11" maxlength="11">
                  <input type="hidden" value="<?echo $Hasta;?>" name="Hasta" class="cajas"size="11" maxlength="11">
                  <input type="hidden" value="<?echo $fechap;?>" name="fechap" class="cajas"size="11" maxlength="11">
                  <td><input type="hidden" name="valor" value="<? echo $valor;?>"></td>
                   <td><input type="hidden" name="Xestado" value="2"></td>
                  <table border="0" align="center">
                     <tr>
                         <td class="cajas"><b>Zona:</b>&nbsp;&nbsp;<? echo $filas_s["zona"];?></td>
                     </tr>
                     <tr class="cajas">
                         <td colspan="2"><b>Desde:</b>&nbsp;&nbsp;<? echo $filas_s["desde"];?><b>&nbsp;&nbsp;&nbsp;&nbsp;Hasta:</b>&nbsp;&nbsp;<? echo $filas_s["hasta"];?></td>
                     </tr>
                  </table>
                  <?
                  $consulta="select maestro.codmaestro,maestro.dvmaestro,maestro.nomaestro,sucursal.sucursal,zona.zona,empleado.periodo,empleado.cedemple,empleado.vlrpagado,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.nivel,empleado.vlrpagado,empleado.eps,empleado.pension,
                              nomina.consecutivo,contrato.cargo,contrato.fechainic from maestro,nomina,empleado,sucursal,zona,periodo,contrato
                                where maestro.codmaestro=sucursal.codmaestro and
                                 sucursal.codsucursal=zona.codsucursal and
                                 zona.codzona=empleado.codzona and
                                 zona.codzona=periodo.codzona and
                                 empleado.cedemple=nomina.cedemple and
                                 empleado.codemple=contrato.codemple and
                                 contrato.fechater='0000-00-00' and
                                 periodo.codigo=nomina.codigo and
                                 periodo.desde='$Desde' and periodo.hasta='$Hasta' and
                                 zona.codzona='$CodZona' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
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
                             <td>&nbsp;</b></td>
                             <td>&nbsp;</b></td>
                             <td>&nbsp;</b></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><? echo $vlrcaja;?>%</td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><? echo $vlrprestacion;?>%</b></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><? echo $vlrvacacion;?>%</b></td>
                             <td>&nbsp;&nbsp;&nbsp;&nbsp;<b><? echo $valor;?>%</b></td>
                             </tr>
                                <th><b>Cedula</b></th><th><b>Empleado</b></th><th><b>Básico</b></th> <th class="cajas"><b>Tpo_Extra</b></th><th><b>T.Auxilio</b></th><th><b>Ayuda</b></th><th class="cajas"><b>Arp</b></th><th class="cajas"><b>Eps</b></th><th class="cajas"><b>Pensión</b></th><th class="cajas"><b>Caja</b></th><th class="cajas"><b>Cesa_Prima</b></th><th class="cajas"><b>Vacación</b></th><th class="cajas"><b>Admon</b></th> <th class="cajas"><b>Nov/Ret</b></th><th class="cajas"><b>F_Ingreso.</b></th><th class="cajas"><b>N_Arp</b></th><th class="cajas"><b>Sala_Quin</b></th>
                             </tr><?
                             $i=1;
                             $fechap=date("Y-m-d");
                             echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . $registros . "\">");
                             while ($filas=mysql_fetch_array($resultado)):
                                  $retiro=0;
                                  $vlrbasico=$filas["vlrpagado"];
                                  $vlreps=$filas["eps"];
                                  $vlrpension=$filas["pension"];
                                  $vlrarp=$filas["nivel"];
                                  $documento=$filas["cedemple"];
                                  $Fcontrato=$filas["fechainic"];
                                  $Bsalario=$filas["vlrpagado"];
                                  $CodNomina=$filas["consecutivo"];
                                  /*codigo aparte*/
                                    $Inicio=substr($Desde,8,2);
                                    $Final=substr($Hasta,8,2);
                                    $TotalFecha=($Final-$Inicio)+1;
                                 /*fin codigo*/
                                  $con="select nomina.cedemple from nomina where nomina.cedemple='$documento'";
				  $res=mysql_query($con)or die ("Error de consulta");
				  $reg=mysql_affected_rows();
                                  if($reg > 1):
                                      $conR="select retiroprovision.fechare,retiroprovision.dias from retiroprovision
                                      where retiroprovision.cedemple='$documento' and
                                      retiroprovision.fechare >= '$Desde' and retiroprovision.fechare between '$Desde' and '$Hasta'";
				      $resR=mysql_query($conR)or die ("Error en la busqueda de retiro");
				      $regR=mysql_affected_rows();
                                      $filaR=mysql_fetch_array($resR);
                                      $DiasR=$filaR["dias"];
                                      if($regR==0):
                                         $resta=$TotalFecha;
                                         $SalarioBasico=round(($Bsalario/$TotalFecha)*$resta);
			                 $Tcaja=round(((($Bsalario/$TotalFecha)*$resta)*$vlrcaja)/100);
                                         $Tarp=round(((($Bsalario/$TotalFecha)*$resta)*$vlrarp)/100);
                                         $Teps=round(((($Bsalario/$TotalFecha)*$resta)*$vlreps)/100);
                                         $Tpension=round(((($Bsalario/$TotalFecha)*$resta)*$vlrpension)/100);
                                         $Tsena=round(((($Bsalario/$TotalFecha)*$resta)*$vlrsena)/100);
                                         $Ticbf=round(((($Bsalario/$TotalFecha)*$resta)*$vlricbf)/100);

                                      else:
                                           $FinalR=$filaR["fechare"];
			                   $diaRet=substr($FinalR,8,2);
                                           $Finicio=substr($desde,8,2);
                                           $Tretiro=($diaRet-$Finicio)+1;
                                            $SalarioBasico=round(($Bsalario/$TotalFecha)*$DiasR);
                                          $Tcaja=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrcaja)/100);
                                         $Tarp=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrarp)/100);
                                         $Teps=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlreps)/100);
                                         $Tpension=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrpension)/100);
                                         $Tsena=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrsena)/100);
                                         $Ticbf=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlricbf)/100);
                                           $retiro=1;

                                      endif;
                                  else:
                                       $conT="select retiroprovision.fechare,retiroprovision.dias from retiroprovision
                                       where retiroprovision.cedemple='$documento' and
                                       retiroprovision.fechare >= '$Desde' and
                                       retiroprovision.fechare between '$Desde' and '$Hasta' ";
				       $resT=mysql_query($conT)or die ("Error en la busqueda de retiro");
				       $regT=mysql_affected_rows();
                                       $filaT=mysql_fetch_array($resT);
                                       $DiasR=$filaT["dias"];
                                       if($regT != 0):
                                           $FinalR=$filaT["fechare"];
			                   $diaT=substr($Fcontrato,8,2);
			                   $calculo=substr($FinalR,8,2);
			                   $restaT=($calculo-$diaT)+1;
                                            $SalarioBasico=round(($Bsalario/$TotalFecha)*$DiasR);
                                           $Tcaja=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrcaja)/100);
                                           $Tarp=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrarp)/100);
                                           $Teps=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlreps)/100);
                                           $Tpension=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrpension)/100);
                                           $Tsena=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlrsena)/100);
	                                   $Ticbf=round(((($Bsalario/$TotalFecha)*$DiasR)*$vlricbf)/100);
                                           $retiro=1;

                                       else:
                                                                      /*otro codigo*/
                                           $DatoInicio=substr($Fcontrato,8,2);
                                           $DatoFinal=substr($hasta,8,2);
                                           $TotalDato=($DatoFinal-$DatoInicio)+1;
                                                                      /*fin codigo*/
                                           $SalarioBasico=round(($Bsalario/$TotalFecha)*$TotalDato);
                                           $Tcaja=round(((($Bsalario/$TotalFecha)*$TotalDato)*$vlrcaja)/100);
                                           $Tarp=round(((($Bsalario/$TotalFecha)*$TotalDato)*$vlrarp)/100);
                                           $Teps=round(((($Bsalario/$TotalFecha)*$TotalDato)*$vlreps)/100);
                                           $Tpension=round(((($Bsalario/$TotalFecha)*$TotalDato)*$vlrpension)/100);
                                           $Tsena=round(((($Bsalario/$TotalFecha)*$TotalDato)*$vlrsena)/100);
	                                   $Ticbf=round(((($Bsalario/$TotalFecha)*$TotalDato)*$vlricbf)/100);

                                       endif;
                                  endif;

                                    /*codigo de seleccion de nomina*/
                                    $Transporte=0; $SalarioPresta=0; $SalarioNoPresta=0; $PorHora=0; $Licencia=0;$TiempoExtra=0; $Incapacidad=0; $TiempoUno=0;$AuxilioTra=0; $ComisionP=0;$ComisionNP=0;$Porcentaje=0;$DiaP=0;$DiaInca;
	                            $ConN="SELECT denomina.salario 'Devengado',denomina.prestacion 'Cont',denomina.porcentaje,salario.formapago,salario.totalhoras,salario.licencia,denomina.nrohora
	                                FROM  denomina,nomina,salario
	                                WHERE  nomina.consecutivo = denomina.consecutivo and
                                               denomina.codsala=salario.codsala and
	                                       denomina.consecutivo='$CodNomina' group by denomina.codsala" ;
	                            $ReN=mysql_query($ConN)or die ("Error al buscar detalle de Colillas");
	                            while ($filaS=mysql_fetch_array($ReN)):
                                          $Presta=$filaS["Cont"];
                                          $PorHora=$filaS["totalhoras"];
                                          $FormaPago=$filaS["formapago"];
                                          $Positivo=$filaS["Devengado"];
                                          $Porcentaje=$filaS["porcentaje"];
                                          $NroHora= $filaS["nrohora"];
                                          $LM=$filaS["licencia"];
                                           /*codigo tiempo suplementario*/
                                          if($Presta=='SI' and $FormaPago=='HORAS' and $Porcentaje>0 and $PorHora=='NO' ):
                                               $TiempoUno=$TiempoUno+$Positivo;
                                          endif;
                                           if($Presta=='SI' and $FormaPago=='HORAS' and $Porcentaje>0 and $PorHora=='IGUAL' ):
                                               $TiempoExtra=$TiempoExtra+$Positivo;
                                          endif;
                                            /*codigo de Salarios*/
                                          if($Presta=='SI' and $PorHora=='SI'):
                                             $Salario=$Positivo;
                                             $DiaP=$NroHora;
                                          endif;
                                          if($Presta=='SI' and $LM=='SI'):
                                             $Licencia=$Licencia+$Positivo;
                                          endif;
                                          if($Presta=='SI' and $PorHora=='ING'):
                                             $Incapacidad=$Incapacidad+$Positivo;
                                             $DiaInca=$DiaInca+$NroHora;
                                          endif;
                                          /*codigo para Comision Prestacion*/
                                          if($Presta=='SI' and $FormaPago=='COMISION'):
                                             $ComisionP=$ComisionP+$Positivo;
                                          endif;
                                          /*codigigo para comision no prestacional*/
                                          if($Presta=='NO' and $FormaPago=='COMISION'):
                                             $ComisionNP=$ComisionNP+$Positivo;
                                          endif;
                                          /*codigigo para para auxilio de Transporte*/
                                          if($Presta=='NO' and $FormaPago=='DIAS'):
                                             $AuxilioTra=$Positivo;
                                          endif;
                                    endwhile;
                                    /*variables*/
                                    $TotalS=($Salario+$Licencia+$Incapacidad);
                                    $VlrTotalT=($TiempoUno+$ComisionP+$TiempoExtra);
                                    $VlrTotalA=($ComisionNP);
                                    $AuxilioT=($AuxilioTra);
                                    /*fin variables*/
                                    /*acumulador*/
                                      $SalarioT=$SalarioT+$TotalS;
                                      $TiempoP=$TiempoP+$VlrTotalT;
                                      $TiempoNP=$TiempoNP+$VlrTotalA;
                                      $AyudaT=$AyudaT+$AuxilioT;
                                      $SalarioPagado=$filas["vlrpagado"];
                                    /*fin acumulador*/
                                         if($valor==0 and $AdmonFija==0):
	                                           ?>
				                  <script language="javascript">
				                     alert("No se ha definido el porcentaje de la administracion!")
				                     history.back()
				                  </script>
				                   <?
                                          else:
                                                  if($AdmonFija==0):
                                                       $TotalArl=round((($SalarioBasico+$VlrTotalT)*$vlrarp)/100);
                                                       $Teps=round((($SalarioBasico+$VlrTotalT)*$vlreps)/100);
                                                       $Tpension=round((($SalarioBasico+$VlrTotalT)*$vlrpension)/100);
                                                       $Tcaja=round((($SalarioBasico+$VlrTotalT)*$vlrcaja)/100);
                                                       $Tsena=round((($SalarioBasico+$VlrTotalT)*$vlrsena)/100);
                                                       $Ticbf=round((($SalarioBasico+$VlrTotalT)*$vlricbf)/100);
                                                       $Tprestacion=round((($SalarioBasico+$VlrTotalT+$AuxilioT)*$vlrprestacion)/100);
                                                       $Tvacacion=round((($SalarioBasico)*$vlrvacacion)/100);
                                                       $Tadmon=round((($TotalS + $VlrTotalT + $VlrTotalA + $AuxilioT + $Tarp + $Teps +$Tpension +$Tcaja +$Tsena +$Ticbf + $Tprestacion + $Tvacacion)*$valor)/100);
                                                       $ArpT=$ArpT+$Tarp;
                                                       $EpsT=$EpsT+$Teps;
                                                       $PensionT=$PensionT+$Tpension;
                                                       $CajaT=$CajaT+$Tcaja;
                                                       $SenaT=$SenaT+$Tsena;
                                                       $IcbfT=$IcbfT+$Ticbf;
                                                       $PrestacionT=$PrestacionT+$Tprestacion;
                                                       $VacacionT=$VacacionT+$Tvacacion;
                                                       $AdmonT=$AdmonT+$Tadmon;

                                                       ?>
  	                                               <tr>
	                                               <?
	                                               echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['cedemple'] ."\"\">" .$filas['cedemple']."</td>");?>
	                                                 <input type="hidden" name="cedula" value="<? echo $filas["cedemple"];?>" class="cajas" size="12" readonly>
	                                                 <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"name="empleado[<? echo $i;?>]" id="empleado[<? echo $i;?>]" class="cajas" size="32" readonly></td>
	                                                 <td><input type="text"  value="<? echo $TotalS;?>"name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]" class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<?echo round($VlrTotalT,0);?>" name="tiempo[<? echo $i;?>]" id="tiempo[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<?echo round($VlrTotalA,0);?>" name="tauxilio[<? echo $i;?>]" id="tauxilio[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<?echo round($AuxilioT,0);?>" name="ayuda[<? echo $i;?>]" id="ayuda[<? echo $i;?>]" class="cajas" size="6"></td>
	                                                 <td><input type="text"  value="<? echo round($TotalArl,0);?>"name="arp[<? echo $i;?>]" id="arp[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Teps,0);?>"name="eps[<? echo $i;?>]" id="eps[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Tpension,0);?>"name="pension[<? echo $i;?>]" id="pension[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Tcaja,0);?>"name="cp[<? echo $i;?>]"id="cp[<? echo $i;?>]" class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Tprestacion,0);?>"name="ps[<? echo $i;?>]" id="ps[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<? echo round($Tvacacion,0);?>"name="vacacion[<? echo $i;?>]" id="vacacion[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<? echo round($Tadmon,0);?>"name="admon[<? echo $i;?>]" id="admon[<? echo $i;?>]" class="cajas" size="7"></td>
	                                                 <?if ($retiro==0):?>
	                                                     <td><input type="text"  value="" name="nove[<? echo $i;?>]" id="nove[<? echo $i;?>]" class="cajas" size="10"></td>
	                                                 <?else:?>
	                                                     <td><input class="ValidarCajasR" type="text"  value="<?echo $FinalR;?>" name="nove[<? echo $i;?>]" id="nove[<? echo $i;?>]" class="cajas" size="10"></td>
	                                                 <?endif;?>
	                                                 <td><input type="text"  value="<? echo $filas["fechainic"];?>"  class="cajas" size="10" readonly></td>
	                                                 <td><input type="text"  value="<? echo $filas["nivel"];?>" name="parp[<? echo $i;?>]" id="parp[<? echo $i;?>]" class="cajas" size="7" readonly></td>
                                                            <?if($TotalS < $SalarioPagado):?>
                                                             <td><input class="ValidarCajas" type="text"  value="<? echo $filas["vlrpagado"];?>" name="Pagado[<? echo $i;?>]" id="Pagado[<? echo $i;?>]" size="10" readonly></td>
                                                        <?else:?>
                                                          <td><input type="text"  value="<? echo $filas["vlrpagado"];?>" name="Pagado[<? echo $i;?>]" id="Pagado[<? echo $i;?>]" class="cajas" size="10" readonly ></td>
                                                       <?endif;?>
	                                                 <td><input type="hidden"  value="<? echo $filas["eps"];?>" name="peps[<? echo $i;?>]" id="peps[<? echo $i;?>]" class="cajas" size="5" readonly></td>
	                                                 <td><input type="hidden"  value="<? echo $filas["pension"];?>" name="ppension[<? echo $i;?>]" id="ppension[<? echo $i;?>]" class="cajas" size="10" readonly></td>
	                                                 <td><input type="hidden"  value="<? echo $filas["cargo"];?>" name="cargo[<? echo $i;?>]" id="cargo[<? echo $i;?>]" class="cajas" size="6" readonly></td>
                                                          <td><input type="hidden"  value="<? echo round($Tsena,0);?>"name="sena[<? echo $i;?>]" id="sena[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="hidden"  value="<? echo round($Ticbf,0);?>"name="icbf[<? echo $i;?>]" id="icbf[<? echo $i;?>]"class="cajas" size="7"></td>
	                                            </tr>
                                                  <?
                                                  $m=$m+1;
                                                  else:
                                                       $TotalArl=round((($SalarioBasico+$VlrTotalT)*$vlrarp)/100);
                                                       $Teps=round((($SalarioBasico+$VlrTotalT)*$vlreps)/100);
                                                       $Tpension=round((($SalarioBasico+$VlrTotalT)*$vlrpension)/100);
                                                       $Tcaja=round((($SalarioBasico+$VlrTotalT)*$vlrcaja)/100);
                                                       $Tsena=round((($SalarioBasico+$VlrTotalT)*$vlrsena)/100);
                                                       $Ticbf=round((($SalarioBasico+$VlrTotalT)*$vlricbf)/100);
                                                       $Tprestacion=round((($SalarioBasico+$VlrTotalT+$AuxilioT)*$vlrprestacion)/100);
                                                       $Tvacacion=round((($SalarioBasico+$VlrTotalT)*$vlrvacacion)/100);
                                                       $Tadmon=$AdmonFija;
                                                       $ArpT=$ArpT+$Tarp;
                                                       $EpsT=$EpsT+$Teps;
                                                       $PensionT=$PensionT+$Tpension;
                                                       $CajaT=$CajaT+$Tcaja;
                                                       $SenaT=$SenaT+$Tsena;
                                                       $IcbfT=$IcbfT+$Ticbf;
                                                       $PrestacionT=$PrestacionT+$Tprestacion;
                                                       $VacacionT=$VacacionT+$Tvacacion;
                                                       $AdmonT=$AdmonT+$Tadmon;
                                                       ?>
  	                                               <tr>
	                                               <?
	                                               echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['cedemple'] ."\"\">" .$filas['cedemple']."</td>");?>
	                                                 <input type="hidden" name="cedula" value="<? echo $filas["cedemple"];?>" class="cajas" size="12" readonly>
	                                                 <td><input type="text"  value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"name="empleado[<? echo $i;?>]" id="empleado[<? echo $i;?>]" class="cajas" size="32" readonly></td>
	                                                 <td><input type="text"  value="<? echo $TotalS;?>"name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]" class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<?echo round($VlrTotalT,0);?>" name="tiempo[<? echo $i;?>]" id="tiempo[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<?echo round($VlrTotalA,0);?>" name="tauxilio[<? echo $i;?>]" id="tauxilio[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<?echo round($AuxilioT,0);?>" name="ayuda[<? echo $i;?>]" id="ayuda[<? echo $i;?>]" class="cajas" size="6"></td>
	                                                 <td><input type="text"  value="<? echo round($TotalArl,0);?>"name="arp[<? echo $i;?>]" id="arp[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Teps,0);?>"name="eps[<? echo $i;?>]" id="eps[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Tpension,0);?>"name="pension[<? echo $i;?>]" id="pension[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Tcaja,0);?>"name="cp[<? echo $i;?>]"id="cp[<? echo $i;?>]" class="cajas" size="7"></td>
	                                                 <td><input type="text"  value="<? echo round($Tprestacion,0);?>"name="ps[<? echo $i;?>]" id="ps[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<? echo round($Tvacacion,0);?>"name="vacacion[<? echo $i;?>]" id="vacacion[<? echo $i;?>]"class="cajas" size="8"></td>
	                                                 <td><input type="text"  value="<? echo round($Tadmon,0);?>"name="admon[<? echo $i;?>]" id="admon[<? echo $i;?>]" class="cajas" size="7"></td>
	                                                 <?if ($retiro==0):?>
	                                                     <td><input type="text"  value="" name="nove[<? echo $i;?>]" id="nove[<? echo $i;?>]" class="cajas" size="10"></td>
	                                                 <?else:?>
	                                                     <td><input class="ValidarCajasR" type="text"  value="<?echo $FinalR;?>" name="nove[<? echo $i;?>]" id="nove[<? echo $i;?>]" class="cajas" size="10"></td>
	                                                 <?endif;?>
	                                                 <td><input type="text"  value="<? echo $filas["fechainic"];?>"  class="cajas" size="10" readonly></td>
	                                                 <td><input type="text"  value="<? echo $filas["nivel"];?>" name="parp[<? echo $i;?>]" id="parp[<? echo $i;?>]" class="cajas" size="7" readonly></td>
                                                         <?if($TotalS < $SalarioPagado):?>
                                                             <td><input class="ValidarCajas" type="text"  value="<? echo $filas["vlrpagado"];?>" name="Pagado[<? echo $i;?>]" id="Pagado[<? echo $i;?>]"  size="10" readonly></td>
                                                        <?else:?>
                                                          <td><input type="text"  value="<? echo $filas["vlrpagado"];?>" name="Pagado[<? echo $i;?>]" id="Pagado[<? echo $i;?>]" class="cajas" size="10" readonly ></td>
                                                       <?endif;?>
	                                                 <td><input type="hidden"  value="<? echo $filas["eps"];?>" name="peps[<? echo $i;?>]" id="peps[<? echo $i;?>]" class="cajas" size="5" readonly></td>
	                                                 <td><input type="hidden"  value="<? echo $filas["pension"];?>" name="ppension[<? echo $i;?>]" id="ppension[<? echo $i;?>]" class="cajas" size="10" readonly></td>
	                                                 <td><input type="hidden"  value="<? echo $filas["cargo"];?>" name="cargo[<? echo $i;?>]" id="cargo[<? echo $i;?>]" class="cajas" size="6" readonly></td>
                                                         <td><input type="hidden"  value="<? echo round($Tsena,0);?>"name="sena[<? echo $i;?>]" id="sena[<? echo $i;?>]"class="cajas" size="7"></td>
	                                                 <td><input type="hidden"  value="<? echo round($Ticbf,0);?>"name="icbf[<? echo $i;?>]" id="icbf[<? echo $i;?>]"class="cajas" size="7"></td>
	                                            </tr>
                                                     <?
                                                     $m=$m+1;
                                                  endif;
                                     endif;
                                     $i=$i+1;
                             endwhile;
                             echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" .$registros . "\">");
                             ?>

                        </table>
                        <table border="0" align="center">
                              <tr class="cajas">
                                 <td><b>Básico</b></td><td><b>T.Extra</b></td><td><b>T.Auxilio</b></td><td><b>Ayuda</b></td><td><b>Arp</b></td><td><b>Eps</b></td><td><b>Pensión</b></td><td><b>Caja</b></td><td><b>Cesan_Prima</b></td><td><b>Vacación</b></td><td><b>Admon</b>
                              </tr>
                              <tr>
                                  <td><input type="text" name="total1" value="<? echo round($SalarioT,0);?>" id="total1"class="cajas" size="12"></td>
                                  <td><input type="text" name="total2" value="<? echo round($TiempoP,0);?>" id="total2" class="cajas" size="12"></td>
                                  <td><input type="text" name="total3" value="<? echo round($TiempoNP,0);?>" id="total3" class="cajas" size="12"></td>
                                  <td><input type="text" name="total4" value="<? echo round($AyudaT,0);?>" id="total4" class="cajas" size="12"></td>
                                  <td><input type="text" name="total5" value="<? echo round($ArpT,0);?>" id="total5" class="cajas" size="11"></td>
                                  <td><input type="text" name="total6" value="<? echo round($EpsT,0);?>" id="total6" class="cajas" size="11"></td>
                                  <td><input type="text" name="total7" value="<? echo round($PensionT,0);?>" id="total7" class="cajas" size="11"></td>
                                  <td><input type="text" name="total8" value="<? echo round($CajaT,0);?>" id="total8" class="cajas" size="11"></td>
                                  <td><input type="text" name="total11" value="<? echo round($PrestacionT,0);?>" id="total11" class="cajas" size="11"></td>
                                  <td><input type="text" name="total12" value="<? echo round($VacacionT,0);?>" id="total12" class="cajas" size="11"></td>
                                  <td><input type="text" name="total13" value="<? echo round($AdmonT,0);?>" id="total13" class="cajas" size="9"></td>
                                  <td><input type="hidden" name="valor" value="<?echo $valor;?>" id="valor" class="cajas" size="11"></td>
                                   <td><input type="hidden" name="vlriva" value="<?echo $vlriva;?>" id="vlriva" class="cajas" size="11"></td>
                                    <td><input type="hidden" name="total9" value="<? echo round($SenaT,0);?>" id="total9" class="cajas" size="11"></td>
                                  <td><input type="hidden" name="total10" value="<? echo round($IcbfT,0);?>" id="total10" class="cajas" size="11"></td>
								  <td><input type="hidden" name="ContadorEmpleado" value="<? echo $m;?>" id="ContadorEmpleado" class="cajas" size="11"></td>
                              </tr>
                        </table>
                        <table border="0" align="center">
                               <tr><td class="cajas"><b>Reg:<b>&nbsp;<?echo $m;?>&nbsp;<input type="button" value="Calcular Columna" name="calcular" onClick="validar()"></td>

                               <td><input type="button" value="Calcular Filas" name="calculofilas" onClick="CalculoFilas()"></td></tr>
                        </table>
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
	                               <td><input type="text" name="total" value="0" class="cajas" size="11" id="total" onclick="calculo()"></td>
	                               <td><input type="text" name="incapacidad" value="0" class="cajas" id="incapacidad" size="11"></td>
	                               <td><input type="text" name="anticipo" value="0" class="cajas" id="anticipo"size="11"></td>
	                               <td><input type="text" name="otro" value="0" class="cajas" id="otro" size="11"></td>
	                               <td><input type="text" name="ajuste" value="0" class="cajas" id="ajuste" size="11"></td>
	                               <td><input type="text" name="menor" value="0" class="cajas" id="menor" size="11"></td>
	                               <td><input type="hidden" name="tbaseiva" value="<?echo $tbaseiva;?>" id="tbaseiva"class="cajas" size="11"></td>

                               </tr>
                               <tr class="cajas">
                                   <td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td><b>SUBTOTAL</b></td> <td><b>BASE IVA</b></td><td><b>IVA</b></td><td><b>GRAN TOTAL</b></td>
                               </tr>
                               <tr>
	                               <td>&nbsp;</td>
	                               <td>&nbsp;</td>
	                               <td>&nbsp;</td>
	                               <td>&nbsp;</td>
	                               <td>&nbsp;</td>
	                               <td>&nbsp;</td>
	                               <td><input type="text" name="subtotal" value=" " class="cajas" size="11" id="subtotal" onclick="calculo2()" onFocus="calculo2()"></td>
	                               <td><input type="text" name="vlrbase" value="" class="cajas" size="11" id="vlrbase" onclick="BaseIva()" onFocus="BaseIva()"></td>
	                               <td><input type="text" name="ivato" value="" class="cajas" size="11"  id="ivato" onclick="ivapagar()" onFocus="ivapagar()"></td>
	                               <td><input type="text" name="grantotal" value="" class="cajas" size="11" id="grantotal" onclick="totalvalor()" onFocus="totalvalor()"></td>
                               </tr>
                               <tr><td><br></td></tr>
                               <tr>
                                   <td colspan="5">
                                   <input type="submit" value="Enviar Dato" class="boton">
                                   </td>
                               </tr>
                        </table>
                      <?
                  else:
                      ?>
                      <script language="javascript">
                        alert("No hay empleados con nomima para generar la factura.!")
                        history.back()
                      </script>
                      <?
                  endif;
             ?>
             </table>
         </form>
         <?
     else:
          ?>
          <script language="javascript">
             alert("No hay registros con este rango de Fechas ?")
             history.back()
          </script>
         <?
     endif;
   else:
      ?>
          <script language="javascript">
             alert("Ya se hizo el detalle factura a esta empresa.!")
             history.back()
          </script>
         <?
   endif;
endif;
?>
</body>
</html>

