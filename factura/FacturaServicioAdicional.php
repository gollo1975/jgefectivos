<html>

<head>
  <title>Factura de Venta</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
	function ColorFoco(obj)
	{
       		document.getElementById(obj).style.background="#9DFF9D"
	}

	function QuitarFoco(obj)
	{
		document.getElementById(obj).style.background="white"
	}
        function ValidarDcto()
           {
		var Dcto = 0;
		var VlrUnitario = 0;
		var TotalDcto = 0;
		var Unidad = 0;
		var TotalValor = 0;
                var TotalValorPagar = 0;
		var totalitem = document.getElementById("ContadorRegistro").value;
		for (j=1; j<=totalitem; j++){
			Unidad = parseFloat(document.getElementById("Cantidad[" + j +"]").value);
	                VlrUnitario = parseFloat(document.getElementById("VlrUnitario[" + j +"]").value) ;
			TotalValor = parseFloat(Unidad * VlrUnitario);
			Dcto = parseFloat(document.getElementById("Dcto[" + j +"]").value);
			TotalDcto = parseFloat(TotalValor * Dcto)/100;
			TotalValorPagar = parseFloat(TotalValor - TotalDcto);
			document.getElementById("Total[" + j + "]").value= TotalValorPagar.toFixed(0);
                 }
            }
       function ActualizarImpuestos()
         {
         var PorFuente = 0;
         var PorReteIva = 0
         var PorCree = 0;
         var PorIva = 0;
         var Subtotal = 0;
         var ValorFuente = 0;
         var ValorCree = 0;
         var ValorIva = 0;
         var ValorReteIva = 0;
         var $TotalPagar = 0;
         var TipoBaseVenta = 0
         var Total = document.getElementById("ContadorRegistro").value;
         for (k=1; k<=Total; k++){
             PorFuente = parseFloat(document.getElementById("PorcentajeRetencionFuente").value);
             PorCree = parseFloat(document.getElementById("PorcentajeCree").value);
             PorReteIva = parseFloat(document.getElementById("PorcentajeRetencionIva").value);
             PorIva = parseFloat(document.getElementById("IvaFacturado").value);
             TipoBaseVenta = parseFloat(document.getElementById("TipoBaseVenta").value);
             Subtotal = parseFloat(document.getElementById("Total["+ k +"]").value);
             if(Subtotal > TipoBaseVenta){
	          ValorFuente = parseFloat((Subtotal * PorFuente)/100);
             }else{
                 ValorFuente = 0;
             }
             ValorCree = parseFloat((Subtotal * PorCree)/100);
             ValorIva = parseFloat((Subtotal * PorIva)/100);
             ValorReteIva = parseFloat((ValorIva * PorReteIva)/100);
             TotalPagar = parseFloat((Subtotal + ValorIva)-(ValorFuente + ValorReteIva));
             document.getElementById("SubtotalServicio").value = Subtotal.toFixed(0);
             document.getElementById("ValorFuente").value = ValorFuente.toFixed(0);
             document.getElementById("ValorCree").value = ValorCree.toFixed(0);
             document.getElementById("ValorIva").value = ValorIva.toFixed(0);
             document.getElementById("ValorReteIva").value = ValorReteIva.toFixed(0);
             document.getElementById("ValorTotal").value = TotalPagar.toFixed(0);
         }
      }

