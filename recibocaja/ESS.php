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
