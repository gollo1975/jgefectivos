<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
    function ActualizarSaldo()
         {
         var totalitem = document.getElementById("tActualizaciones").value
         var NuevoSaldo = 0;
         var TotalPagado = 0;
         var AuxValor = 0;
         var SaldoCartera = 0;
         var SaldoFactura = 0;
         var SaldoPagado = 0;
         var SaldoR = 0;
         var VlrInicio = 0;
         var AuxSaldo = 0;
         var AuxDos = 0;
         var ValorFactura = 0;
         var AuxTres = 0;
         var Suma = 0;
         var Suma1 = 0;
         var Suma2 = 0;
         SaldoCartera = parseFloat(document.getElementById("Vlr_Pagado").value);
         for (i=1;i<=totalitem;i++){
              if (document.getElementById("datos[" + i + "]").checked == true ){
                  if (document.getElementById("Vlr_Pagado").value == 0){
                      alert("Debes de colocar el valor pagado por el cliente en la caja de texto.")
                      return;
                  }else{
                    Suma = parseFloat(document.getElementById("Vlr_Pagado").value );
                    Suma1 = parseFloat(document.getElementById("ValorPagado").value);
                      if (Suma1 > Suma){
                          alert("El abono a facturas no  puede ser mayor que el valor pagado por el cliente.")
                          return;
                      }else{
                         if (document.getElementById("OtroValor[" + i +"]").value != 0){
	                    AuxValor = parseFloat(document.getElementById("OtroValor[" + i + "]").value);
                            SaldoFactura = parseFloat(document.getElementById("SaldoP[" + i + "]").value);
                            if(AuxValor > SaldoFactura){
                                 alert("El valor de la factura actual es menor que el abono a realizar.!")
                                  return;
                            }else{
                                 if (document.getElementById("ValorPagado").value != 0){
                                      AuxValor = parseFloat(document.getElementById("OtroValor[" + i + "]").value);
                                      Suma1 = parseFloat(document.getElementById("ValorPagado").value);
                                      Suma = parseFloat(AuxValor + Suma1);
                                     if (AuxValor != 0){
                                            NuevoSaldo = parseFloat(Suma1 - AuxValor);
	                                    document.getElementById("Nuevo_Saldo[" + i + "]").value = NuevoSaldo;
                                            document.getElementById("ValorPagado").value = Suma;
	                                    document.getElementById("SaldoRestante").value = NuevoSaldo;
                                            Suma2 = parseFloat(SaldoFactura - AuxValor);
                                            document.getElementById("Nuevo_Saldo[" + i + "]").value = Suma2;
                                       }else{
                                          NuevoSaldo = parseFloat(SaldoFactura - AuxValor);
                                          document.getElementById("Nuevo_Saldo[" + i + "]").value = NuevoSaldo;
                                          TotalPagado = parseFloat(TotalPagado + AuxValor);
                                          document.getElementById("ValorPagado").value = TotalPagado;
                                       }

                                 }else{
                                      if (TotalRegistro <= 1){
                                            SaldoPagado = parseFloat(document.getElementById("ValorPagado").value);
	                                    SaldoFactura = parseFloat(document.getElementById("SaldoP[" + i + "]").value);
	                                    SaldoR = document.getElementById("SaldoRestante").value;
	                                    AuxValor = parseFloat(document.getElementById("OtroValor[" + i + "]").value);
	                                    NuevoSaldo = parseFloat(SaldoFactura - AuxValor);
	                                    document.getElementById("Nuevo_Saldo[" + i + "]").value = NuevoSaldo;
	                                    TotalPagado = parseFloat(SaldoPagado + AuxValor);
	                                    SaldoR = parseFloat(SaldoR - AuxValor);
	                                    document.getElementById("SaldoRestante").value = SaldoR;
                                      }else{
                                            TotalPagado = parseFloat(document.getElementById("Vlr_Pagado").value);
                                            SaldoPagado = parseFloat(document.getElementById("ValorPagado").value);
	                                    SaldoFactura = parseFloat(document.getElementById("SaldoP[" + i + "]").value);
                                            AuxValor = parseFloat(document.getElementById("OtroValor[" + i + "]").value);
                                            if (AuxValor != 0){
                                                Suma = parseFloat(Suma + SaldoPagado);
	                                        SaldoR = document.getElementById("SaldoRestante").value;
	                                        NuevoSaldo = parseFloat(SaldoFactura - AuxValor);
	                                        document.getElementById("Nuevo_Saldo[" + i + "]").value = NuevoSaldo;
                                                document.getElementById("ValorPagado").value = Suma;
	                                        document.getElementById("SaldoRestante").value = NuevoSaldo;
                                            }else{
	                                        SaldoR = document.getElementById("SaldoRestante").value;
	                                        NuevoSaldo = parseFloat(SaldoFactura - AuxValor);
	                                        document.getElementById("Nuevo_Saldo[" + i + "]").value = NuevoSaldo;
                                                document.getElementById("ValorPagado").value = SaldoR;
	                                        document.getElementById("SaldoRestante").value = NuevoSaldo;
                                            }
                                      }

                                 }
                            }
                         }else{
                             if (document.getElementById("ValorPagado").value != 0){
                                 TotalPagado = parseFloat(document.getElementById("Vlr_Pagado").value);
                                 SaldoPagado = parseFloat(document.getElementById("ValorPagado").value);
                                 SaldoR = document.getElementById("SaldoRestante").value;
                                 SaldoFactura = parseFloat(SaldoPagado + SaldoR);
                                 if(TotalPagado > SaldoFactura){
                                     alert("El valor a abonar es mayor que el saldo restante.")
                                     return;
                                 }else{
                                 /*QUE CODIGO*/
                                     if (document.getElementById("OtroValor[" + i +"]").value == 0){
                                         ValorFactura = parseFloat(document.getElementById("SaldoP[" + i + "]").value);
                                         AuxDos =  parseFloat(document.getElementById("ValorPagado").value);
                                         AuxTres = parseFloat(AuxTres + ValorFactura);
                                         document.getElementById("ValorPagado").value = parseFloat(AuxTres);

                                     }else{
                                        AuxValor = parseFloat(document.getElementById("OtroValor[" + i + "]").value);
                                        NuevoSaldo = parseFloat(SaldoFactura - AuxValor);
                                        document.getElementById("Nuevo_Saldo[" + i + "]").value = NuevoSaldo;
                                     }
                                 }
                             }else{
                                   SaldoFactura = parseFloat(document.getElementById("SaldoP[" + i + "]").value);
                                  if((SaldoCartera > SaldoFactura) && ( TotalRegistro > 1)){
                                      alert("El abono a facturas no  puede ser mayor que el valor pagado por el cliente.")
                                     return;
                                 }else{
                                      if (document.getElementById("ValorPagado").value == 0){
                                          SaldoPagado = parseFloat(document.getElementById("Vlr_Pagado").value);
                                          SaldoFactura = parseFloat(document.getElementById("SaldoP[" + i + "]").value);
                                          if(SaldoFactura > SaldoPagado){
                                               alert("El Valor pagado por el cliente es menor que el saldo de la factura.!")
                                                return;
                                          }else{
                                              document.getElementById("ValorPagado").value = SaldoFactura;
                                              SaldoR = parseFloat(SaldoPagado - SaldoFactura);
                                              document.getElementById("SaldoRestante").value = SaldoR;
                                          }
                                      }else{
                                           document.getElementById("OtroValor[" + i + "]").value = SaldoFactura;
                                           TotalPagado = parseFloat(TotalPagado + SaldoFactura);
                                           document.getElementById("ValorPagado").value = TotalPagado;
                                      }

                                 }
                             }
                         }
                        SaldoPagado = parseFloat(document.getElementById("ValorPagado").value);
                         SaldoR =  parseFloat(SaldoCartera - SaldoPagado);
                         document.getElementById("SaldoRestante").value = SaldoR;
                      }
                  }
              }
         }
    }
