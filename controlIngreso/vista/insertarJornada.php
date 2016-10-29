<? @session_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control de Ingresos :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
<script type="text/javascript" src="../validar/validar.js"></script>
</head>

<body onload="inicioJornada ()">
<div id="header">  </div>
<br /><br />
<?	if (isset ($_SESSION ["usuario"]))	{	?>

<form id="form1" name="form1" method="post" action="../control/procesos.php?opc=2" onsubmit = "return validarJornada ()">
  <table width="550" border="0" align="center">
    <tr>
      <td colspan="8" class="titulo">Ingreso de Jornadas</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
    </tr>
    <tr>
      <td width="166">&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td>Nombre de la Jornada (<b class="obligatorios">*</b>) </td>
      <td colspan="7"><input name="nombreJornada" type="text" id="nombreJornada" size="50" maxlength="50" onkeypress="return sololetras(event)" /></td>
    </tr>
    <tr>
      <td width="166">Dias (<b class="obligatorios">*</b>) </td>
      <td width="50">L</td>
      <td width="50">M</td>
      <td width="50">M</td>
      <td width="50">J</td>
      <td width="50">V</td>
      <td width="50">S</td>
      <td width="50">D</td>
    </tr>
    <tr>
      <td valign="top">&nbsp;</td>
      <td><input name="dial" type="checkbox" id="dial" value="S" /></td>
      <td><input name="diam" type="checkbox" id="diam" value="S" /></td>
      <td><input name="diaw" type="checkbox" id="diaw" value="S" /></td>
      <td><input name="diaj" type="checkbox" id="diaj" value="S" /></td>
      <td><input name="diav" type="checkbox" id="diav" value="S" /></td>
      <td><input name="dias" type="checkbox" id="dias" value="S" /></td>
      <td><input name="diad" type="checkbox" id="diad" value="S" /></td>
    </tr>
    <tr>
      <td valign="top">Observación</td>
      <td colspan="7"><textarea name="observacion" id="observacion" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td width="166">&nbsp;</td>
      <td colspan="7">&nbsp;</td>
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