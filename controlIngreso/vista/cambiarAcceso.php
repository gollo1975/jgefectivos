<? @session_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Control de Ingresos :: JGEfectivo</title>
	<link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
	<script type="text/javascript" src="../validar/validar.js"></script>
</head>

<body onload="inicioAcceso()">
<div id="header">  </div>
<br /><br />
<?	if (isset ($_SESSION ["usuario"]))	{	?>

<form id="form1" name="form1" method="post" action="../control/procesos.php?opc=122" onsubmit = "return validarAcceso ()">
  <table width="550" border="0" align="center">
    <tr>
      <td colspan="8" class="titulo">Cambio de Contraseña </td>
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
      <td>Usuario (<b class="obligatorios">*</b>)</td>
      <td colspan="7"><input name="usuario" type="text" id="usuario" value="<? echo $_SESSION["usuario"]?>" readonly /></td>
    </tr>
    <tr>
      <td>Contraseña (<b class="obligatorios">*</b>)</td>
      <td colspan="7"><input name="contrasena" type="password" id="contrasena" /></td>
    </tr>
    <tr>
      <td>Contrasena Nueva (<b class="obligatorios">*</b>)</td>
      <td colspan="7"><input name="contrasenaNueva" type="password" id="contrasenaNueva" /></td>
    </tr>
    <tr>
      <td>Confirmación Contraseña (<b class="obligatorios">*</b>)</td>
      <td colspan="7"><input name="contrasenaConfirmacion" type="password" id="contrasenaConfirmacion" /></td>
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