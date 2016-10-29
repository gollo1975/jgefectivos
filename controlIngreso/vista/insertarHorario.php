<? @session_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control de Ingresos :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
<script type="text/javascript" src="../validar/validar.js"></script>
</head>

<body onload="inicioHorario()">
<div id="header">  </div>
<br /><br />
<?	if (isset ($_SESSION ["usuario"]))	{	?>

<form id="form1" name="form1" method="post" action="../control/procesos.php?opc=22" onsubmit = "return validarHorario ()" >
  <table width="650" border="0" align="center">
    <tr>
      <td colspan="4" class="titulo">Ingreso de Horarios</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
    </tr>
    <tr>
      <td width="173">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Jornada (<b class="obligatorios">*</b>)</td>
      <td colspan="3"><select name="idJornada" id="idJornada">
      <?	foreach ($proceso_j as $listar_j)	{?>
      
      	<option value="<? echo $listar_j -> idJornada;?>"><? echo $listar_j -> nombreJornada;?>
      <?	}?>
      </select></td>
    </tr>
    <tr>
      <td valign="top">Nombre Horario (<b class="obligatorios">*</b>)</td>
      <td colspan="3"><input name="nombreHorario" type="text" id="nombreHorario" size="50" maxlength="50" onkeypress="return sololetras(event)" /></td>
    </tr>
    <tr>
      <td valign="top">Hora Inicio (<b class="obligatorios">*</b>)</td>
      <td width="183"><input name="horarioInicial" type="text" id="horarioInicial" size="20" maxlength="10" />
      &nbsp;<b class="textoEjemplo">"10:15"</b> </td>
      <td width="137">Tipo</td>
      <td width="139"><select name="idTipoI" id="idTipoI">
      <?	foreach ($proceso_ti as $listar_ti)	{?>
      
      	<option value="<? echo $listar_ti -> idTipo;?>"><? echo $listar_ti -> nombreTipo;?>
      <?	}?>
      </select></td>
    </tr>
    <tr>
      <td valign="top">Hora Fin (<b class="obligatorios">*</b>)</td>
      <td><input name="horarioFinal" type="text" id="horarioFinal" size="20" maxlength="10" />
      &nbsp;<b class="textoEjemplo">"15:30"</b></td>
      <td>Tipo</td>
      <td><select name="idTipoF" id="idTipoF">
      <?	foreach ($proceso_tf as $listar_tf)	{?>
      
      	<option value="<? echo $listar_tf -> idTipo;?>"><? echo $listar_tf -> nombreTipo;?>
      <?	}?>
      </select></td>
    </tr>
    <tr>
      <td valign="top">Observación</td>
      <td colspan="3"><textarea name="observacion" id="observacion" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td width="173">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><input type="submit" name="Almacenar" id="Almacenar" value="Almacenar" />&nbsp;&nbsp;
      <input type="submit" name="Restablecer" id="Restablecer" value="Restablecer" /></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4">(*) Campo Obligatorio </td>
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