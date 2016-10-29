<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../formato/estilo.css" />
<title>Documento sin t&iacute;tulo</title>
</head>

<body>
<table width="500" border="0" align="center">
  <tr>
    <th colspan="4">Listado General de Areas </th>
  </tr>
  <tr>
    <td width="53">&nbsp;</td>
    <td width="310">&nbsp;</td>
    <td width="58">&nbsp;</td>
    <td width="61">&nbsp;</td>
  </tr>
  <tr>
    <th colspan="4">Retornar</th>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>C&oacute;digo</td>
    <td>Area</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php foreach ($procesoDependencia as $listarDependencia)	{	?>
  <tr>
    <td>&nbsp;<?php echo $listarDependencia -> idDependencia;?></td>
    <td>&nbsp;<?php echo $listarDependencia -> nombreDependencia;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php 	}	?>
</table>
</body>
</html>
