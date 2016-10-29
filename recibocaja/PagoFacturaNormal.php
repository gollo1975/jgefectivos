<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
    function CalculoTotal(){
        var vector = parseFloat(document.getElementById("tActualizaciones").value);
        var ValorAbono = 0;
        var Resultado = 0;
        var Aux = '';
        var ReteIca = 0;
        var AuxT = 0;
        var NuevoS = 0;
        Aux = document.getElementById("TipoPago").value;
        AuxT = document.getElementById("TotalPagar").value;
        if(Aux == 'RETEICA'){
          /* for (k=1;k<=vector;k++){
                if (document.getElementById("ReteIca[" + k+"]").value == 0){
                     ValorAbono = parseFloat(document.getElementById("OtroValor[" + k+ "]").value);
	             Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value);
	             Resultado = parseFloat(Saldo - ValorAbono);
	             AuxT = parseFloat(AuxT + ValorAbono);
	             document.getElementById("Nuevo_Saldo[" + k+ "]").value = Resultado;
                     document.getElementById("TotalPagar").value = AuxT;
                 }else{
                      Aux = document.getElementById("AuxiliarT").value;
	             ValorAbono = parseFloat(document.getElementById("ReteIca[" + k+ "]").value);
	             Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value);
	             Resultado = parseFloat(Saldo - ValorAbono);
	             ReteIca = parseFloat(ReteIca + ValorAbono);
	             document.getElementById("OtroValor[" + k+ "]").value = Resultado;
                 }
             }  */

        }else{
             if(Aux == 'DESCUENTO'){
                var TotalP = 0;
                 for (k=1;k<=vector;k++){
                   ValorAbono = parseFloat(document.getElementById("VlrDescuento[" + k+ "]").value)
                   Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value);
                   Resultado = parseFloat(Saldo - ValorAbono);
                   //ReteIca = parseFloat(ReteIca + ValorAbono);
                   document.getElementById("Nuevo_Saldo[" + k+ "]").value = Resultado;
                   TotalP += parseFloat(document.getElementById("Nuevo_Saldo[" + k+ "]").value);
                  // alert(TotalP);
                 }
                 document.getElementById("TotalPagar").value = TotalP;

             }else{
                  if(Aux == 'RETEIVA'){
                       for (k=1;k<=vector;k++){
                          ValorAbono = parseFloat(document.getElementById("OtroValor[" + k+ "]").value);
	                  Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value);
	                  Resultado = parseFloat(Saldo - ValorAbono);
  	                  document.getElementById("Nuevo_Saldo[" + k+ "]").value = Resultado;
                       }
                  }else{
                       if(Aux=='NORMAL'){
                            for (k=1;k<=vector;k++){
	                        ValorAbono = parseFloat(document.getElementById("OtroValor[" + k+ "]").value);
	                        Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value)
	                        Resultado = parseFloat(Saldo - ValorAbono);
	                        document.getElementById("Nuevo_Saldo[" + k+ "]").value = Resultado;
                            }
                       }else{
                              if(Aux == 'RETEIVARETEICA'){
			           for (k=1;k<=vector;k++){
			                if (document.getElementById("OtroValor[" + k+"]").value != 0){
                                             AuxT = document.getElementById("TotalPagar").value;
			                     ValorAbono = parseFloat(document.getElementById("OtroValor[" + k+ "]").value);
				             Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value);
				             Resultado = parseFloat(Saldo - ValorAbono);
				             AuxT = parseFloat(AuxT + ValorAbono);
				             document.getElementById("Nuevo_Saldo[" + k+ "]").value = Resultado;
			                     document.getElementById("TotalPagar").value = AuxT;
			                 }else{
			                     Aux = document.getElementById("AuxiliarT").value;
				             ValorAbono = parseFloat(document.getElementById("ReteIca[" + k+ "]").value);
				             Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value);
				             ReteIca = parseFloat(Saldo - ValorAbono);
                                             AuxT= parseFloat(AuxT + ReteIca);
                                              document.getElementById("OtroValor[" + k+ "]").value = ReteIca;
				             document.getElementById("TotalPagar").value = AuxT;
			                 }
			             }
                              }else{
                                    for (k=1;k<=vector;k++){
	                                    AuxT = document.getElementById("AuxiliarT").value;
	                                    ValorAbono =  parseFloat(document.getElementById("ReteIca[" + k+ "]").value);
	                                    Saldo = parseFloat(document.getElementById("SaldoP[" + k+ "]").value);
	                                    Aux = parseFloat(document.getElementById("VlrDescuento[" + k+ "]").value);
	                                    NuevoS = parseFloat(Saldo - ValorAbono - Aux);
	                                    document.getElementById("OtroValor[" + k+ "]").value = NuevoS;
                                            Resultado= parseFloat(Resultado + NuevoS);
                                            document.getElementById("TotalPagar").value = Resultado;
                                    }
                              }
                       }
                  }
             }
        }
     }
      function ActualizarSaldo()
         {
         var Saldo = 0;
         var OtroValor = 0;
         var ValorP = 0;
         var Total = parseFloat(document.getElementById("tActualizaciones").value);
         for (j=1; j<=Total; j++){
             Saldo = parseFloat(document.getElementById("SaldoP[" + j + "]").value);
	     OtroValor = parseFloat(document.getElementById("OtroValor[" + j + "]").value);
	     if (document.getElementById("datos[" + j + "]").checked == true ){
  		 if (Saldo != 0 && OtroValor == 0){
                     ValorP += parseFloat(Saldo);
                     document.getElementById("ValorSumado").value= ValorP.toFixed(0);
 		 }else{
                    ValorP += parseFloat(OtroValor);
                    document.getElementById("ValorSumado").value= ValorP.toFixed(0);
                 }

             }
         }
     }
     function ActualizarSaldoDcto()
         {
         var Saldo = 0;
         var OtroValor = 0;
         var ValorP = 0;
         var Total = parseFloat(document.getElementById("tActualizaciones").value);
         for (j=1; j<=Total; j++){
             Saldo = parseFloat(document.getElementById("Nuevo_Saldo[" + j + "]").value);
	     OtroValor = parseFloat(document.getElementById("OtroValor[" + j + "]").value);
	     if (document.getElementById("datos[" + j + "]").checked == true ){
  		 if (Saldo != 0 && OtroValor == 0){
                     ValorP += parseFloat(Saldo);
                     document.getElementById("ValorSumado").value= ValorP.toFixed(0);
 		 }else{
                    ValorP += parseFloat(OtroValor);
                    document.getElementById("ValorSumado").value= ValorP.toFixed(0);
                 }

             }
         }
     }
     function ActualizarSaldoIca()
         {
         var Ica = 0;
         var Saldo = 0;
         var Total = 0;
         var  Aux = 0;
         var Aux2 = 0;
         var OtroSaldo = 0;
         var SaldoActual = 0;
         var ValorP = 0;
         var TotalReg = parseFloat(document.getElementById("TotalR").value);
         for (t=1; t<=TotalReg; t++){
             Saldo = parseFloat(document.getElementById("SaldoP[" + t + "]").value);
	     Ica = parseFloat(document.getElementById("ReteIca[" + t + "]").value);
	     if (document.getElementById("datos[" + t + "]").checked == true ){
  		 if (document.getElementById("OtroValor[" + t +"]").value == 0){
                     Total = parseFloat(Saldo - Ica);
                     if(Ica == 0){
                        document.getElementById("OtroValor[" + t + "]").value = Total;
                     }else{
                        document.getElementById("OtroValor[" + t + "]").value = Total;
                     }
                      Aux2 = document.getElementById("OtroValor[" + t + "]").value;

                 }else{
                         Saldo = parseFloat(document.getElementById("SaldoP[" + t + "]").value);
                         Aux2 = document.getElementById("OtroValor[" + t + "]").value;
                         Total = parseFloat(Saldo - Aux2);
                         document.getElementById("Nuevo_Saldo[" + t + "]").value = Total.toFixed(0);
                 }
                 ValorP += parseFloat(Aux2);
                 document.getElementById("ValorSumado").value= ValorP.toFixed(0);
             }
         }
     }
