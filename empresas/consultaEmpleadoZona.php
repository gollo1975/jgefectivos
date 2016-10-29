<?php session_start ();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Gestor Documental :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../estilo.css" />
<script type="text/javascript" src="../validar/validar.js"></script>
</head>

<body onload="inicioRol ()">

<div id="header">  </div>
<br /><br />
  
<form id="form1" name="form1" method="post" action="procesos.php?opc=48" onsubmit = "return validarRol ()">
  <table width="550" border="0" align="center">
    <tr>
      <th colspan="8" class="titulo"><div align="center"><strong>Consulta de Empleados </strong></div></th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="350" colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><a href="../menuzona.php"></a></td>
    </tr>
    <tr>
      <td width="166">&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td><b>Campo de Consulta:</b>   (<b class="obligatorios">*</b>)</td>
      <td colspan="7"><select name="campo" id="campo">
        <option value="cedemple">Cédula</option>
        <option value="nomemple">Primer Nombre</option>
        <option value="nomemple1">Segundo Nombre</option>
        <option value="apemple">Primer Apellido</option>
        <option value="apemple1">Segundo Apellido</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td><b>Valor de Consulta:</b>  (<b class="obligatorios">*</b>) </td>
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
<div id="footer"></div>
</body>
</html>
