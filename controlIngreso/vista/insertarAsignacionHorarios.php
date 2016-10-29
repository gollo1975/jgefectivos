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
<p>
  <?	if (isset ($_SESSION ["usuario"]))	{	?>

<form id="form1" name="form1" method="post" action="../control/procesos.php?opc=114">
  <table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="7" class="titulo">Asignación de Horarios</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7"><a href="../vista/menu.php"><img src="../imagen/retorno.jpg" border="0" /></a></td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td width="39">&nbsp;</td>
      <td width="82">C&eacute;dula</td>
      <td colspan="3">&nbsp;&nbsp;&nbsp;Nombre</td>
      <td width="38">&nbsp;</td>
      <td width="43">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td colspan="3">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <? 
	$i = 0;
	foreach ($proceso_e as $listar_e)	{	
	
		$i++;
	?>
    <tr id="<?php echo "ide_$i";?>" style="background-color:#F0F0F0" onMouseMove="cambiar('<?php echo "ide_$i";?>','#cccccc')" onMouseOut="cambiar('<?php echo "ide_$i";?>','#F0F0F0');">
      <td>&nbsp;
      <input name="cedEmple[]" type="checkbox" id="cedEmple[]" value="<? echo $listar_e -> cedemple;?>" /></td>
      <td align="right"><a href="../control/procesos.php?opc=88&valor=<? echo $listar_e -> cedemple;?>"><? echo number_format($listar_e -> cedemple);?></a></td>
      <td colspan="3">&nbsp;&nbsp;&nbsp;<? echo $listar_e -> nomemple;?>&nbsp;<? echo $listar_e -> nomemple1;?>&nbsp;<? echo $listar_e -> apemple;?>&nbsp;<? echo $listar_e -> apemple1;?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <? }	?>
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
    	<td>&nbsp;</td>
    	<td>Horario</td>
    	<td width="201"><select name="idHorario" id="idHorario">
			<?	foreach ($proceso_h as $listar_h)	{	?>
			
				<option value = "<? echo $listar_h -> idHorario;?>"><? echo $listar_h -> nombreHorario;?>		
			<?	}	?>
  	      </select>    	</td>
    	<td width="49">Periodo</td>
    	<td width="292"><select name="idPeriodo" id="idPeriodo">
			<?	foreach ($proceso_p as $listar_p)	{	?>
			
				<option value = "<? echo $listar_p -> idPeriodo;?>"><? echo $listar_p -> fechaInicio;?>	&nbsp;&nbsp; - &nbsp;&nbsp; <? echo $listar_p -> fechaFinal;?>
			<?	}	?>
                </select></td>
    	<td>&nbsp;</td>
    	<td>&nbsp;</td>
   	</tr>
    <tr>
      <th colspan="7">&nbsp;</th>
    </tr>
    <tr>
      <td colspan="7"><input type="submit" name="Guardar" id="Guardar" value="Guardar" />
      <input type="reset" name="Limpiar" id="Limpiar" value="Limpiar" /></td>
    </tr>
    <tr>
      <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
    	<td colspan="7">&nbsp;</td>
    </tr>
  </table>
</form>
<br />
<br />
<div id="footer"> JG Efectivos S.A.S<br /><br />
Empresa de Servicios Temparales <br><br />
Medellín - Colombia
</div>
<p>&nbsp;</p>
<p>
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
<?
	}
?>
</body>
</html>