
<?
include("../conexion.php");
/*consulta que permite actualizar saldo*/
$descripcion=strtoupper($descripcion);
$conA="update detalladoparametroexamenzona set concepto='$descripcion',estado='$Estado' where detalladoparametroexamenzona.codigo='$Codigo'";
$resuA=mysql_query($conA) or die("Actualizacion de examen  ");
$registros=mysql_affected_rows();
   ?>
    <script language="javascript">
        open("EditarParametro.php?IdZona=<?echo $IdZona;?>","_self")
    </script>
<?
?>
