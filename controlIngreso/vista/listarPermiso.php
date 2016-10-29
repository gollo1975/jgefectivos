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
<?	if (isset ($_SESSION ["usuario"]))	{	?>

<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" class="titulo">Listado de Permisos</td>
  </tr>
  <tr>
    <td width="61">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Nit</td>
    <td width="383">&nbsp;&nbsp;&nbsp;Zona</td>
    <td width="221">Permiso</td>
    <td width="37">&nbsp;</td>
    <td width="42">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <? 
  $i = 0;
  foreach ($proceso_p as $listar_p)	{
  
	  $i++;
  ?>
  <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onMouseMove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onMouseOut="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td align="right">&nbsp;<? echo $listar_p -> idPermiso;?></td>
    <td>&nbsp;&nbsp;&nbsp;<? echo $listar_p -> zona;?></td>
    <td><? echo $listar_p -> nombreSubMenu;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? }	?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<br />
<br />
<div id="footer"> JG Efectivos S.A.S<br /><br />
Empresa de Servicios Temparales <br><br />
Medellín - Colombia
</div>
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
<?	}	?>
</body>
</html>