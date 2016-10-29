<html>

<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?php
/*inicio codigo*/
include("../conexion.php");
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
/*fin codigo*/
$Sql="select zonacosto.* FROM zonacosto,zona WHERE
zonacosto.codzona=zona.codzona and
zonacosto.desde='$Desde' and
zonacosto.hasta='$Hasta' and
zona.codzona='$CodZona' and
zonacosto.facturado='NO' order by zonacosto.centro DESC";
$Rs=mysql_query($Sql) or die("Error al buscar centro de costos.");
$Cont=mysql_num_rows($Rs);
if($Cont != 0){?>
      <center><h4><u>FACTURACION X CENTRO DE COSTO</u></h4></center>
      <form action="FacturaCentroCosto.php" method="post" id="f1" name="f1">
                <input type="hidden" name="TipoVlr" value="<?echo $TipoVlr;?>" id="TipoVlr">
                <input type="hidden" name="CodZona" value="<?echo $CodZona;?>" id="CodZona">
                 <input type="hidden" name="Desde" value="<?echo $Desde;?>" id="Desde">
                 <input type="hidden" name="Hasta" value="<?echo $Hasta;?>" id="Hasta">
                 <input type="hidden" name="IvaFacturado" value="<?echo $IvaFacturado;?>" id="IvaFacturado">
                 <input type="hidden" name="Zona" value="<?echo $Zona;?>" id="Zona" size="60">
                 <input type="hidden" name="AplicaIva" value="<?echo $AplicaIva;?>" id="AplicaIva">
                 <input type="hidden" name="TipoFactura" value="<?echo $TipoFactura;?>" id="TipoFactura">
                  <input type="hidden" name="TipoBaseVenta" value="<?echo $TipoBaseVenta;?>" id="TipoBaseVenta">

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
				<td><b>Ajuste Factura:</b></td>
                                <td><input type="radio" value="NO" checked name="AjusteFacturaCentro">NO<input type="radio" value="SI"  name="AjusteFacturaCentro">SI</td>
                        </tr>
                        	<tr>
				<td><b>Valor_Ajuste:</b></td>
		       		<td><input type="text" name="ValorAjusteCentro" value="0" size="11" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="ValorAjusteCentro"></td>
			</tr>
                        <table border="0" align="center" width="350">
	                 <tr class="cajas">
		         	<th><b>Item</b></td><th></th><th>Código</th><th><b>Concepto</b></td>
	                 </tr>
		            <?
		            $i=1;
		                   echo ("<input type=\"hidden\" id=\"Total\" name=\"Total\" value=\"" . mysql_num_rows($Rs) . "\">");  ;
		            while($Registro=mysql_fetch_array($Rs)){
		                 $CodCostoInicio = $Registro["codigocosto"];
		                 $SqlCosto="select zonacosto.codcosto from zonacosto
		   			 where zonacosto.codcosto='$CodCostoInicio' and
		                              zonacosto.codzona='$CodZona' and
                                              zonacosto.desde='$Desde' and
                                              zonacosto.hasta='$Hasta' and
                                              zonacosto.facturado='NO'";
				 $RsCosto=mysql_query($SqlCosto) or die("Error al buscar el codigo de costo en la zona costo.");
		                 $Cont = mysql_num_rows($RsCosto);
		                 if($Cont==0){
			                  ?>
			                  <tr class="cajas">
				               <th><?echo $i;?></th>
		                               <?
			                       echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $Registro['codcosto'] ."\"\"></td>");?>
					       <td class="cajas"><input type="text" value="<?echo $Registro["codcosto"];?>" size="10" readonly class="cajas"></td>
					       <td class="cajas"><input type="text" value="<?echo $Registro["centro"];?>" size="35" readonly class="cajas"></td>
		                         </tr>
		                          <?
		                 }
		                 $i +=1;
		            }
	                    ?>
	                    <tr><td><br></td></tr>
	                    <tr>
	                       <td colspan="5"><input type="submit" value="Generar" class="boton" id="Generar" name="Generar"></td>
	                    </tr>
                 </table>
      </form>
      <?
}else{
     ?>
	<script language="javascript">
	      alert ("Esta Empresa no tiene centro de costo creado para la facturación.!")
	      history.back()
	</script>
     <?
}
?>
</body>
</html>