</script>
</head>
<body>
<center><h4><u>Recibo de caja[FACTURAS]</u></h4></center>
<form action="GrabarReciboFactura.php" method="post" name="recibocaja" id="recibocaja">
  <input type="hidden" name="empresa" value="<?echo $NitEmpresa;?>">
   <input type="hidden" name="TipoNomina" value="<?echo $TipoNomina;?>">
    <input type="hidden" name="CodZona" value="<?echo $CodZona;?>">
  <input type="hidden" name="codbanco" value="<?echo $codbanco;?>">
  <table border="0" align="center" width="460">
    <tr>
    <tr><td><br></td></tr>
        <?
    include("../conexion.php");?>
    <tr>
       <td><b>Nit/Cedula:</b></td>
       <td><input type="text" name="NitEmpresa" value="<? echo $NitEmpresa;?>" size="13" readonly class="cajas"></td>
    </tr>
    <tr>
       <td><b>Empresa:</b></td>
       <td><input type="text" name="empresa" value="<?echo $Empresa;?>" size="47" class="cajas" readonly></td>
    </tr>
    <tr>
       <td><b>Municipio:</b></td>
       <td colspan="5"><select name="municipio" class="cajas" id="municipio">
       <option value="0">Seleccione
       <?
       $consulta="select codmuni,municipio from municipio order by municipio";
       $resultado=mysql_query($consulta) or die("error al buscar empresa");
       while ($filas=mysql_fetch_array($resultado)){
             ?>
             <option value="<?echo $filas["codmuni"];?>"><?echo $filas["municipio"];?>
             <?
       }
       ?>
      </select></td>
      </tr>
      <tr>
         <td><b>F_Pago:</b></td>
         <td><input type="text" name="fechapago" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas" id="fechapago"></td>
      </tr>
      <tr>
          <td><b>Forma_Pago:</b></td>
           <td width="8"><select name="FormaPago" class="cajas" id="FormaPago">
               <option value="0">Seleccione un Item
	       <option value="BANCO">BANCO
	       <option value="CHEQUE">CHEQUE
               <option value="EFECTIVO">EFECTIVO
               <option value="OTRA">OTRA
	   </select></td>
       </tr>
      <tr>
          <td><b>Tipo_Producto:</b></td>
           <td width="8"><select name="TipoCta" class="cajas" id="TipoCta">
               <option value="0">Seleccione un Item
	       <option value="AHORRO">AHORRO
	       <option value="CORRIENTE">CORRIENTE
               <option value="OFICINA">OFICINA
               <option value="OTRA">OTRA
	   </select></td>
       </tr>
       <tr>
           <td><b>Banco:</b></td>
           <td><select name="codbanco" class="cajas" id="codbanco">
           <option value="0">Seleccione el banco
           <?$con="select codbanco,bancos from banco order by bancos";
           $resu=mysql_query($con)or die("Error de busqueda de bancos");
           while($filas=mysql_fetch_array($resu)){
                   ?>
                    <option value="<? echo $filas["codbanco"];?>"><?echo $filas["bancos"];?>
                  <?
          }?>
         </select> </td>
      </tr>
       <tr>
          <td><b>Tipo_Factura:</b></td>
           <td width="8"><select name="TipoFactura" class="cajas" id="TipoFactura">
	       <option value="PAGO FACTURA">PAGO FACTURA
	   </select></td>
       </tr>
        </tr>
      <tr>
         <td><b>Vlr_Pagado:</b></td>
         <td><input type="text" name="Vlr_Pagado" value="" size="13" maxlength="11" class="cajas" id="Vlr_Pagado" style="text-align:right;background-color:#9BCDFF"></td>
      </tr>
      <table border="0" align="center" width="460">
       <tr class="cajas">
       <th><b>Item</b></td><th></th><th>Nro_Factura</th><th><b>Cod_Zona</b></th><th><b>Zona</b></th><th><b>F_Vcto</b></th><th><b>Vlr_Factura</b></th><th>Saldo</th><th>Otro_Valor</th><th>Nuevo_Saldo</th>
       </tr>
       <?
       $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona from factura,zona
                where zona.codzona=factura.codzona and
	         factura.nsaldo > 0  and
                 zona.codzona='$CodZona' and
                 zona.reteica='NO'  and
                 zona.dcto='NO' order by factura.fechaven ASC";
       $resulta=mysql_query($consu)or die ("Error de busqueda cartera de facturas");
       $registro=mysql_affected_rows();
       if ($registro!=0){
                 $i=1;
                 $Contavalor=0;
		 echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
		 while ($filas_Z = mysql_fetch_array($resulta)){?>
    	                <tr class="cajas">
		              <th><?echo $i;?></th>
		              <?
                              echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
		              <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
		              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
                               <td> <input type="text" value="<?echo $filas_Z["fechaven"];?>" size="11" readonly class="cajas" style="text-align:center"></td>
                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
                              <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="13" style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
                              <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="13" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                              <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
                              <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
                              <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
                              <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
                         </tr>
                          <?
                         $i=$i+1;
                          $Contavalor = $Contavalor + $filas_Z["nsaldo"];
		 }
                 $Contavalor=number_format($Contavalor,0);
       }else{
            $consu="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona,zona.pordcto,zona.dcto from factura,zona
                where zona.codzona=factura.codzona and
	         factura.nsaldo > 0  and
                 zona.codzona='$CodZona' and
                 zona.reteica='NO'  and
                 zona.dcto='SI' order by factura.fechaven ASC";
	    $resulta=mysql_query($consu)or die ("Error de busqueda cartera de facturas con descuento");
	    $registro=mysql_affected_rows();
	    if ($registro!=0){
                  $i=1;
                 $Contavalor=0;
		 echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
		 while ($filas_Z = mysql_fetch_array($resulta)){
                        $DatoDcto=$filas_Z["pordcto"];
                        $Dcto = $filas_Z["dcto"];
                        $NroFactura = $filas_Z["nrofactura"];
                        ?>
    	                <tr class="cajas">
		              <th><?echo $i;?></th>
		              <?
                              $conD="select factura.*,zona.zona,zona.dirzona,zona.telzona,zona.nitzona,zona.dvzona,zona.pordcto,zona.dcto from factura,zona,descuentofactura
		                where zona.codzona=descuentofactura.codzona and
			              descuentofactura.nrofactura='$NroFactura'";
			     $resD=mysql_query($conD)or die ("Error de busqueda cartera de facturas con descuento");
                             $regD=mysql_num_rows($resD);
                              echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
   	                     <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
			     <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
	                     <td> <input type="text" value="<?echo $filas_Z["fechaven"];?>" size="11" readonly class="cajas" style="text-align:center"></td>
	                     <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
	                     <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
	                     <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="13" style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
	                     <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="13" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                             <?if($regD != 0){?>
                              <tr class="cajas">
                              <th><?echo $i;?></th>
		              <?
                              $NroFacturaDcto=$NroFactura;
                               echo ("<td><input type=\"checkbox\" id=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['nrofactura'] ."\" onClick=\"ActualizarSaldo()\"></td>");?>
                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nrofactura"];?>" size="10" readonly class="cajas"></td>
   	                     <td class="cajas"><input type="text" value="<?echo $CodZona;?>" name="CodZona[<? echo $i;?>]"id="CodZona[<? echo $i;?>]" size="8" readonly class="cajas"></td>
			     <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="45" readonly class="cajas"></td>
	                     <td> <input type="text" value="<?echo $filas_Z["fechaven"];?>" size="11" readonly class="cajas" style="text-align:center"></td>
                              <td> <input type="text" value="<?echo $filas_Z["grantotal"];?>" name="Total[<? echo $i;?>]" id="Total[<? echo $i;?>]" size="11" readonly style="text-align:right"  class="cajas"></td>
                              <td class="cajas"><input type="text" value="<?echo $filas_Z["nsaldo"];?>" name="SaldoP[<? echo $i;?>]" id="SaldoP[<? echo $i;?>]" size="11" readonly style="text-align:right;background-color:orange" class="cajas"></font></td>
	                     <td class="cajas"><input type="text" value="0" name="OtroValor[<? echo $i;?>]" id="OtroValor[<? echo $i;?>]" size="13" style="text-align:right;background-color:#A5D1D1" class="cajas"></font></td>
	                     <td class="cajas"><input type="text" value="0" name="Nuevo_Saldo[<? echo $i;?>]" id="Nuevo_Saldo[<? echo $i;?>]" size="13" style="text-align:right;background-color:#FFC1C1" class="cajas"></font></td>
                             <?}?>
	                         <input type="hidden" value="<?echo $filas_Z["dirzona"];?>" name="dirzona[<? echo $i;?>]"id="dirzona[<? echo $i;?>]" size="45" readonly class="cajas">
	                         <input type="hidden" value="<?echo $filas_Z["telzona"];?>" name="telzona[<? echo $i;?>]"id="telzona[<? echo $i;?>]" size="10" readonly class="cajas">
	                         <input type="hidden" value="<?echo $filas_Z["nitzona"];?>" name="nitzona[<? echo $i;?>]"id="nitzona[<? echo $i;?>]" size="12" readonly class="cajas">
	                         <input type="hidden" value="<?echo $filas_Z["dvzona"];?>" name="dvzona[<? echo $i;?>]"id="dvzona[<? echo $i;?>]" size="2" readonly class="cajas">
                         </tr>
                          <?
                         $i=$i+1;
                          $Contavalor = $Contavalor + $filas_Z["nsaldo"];
		 }
                 $Aux = 0;
                 $Aux = round(($Contavalor * $DatoDcto)/100);
                 $ValorDcto = number_format($Aux,0);
                 $Contavalor=number_format($Contavalor,0);
            }else{
                  ?>
	          <script language="javascript">
	             alert("No hay facturas en cartera para esta Empresa.!")
	              history.back()
                  </script>
                <?
           }
      }
                 ?>
            <tr>
               <th colspan="10"><b><div align="center">Total_Pagado</div></b></td>
               <div align="right"><input type="text" value="0" name="ValorPagado" id="ValorPagado" size="11" style="text-align:right;background-color:#A5D1D1" class="cajas"></div></td>
               <input type="hidden" value="<?echo $registro;?>" name="TotalRegistro" id="TotalRegistro" size="10" class="cajas">
               <input type="hidden" value="<?echo $Dcto;?>" name="DctoF" id="DctoF" size="10" class="cajas">
               <input type="hidden" value="<?echo $NroFacturaDcto;?>" name="NroFacturaDcto" id="NroFacturaDcto" size="10" class="cajas">
               <input type="hidden" value="<?echo $Aux;?>" name="VlrDcto" id="VlrDcto" size="10" class="cajas">
               <input type="text" value="<?echo $DatoDcto;?>" name="PorDcto" id="PorDcto" size="10" class="cajas">
            </tr>
            <tr>
               <th colspan="10"><b><div align="center">Saldo_Restante:</div></b></td>
               <div align="right"><input type="text" value="0" name="SaldoRestante" id="SaldoRestante" size="11" style="text-align:right;background-color:#3EC0FF" class="cajas"></div></td>
            </tr>
            <tr>
               <th colspan="10"><b><div align="center">Dcto_Autorizado:</div></b></td>
               <div align="right"><input type="text" value="<?echo $ValorDcto;?>" name="Dcto" id="Dcto" size="11" style="text-align:right;background-color:#AEAEFF" class="cajas"></div></td>
            </tr>
           <tr><td><br></td></tr>
            <tr><th colspan="10"><div align="right"><b>Total_Cartera:&nbsp;<?echo $Contavalor;?></b></div></tde></tr>
            <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Enviar" class="boton" id="buscar" name="buscar" id="buscar" name="buscar"></td>
          </table>
     </table>
   </form>
</body>
</html>