</script>
</head>
<body>
<?php
     include("../conexion.php");
if(empty($CodMuni)){
    ?>
    <script language="javascript">
        alert("Seleccione el municipio de la lista.!")
        history.back()
    </script>
    <?
}elseif(empty($CodZona)){
     ?>
    <script language="javascript">
        alert("Seleccione la zona para generar el recibo.!")
        history.back()
    </script>
    <?
}elseif(empty($FormaPago)){
     ?>
    <script language="javascript">
        alert("Seleccione la forma de Pago.!")
        history.back()
    </script>
    <?
}elseif(empty($TipoCta)){
     ?>
    <script language="javascript">
        alert("Seleccione el tipo de producto de consignación o pago!")
        history.back()
    </script>
    <?
}elseif(empty($CodBanco)){
     ?>
    <script language="javascript">
        alert("Seleccione la entidad financiera de la lista.!")
        history.back()
    </script>
    <?
}elseif(empty($TipoRecibo)){
     ?>
    <script language="javascript">
        alert("Seleccione el tipo de recibo de pago.!")
        history.back()
    </script>
    <?
}else{
     $ConM="select municipio.municipio from municipio
	   where municipio.codmuni='$CodMuni'";
     $ResM=mysql_query($ConM)or die ("Error de busqueda de Municipio");
     $FilaM=mysql_fetch_array($ResM);
     $Municipio=$FilaM["municipio"];
     $ConB="select banco.bancos from banco
	   where banco.codbanco='$CodBanco'";
     $ResB=mysql_query($ConB)or die ("Error de busqueda de bancos");
     $FilaB=mysql_fetch_array($ResB);
     $Bancos=$FilaB["bancos"];
     $ConZ="select zona.zona from zona
	   where zona.codzona='$CodZona'";
     $ResZ=mysql_query($ConZ)or die ("Error de busqueda de bancos");
     $FilaZ=mysql_fetch_array($ResZ);
     $Zona=$FilaZ["zona"];
      $ConR="select tiporecibo.descripcion from tiporecibo
	   where tiporecibo.idrecibo='$TipoRecibo'";
     $ResR=mysql_query($ConR)or die ("Error de busqueda del tipo recibo");
     $FilaR=mysql_fetch_array($ResR);
     $Concepto=$FilaR["descripcion"];
     ?>
	<center><h4><u>Recibo de caja[FACTURAS]</u></h4></center>
	<form action="GrabarReciboFactura.php" method="post" name="recibocaja" id="recibocaja">
	  <input type="hidden" name="empresa" value="<?echo $NitEmpresa;?>">
	   <input type="hidden" name="TipoPago" value="<?echo $TipoPago;?>">
	  <table border="0" align="center" width="410">
	    <tr>
	       <td><b>Nit/Cedula:</b></td>
	       <td><input type="text" name="NitEmpresa" value="<? echo $NitEmpresa;?>" size="13" readonly class="cajas"></td>
	    </tr>
	    <tr>
	       <td><b>Empresa:</b></td>
	       <td><input type="text" name="empresa" value="<?echo $empresa;?>" size="47" class="cajas" readonly></td>
	    </tr>
	    <tr>
	       <td><b>Cod_Municipio:</b></td>
               <td><input type="text" name="CodMuni" value="<?echo $CodMuni;?>" size="13" class="cajas" readonly id="CodMuni"> <input type="text" name="" value="<?echo $Municipio;?>" size="30" class="cajas" readonly</td>
             <tr>
            <tr>
	       <td><b>Cod_Zona:</b></td>
               <td><input type="text" name="CodZona" value="<?echo $CodZona;?>" size="13" class="cajas" readonly id="CodZona"> <input type="text" name="" value="<?echo $Zona;?>" size="30" class="cajas" readonly</td>
             <tr>
	      </tr>
               <tr>
	       <td><b>Cod_Banco:</b></td>
               <td><input type="text" name="CodBanco" value="<?echo $CodBanco;?>" size="13" class="cajas" readonly id="CodBanco"> <input type="text" name="" value="<?echo $Bancos;?>" size="30" class="cajas" readonly</td>
             <tr>
             <tr>
	         <td><b>Fecha_Pago:</b></td>
	         <td><input type="text" name="fechapago" value="<?echo $fechapago;?>" size="13" maxlength="10" class="cajas" id="fechapago">
	         <b>Forma_Pago:&nbsp;</b>
	        <input type="text" name="FormaPago" value="<?echo $FormaPago;?>" size="16"  class="cajas" id="FormaPago" readonly ></td>
	      </tr>
               <tr>
	         <td><b>Tipo_Producto:</b></td>
	         <td><input type="text" name="TipoCta" value="<?echo $TipoCta;?>" size="13"  class="cajas" id="TipoCta" readonly>
	         <b>Vlr_Pagado:&nbsp;&nbsp;</b>
	         <input type="text" name="Vlr_Pagado" value="<?echo $Vlr_Pagado;?>" size="16" maxlength="11" class="cajas" id="Vlr_Pagado" readonly style="text-align:right;background-color:#9BCDFF"></td>
	      </tr>
              <tr>
	         <td><b>Tipo_Recibo:</b></td>
                 <td><input type="text" name="TipoRecibo" value="<?echo $TipoRecibo;?>" size="13" class="cajas" readonly id="TipoRecibo"> <input type="text" name="" value="<?echo $Concepto;?>" size="30" class="cajas" readonly</td>
             <tr>
	       <?
               if($TipoPago=='NORMAL'){
	         $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona from factura,zona
	                where zona.codzona=factura.codzona and
		         factura.nsaldo > 0  and
	                 zona.codzona='$CodZona' and
                         zona.reteiva='NO' and
	                 zona.reteica='NO'  and
	                 zona.dcto='NO' order by factura.fechaven ASC";
               }else{
                    if($TipoPago=='DESCUENTO'){
                          $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona,zona.pordcto from factura,zona
	                 where zona.codzona=factura.codzona and
		         factura.nsaldo > 0  and
	                 zona.codzona='$CodZona' and
                         zona.reteiva='NO' and
	                 zona.reteica='NO'  and
	                 zona.dcto='SI' order by factura.fechaven ASC";
                    }else{
                         if($TipoPago=='RETEIVA'){
                                 $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona,zona.vlriva from factura,zona
		                 where zona.codzona=factura.codzona and
			         factura.nsaldo > 0  and
		                 zona.codzona='$CodZona' and
		                 zona.reteiva='SI'  and
                                 zona.reteica='NO'  and
		                 zona.dcto='NO' order by factura.fechaven ASC";
                         }else{
                              if($TipoPago=='RETEICA'){
                                  $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona,zona.pordcto from factura,zona
		                   where zona.codzona=factura.codzona and
			           factura.nsaldo > 0  and
		                   zona.codzona='$CodZona' and
                                   zona.reteiva='NO'  and
		                   zona.reteica='SI'  and
		                   zona.dcto='NO' order by factura.fechaven ASC";
                              }else{
                                   if($TipoPago=='RETEIVARETEICA'){
                                        $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona,zona.pordcto,zona.vlriva from factura,zona
			                 where zona.codzona=factura.codzona and
				         factura.nsaldo > 0  and
			                 zona.codzona='$CodZona' and
                                         zona.reteiva='SI'  and
			                 zona.reteica='SI'  and
			                 zona.dcto='NO' order by factura.fechaven ASC";
	                           }else{
	                                 $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona,zona.pordcto,zona.vlriva from factura,zona
			                 where zona.codzona=factura.codzona and
				         factura.nsaldo > 0  and
			                 zona.codzona='$CodZona' and
                                         zona.reteiva='SI'  and
			                 zona.reteica='SI'  and
			                 zona.dcto='SI' order by factura.fechaven ASC";
                                   }
                              }
                         }
                    }
               }
	       $resulta=mysql_query($consu)or die ("Error de busqueda cartera de facturas");
	       $registro=mysql_affected_rows();
	       if ($registro!=0){
	                 $i=1;
	                 $Contavalor=0;
                          if($TipoPago=='NORMAL'){
                             ?>
                             <table border="0" align="center" width="460">
			       <tr class="cajas">
			       <th><b>Item</b></td><th></th><th>Nro_Factura</th><th><b>Cod_Zona</b></th><th><b>Zona</b></th><th><b>Subtotal</b></th><th><b>Vlr_Factura</b></th><th>Saldo</th><th>Otro_Valor</th><th>N_Saldo</th><th>Rete_Fte</th>
			       </tr>
                             <?
                             $TotalPagar = 0;
		              echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
			      while ($filas_Z = mysql_fetch_array($resulta)){?>
	    	                  <tr class="cajas">
			              <th><?echo $i;?></th>
			              <?
                                     echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
		                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
				              <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
				              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
		                               <td> <input type="text" value="<?echo $filas_Z["subtotal"];?>" name="SubTotal[<? echo $i;?>]" id="SubTotal[<? echo $i;?>]"size="11" readonly class="cajas" style="text-align:right"></td>
		                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
		                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
		                              <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="9" style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
		                              <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="9" onFocus="CalculoTotal()" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                              <td class="cajas"><input type="text" value="<?echo $filas_Z["rfte"]?>" name="ReteFuente[<? echo $i;?>]" id="Retefuente[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                              <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
		                              <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
		                              <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
		                              <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
	                                 </tr>
	                        </tr>
	                        <?
                                 $i=$i+1;
	                         $TotalPagar = $TotalPagar + $filas_Z["nsaldo"];
			      }
                                  ?>
                                  <tr><td><br></td></tr>
                                    <tr>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
			              <th><div align="left">Total_Pagar:</div></th>
                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
			            </tr>
                                     <tr>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                     <th><div align="left">Valor_Pagado:</div></th>
                                       <td colspan="10"><div align="right"><input type="text" value="0" name="ValorSumado" id="ValorSumado" size="11" style="text-align:right;background-color:#FF80FF" class="cajas"></div></td>
			            </tr>
                                     <td colspan="10"><input type="hidden" value="<?echo $TipoPago;?>" name="TipoPago" id="TipoPago" size="20"</td>
			            <tr><td><br></td></tr>
			           <td colspan="5">
			          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar" name="buscar"></td>
                                 </table>
                                     <?
                          }else{
                                if($TipoPago=='DESCUENTO'){
                                     ?>
	                             <table border="0" align="center" width="460">
				       <tr class="cajas">
				       <th><b>Item</b></td><th></th><th>Nro_Factura</th><th><b>Cod_Zona</b></th><th><b>Zona</b></th><th><b>Subtotal</b></th><th><b>Vlr_Factura</b></th><th>Saldo</th><th>Otro_Valor</th><th>N_Saldo</th><th>%Dcto</th> <th>Rete_Fte</th><th>Dcto</th>
				       </tr>
	                             <?
                                       $ValorD=0; $PorD=0; $ValorDcto=0;$TotalRetefuente=0; $TotalIva = 0; $TotalPagar = 0;

                                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
			             while ($filas_Z = mysql_fetch_array($resulta)){
                                            $Nro_F= $filas_Z["nrofactura"];
                                            $ConN="select notacredito.valor from notacredito
			                      where notacredito.nrofactura='$Nro_F'";
                                            $Res=mysql_query($ConN)or die ("Error de busqueda nota creditos");
                                            $regis=mysql_num_rows($Res);
                                            if(regis != 0){
                                                while ($fila = mysql_fetch_array($Res)){
                                                   $Valor = $fila["valor"];
                                                   $Acumular = $Acumular + Valor;
                                                }
                                                $AuxSaldo = $ValorD - $Acumular;
                                                $ValorDcto = round(($AuxSaldo * $PorD)/100);
                                                $AuxSaldo = $ValorD - $Acumular;
                                             }else{
                                                  $ValorD=$filas_Z["subtotal"];
                                                  $PorD=$filas_Z["pordcto"];
                                                 $ValorDcto = round(($ValorD * $PorD)/100);
                                             }
                                            ?>
		    	                  <tr class="cajas">
				              <th><?echo $i;?></th>
				              <?
                                              echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldoDcto()\"></td>");?>
		                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
				              <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
				              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
		                               <td> <input type="text" value="<?echo $filas_Z["subtotal"];?>" name="SubTotal[<? echo $i;?>]" id="SubTotal[<? echo $i;?>]"size="11" readonly class="cajas" style="text-align:right"></td>
		                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
		                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
		                              <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="9"  style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
		                              <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="9" onFocus="CalculoTotal()" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                               <td class="cajas"><input type="text" value="<?echo $filas_Z["pordcto"]?>" name="PorDcto[<? echo $i;?>]" id="PorDcto[<? echo $i;?>]" size="5" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                              <td class="cajas"><input type="text" value="<?echo $filas_Z["rfte"]?>" name="ReteFuente[<? echo $i;?>]" id="Retefuente[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                              <td class="cajas"><input type="text" value="<?echo $ValorDcto;?>" name="VlrDescuento[<? echo $i;?>]" id="VlrDescuento[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
		                              <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
		                              <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
		                              <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
		                              <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
	                                 </tr>
	                                 <?
	                                $i=$i+1;
                                        $ValorTotalDcto = $ValorTotalDcto + $ValorDcto;
	                                $TotalP = $TotalP + $filas_Z["nsaldo"];
			             }
                                     $TotalPagar = round($TotalP - $ValorTotalDcto);
                                      ?>
                                    <tr>
                                    <tr><td><br></td></tr>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
			              <th><div align="left">Total_Pagar:</div></th>
                                      <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
				   </tr>
                                   <tr>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                      <th>&nbsp;</th>
                                     <th><div align="left">Valor_Pagado:</div></th>
                                       <td colspan="10"><div align="right"><input type="text" value="0" name="ValorSumado" id="ValorSumado" size="11" style="text-align:right;background-color:#FF80FF" class="cajas"></div></td>
			            </tr>
	                                     <td colspan="10"><input type="hidden" value="<?echo $TipoPago;?>" name="TipoPago" id="TipoPago" size="20"</td>
				            <tr><td><br></td></tr>
				           <td colspan="5">
				          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar" name="buscar"></td>
                                   </table>
                                     <?
                                }else{
                                      if($TipoPago=='RETEIVA'){
	                                     ?>
		                             <table border="0" align="center" width="460">
					       <tr class="cajas">
					       <th><b>Item</b></td><th></th><th>Nro_Factura</th><th><b>Cod_Zona</b></th><th><b>Zona</b></th><th><b>Subtotal</b></th><th><b>Vlr_Factura</b></th><th>Saldo</th><th>Otro_Valor</th><th>N_Saldo</th><th>%</th><th>Rete_Fte</th><th>Rete_Iva</th>
					       </tr>
		                             <?
	                                       $ValorD=0; $PorD=0; $ValorDcto=0;$TotalRetefuente=0; $TotalIva = 0; $TotalPagar = 0;$TotalReteIca = 0; $ReteIva = 0;

	                                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
				             while ($filas_Z = mysql_fetch_array($resulta)){
	                                            $PorD=$filas_Z["retiva"];
	                                          ?>
			    	                  <tr class="cajas">
					              <th><?echo $i;?></th>
					              <?
			                               echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
			                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
					              <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
					              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
			                               <td> <input type="text" value="<?echo $filas_Z["subtotal"];?>" name="SubTotal[<? echo $i;?>]" id="SubTotal[<? echo $i;?>]"size="11" readonly class="cajas" style="text-align:right"></td>
			                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
			                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
			                              <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="9"  style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
			                              <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="9" onFocus="CalculoTotal()" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["vlriva"]?>%" name="PorDcto[<? echo $i;?>]" id="PorDcto[<? echo $i;?>]" size="4" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
	                                              <td class="cajas"><input type="text" value="<?echo $filas_Z["rfte"]?>" name="ReteFuente[<? echo $i;?>]" id="Retefuente[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                       <td class="cajas"><input type="text" value="<?echo $filas_Z["rteiva"]?>" name="ReteIva[<? echo $i;?>]" id="ReteIva[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
			                              <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
			                              <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
			                              <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
			                              <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
		                                 </tr>
		                                 <?
		                                $i=$i+1;
	                                        $TotalPagar = $TotalPagar + $filas_Z["nsaldo"];
				             }
	                                     ?>
	                                    <tr>
                                             <tr><td><br></td></tr>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
                                              <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
				              <th><div align="left">Total_Pagar:</div></th>
	                                      <td colspan="10"><div align="right"><input type="text" value="<?echo $TotalPagar;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
					      </tr>
                                               <tr>
                                              <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
                                              <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                      <th>&nbsp;</th>
	                                     <th><div align="left">Valor_Pagado:</div></th>
	                                       <td colspan="10"><div align="right"><input type="text" value="0" name="ValorSumado" id="ValorSumado" size="11" style="text-align:right;background-color:#FF80FF" class="cajas"></div></td>
				            </tr>
		                                     <td colspan="10"><input type="text" value="<?echo $TipoPago;?>" name="TipoPago" id="TipoPago" size="20"</td>
					            <tr><td><br></td></tr>
					           <td colspan="5">
					          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar"></td>
	                                   </table>
                                        <?
                                        }else{
                                              if($TipoPago=='RETEICA'){
		                                     ?>
			                             <table border="0" align="center" width="460">
						       <tr class="cajas">
						       <th><b>Item</b></td><th></th><th>Nro_Factura</th><th><b>Cod_Zona</b></th><th><b>Zona</b></th><th><b>Subtotal</b></th><th><b>Vlr_Factura</b></th><th>Saldo</th><th>Otro_Valor</th><th>N_Saldo</th><th>Rete_Fte</th><th>Rete_Ica</th>
						       </tr>
			                             <?
		                                       $ValorD=0; $PorD=0; $ValorDcto=0;$TotalRetefuente=0; $TotalIva = 0; $TotalPagar = 0;$TotalReteIca = 0; $ReteIva = 0;

		                                     echo ("<input type=\"hidden\" id=\"TotalR\" name=\"TotalR\" value=\"" . mysql_num_rows($resulta) . "\">");
					             while ($filas_Z = mysql_fetch_array($resulta)){
		                                            $PorD=$filas_Z["retiva"];
		                                          ?>
				    	                  <tr class="cajas">
						              <th><?echo $i;?></th>
						              <?
				                              echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldoIca()\"></td>");?>
				                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
						              <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
						              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
				                               <td> <input type="text" value="<?echo $filas_Z["subtotal"];?>" name="SubTotal[<? echo $i;?>]" id="SubTotal[<? echo $i;?>]"size="11" readonly class="cajas" style="text-align:right"></td>
				                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
				                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
				                              <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="9"  style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
				                              <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="9" onFocus="CalculoTotal()" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
   	                                                     <td class="cajas"><input type="text" value="<?echo $filas_Z["rfte"]?>" name="ReteFuente[<? echo $i;?>]" id="Retefuente[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
	                                                       <td class="cajas"><input type="text" value="0" name="ReteIca[<? echo $i;?>]" id="ReteIca[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
				                              <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
				                              <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
				                              <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
				                              <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
			                                 </tr>
			                                 <?
			                                $i=$i+1;
		                                        $TotalPagar = $TotalPagar + $filas_Z["grantotal"];
					             }
		                                     ?>
		                                    <tr>
	                                             <tr><td><br></td></tr>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
	                                              <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
					              <th><div align="left">Total_Pagar:</div></th>
                                                      <input type="hidden" value="<?echo $TotalPagar;?>" name="AuxiliarT" id="AuxiliarT" size="11">
		                                       <td colspan="10"><div align="right"><input type="text" value="<?echo $Vlr_Pagado;?>" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
						      </tr>
                                                        <tr>
                                                     <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
	                                              <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                      <th>&nbsp;</th>
		                                     <th><div align="left">Valor_Pagado:</div></th>
		                                       <td colspan="10"><div align="right"><input type="text" value="0" name="ValorSumado" id="ValorSumado" size="11" style="text-align:right;background-color:#FF80FF" class="cajas"></div></td>
					            </tr>
			                                     <td colspan="10"><input type="hidden" value="<?echo $TipoPago;?>" name="TipoPago" id="TipoPago" size="20"</td>
						            <tr><td><br></td></tr>
						           <td colspan="5">
						          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar"></td>
		                                   </table>
                                              <?
                                              }else{
	                                            if($TipoPago=='RETEIVARETEICA'){
			                                     ?>
				                             <table border="0" align="center" width="460">
							       <tr class="cajas">
							       <th><b>Item</b></td><th></th><th>Nro_Factura</th><th><b>Cod_Zona</b></th><th><b>Zona</b></th><th><b>Subtotal</b></th><th><b>Vlr_Factura</b></th><th>Saldo</th><th>Otro_Valor</th><th>N_Saldo</th><th>Rete_Iva</th><th>%Iva</th><th>Rete_Fte</th><th>Rete_Ica</th>
							       </tr>
				                             <?
			                                       $ValorD=0; $PorD=0; $ValorDcto=0;$TotalRetefuente=0; $TotalIva = 0; $TotalPagar = 0;$TotalReteIca = 0; $ReteIva = 0;

			                                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
						             while ($filas_Z = mysql_fetch_array($resulta)){
			                                            $PorD=$filas_Z["retiva"];
			                                          ?>
					    	                  <tr class="cajas">
							              <th><?echo $i;?></th>
							              <?
					                              echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
					                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
							              <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
							              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
					                               <td> <input type="text" value="<?echo $filas_Z["subtotal"];?>" name="SubTotal[<? echo $i;?>]" id="SubTotal[<? echo $i;?>]"size="11" readonly class="cajas" style="text-align:right"></td>
					                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
					                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
					                              <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="9"  style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
					                              <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="9" onFocus="CalculoTotal()" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["rteiva"];?>" name="ReteIva[<? echo $i;?>]" id="ReteIva[<? echo $i;?>]" size="8" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                       <td class="cajas"><input type="text" value="<?echo $filas_Z["vlriva"]?>%" name="PorDcto[<? echo $i;?>]" id="PorDcto[<? echo $i;?>]" size="4" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                       <td class="cajas"><input type="text" value="<?echo $filas_Z["rfte"]?>" name="ReteFuente[<? echo $i;?>]" id="Retefuente[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
		                                                       <td class="cajas"><input type="text" value="0" name="ReteIca[<? echo $i;?>]" id="ReteIca[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
					                              <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
					                              <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
					                              <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
					                              <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
				                                 </tr>
				                                 <?
				                                $i=$i+1;
			                                        $TotalPagar = $TotalPagar + $filas_Z["grantotal"];
						             }
			                                     ?>
			                                    <tr>
		                                             <tr><td><br></td></tr>
			                                      <th>&nbsp;</th>
                                                               <th>&nbsp;</th>
                                                                <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
		                                              <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
						              <th><div align="left">Total_Pagar:</div></th>
	                                                      <input type="hidden" value="<?echo $TotalPagar;?>" name="AuxiliarT" id="AuxiliarT" size="11">
			                                      <td colspan="10"><div align="right"><input type="text" value="" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
							      </tr>
                                                              <tr>
                                                              <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
		                                              <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                     <th><div align="left">Valor_Pagado:</div></th>
			                                       <td colspan="10"><div align="right"><input type="text" value="0" name="ValorSumado" id="ValorSumado" size="11" style="text-align:right;background-color:#FF80FF" class="cajas"></div></td>
						            </tr>
				                                     <td colspan="10"><input type="text" value="<?echo $TipoPago;?>" name="TipoPago" id="TipoPago" size="20"</td>
							            <tr><td><br></td></tr>
							           <td colspan="5">
							          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar"></td>
			                                   </table><?
                                                    }else{
                                                           ?>
				                             <table border="0" align="center" width="460">
							       <tr class="cajas">
							       <th><b>Item</b></td><th></th><th>Nro_Factura</th><th><b>Cod_Zona</b></th><th><b>Zona</b></th><th><b>Subtotal</b></th><th><b>Vlr_Factura</b></th><th>Saldo</th><th>Otro_Valor</th><th>N_Saldo</th><th>Rete_Iva</th><th>%Iva</th><th>Rete_Fte</th><th>%D_Fin</th><th>Dcto</th><th>Rete_Ica</th>
							       </tr>
				                             <?
			                                       $ValorD=0; $PorD=0; $ValorDcto=0;$TotalRetefuente=0; $TotalIva = 0; $TotalPagar = 0;$TotalReteIca = 0; $ReteIva = 0;

			                                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
						             while ($filas_Z = mysql_fetch_array($resulta)){
			                                            $PorD=$filas_Z["retiva"];
                                                                     $ValorD=$filas_Z["subtotal"];
			                                            $PorD=$filas_Z["pordcto"];
			                                            $ValorDcto = round(($ValorD * $PorD)/100);
			                                          ?>
					    	                  <tr class="cajas">
							              <th><?echo $i;?></th>
							              <?
					                              echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>  
					                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
							              <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
							              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
					                               <td> <input type="text" value="<?echo $filas_Z["subtotal"];?>" name="SubTotal[<? echo $i;?>]" id="SubTotal[<? echo $i;?>]"size="11" readonly class="cajas" style="text-align:right"></td>
					                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
					                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
					                              <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="9"  style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
					                              <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="9" onFocus="CalculoTotal()" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["rteiva"];?>" name="ReteIva[<? echo $i;?>]" id="ReteIva[<? echo $i;?>]" size="8" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["vlriva"]?>%" name="PorDcto[<? echo $i;?>]" id="PorDcto[<? echo $i;?>]" size="4" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                       <td class="cajas"><input type="text" value="<?echo $filas_Z["rfte"]?>" name="ReteFuente[<? echo $i;?>]" id="Retefuente[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                      <td class="cajas"><input type="text" value="<?echo $filas_Z["pordcto"]?>%" name="DctoF[<? echo $i;?>]" id="DctoF[<? echo $i;?>]" size="6" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                                                                       <td class="cajas"><input type="text" value="<?echo $ValorDcto;?>" name="VlrDescuento[<? echo $i;?>]" id="VlrDescuento[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
		                                                       <td class="cajas"><input type="text" value="0" name="ReteIca[<? echo $i;?>]" id="ReteIca[<? echo $i;?>]" size="11" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
					                              <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
					                              <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
					                              <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
					                              <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
				                                 </tr>
				                                 <?
				                                $i=$i+1;
                                                                $ValorTotalDcto = $ValorTotalDcto + $ValorDcto;
			                                        $TotalPagar = $TotalPagar + $filas_Z["nsaldo"];
						             }
			                                     ?>
			                                    <tr>
		                                             <tr><td><br></td></tr>
			                                      <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
                                                               <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
		                                              <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
						              <th><div align="left">Total_Pagar:</div></th>
	                                                      <input type="hidden" value="<?echo $TotalPagar;?>" name="AuxiliarT" id="AuxiliarT" size="11">
			                                      <td colspan="10"><div align="right"><input type="text" value="" name="TotalPagar" id="TotalPagar" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
							      </tr>
                                                              <tr>
                                                               <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
                                                              <th>&nbsp;</th>
                                                               <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
		                                              <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                      <th>&nbsp;</th>
			                                     <th><div align="left">Valor_Pagado:</div></th>
			                                       <td colspan="10"><div align="right"><input type="text" value="0" name="ValorSumado" id="ValorSumado" size="11" style="text-align:right;background-color:#FF80FF" class="cajas"></div></td>
						            </tr>
				                                  <td colspan="10"><input type="hidden" value="<?echo $TipoPago;?>" name="TipoPago" id="TipoPago" size="20"</td>
							          <tr><td><br></td></tr>
							          <td colspan="5">
							          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar"></td>
			                                   </table><?
                                                    }
                                              }
                                        }

                                    }
                          }
	        }else{
                    ?>
		    <script language="javascript">
		        alert("No hay facturas en cartera para esta Empresa o la Empresa no cumple con los parámetros!")
		        history.back()
		    </script>
                    <?
	        }?>
	     </table>
	   </form>
<?
}
?>
</body>
</html>
