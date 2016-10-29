<html>
<head>
<title>Edicion del Registro</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
include("../conexion.php");
$Sql="select detalladoparametrocentrocosto.* FROM parametrocentrocosto,zona,detalladoparametrocentrocosto WHERE
        detalladoparametrocentrocosto.nroparametro=parametrocentrocosto.nroparametro and
	parametrocentrocosto.codzona=zona.codzona and
	zona.codzona='$CodZona' order by detalladoparametrocentrocosto.concepto";
$Rs=mysql_query($Sql) or die("Error al buscar centro de costos.");
$Cont=mysql_num_rows($Rs);
if ($Cont==0){
	?>
	<script language="javascript">
	alert("Esta Empresa no tiene centro de costos creados para facturacion.!")
	history.back()
	</script>
	<?
}else{
    ?>
    <div align="center"><b>CENTRO DE COSTOS X EMPRESA</b></div>
     <tr><td><br></td></tr>
    <form action="" method="post">
        <table border="0" align="center" width="350">
            <tr class="cajas">
		<th><b>Item</b></td><th></th><th>Código</th><th><b>Concepto</b></td><th><b>Estado</b></td>
            </tr>
            <?
            $i=1;
            while($Registro=mysql_fetch_array($Rs)){
                 $NroParametro = $Registro["nroparametro"];
                  ?>
                  <tr class="cajas">
	               <th><?echo $i;?></th>
                       <td>&nbsp;<a href="EditarDetalle.php?CodZona=<?echo $CodZona;?>&Codigo=<?echo $Registro["id"];?>&Estado=<?echo $Registro["estado"];?>"><img src="../image/mod.jpg" border="0" alt="Modificar Registro"></a></td>
		       <td class="cajas"><input type="text" value="<?echo $Registro["codigocosto"];?>" size="10" readonly class="cajas"></td>
		       <td class="cajas"><input type="text" value="<?echo $Registro["concepto"];?>" size="35" readonly class="cajas"></td>
                       <td class="cajas"><input type="text" value="<?echo $Registro["estado"];?>" size="12" readonly class="cajas"></td>
                   </tr>
                   <?
                   $i +=1;
            }
            ?>
        </table>
    </form>
    <form action="AdicionarCentro.php" method="post" id="inicio" name="inicio">
    <input type="hidden" name="NroParametro" value="<?echo $NroParametro;?>" id="NroParametro">
    <input type="hidden" name="CodZona" value="<?echo $CodZona;?>" id="CodZona">
        <table border="0" align="center" width="350">
            <tr class="cajas">
                <td><b>Centro_Costo:</b></td>
					<td colspan=3><select name="CodCosto" class="cajas" id="CodCosto" style="width: 400px">
					<option value="0">Seleccione el centro
					<?
					$SqlCosto="select codcosto,centro from costo where costo.estado='ACTIVO' order by centro ";
					$RsCosto=mysql_query($SqlCosto)or die ("Consulta de costos incorrecta");
					while($RtCosto=mysql_fetch_array($RsCosto)):
						?>
						<option value="<?echo $RtCosto["codcosto"];?>"> <?echo $RtCosto["centro"];?>
						<?
					endwhile;
					?></select></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
              <td colspan="10"><input type="submit" name="Crear" value="Crear" id="Crear" class="boton"></td>
            <tr>
        </table>
    </form>
     <tr>&nbsp;</td>
  <div align="center"><a href="EdicionCentroCosto.php"><img src="../image/regresar.png" border="0" title="Regresar al menu"></div>
<?
}
?>
</body>
</html>
