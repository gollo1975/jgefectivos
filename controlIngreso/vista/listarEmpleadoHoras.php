<? @session_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control de Ingresos :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
<script type="text/javascript" src="../validar/validar.js"></script>
</head>

<body>
<div id="header">  </div>
<br /><br />
<p>
  <?	if (isset ($_SESSION ["usuario"]))	{	?>

<form id="form1" name="form1" method="post" action="">
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="4" class="titulo">Listado de Horas por Empleado</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="80">&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td height="18">Fecha</td>
      <td>Horas por Dia</td>
      <td width="37">&nbsp;</td>
      <td width="42">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <? 
	$i = 0;
	foreach ($proceso_mi as $listar_mi)	{	
	
		$i++;
	?>
    <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onMouseMove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onMouseOut="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
      <td>&nbsp;<? echo $listar_mi -> fecha;?></td>
      <td>&nbsp;<? echo $listar_mi -> horas;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <? }	?>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
   	</tr>
    <tr>
      <th colspan="4">&nbsp;</th>
    </tr>
    <tr>
      <td colspan="4"><input type="submit" name="button" id="button" value="Aceptar" /></td>
    </tr>
    <tr>
      <th colspan="4">&nbsp;</th>
    </tr>
    <tr>
    	<th colspan="4">&nbsp;</th>
    </tr>
  </table>
</form>
<br />
<br />
<div id="footer"> JG Efectivos S.A.S<br /><br />
Empresa de Servicios Temparales <br><br />
Medellín - Colombia
</div>
<p>&nbsp;</p>
<p>
  <?
	}
	else	{
	?>
  <script language="javascript">
			alert ("Ingreso Incorrecto")
			pagina = '../admon.php'
			tiempo = 10
			ubicacion = '_self'
			setTimeout ("open(pagina, ubicacion)", tiempo)
		</script>
<?
	}
?>
</body>
</html>