<?
include("../conexion.php");
$con="insert into detalladoparametroexamenzona (idexamen,concepto,codzona) values('$Codigo','$descripcion','$IdZona')";
$resultado=mysql_query($con) or die("Error al grabar registros  ");
$registros=mysql_affected_rows();
   ?>
    <script language="javascript">
        open("EditarParametro.php?IdZona=<?echo $IdZona;?>","_self")
    </script>
<?
?>
