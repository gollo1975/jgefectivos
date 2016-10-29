<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='ImprimirAutorizacion.php?NroAuto=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
                </script>
<input type="hidden" value="<?echo $UsuarioPreparador;?>" name="UsuarioPreparador" id="UsuarioPreparador">
<?
include("../conexion.php");
$Sql = "select count(*) from maestroautorizaciondescuento";
$Rs = mysql_query ($Sql);
$sw = mysql_fetch_row($Rs);
if ($sw[0]>0):
	$consulta = "select max(cast(nroautorizacion as unsigned)) + 1 from maestroautorizaciondescuento";
	$result = mysql_query($consulta) or die ("Fallo en la consulta");
	$IdCarta = mysql_fetch_row($result);
	$NroDcto = str_pad ($IdCarta[0], 7, "0", STR_PAD_LEFT);
else:
	$NroDcto="0000001";
endif;
$UsuarioPreparador= strtoupper($UsuarioPreparador);
$FechaP=date('Y-m-d');
$ConSql="insert into maestroautorizaciondescuento(nroautorizacion,cedemple,empleado,lugarexpedicion,fechaentrega,usuario)
values('$NroDcto','$Documento','$Trabajador','$LugarExpedicion','$FechaP','$UsuarioPreparador')";
$RsI=mysql_query($ConSql)or die("Error al grabar el maestro de la Tabla.");
$registro=mysql_affected_rows();
echo "<script language=\"javascript\">";
echo ("open (\"ImprimirAutorizacion.php?NroAuto=$NroDcto\" ,\"\");");
echo "</script>";
?>
<script language="javascript">
open("AutorizacionDescuento.php?UsuarioPreparador=<?echo $UsuarioPreparador;?>","_self");
</script>
<?

