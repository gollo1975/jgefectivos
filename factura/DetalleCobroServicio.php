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
    
</script>
</head>
<body>
<input type="hidden" name="ValorAjusteFactura" value="<?echo $ValorAjusteFactura;?>" id="ValorAjusteFactura">
<?php
if(empty($TipoServicio)){
  ?>
  <script language="javascript">
   alert("Seleccione el tipo de Servicio para esta factura.!")
   history.back()
  </script>
<?
}else{
  /*codigo de tipo factura*/
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
        $PorcentajeRetencionFuente = $filaZ["vlrfte"];
        $PorcentajeRetencionIva = $filaZ["vlriva"];
        $PorcentajeCree = $filaZ["porcre"];
	/*codigo de cobrozona*/
        if ($TipoServicio=='Misional'){
		$Sql="select cobrozona.codigo,cobrozona.desde,cobrozona.hasta,detalladozona.periocidad,cobrozona.subtotalsinadmon,cobrozona.admon,cobrozona.ivatotal,cobrozona.ajuste,cobrozona.subtotal,cobrozona.grantotal,cobrozona.contador from cobrozona,detalladozona
		        where  detalladozona.codzona=cobrozona.codzona and
		               cobrozona.codigo='$NroServicio' and cobrozona.codzona='$CodZona'";
		$Rs=mysql_query($Sql)or die("Error en la busqueda del numero del servicio");
		$filaCosto=mysql_fetch_array($Rs);
		$Fecha_Inicio = $filaCosto["desde"];
		$Fecha_Final = $filaCosto["hasta"];
		$Periodo=$filaCosto["periocidad"];
	        $ContadorEmpleado=$filaCosto["contador"];
	        $SubtotalServicio=$filaCosto["subtotal"];
	        $Subtotal=$filaCosto["subtotalsinadmon"];
	        $Admon=$filaCosto["admon"];
			$ValorAjusteFactura = $filaCosto["ajuste"];
        }else{
                $Sql="select relacionexamen.*,detalladozona.periocidad from relacionexamen,zona,detalladozona
		        where  relacionexamen.codzona=detalladozona.codzona and
                               relacionexamen.codzona=zona.codzona and
		               relacionexamen.radicado='$NroServicio' and
                               zona.codzona='$CodZona'";
	        $Rs=mysql_query($Sql)or die("Error en la busqueda del numero del servicio");
                $filaCosto=mysql_fetch_array($Rs);
                $SubtotalServicio=$filaCosto["total"];
                $ContadorEmpleado=$filaCosto["contador"];
               	$Periodo=$filaCosto["periocidad"];
                $Fecha_Inicio = date('Y-m-d');
        }
	$fechaSistema = date('Y-m-d');
	$fecha = $fechaSistema;
	if($Periodo==7):
	   $nuevafecha = strtotime ( '+ 7 day' , strtotime ( $fecha ) ) ;
	   $Fecha_Vcto = date ( 'Y-m-d' , $nuevafecha );
	else:
	   if($Periodo==10):
	       $nuevafecha = strtotime ( '+ 10 day' , strtotime ( $fecha ) )-1 ;
	       $Fecha_Vcto = date ( 'Y-m-d' , $nuevafecha );
	   else:
	       if($Periodo==14):
	           $nuevafecha = strtotime ( '+ 14 day' , strtotime ( $fecha ) )-1;
	           $Fecha_Vcto = date ( 'Y-m-d' , $nuevafecha );
	       else:
	           if($Periodo==15):
	               $nuevafecha = strtotime ( '+ 15 day' , strtotime ( $fecha ) )-1 ;
	               $Fecha_Vcto = date ( 'Y-m-d' , $nuevafecha );
	           else:
	               if($Periodo==30):
	                   $nuevafecha = strtotime ( '+ 30 day' , strtotime ( $fecha ) )-1 ;
	                   $Fecha_Vcto = date ( 'Y-m-d' , $nuevafecha );
	               else:
	                   $nuevafecha = strtotime ( '+ 1 day' , strtotime ( $fecha ) ) ;
	                   $Fecha_Vcto = date ( 'Y-m-d' , $nuevafecha );
	               endif;
	           endif;
	       endif;
	   endif;
	endif;
        /*fin codigo*/
	if(mysql_num_rows($Rs) > 0){
           if($AjusteF=='NO'){
               if($TipoServicio=='Misional'){
                   $ValorBase = round($SubtotalServicio / $TipoVlr);
                   $Item="select item.* FROM item
	                 where item.misional='SI' order by item.puc ASC";
               }else{
                     $ValorBase = round($SubtotalServicio / $TipoVlr);
                   $Item="select item.* FROM item
	                 where item.examen='SI' order by item.puc ASC";
               }
           }else{
               $ValorBase = round(($SubtotalServicio)/ $TipoVlr);
               $Item="select item.* FROM item
	             where (item.misional='SI' OR item.ajuste='SI') order by item.puc ASC";
           }
	       $RsItem=mysql_query($Item)or die("Error en la busqueda de item de facturacion");
               $TotalRegistro = mysql_num_rows($RsItem);
           ?>

		<center><h4><u>FACTURA DE VENTA</u></h4></center>
		<form action="GrabarFacturaNueva.php" method="post" id="Busqueda" name="Busqueda">
			<input type="hidden" name="AplicaIva" value="<?echo $AplicaIva;?>" id="AplicaIva">
                        <input type="hidden" name="TotalRegistro" value="<?echo $TotalRegistro;?>" id="TotalRegistro">
                        <input type="hidden" name="AjusteF" value="<?echo $AjusteF;?>" id="AjusteF">
                        <input type="hidden" name="TipoVlr" value="<?echo $TipoVlr;?>" id="TipoVlr">
                         <input type="hidden" name="SubtotalServicio" value="<?echo $SubtotalServicio;?>" id="SubtotalServicio">
                        <input type="hidden" name="ResolucionDian" value="<?echo $ResolucionDian;?>" id="ResolucionDian">
                        <input type="hidden" name="InicioResolucion" value="<?echo $InicioResolucion;?>" id="InicioResolucion">
                        <input type="hidden" name="FinalResolucion" value="<?echo $FinalResolucion;?>" id="FinalResolucion">
                        <input type="hidden" name="PorcentajeRetencionFuente" value="<?echo $PorcentajeRetencionFuente;?>" id="PorcentajeRetencionFuente">
                        <input type="hidden" name="PorcentajeRetencionIva" value="<?echo $PorcentajeRetencionIva;?>" id="PorcentajeRetencionIva">
                        <input type="hidden" name="PorcentajeCree" value="<?echo $PorcentajeCree;?>" id="PorcentajeCree">
                        <input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">
                        <input type="hidden" name="ValorAjusteFactura" value="<?echo $ValorAjusteFactura;?>" id="ValorAjusteFactura">
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
					<td><input type="text" name="NroServicio" value="<?echo $NroServicio;?>" size="20" maxlength="10" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="NroServicio"></td>
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
					<td><input type="text" name="Fecha_Inicio" value="<?echo date('Y-m-d');?>" size="20" maxlength="10"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Fecha_Inicio"></td>
	                                <td><b>Fecha_Vcto:</b></td>
					<td><input type="text" name="Fecha_Vcto" value="<?echo $Fecha_Vcto;?>" size="26" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Fecha_Vcto"></td>
				</tr>
                                <?if($TipoServicio=='Misional'){?>
		                        <tr>
		                            <td><b>Observación:</b></td>
		                            <td colspan="15"><textarea name="observacion" cols="64" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion" style="width: 413px">SERVICIO MISIONAL TEMPORAL DEL <?echo $Fecha_Inicio;?> AL <?echo $Fecha_Final;?> </textarea></td>
		                       </tr>
                                <?}else{?>
                                       <tr>
		                            <td><b>Observación:</b></td>
		                            <td colspan="15"><textarea name="observacion" cols="64" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion" style="width: 413px">EXAMENES MEDICOS PERSONAL MISIONAL </textarea></td>
		                       </tr>
                                <?}?>
                               <table border="0" align="center" >
				<tr class="cajas">
				<th><b>Item</b></td></th><th><b></b></th><th><b>Código</b></th><th><b>Concepto</b></th><th><b>Cant.</b></th><th><b>Vlr_Unit.</b></th><th><b>Dcto</b></th><th><b>Total</b></th>
				</tr>
                                <input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">
				<?
				$i=1;
                                echo ("<input type=\"hidden\" id=\"ContadorRegistro\" name=\"ContadorRegistro\" value=\"" . mysql_num_rows($RsItem) . "\">");
  			        while($filas=mysql_fetch_array($RsItem)):
                                      $CodItem[$i] = $filas["codcom"];
					?>
					<tr class="cajas">
					<th><?echo $i;?></th>
					<?
                                        /*CODIGO DE ADMON*/
                                       if($CodItem[$i]=='41559501'){
                                               $VlrUnit = ($Admon/$ContadorEmpleado);
					                         echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $filas['codcom'] ."\"></td>");?>
	                                         <td><input type="text" value="<?echo $filas["codcom"];?>" size="10" readonly class="cajas"></td>
	                                        <td><input type="text" value="<?echo $filas["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]"size="45" readonly class="cajas"></td>
	                                        <td><input type="text" value="<?echo $ContadorEmpleado;?>" name="Cantidad[<? echo $i;?>]"id="Cantidad[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $VlrUnit;?>" name="VlrUnitario[<? echo $i;?>]"id="VlrUnitario[<? echo $i;?>]"size="13" class="cajas" style="text-align:right;background-color:#27B138"></td>
	                                        <td><input type="text" value="0" name="Dcto[<? echo $i;?>]"id="Dcto[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $Admon;?>" name="Total[<? echo $i;?>]"id="Total[<? echo $i;?>]"size="13" class="cajas" style="text-align:right;background-color:#27B138"></td>
                                        <?
                                         }
                                          /*CODIGO DE INGRESO TRABAJADORES*/
                                        if($CodItem[$i]=='41559510'){
                                               if ($TipoServicio=='Misional'){
                                                   $VlrUnitIngreso = ($Subtotal/$ContadorEmpleado);
                                                   $VlrUnitIngreso = round($VlrUnitIngreso,2);
                                               }else{
                                                   $Subtotal = $SubtotalServicio;
                                                   $VlrUnitIngreso = ($SubtotalServicio/$ContadorEmpleado);
                                                   $VlrUnitIngreso = round($VlrUnitIngreso,2);
                                               }
					        echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $filas['codcom'] ."\"></td>");?>
	                                         <td><input type="text" value="<?echo $filas["codcom"];?>" size="10" readonly class="cajas"></td>
	                                        <td><input type="text" value="<?echo $filas["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]"size="45" readonly class="cajas"></td>
	                                        <td><input type="text" value="<?echo $ContadorEmpleado;?>" name="Cantidad[<? echo $i;?>]"id="Cantidad[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $VlrUnitIngreso;?>" name="VlrUnitario[<? echo $i;?>]"id="VlrUnitario[<? echo $i;?>]"size="13" class="cajas" style="text-align:right;background-color:#27B138"></td>
	                                        <td><input type="text" value="0" name="Dcto[<? echo $i;?>]"id="Dcto[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $Subtotal;?>" name="Total[<? echo $i;?>]"id="Total[<? echo $i;?>]"size="13" class="cajas" style="text-align:right;background-color:#27B138"></td>
                                        <?
                                         }
                                          /*CODIGO DE AJUSTE TRABAJADORES*/
                                         if($CodItem[$i]=='410570'){
                                                echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $filas['codcom'] ."\"></td>");?>
	                                         <td><input type="text" value="<?echo $filas["codcom"];?>" size="10" readonly class="cajas"></td>
	                                        <td><input type="text" value="<?echo $filas["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]"size="45" readonly class="cajas"></td>
	                                        <td><input type="text" value="1" name="Cantidad[<? echo $i;?>]"id="Cantidad[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $ValorAjusteFactura;?>" name="VlrUnitario[<? echo $i;?>]"id="VlrUnitario[<? echo $i;?>]"size="13" class="cajas"  style="text-align:right;background-color:#70EBCF"></td>
	                                        <td><input type="text" value="0" name="Dcto[<? echo $i;?>]"id="Dcto[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $ValorAjusteFactura;?>" name="Total[<? echo $i;?>]"id="Total[<? echo $i;?>]"size="13" class="cajas" style="text-align:right;background-color:#70EBCF"></td>
                                        <?
                                         }
                                          /*CODIGO APLCAR  BASE DE IVA*/
                                         if($CodItem[$i]=='102030'){
					        echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $filas['codcom'] ."\"></td>");?>
	                                         <td><input type="text" value="<?echo $filas["codcom"];?>" size="10" readonly class="cajas"></td>
	                                        <td><input type="text" value="<?echo $filas["concepto"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]"size="45" readonly class="cajas"></td>
	                                        <td><input type="text" value="1" name="Cantidad[<? echo $i;?>]"id="Cantidad[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $ValorBase;?>" name="VlrUnitario[<? echo $i;?>]"id="VlrUnitario[<? echo $i;?>]"size="13" class="cajas" style="text-align:right;background-color:#FFC1C1"></td>
	                                        <td><input type="text" value="0" name="Dcto[<? echo $i;?>]"id="Dcto[<? echo $i;?>]"size="4" class="cajas"></td>
	                                        <td><input type="text" value="<?echo $ValorBase;?>" name="Total[<? echo $i;?>]"id="Total[<? echo $i;?>]"size="13" class="cajas" style="text-align:right;background-color:#FFC1C1"></td>
                                        <?
                                         }
                                         ?>
					</tr>
					<?
					$i=$i+1;
				endwhile;
                                /*homologacion de variables*/
                                $ValorSubtotal = $SubtotalServicio;
                                if($TipoFactura==1){
                                    if($ValorBase > $TipoBaseVenta){
                                        $ValorFuente = round(($ValorBase * $PorcentajeRetencionFuente)/100);
                                    }else{
                                        $ValorFuente = 0;
                                    }
                                }
                                $ValorCree = round(($ValorBase * $PorcentajeCree)/100);
                                $ValorIva = round(($ValorBase * $IvaFacturado)/100);
                                $ValorReteIva = round(($ValorIva * $PorcentajeRetencionIva)/100);
                                $ValorTotal =  round(($ValorSubtotal + $ValorIva)-($ValorFuente + $ValorReteIva));
                                $GranSubtotal = number_format($ValorSubtotal,0);
                                $GranFuente =  number_format($ValorFuente,0);
                                $GranCree =  number_format($ValorCree,0);
                                $GranIva =  number_format($ValorIva,0);
                                $GranReteIva =  number_format($ValorReteIva,0);
                                $GranTotal =  number_format($ValorTotal,0);
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
				<td colspan="10"><div align="right"><input type="text" value="<?echo $GranSubtotal;?>" size="13" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
                                </tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Rete Fuente(-):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="<?echo $GranFuente;?>" name="ValorFuente" id="ValorFuente" size="13" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
                                <input type="hidden" name="ValorFuente" value="<?echo $ValorFuente;?>" id="ValorFuente">
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Impuesto Cree(-):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="<?echo $GranCree;?>"  size="13" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
                                <input type="hidden" name="ValorCree" value="<?echo $ValorCree;?>" id="ValorCree">
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Iva(+):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="<?echo $GranIva;?>" size="13" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
                                <input type="hidden" name="ValorIva" value="<?echo $ValorIva;?>" id="ValorIva">
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Rete Iva(-):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="<?echo $GranReteIva;?>" size="13" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
                                <input type="hidden" name="ValorReteIva" value="<?echo $ValorReteIva;?>" id="ValorReteIva">
				</tr>
                                <tr>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th><div align="right">Total_Pagar(+):</div></th>
				<th>&nbsp;</th>
				<td colspan="10"><div align="right"><input type="text" value="<?echo $ValorTotal;?>" size="13" style="text-align:right;background-color:#54A7A7" class="cajas"></div></td>
                                <input type="hidden" name="ValorTotal" value="<?echo $ValorTotal;?>" id="ValorTotal">
				</tr>
					<tr><td><br></td></tr>
					<tr>
					<td colspan="4"><input type="submit" value="Crear Factura" class="boton"></td>
				</tr>
		        </table>
		</form>
                <div align="center"><a href="ProcesoFacturacion.php"><img src="../image/regresar.png" border="0" title="Regresar al menu de factuacion."></div>
	<?
	}else{
	    ?>
	     <script language="javascript">
		   alert("El Número de servicio digitado no existe para este Cliente.!")
		   history.back()
	     </script>
	   <?
	}
 }
?>
</body>
</html>
