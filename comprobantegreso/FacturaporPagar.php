<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Facturas por Pagar</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
<script type="text/javascript" src="../validar.js"></script>
</head>

<body>

<table width="950" border="0" align="center">
  <tr>
    <td colspan="9"><strong>Facturas por Pagar </strong></td>
  </tr>
  <tr>
    <td width="73">&nbsp;</td>
    <td width="330">&nbsp;</td>
    <td width="93">&nbsp;</td>
    <td width="108">&nbsp;</td>
    <td width="82">&nbsp;</td>
    <td width="75">&nbsp;</td>
    <td width="74">&nbsp;</td>
    <td width="77">&nbsp;</td>
    <td width="77">&nbsp;</td>
  </tr>
  <tr>
    <td class="informacion"><strong>Nro Factura </strong></td>
    <td><strong>Provedor</strong></td>
    <td> <strong>Inicio </strong></td>
    <td><strong>Vencimiento</strong></td>
    <td class="informacion"><strong>SubTotal</strong></td>
    <td class="informacion"><strong>Iva</strong></td>
    <td class="informacion"><strong>Retenci&oacute;n</strong></td>
    <td class="informacion"><strong>Total</strong></td>
    <td class="informacion"><strong>Tipo Factura </strong></td>
  </tr>
<?php
	include("../conexion.php");
	$consulta = "select pagar.nrofactura, pagar.nitprove, provedor.nomprove, pagar.fechaini, pagar.fechaven, pagar.subtotal, pagar.baserfte, pagar.ivapagado, pagar.total, pagar.tipofactura from pagar inner join provedor on pagar.nitprove = provedor.nitprove where saldo > 0 order by pagar.fechaven asc";
	$resultado = mysql_query ($consulta);
	$registros = mysql_num_rows ($resultado);
	if ($registros == 0)
	
		echo "<script type='text/javascript'> alert ('No Existen Facturas'); history.back (); </script>";
	else	{	
	
			$i = 0;
			while ($reg = mysql_fetch_array ($resultado))	{ 
			
				$i++;
?>
  <tr  id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onmousemove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onmouseout="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td align="left">&nbsp;<?php echo $reg ["nrofactura"];?></td>
    <td>&nbsp;<?php echo $reg ["nomprove"];?></td>
    <td>&nbsp;<?php echo $reg ["fechaini"];?></td>
    <td>&nbsp;<?php echo $reg ["fechaven"];?></td>
    <td class="informacion">&nbsp;<?php echo number_format($reg ["subtotal"], 2);?></td>
    <td class="informacion">&nbsp;<?php echo number_format($reg ["ivapagado"],2);?></td>
    <td class="informacion">&nbsp;<?php echo number_format($reg ["baserfte"],2);?></td>
    <td class="informacion">&nbsp;<?php echo number_format($reg ["total"],2);?></td>
    <td align="left"><?php echo $reg ["tipofactura"];?></td>
  </tr>
  <?php 
  			}
		}
	?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>
