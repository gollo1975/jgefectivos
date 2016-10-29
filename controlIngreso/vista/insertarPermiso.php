<? @session_start (); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Control de Ingresos :: JGEfectivo</title>
<link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
<script type="text/javascript" src="../validar/validar.js"></script>
</head>

<body>
<div id="header">  </div>
<br /><br />
<?	if (isset ($_SESSION ["usuario"]))	{	?>

<form id="form1" name="form1" method="post" action="../control/procesos.php?opc=52">
  <table width="550" border="0" align="center">
    <tr>
      <td colspan="8" class="titulo">Ingreso de Permisos</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="350" colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
    </tr>
    <tr>
      <td width="166">&nbsp;</td>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td>Empresa</td>
      <td colspan="7">Opcion</td>
    </tr>
    <tr>
      <td><select name="nitzona" id="nitzona">
        <? foreach ($proceso_z as $listar_z)	{	?>
		
        <option value ="<? echo $listar_z -> nitzona;?>"><? echo $listar_z -> zona;?>
          <?	}	?>
          </option>
      </select></td>
      <td colspan="7"><select name="idSubMenu" id="idSubMenu">
        <? foreach ($proceso_s as $listar_s)	{	?>
		
        <option value ="<? echo $listar_s -> idSubMenu;?>"><? echo $listar_s -> nombreSubMenu;?>
          <?	}	?>
          </option>
      </select></td>
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