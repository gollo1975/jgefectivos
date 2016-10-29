<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestor Documental :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css" />
<script type="text/javascript" src="../validar.js"></script>
</head>

<body onload="inicioRol ()">

<div id="header">  </div>
<br /><br />
  
<form id="form1" name="form1" method="post" action="procesos.php?opc=2" onsubmit = "return validarRol ()">
  <table width="550" border="0" align="center">
    <tr>
      <td colspan="8" class="titulo"><strong>Consulta de Empleados </strong></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="350" colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><a href="../Vista/menu.php"></a></td>
    </tr>
    <tr>
      <td width="166">&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td>Campo de Consulta   (<b class="obligatorios">*</b>)</td>
      <td colspan="7"><select name="campo" id="campo">
        <option value="cedemple">Cédula</option>
        <option value="nomemple">Primer Nombre</option>
        <option value="zona">Empresa</option>
        <option value="municipio">Municipio</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td>Valor de Consulta  (<b class="obligatorios">*</b>) </td>
      <td colspan="7"><input name="valor" type="text" id="valor" size="50" maxlength="40" /></td>
    </tr>
    <tr>
      <td width="166">&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><input type="submit" name="Almacenar" id="Almacenar" value="Consultar" />
      &nbsp;&nbsp;
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
</body>
</html>