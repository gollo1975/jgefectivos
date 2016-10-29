<? @session_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Control de Ingresos :: JGEfectivo</title>
	<link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
	<script type="text/javascript" src="../validar/validar.js"></script>
	
	<script type="text/javascript" src="../validar/calendar.js"></script>
</head>

<body onload="inicioAusencia()">
<div id="calendarDiv"></div>
<div id="header">  </div>
<br /><br />
<?	if (isset ($_SESSION ["usuario"]))	{	?>

<form id="form1" name="form1" method="post" action="../control/procesos.php?opc=112" onsubmit = "return validarAusencia ()">
  <table width="550" border="0" align="center">
    <tr>
      <td colspan="8" class="titulo">Ingreso de Periodos de Pago </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="349" colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><a href="../vista/menu.php" target="_self"><img src="../imagen/retorno.jpg" border="0" /> </a></td>
    </tr>
    <tr>
      <td width="185">&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td>Fecha Inicio </td>
      <td colspan="7"><input name="fechaInicio" type="text" class="calendarSelectDate" id="fechaInicio"  size="20" maxlength="10" />&nbsp;<b class="textoEjemplo">"2013-01-30"</b></td>
    </tr>
    <tr>
      <td>Fecha Terminación </td>
      <td colspan="7"><input name="fechaFinal" type="text" id="fechaFinal" size="20" maxlength="10" class="calendarSelectDate" />&nbsp;<b class="textoEjemplo">"2013-02-05"</b></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><input type="submit" name="Almacenar" id="Almacenar" value="Almacenar" />&nbsp;&nbsp;
      <input type="reset" name="Restablecer" id="Restablecer" value="Restablecer" /></td>
    </tr>
    <tr>
      <td colspan="8">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8">(*) Campo Obligatorio </td>
    </tr>
  </table>
  <div id="calendarDiv"></div>
</form>
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