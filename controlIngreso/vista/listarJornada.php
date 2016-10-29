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

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="12" class="titulo">Listado de Jornadas</td>
  </tr>
  <tr>
    <td width="80">&nbsp;</td>
    <td width="162">&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="12"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="8">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>C&oacute;digo</td>
    <td>Jornada</td>
    <td width="243" colspan="7">Dias de la Jornada</td>
    <td width="210">Observación</td>
    <td width="37">&nbsp;</td>
    <td width="42">&nbsp;</td>
  </tr>
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>L</td>
    <td>M</td>
    <td>M</td>
    <td>J</td>
    <td>V</td>
    <td>S</td>
    <td>D</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

  <? 
  $i = 0;
  foreach ($proceso_j as $listar_j)	{
  
	  $i++;
  ?>
  <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onMouseMove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onMouseOut="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
    <td>&nbsp;<? echo $listar_j -> idJornada;?></td>
    <td>&nbsp;<? echo $listar_j -> nombreJornada;?></td>
    <td><? echo $listar_j -> dial;?></td>
    <td><? echo $listar_j -> diam;?></td>
    <td><? echo $listar_j ->diaw;?></td>
    <td><? echo $listar_j -> diaj;?></td>
    <td><? echo $listar_j -> diav;?></td>
    <td><? echo $listar_j ->dias;?></td>
    <td><? echo $listar_j -> diad;?></td>
    <td><? echo $listar_j ->observacion;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <? }	?>
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