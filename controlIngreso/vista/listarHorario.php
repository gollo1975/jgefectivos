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

<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="5" class="titulo">Listado de Horarios Por Jornada</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="80">&nbsp;</td>
    <td width="213">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="58">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>C&oacute;digo</td>
    <td>Nombre Horario</td>
    <td width="154">Observación</td>
    <td width="173">Jornada</td>
    <td>&nbsp;</td>
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
  foreach ($proceso_h as $listar_h)	{
  
	  $i++;
  ?>
  <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onMouseMove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onMouseOut="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td>&nbsp;<? echo $listar_h -> idHorario;?></td>
    <td>&nbsp;<? echo $listar_h -> nombreHorario;?></td>
    <td><? echo $listar_h -> observacion;?></td>
    <td><? echo $listar_h -> nombreJornada;?></td>
    <td>&nbsp;</td>
  </tr>
  <? }	?>
    <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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