<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="../control/fachada.php?opc=14">
  <table width="700" border="0" align="center">
    <tr>
      <th colspan="4">Registro de Visitantes</th>
    </tr>
    <tr>
      <td width="130">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="4">Retornar</th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td>Identificaci&oacute;n</td>
      <td width="186"><input name="identificacion" type="text" value="<?php echo $_REQUEST["identificacion"];?>" id="identificacion" size="20" maxlength="10" readonly /></td>
      <td width="98">Nombre</td>
      <td width="268"><input name="nombre" type="text"  value="<?php echo $_REQUEST["nombre"];?>" id="nombre" size="40" maxlength="50" /></td>
    </tr>
    <tr>
      <td valign="top">Area</td>
      <td>	<select name="idDependencia" id="idDependencia">
	  		<?php foreach ($procesoDependencia as $listarDependencia)	{	?>
			
				<option value="<?php echo $listarDependencia -> idDependencia;?>"><?php echo $listarDependencia -> nombreDependencia;?>
			<?php	}	?>
      </select>      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">Motivo</td>
      <td colspan="3"><textarea name="motivo" cols="50" rows="5" id="motivo"></textarea></td>
    </tr>
    <tr>
      <td>C&oacute;digo Visita </td>
      <td colspan="3"><input name="codigoVisitante" type="text" id="codigoVisitante" size="10" maxlength="5" /></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="4"><input type="submit" name="Submit" value="Almacenar" />&nbsp;&nbsp;
      <input type="submit" name="Submit2" value="Restablecer" /></th>
    </tr>
  </table>
</form>
</body>
</html>
