<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimeconveniodepto.php?codigo=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
include("../conexion.php");
$consulta="update convenio set cedemple='$cedula',nombres='$cliente',tipo='$tipo',descripcion='$nota' where nroconvenio='$nro'";
$resultado=mysql_query($consulta)or die("Error al actualizar datos del convenio");
$registro=mysql_affected_rows();
echo ("<script language=\"javascript\">");
echo ("open (\"imprimeconveniodepto.php?codigo=$nro\" ,\"\");");
echo ("</script>");
?>
<script language="javascript">
open("ModificarConvenioCartadepto.php","_self");
</script>
