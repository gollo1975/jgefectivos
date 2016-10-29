<?
 session_start();
?>
<html>

<head>
  <title>CENTRO DE COSTOS GENERALES</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(session_is_registered("xsession")):
	include("../conexion.php");
	$consulta="select * from costo where estado='ACTIVO' order by centro";
	$resultado=mysql_query($consulta)or die ("Consulta incorrecta");
	$registros=mysql_num_rows($resultado);
	if ($registros==0):
		?>
		<script language="javascript">
		alert("No existen Registro en la base de datos ?")
		</script>
		<?
	else:
		?>
		<center><h4><u>Centro de Costos</u></h4></center>
		<form action="GrabarDetalleCentro.php" method="POST" id="inicio">
			<table border="0" align="center">
				<tr>
					<td><b>Zona:</b></td>
					<td colspan=3><select name="CodZona" class="cajas" id="CodZona" style="width: 400px">
					<option value="0">Seleccione la Zona
					<?
					$Sql="select codzona,zona from zona where zona.estado='ACTIVA' and (tiponegociacion='MISIONAL' OR tiponegociacion='MIXTA') order by zona ";
					$Rs=mysql_query($Sql)or die ("Consulta de zona incorrecta");
					while($Rt=mysql_fetch_array($Rs)):
						?>
						<option value="<?echo $Rt["codzona"];?>"> <?echo $Rt["zona"];?>
						<?
					endwhile;
					?></select></td>
				</tr>
                                </table>
                                <table border="0" align="center" width='400'>
				<tr class="cajas">
				<th><b>Item</b></td></th><th><b></b></th><th><b>Código</b></th><th><b>Descripción</b></th><th><b>Estado</b></th>
				</tr>
				<?
				$i=1;
                                  echo ("<input type=\"hidden\" id=\"Total\" name=\"Total\" value=\"" . mysql_num_rows($resultado) . "\">");  ;
				while($filas=mysql_fetch_array($resultado)):
					?>
					<tr class="cajas">
					<th><?echo $i;?></th>
					<?
					echo ("<td><input type=\"checkbox\" id=\"Vector[" . $i . "]\" name=\"Vector[" . $i . "]\" value=\"" . $filas['codcosto'] ."\"></td>");?>
                                         <td><input type="text" value="<?echo $filas["codcosto"];?>" size="10" readonly class="cajas"></td>
                                        <td><input type="text" value="<?echo $filas["centro"];?>" name="Concepto[<? echo $i;?>]"id="Concepto[<? echo $i;?>]"size="33" readonly class="cajas"></td>
                                        <td><input type="text" value="<?echo $filas["estado"];?>" name="Estado[<? echo $i;?>]"id="Estado[<? echo $i;?>]"size="11" readonly class="cajas"></td>
					</tr>
					<?
					$i=$i+1;
				endwhile;
			        ?>
                                <tr><td><br></td></tr>
                                <tr>
                                  <td colspan="10"><input type="submit" name="Crear" value="Enviar" id="Crear" class="boton"></td>
                                <tr>
                         </table>
		</form>
                <?
	endif;
else:
?>
<script language="javascript">
alert("Debe de hacer Inicio de Sección")
pagina='../acceso/agregar.php'
tiempo=10
ubicacion='_self'
setTimeout("open(pagina,ubicacion)",tiempo)
</script>
<?
endif;
?>
</table>
</body>


</html>
