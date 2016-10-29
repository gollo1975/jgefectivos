<? @session_start (); ?>
<html>
	<head>
		<title>Control de Ingresos :: JGEfectivo</title>
        <link rel="stylesheet" type="text/css" href="../formatos/estilos.css" />
		<script type="text/javascript" src="../validar/validar.js"></script>
	</head>
	<body>
		<div id="header">  </div>
		<br /><br />
		<?	if (isset ($_SESSION ["usuario"]))	{	?>

			<table width="250" border="0">
	  			<tr>
	    			<td>&nbsp;<? include ("subMenu.php");	?></td>
  				</tr>
			</table>
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