</script>
</head>
<body>
<input type="hidden" name="ValorAjusteFactura" value="<?echo $ValorAjusteFactura;?>" id="ValorAjusteFactura">
<?php
if(empty($CodZona)){
    ?>
    <script language="javascript">
       alert("Seleccione el cliente para facturarle.!")
       history.back()
    </script>
    <?
}elseif(empty($NroServicio)){
       ?>
       <script language="javascript">
	   alert("Seleccione el servicio a facturar.!")
	   history.back()
       </script>
       <?
}else{
	include("../conexion.php");
	/*codigo que busca la zona*/
      	$SqlZona="select zona.zona,zona.iva,zona.vlrfte,zona.vlriva,zona.porcre,sucursal.dian,sucursal.rango,sucursal.rango2 from sucursal,zona
	where  sucursal.codsucursal=zona.codsucursal and
               zona.codzona='$CodZona'";
	$RsZona=mysql_query($SqlZona)or die("Error en la busqueda de la zona.");
	$filaZ=mysql_fetch_array($RsZona);
	$Zona=$filaZ["zona"];
	$IvaFacturado = $filaZ["iva"];
        $ResolucionDian = $filaZ["dian"];
        $InicioResolucion = $filaZ["rango"];
        $FinalResolucion = $filaZ["rango2"];
        /*informacion tributaria*/
        $PorcentajeRetencionIva = $filaZ["vlriva"];
        $PorcentajeCree = $filaZ["porcre"];
	/*codigo de cobrozona*/
         $Sql="select item.concepto,item.basefte from item
	       where item.codcom='$NroServicio'";
	$Rs=mysql_query($Sql)or die("Error en la busqueda del numero del servicio");
	$TotalRegistro = mysql_num_rows($Rs);
        /*codigo de la base*/
        $SqlB="select tipofactura.basegrabado from tipofactura
	       where tipofactura.nroservicio='$TipoFactura'";
	$RsB=mysql_query($SqlB)or die("Error en la busqueda del servicio para la base.");
	$filaB=mysql_fetch_array($RsB);
	$TipoBaseVenta = $filaB["basegrabado"];
         ?>
	<center><h4><u>FACTURA DE VENTA</u></h4></center>
	<form action="GrabarFacturaNueva.php" method="post" id="Busqueda" name="Busqueda">
		<input type="hidden" name="AplicaIva" value="<?echo $AplicaIva;?>" id="AplicaIva">
		<input type="hidden" name="ResolucionDian" value="<?echo $ResolucionDian;?>" id="ResolucionDian">
		<input type="hidden" name="InicioResolucion" value="<?echo $InicioResolucion;?>" id="InicioResolucion">
		<input type="hidden" name="FinalResolucion" value="<?echo $FinalResolucion;?>" id="FinalResolucion">
		<input type="hidden" name="PorcentajeRetencionIva" value="<?echo $PorcentajeRetencionIva;?>" id="PorcentajeRetencionIva">
		<input type="hidden" name="PorcentajeCree" value="<?echo $PorcentajeCree;?>" id="PorcentajeCree">
		<input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">
                <input type="hidden" name="TotalRegistro" value="<?echo $TotalRegistro;?>" id="TotalRegistro">
		<table border="0" align="center">
				<tr>
				   <td><b>Tipo_Factura:</b></td>
				   <td><input type="text" name="TipoFactura" value="<?echo $TipoFactura;?>" size="3" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoFactura"><?echo $Servicio;?></td>
			    	   <td><b>Tipo_Proceso:</b></td>
				   <td><input type="text" name="TipoProceso" value="<?echo $TipoProceso;?>" size="26" readonly class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoProceso"></td>
	                        </tr>
	                        <tr>
				   <td><b>Codigo_Zona:</b></td>
				   <td colspan="15"><input type="text" name="CodZona" value="<?echo $CodZona;?>" size="3" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="TipoFactura"><?echo $Zona;?></td>
				</tr>
				<tr>
					<td><b>Nro_Servicio:</b></td>
					<td><input type="text" name="NroServicio" value="<?echo $NroContrato;?>" size="20" maxlength="10" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroServicio"></td>
	                                <?if($AplicaIva=='SI'){?>
	                                    <td><b>Iva:</b></td>
					    <td><input type="text" name="IvaFacturado" value="<?echo $IvaFacturado;?>" size="26" maxlength="10" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="IvaFacturado"></td>
	                                <?}else{?>
	                                    <td><b>Iva:</b></td>
					    <td><input type="text" name="IvaFacturado" value="0" size="26" maxlength="10" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="IvaFacturado"></td>
	                                <?}?>
				</tr>
	                        <tr>
					<td><b>Fecha_Inicio:</b></td>
					<td><input type="text" name="Fecha_Inicio" value="<?echo date('Y-m-d')?>" size="20" maxlength="10"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Fecha_Inicio"></td>
	                                <td><b>Fecha_Vcto:</b></td>
					<td><input type="text" name="Fecha_Vcto" value="<?echo date('Y-m-d')?>" size="26" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Fecha_Vcto"></td>
				</tr>
                                <tr>
		                            <td><b>Observación:</b></td>
		                            <td colspan="15"><textarea name="observacion" cols="64" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion" style="width: 436px"> </textarea></td>
		                       </tr>
                               <table border="0" align="center" >
				<tr class="cajas">
				<th><b>Item</b></td></th><th><b></b></th><th><b>Código</b></th><th><b>Concepto</b></th><th><b>Cant.</b></th><th><b>Vlr_Unit.</b></th><th><b>Dcto</b></th><th><b>Total</b></th>
				</tr>
				<?
				$i=1;
                                echo ("<input type=\"hidden\" id=\"ContadorRegistro\" name=\"ContadorRegistro\" value=\"" . mysql_num_rows($Rs) . "\">");
  			        while($filas=mysql_fetch_array($Rs)):
                                      $PorcentajeRetencionFuente = $filas["basefte"];
					?>
					<tr class="cajas">
					<th><?echo $i;?></th>
					<?
                                        echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $NroServicio ."\"  onclick=\"ActualizarImpuestos()\"></td>");?>
                                         <td><input type="text" value="<?echo $NroServicio;?>" size="10" readonly class="cajas"></td>
	                                 <td><input type="text" value="<?echo $filas["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]"size="45" readonly class="cajas"></td>
	                                 <td><input type="text" value="<?echo $ContadorEmpleado;?>" name="Cantidad[<? echo $i;?>]"id="Cantidad[<? echo $i;?>]"size="4" class="cajas"></td>
	                                 <td><input type="text" value="<?echo $VlrUnit;?>" name="VlrUnitario[<? echo $i;?>]"id="VlrUnitario[<? echo $i;?>]"size="18" class="cajas" style="text-align:right;background-color:#27B138"></td>
	                                 <td><input type="text" value="0" name="Dcto[<? echo $i;?>]"id="Dcto[<? echo $i;?>]"size="4" class="cajas"></td>
	                                 <td><input type="text" value="" name="Total[<? echo $i;?>]"id="Total[<? echo $i;?>]"size="15" class="cajas"  onfocus="ValidarDcto()" style="text-align:right;background-color:#27B138"></td>
                                         <input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">
                                         <input type="hidden" name="PorcentajeRetencionFuente" value="<?echo $PorcentajeRetencionFuente;?>" id="PorcentajeRetencionFuente">
					</tr>
					<?
					$i=$i+1;
				endwhile;
			        ?>
				<tr>
				<tr><td><br></td></tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">SubTotal(+):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="" size="15" name="SubtotalServicio" id="SubtotalServicio" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
                                </tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Rete Fuente(<?echo $PorcentajeRetencionFuente;?>):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="" name="ValorFuente" id="ValorFuente" size="15" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Impuesto Cree(<?echo $PorcentajeCree;?>):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="" name="ValorCree" id="ValorCree" size="15" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Iva(<?echo $IvaFacturado;?>):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="" name="ValorIva" id="ValorIva" size="15" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Rete Iva(<?echo $PorcentajeRetencionIva;?>):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="" name="ValorReteIva" id="ValorReteIva" size="15" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Total_Pagar(+):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="" name="ValorTotal" id="ValorTotal" size="15" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
				</tr>
					<tr><td><br></td></tr>
					<tr>
					<td colspan="4"><input type="submit" value="Crear Factura" class="boton"></td>
				</tr>
		        </table>
		</form>
                <div align="center"><a href="ProcesoFacturacion.php"><img src="../image/regresar.png" border="0" title="Regresar al menu de factuacion."></div>
         <?
 }
?>
</body>
</html>
