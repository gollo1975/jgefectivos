<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Centro de Costos</title>
<link href="../estilo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php foreach ($procesoCC as $listarCC)	{?>
<form id="form1" name="form1" method="post" action="procesos.php?opc=5">
  <table width="400" border="0" align="center">
    <tr>
      <td colspan="2"><strong>Modificac&oacute;n de Centro de Costos </strong></td>
    </tr>
    <tr>
      <td width="106">&nbsp;</td>
      <td width="280">&nbsp;</td>
    </tr>
    <tr>
      <td><strong>C&oacute;digo</strong></td>
      <td><input name="codcosto" type="text" id="codcosto" value="<?php echo $listarCC -> codcosto;?>" size="20" maxlength="10" readonly /></td>
    </tr>
    <tr>
      <td><strong>Nombre</strong></td>
      <td><input name="centro" type="text" id="centro" value="<?php echo $listarCC -> centro;?>" size="40" maxlength="60" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><input type="submit" name="Submit" value="Guardar" /></td>
    </tr>
  </table>
</form>
<?php	}	?>
</body>
</html>
