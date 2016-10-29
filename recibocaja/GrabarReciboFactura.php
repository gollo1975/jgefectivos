<input type="hidden" name="fechapago" value="<?echo $fechapago;?>">
<input type="hidden" name="ValidarPago" value="<?echo $ValidarPago;?>">
<?
if(empty($datos)){
   ?>
   <script language="javascript">
      alert("Debe de chequear las diferentes cajas de verificacion para generar el Documento.!")
      history.back()
   </script>
   <?
}else{
   include("../numeros.php");
   $nota=
   $letras=num2letras($Vlr_Pagado);
   $letras=strtoupper($letras);
   $FechaV=date("Y-m-d");
   include("../conexion.php");
   $consulta = "select count(*) from maestrorecibo";
        $result = mysql_query ($consulta);
        $sw = mysql_fetch_row($result);
        if ($sw[0]>0):
           $consulta = "select max(cast(nrocaja as unsigned)) + 1 from maestrorecibo";
           $result = mysql_query($consulta) or die ("Fallo en la consulta");
           $codco = mysql_fetch_row($result);
           $Nroc = str_pad ($codco[0], 6, "0", STR_PAD_LEFT);
        else:
          $Nroc="000001";
        endif;
        $Normal='CANCELA FACTURA DE VENTA';
        $consulta="insert into maestrorecibo(nrocaja,codmaestro,codmuni,fechaRa,fechapago,vlrpagado,letras,idrecibo)
                   values('$Nroc','$NitEmpresa','$CodMuni','$FechaV','$fechapago','$Vlr_Pagado','$letras','$TipoRecibo')";
        $resultado=mysql_query($consulta)or die("Erro al crear el recibo de caja");
        $registro=mysql_affected_rows();
        if($TipoPago=='NORMAL'){
	    for ($k=1 ; $k<=$tActualizaciones; $k ++){
	        if   ($datos[$k] != ""){
	            if($OtroValor[$k]==0){
	                   $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,retefuente,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
	                   values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$SaldoP[$k]','$SaldoP[$k]','$ReteFuente[$k]','$CodBanco','$TipoCta','$FormaPago','$OtroValor[$k]','$Normal','$CodZona[$k]')";
	                   $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas iniciando ");
	                   $registro=mysql_affected_rows();
			   $Act="update factura set nsaldo='$OtroValor[$k]',estado='CANCELADA' where factura.nrofactura='$datos[$k]'";
			   $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");

	            }else{
	                    $concepto='ABONA A FACTURA DE VENTA';
	                    $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
	                    values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$concepto','$CodZona[$k]')";
	                    $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas segunda ");
	                    $registro=mysql_affected_rows();
	                    $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='ABONADA' where factura.nrofactura='$datos[$k]'";
			    $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");
	            }
	        }
	    }
        }else{
             $Descuento='CANCELA FACTURA DE VENTA';
             if($TipoPago=='DESCUENTO'){
                  for ($k=1 ; $k<=$tActualizaciones; $k ++){
	              if   ($datos[$k] != ""){
	                  if($OtroValor[$k]==0){
		                $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,retefuente,descuento,pordcto,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
		                 values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$Nuevo_Saldo[$k]','$Nuevo_Saldo[$k]','$ReteFuente[$k]','$VlrDescuento[$k]','$PorDcto[$k]','$CodBanco','$TipoCta','$FormaPago','$OtroValor[$k]','$Descuento','$CodZona[$k]')";
		                 $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas iniciando ");
		                 $registro=mysql_affected_rows();
			       	 $Act="update factura set nsaldo='$OtroValor[$k]',estado='CANCELADA' where factura.nrofactura='$datos[$k]'";
				 $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");

	                  }else{
	                         $concepto='ABONA A FACTURA DE VENTA';
	                         $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
	                         values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$concepto','$CodZona[$k]')";
	                         $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas segunda ");
	                         $registro=mysql_affected_rows();
	                        $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='ABONADA' where factura.nrofactura='$datos[$k]'";
			        $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");
	                  }
	              }
  	          }
             }else{
                   $Riva='CANCELA FACTURA DE VENTA';
                   if($TipoPago=='RETEIVA'){
                      for ($k=1 ; $k<=$tActualizaciones; $k ++){
	                  if   ($datos[$k] != ""){
	                      if($OtroValor[$k]==0){
			                 $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,retefuente,reteiva,poriva,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
			                 values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$SaldoP[$k]','$SaldoP[$k]','$ReteFuente[$k]','$ReteIva[$k]','$PorDcto[$k]','$CodBanco','$TipoCta','$FormaPago','$OtroValor[$k]','$Riva','$CodZona[$k]')";
			                 $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas iniciando ");
			                 $registro=mysql_affected_rows();
					 $Act="update factura set nsaldo='$OtroValor[$k]',estado='CANCELADA' where factura.nrofactura='$datos[$k]'";
					 $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");

	                      }else{
		                         $concepto='ABONA A FACTURA DE VENTA';
		                         $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
		                         values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$concepto','$CodZona[$k]')";
		                         $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas segunda ");
		                         $registro=mysql_affected_rows();
		                        $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='ABONADA' where factura.nrofactura='$datos[$k]'";
				        $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");
		              }
	                  }
  	              }
                   }else{
                         $Rica='CANCELA FACTURA DE VENTA';
                         if($TipoPago=='RETEICA'){
                              for ($k=1 ; $k<=$TotalR; $k ++){
	                          if   ($datos[$k] != ""){
                                  echo $Nuevo_Saldo[$k];
	                             if($Nuevo_Saldo[$k]==0){
			                 $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,retefuente,reteica,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
			                 values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$ReteFuente[$k]','$ReteIca[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$Rica','$CodZona[$k]')";
			                 $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas iniciando ");
			                 $registro=mysql_affected_rows();
					 $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='CANCELADA' where factura.nrofactura='$datos[$k]'";
					 $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");

	                             }else{
		                        $concepto='ABONA A FACTURA DE VENTA';
		                         $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
		                         values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$Nuevo_Saldo[$k]','$OtroValor[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$concepto','$CodZona[$k]')";
		                         $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas segunda ");
		                         $registro=mysql_affected_rows();
		                        $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='ABONADA' where factura.nrofactura='$datos[$k]'";
				        $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");
		                     }
	                          }
  	                      }
                         }else{
                               $Ricariva='CANCELA FACTURA DE VENTA';
                              if($TipoPago=='RETEIVARETEICA'){
                                  for ($k=1 ; $k<=$tActualizaciones; $k ++){
	                              if   ($datos[$k] != ""){
	                                  if($Nuevo_Saldo[$k]==0){
			                      $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,poriva,reteiva,retefuente,reteica,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
			                      values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$PorDcto[$k]','$ReteIva[$k]','$ReteFuente[$k]','$ReteIca[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$Ricariva','$CodZona[$k]')";
			                      $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas iniciando ");
			                      $registro=mysql_affected_rows();
				              $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='CANCELADA' where factura.nrofactura='$datos[$k]'";
					      $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");

	                                  }else{
		                              $concepto='ABONA A FACTURA DE VENTA';
		                              $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
		                              values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$concepto','$CodZona[$k]')";
		                              $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas segunda ");
		                              $registro=mysql_affected_rows();
		                              $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='ABONADA' where factura.nrofactura='$datos[$k]'";
				              $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");
                                          }
		                     }
	                          }
                              }else{
                                    $Todo='CANCELA FACTURA DE VENTA';
                                   for ($k=1 ; $k<=$tActualizaciones; $k ++){
	                              if   ($datos[$k] != ""){
	                                  if($Nuevo_Saldo[$k]==0){
			                      $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,poriva,reteiva,retefuente,pordcto,descuento,reteica,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
			                      values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$PorDcto[$k]','$ReteIva[$k]','$ReteFuente[$k]','$DctoF[$k]','$VlrDescuento[$k]','$ReteIca[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$Todo','$CodZona[$k]')";
			                      $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas iniciando ");
			                      $registro=mysql_affected_rows();
				              $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='CANCELADA' where factura.nrofactura='$datos[$k]'";
					      $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");

	                                  }else{
		                              $concepto='ABONA A FACTURA DE VENTA';
		                              $con="insert into recibo(nrocaja,fechare,nrofactura,zona,dir,telefono,nit,dv,valor,abono,codbanco,cuenta,pago,nuevosaldo,concepto,codzona)
		                              values('$Nroc','$fechapago','$datos[$k]','$zona[$k]','$dirzona[$k]','$telzona[$k]','$nitzona[$k]','$dvzona[$k]','$OtroValor[$k]','$OtroValor[$k]','$CodBanco','$TipoCta','$FormaPago','$Nuevo_Saldo[$k]','$concepto','$CodZona[$k]')";
		                              $resulta=mysql_query($con)or die("Error al grabar el detalle de las facturas segunda ");
		                              $registro=mysql_affected_rows();
		                              $Act="update factura set nsaldo='$Nuevo_Saldo[$k]',estado='ABONADA' where factura.nrofactura='$datos[$k]'";
				              $RegA=mysql_query($Act)or die("Error al actualizar la tabla factura");
                                          }
		                     }
	                          }
                              }
                         }
                   }
             }
        }
       echo "<script language=\"javascript\">";
       echo ("open (\"imprimirRecibo.php?NroRecibo=$Nroc\" ,\"\");");
        echo "</script>";
        ?>
              <script language="javascript">
               open("PagoGrupal.php","_self");
             </script>
        <?
}
?>
