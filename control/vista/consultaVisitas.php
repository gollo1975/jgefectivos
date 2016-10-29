<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="../control/fachada.php?opc=70">
  <table width="500" border="0" align="center">
    <tr>
      <th colspan="2">Consulta General de Visitas </th>
    </tr>
    <tr>
      <td width="115">&nbsp;</td>
      <td width="375">&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2">Retornar</th>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Consulta Por </td>
      <td><select name="campo" id="campo">
        <option value="identificacion">C&eacute;dula</option>
        <option value="nombre">nombre</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Valor</td>
      <td><input name="valor" type="text" id="valor" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th colspan="2"><input type="submit" name="Submit" value="Almacenar" />
      &nbsp;&nbsp;
      <input type="submit" name="Submit2" value="Restablecer" /></th>
    </tr>
  </table>
</form>
</body>
</html>
